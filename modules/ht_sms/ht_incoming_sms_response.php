<?php
if(isset($_REQUEST) && !empty($_REQUEST) && $_REQUEST['entryPoint'] == 'ht_incoming_sms_response'){

	global $db, $sugar_config;
	// get the related contact from sms number to relate the record
	$From = trim($_REQUEST['source']);
	$check_from_number = str_replace('-', '', $From);
	if(strlen($check_from_number) >= 10){
		$From = preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($From)), 2);
		$To = preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($_REQUEST['destination'])), 2);
		$ht_sms = new ht_sms();
		$phone_status = $ht_sms->checkPhoneStatus($From);
		if(!in_array($phone_status, array('Block', 'Block_OptOut'))){
			$query = "SELECT assigned_user_id FROM ht_sms WHERE to_number LIKE '%{$From}%' AND deleted = 0  
					  ORDER BY date_entered DESC LIMIT 1;";

			$result = $GLOBALS['db']->query($query);
			$LastAssign_Res = $GLOBALS['db']->fetchByAssoc($result);
			$LastUserID = $LastAssign_Res['assigned_user_id'];
			$parent_record_id = '';
			$parent_record_type = '';
			$parent_record_name = '';
			$parent_assigned_user_id = '';
			// Check In Leads
			$sql = "SELECT id, CONCAT(first_name,' ', last_name) AS lead_name, assigned_user_id  
					FROM leads 
					WHERE deleted = 0 AND (phone_home LIKE '%" . $From . "%' OR phone_mobile LIKE '%" . $From . "%' OR phone_work LIKE '%" . $From . "%' OR phone_other LIKE '%" . $From . "%' OR phone_fax LIKE '%" . $From . "%') Limit 1";
			$result = $db->query($sql, true);
			$lead_row = $db->fetchByAssoc($result);
			$parent_record_name = $lead_row['lead_name'];
			$parent_record_id = $lead_row['id'];
			$parent_record_type = 'Leads';
			$parent_assigned_user_id = $lead_row['assigned_user_id'];
			// Check In Contacts
			if(empty($parent_record_id)){
				$sql = "SELECT id, CONCAT(first_name,' ', last_name) AS contact_name, assigned_user_id  
						FROM contacts 
						WHERE deleted = 0 AND (phone_home LIKE '%" . $From . "%' OR phone_mobile LIKE '%" . $From . "%' OR phone_work LIKE '%" . $From . "%' OR phone_other LIKE '%" . $From . "%' OR phone_fax LIKE '%" . $From . "%') Limit 1";
				$result = $db->query($sql, true);
				$contact_row = $db->fetchByAssoc($result);
				$parent_record_name = $contact_row['contact_name'];
				$parent_record_id = $contact_row['id'];
				$parent_record_type = 'Contacts';
				$parent_assigned_user_id = $contact_row['assigned_user_id'];
			}
			// Check In Accounts
			if(empty($parent_record_id)){
				$sql = "SELECT id, name AS account_name, assigned_user_id  
						FROM accounts 
						WHERE deleted = 0 AND (phone_office LIKE '%" . $From . "%' OR phone_alternate LIKE '%" . $From . "%' OR phone_fax LIKE '%" . $From . "%') Limit 1";
				$result = $db->query($sql, true);
				$account_row = $db->fetchByAssoc($result);
				$parent_record_name = $account_row['account_name'];
				$parent_record_id = $account_row['id'];
				$parent_record_type = 'Accounts';
				$parent_assigned_user_id = $account_row['assigned_user_id'];
			}
			$parent_bean = BeanFactory::getBean($parent_record_type, $parent_record_id);
			$subject = "Inbound SMS From {$parent_bean->name} (" . $From .")";
			// create record in the system
			
			if(empty($parent_record_id)){
				$parent_record_type = '';
			}
			
			$ht_sms = new ht_sms();
			$file_id = create_guid();
			$ht_sms->id = $file_id;
			$ht_sms->new_with_id = true;
			if($_REQUEST['type'] == 'sms'){
				$ht_sms->description = $_REQUEST['message'];		
			}else{
				//$ht_sms->description = $_REQUEST['message'];
				if(!empty($_REQUEST['message'])){
					$uploadfile = 'upload://'.$file_id;
					$file_data = file_get_contents($_REQUEST['message']);
					file_put_contents($uploadfile, $file_data);
					$ht_sms->filename = 'MMS File';	
				}		
			}
			$ht_sms->name = $subject;
			$ht_sms->to_number = $To;
			$ht_sms->from_number = $From;
			$ht_sms->sent_received = 'Incoming';
			$ht_sms->message_status = 'Recieved';
			$ht_sms->parent_id = $parent_record_id;
			$ht_sms->parent_type = $parent_record_type;
			if (!empty($LastUserID)) {
				$ht_sms->assigned_user_id = $LastUserID;
				$ht_sms->modified_user_id = $LastUserID;
			}else if (!empty($parent_assigned_user_id)) {
				$ht_sms->assigned_user_id = $parent_assigned_user_id;
				$ht_sms->modified_user_id = $parent_assigned_user_id;
			}else{
				$ht_sms->assigned_user_id = "1";
				$ht_sms->modified_user_id = "1";
			}
			$save_sms = $ht_sms->save();
			sleep(10); // Waiting time to save SMS First
			function checkAutoReplyStatus($From){
				$sql = "SELECT auto_reply_sent 
						FROM `ht_sms` 
						WHERE deleted = 0 AND to_number LIKE '%" . $From . "%' AND sent_received = 'Outgoing' AND auto_reply_sent = '1'
						LIMIT 1";
				$result = $GLOBALS['db']->query($sql, true);
				$row = $GLOBALS['db']->fetchByAssoc($result);
				return $row['auto_reply_sent'];
			}
			// Send Message if the From number not found in the Contacts OR Organizations
			if(empty($parent_record_id)){
				$message_to_reply = "This is MattLaw's automatically generated text message response to your text. Unfortunately, we do not recognize your phone number, can you please either call our office or send another text with your name so we may update your contact. Thank you. Matt Powell";
				$from_crm_user = true;
				$result = checkAutoReplyStatus($From);
				if(!isset($result) && empty($result) && $result != 1){
					$ht_sms->sendMessage($From, $message_to_reply, '', '', $from_crm_user, '', true);			
				}
			}
			// Opt out user from sending messages from system if Message contains stop
			$stop_words = array('stop');
			$check_stop = 0;
			$message_40_charcters = substr($_REQUEST['message'], 0, 39);
			foreach($stop_words as $word){
				if(strpos(strtolower($message_40_charcters), $word) !== false){
					$check_stop = 1;
				}
			}
			if($check_stop == '1'){
				$message_to_reply = "You have successfully been unsubscribed. You will not receive any more messages from 813-222-2222. Reply START to re-subscribe.";
				$from_crm_user = true;
				$ht_sms->sendMessage($From, $message_to_reply, '', '', $from_crm_user, '', true);
				$ht_sms->checkCreateUpdate($From, 'OptOut');
			}
			// Active user from sending messages from system if Message contains start
			$start_words = array('start');
			$check_start = 0;
			foreach($start_words as $word){
				if(strpos(strtolower($message_40_charcters), $word) !== false){
					$check_start = 1;
				}
			}
			if($check_start == '1'){
				$ht_sms->checkCreateUpdate($From, 'Active');				
			}
			
		}

	}
}