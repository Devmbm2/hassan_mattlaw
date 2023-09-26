<?php
require_once('modules/Emails/EmailUI.php');
require_once('modules/Emails/Email.php');
require_once('modules/InboundEmail/InboundEmail.php');

class CacheEmails{
	function import_emails() {		
		global $db;
		
		$ieBoxes = array();
		
		$sql = "SELECT ie_id, mbox, msgno, imap_uid FROM email_cache WHERE deleted='0' AND transfered='0' AND ie_id IN (SELECT id FROM inbound_email WHERE deleted='0' AND status='Active') order by senddate desc LIMIT 0, 100";
		$res = $db->query($sql);
		while($row = $db->fetchByAssoc($res)) {
			if(!isset($ieBoxes[$row['ie_id']])){
				$ieBoxes[$row['ie_id']] = array();
			}
			
			if(!isset($ieBoxes[$row['ie_id']][$row['mbox']])){
				$ieBoxes[$row['ie_id']][$row['mbox']] = array();
			}
			
			$ieBoxes[$row['ie_id']][$row['mbox']][] = array(
				'msgno' => $row['msgno'],										
				'imap_uid' => $row['imap_uid'], 
			);
		}
		foreach($ieBoxes as $ieid => $mboxes){
				$ieX = new InboundEmail();
				$ieX->retrieve($ieid);
				
				//looping through mail boxes inbox, sent etc
				foreach($mboxes as $mbox => $emails) {
					$ieX->mailbox = $mbox;
					
					if($ieX->connectMailserver()){
						$GLOBALS['log']->fatal("Import user Email scheduler connected to mail server id: {$ieid} ");
											
						//Importing emails
						foreach($emails as $email){
						
							//$db->query("UPDATE email_cache SET transfered='1' WHERE ie_id='" . $ieid . "' AND imap_uid='" . $email['imap_uid'] . "'");			
							if(CacheEmails::importOneEmail($ieX,$email['msgno'], $email['imap_uid'], false,true,false)){
									
							}
							else
							{
								$db->query("UPDATE email_cache SET transfered='0' WHERE ie_id='" . $ieid . "' AND imap_uid='" . $email['imap_uid'] . "'");
							}
						}
					}else{
						$GLOBALS['log']->fatal("Import user Email scheduler cannot connect to mail server id: {$ieid} ");
					}
					
					imap_expunge($ieX->conn);
					imap_close($ieX->conn);					
				}				
		}
		
		return true;
	}
	//replication of importOneEmail
	function importOneEmail($inbound_email_obj,$msgNo, $uid, $forDisplay=false, $clean_email=true, $delete_cache=true) {
		$that=$inbound_email_obj;
		$GLOBALS['log']->debug("InboundEmail processing 1 email {$msgNo}-----------------------------------------------------------------------------------------");
		global $timedate;
		global $app_strings;
		global $app_list_strings;
		global $sugar_config;
		global $current_user;

        // Bug # 45477
        // So, on older versions of PHP (PHP VERSION < 5.3),
        // calling imap_headerinfo and imap_fetchheader can cause a buffer overflow for exteremly large headers,
        // This leads to the remaining messages not being read because Sugar crashes everytime it tries to read the headers.
        // The workaround is to mark a message as read before making trying to read the header of the msg in question
        // This forces this message not be read again, and we can continue processing remaining msgs.

        // UNCOMMENT THIS IF YOU HAVE THIS PROBLEM!  See notes on Bug # 45477
        // $that->markEmails($uid, "read");

		$header = imap_headerinfo($that->conn, $msgNo);
		$fullHeader = imap_fetchheader($that->conn, $msgNo); // raw headers
		// reset inline images cache
		$that->inlineImages = array();
		if($delete_cache){
			// handle messages deleted on server
			if(empty($header)) {
				if(!isset($that->email) || empty($that->email)) {
					$that->email = new Email();
				}

				$q = "";
				if ($that->isPop3Protocol()) {
					$that->email->name = $app_strings['LBL_EMAIL_ERROR_MESSAGE_DELETED'];
					$q = "DELETE FROM email_cache WHERE message_id = '{$uid}' AND ie_id = '{$that->id}' AND mbox = '{$that->mailbox}'";
				} else {
					$that->email->name = $app_strings['LBL_EMAIL_ERROR_IMAP_MESSAGE_DELETED'];
					$q = "DELETE FROM email_cache WHERE imap_uid = {$uid} AND ie_id = '{$that->id}' AND mbox = '{$that->mailbox}'";
				} // else
				// delete local cache
				$r = $that->db->query($q);

				$that->email->date_sent = $timedate->nowDb();
				return false;
				//return "Message deleted from server.";
			} 
		}
		///////////////////////////////////////////////////////////////////////
		////	DUPLICATE CHECK
		$dupeCheckResult = $that->importDupeCheck($header->message_id, $header, $fullHeader);
		if($forDisplay || $dupeCheckResult) {
			$GLOBALS['log']->debug('*********** NO duplicate found, continuing with processing.');

			$structure = imap_fetchstructure($that->conn, $msgNo); // map of email

			///////////////////////////////////////////////////////////////////
			////	CREATE SEED EMAIL OBJECT
			$email = new Email();
			$email->isDuplicate = ($dupeCheckResult) ? false : true;
			$email->mailbox_id = $that->id;
			$message = array();
			$email->id = create_guid();
			$email->new_with_id = true; //forcing a GUID here to prevent double saves.
			////	END CREATE SEED EMAIL
			///////////////////////////////////////////////////////////////////

			///////////////////////////////////////////////////////////////////
			////	PREP SYSTEM USER
			if(empty($current_user)) {
				// I-E runs as admin, get admin prefs

				$current_user = new User();
				$current_user->getSystemUser();
			}
			$tPref = $current_user->getUserDateTimePreferences();
			////	END USER PREP
			///////////////////////////////////////////////////////////////////
            if(!empty($header->date)) {
			    $unixHeaderDate = $timedate->fromString($header->date);
            }
			///////////////////////////////////////////////////////////////////
			////	HANDLE EMAIL ATTACHEMENTS OR HTML TEXT
			////	Inline images require that I-E handle attachments before body text
			// parts defines attachments - be mindful of .html being interpreted as an attachment
			if($structure->type == 1 && !empty($structure->parts)) {
				$GLOBALS['log']->debug('InboundEmail found multipart email - saving attachments if found.');
				$that->saveAttachments($msgNo, $structure->parts, $email->id, 0, $forDisplay);
			} elseif($structure->type == 0) {
				$uuemail = ($that->isUuencode($email->description)) ? true : false;
				/*
				 * UUEncoded attachments - legacy, but still have to deal with it
				 * format:
				 * begin 777 filename.txt
				 * UUENCODE
				 *
				 * end
				 */
				// set body to the filtered one
				
							
				if($uuemail) {
					$email->description = $that->handleUUEncodedEmailBody($email->description, $email->id);
					$email->retrieve($email->id);
			   		$email->save();
		   		}
			} else {
				if($that->port != 110) {
					$GLOBALS['log']->debug('InboundEmail found a multi-part email (id:'.$msgNo.') with no child parts to parse.');
				}
			}
			////	END HANDLE EMAIL ATTACHEMENTS OR HTML TEXT
			///////////////////////////////////////////////////////////////////

			///////////////////////////////////////////////////////////////////
			////	ASSIGN APPROPRIATE ATTRIBUTES TO NEW EMAIL OBJECT
			// handle UTF-8/charset encoding in the ***headers***
			global $db;
			$email->name			= $that->handleMimeHeaderDecode($header->subject);
			$email->date_start = (!empty($unixHeaderDate)) ? $timedate->asUserDate($unixHeaderDate) : "";
			$email->time_start = (!empty($unixHeaderDate)) ? $timedate->asUserTime($unixHeaderDate) : "";
			$email->type = 'inbound';
			$email->date_created = (!empty($unixHeaderDate)) ? $timedate->asUser($unixHeaderDate) : "";
			$email->status = 'unread'; // this is used in Contacts' Emails SubPanel
			
			if(preg_match('/Sent/i',$that->mailbox)){
				$email->type = 'out';
				$email->status = 'sent';
			
			}

			if(!empty($header->toaddress)) {
				$email->to_name	 = $that->handleMimeHeaderDecode($header->toaddress);
				$email->to_addrs_names = $email->to_name;
			}
			if(!empty($header->to)) {
				$email->to_addrs	= $that->convertImapToSugarEmailAddress($header->to);
			}
			$email->from_name		= $that->handleMimeHeaderDecode($header->fromaddress);
			$email->from_addr_name = $email->from_name;
			$email->from_addr		= $that->convertImapToSugarEmailAddress($header->from);
			if(!empty($header->cc)) {
				$email->cc_addrs	= $that->convertImapToSugarEmailAddress($header->cc);
			}
			if(!empty($header->ccaddress)) {
				$email->cc_addrs_names	 = $that->handleMimeHeaderDecode($header->ccaddress);
			} // if
			$email->reply_to_name   = $that->handleMimeHeaderDecode($header->reply_toaddress);
			$email->reply_to_email  = $that->convertImapToSugarEmailAddress($header->reply_to);
			if (!empty($email->reply_to_email)) {
				$email->reply_to_addr   = $email->reply_to_name;
			}
			$email->intent			= $that->mailbox_type;

			$email->message_id		= $that->compoundMessageId; // filled by importDupeCheck();

			$oldPrefix = $that->imagePrefix;
			if(!$forDisplay) {
				// Store CIDs in imported messages, convert on display
				$that->imagePrefix = "cid:";
			}
			// handle multi-part email bodies
			$email->description_html= $that->getMessageText($msgNo, 'HTML', $structure, $fullHeader,$clean_email); // runs through handleTranserEncoding() already
			$ht_homes_id= CacheEmails::get_string_between($email->description_html, '###!', '!###');
			$email->ht_homes_id = $ht_homes_id;
			$email->description	= $that->getMessageText($msgNo, 'PLAIN', $structure, $fullHeader,$clean_email); // runs through handleTranserEncoding() already
			$that->imagePrefix = $oldPrefix;

			// empty() check for body content
			if(empty($email->description)) {
				$GLOBALS['log']->debug('InboundEmail Message (id:'.$email->message_id.') has no body');
			}

			// assign_to group
			if (!empty($_REQUEST['user_id'])) {
				$email->assigned_user_id = $_REQUEST['user_id'];
			} else {
				// Samir Gandhi : Commented out this code as its not needed
				//$email->assigned_user_id = $that->group_id;
			}
			
			if(!empty($that->created_by) && ($that->is_personal == 1 || $that->is_personal == '1')){
				$email->assigned_user_id = $that->created_by;
			}
	        //Assign Parent Values if set
	        if (!empty(CacheEmails::getRelatedPerson('Contacts',$email->from_addr))) {
                $email->parent_id = CacheEmails::getRelatedPerson('Contacts',$email->from_addr);
                $email->parent_type = 'Contacts';
                $mod = strtolower($email->parent_type);
                $rel = array_key_exists($mod, $email->field_defs) ? $mod : $mod . "_activities_emails"; //Custom modules rel name

                if(! $email->load_relationship($rel) )
                    return FALSE;
                $email->$rel->add($email->parent_id);
	        }
			// override $forDisplay w/user pref
			if($forDisplay) {
				if($that->isAutoImport()) {
					$forDisplay = false; // triggers save of imported email
				}
			}

			if(!$forDisplay) {
				$email->save();

				$email->new_with_id = false; // to allow future saves by UPDATE, instead of INSERT
				////	ASSIGN APPROPRIATE ATTRIBUTES TO NEW EMAIL OBJECT
				///////////////////////////////////////////////////////////////////

				///////////////////////////////////////////////////////////////////
				////	LINK APPROPRIATE BEANS TO NEWLY SAVED EMAIL
				//$contactAddr = $that->handleLinking($email);
				////	END LINK APPROPRIATE BEANS TO NEWLY SAVED EMAIL
				///////////////////////////////////////////////////////////////////

				///////////////////////////////////////////////////////////////////
				////	MAILBOX TYPE HANDLING
				$that->handleMailboxType($email, $header);
				////	END MAILBOX TYPE HANDLING
				///////////////////////////////////////////////////////////////////

				///////////////////////////////////////////////////////////////////
				////	SEND AUTORESPONSE
				if(!empty($email->reply_to_email)) {
					$contactAddr = $email->reply_to_email;
				} else {
					$contactAddr = $email->from_addr;
				}
				if (!$that->isMailBoxTypeCreateCase()) {
					$that->handleAutoresponse($email, $contactAddr);
				}
				////	END SEND AUTORESPONSE
				///////////////////////////////////////////////////////////////////
				////	END IMPORT ONE EMAIL
				///////////////////////////////////////////////////////////////////
			}
		} else {
			// only log if not POP3; pop3 iterates through ALL mail
			if($that->protocol != 'pop3') {
				$GLOBALS['log']->info("InboundEmail found a duplicate email: ".$header->message_id);
				//echo "This email has already been imported";
			}
			//return false;
			return true;//modified as we have to set transfered bit 1 for processed or those exist in emails
		}
		////	END DUPLICATE CHECK
		///////////////////////////////////////////////////////////////////////

		///////////////////////////////////////////////////////////////////////
		////	DEAL WITH THE MAILBOX
		if(!$forDisplay) {
			$r = imap_setflag_full($that->conn, $msgNo, '\\SEEN');

			// if delete_seen, mark msg as deleted
			if($that->delete_seen == 1  && !$forDisplay) {
				$GLOBALS['log']->info("INBOUNDEMAIL: delete_seen == 1 - deleting email");
				imap_setflag_full($that->conn, $msgNo, '\\DELETED');
			}
		} else {
			// for display - don't touch server files?
			//imap_setflag_full($that->conn, $msgNo, '\\UNSEEN');
		}

		$GLOBALS['log']->debug('********************************* InboundEmail finished import of 1 email: '.$email->name);
		////	END DEAL WITH THE MAILBOX
		///////////////////////////////////////////////////////////////////////

		///////////////////////////////////////////////////////////////////////
		////	TO SUPPORT EMAIL 2.0
		$that->email = $email;

		if(empty($that->email->et)) {
			$that->email->email2init();
		}

		return true;
	}
	function getRelatedPerson($module,$email){
		global $db;
		$table = strtolower($module);
		$sql = "SELECT {$table}.id FROM {$table}
				INNER JOIN email_addr_bean_rel eab ON (eab.deleted=0 AND eab.bean_module='{$module}' AND eab.bean_id={$table}.id)
				INNER JOIN email_addresses ea ON(ea.deleted=0 AND LOWER(ea.email_address) ='".strtolower($email)."' AND ea.id=eab.email_address_id)
				WHERE {$table}.deleted=0";
		$result = $db->query($sql, true);
		$row = $db->fetchByAssoc($result);
		return $row['id'];
	}	
	function get_string_between($string, $start, $end){
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}	
}