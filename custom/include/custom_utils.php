<?php

	/**
	 * Converts an Array to a Select2 compatible id_text_list
	 *
	 * @param Array $data
	 * @return Array
	 */
	function convertArrayToITL( $data, $decode = true){
		$return = array();
		foreach ( $data as $key => $value )
			$return[] = array( 'id' => $key, 'text' => $value );
		if($decode)
			$return = json_encode($return);
		return $return;
	}
	/**
	Custom subpanel under Cases module to show the related Documents
	**/
	function getSoftDocuments($params){
		$return_array['select']=' SELECT *';
		$return_array['from']=' FROM documents';
		$return_array['where']=" WHERE documents.deleted=0  AND documents.hard_or_soft_doc = 'Soft_Documents' AND  documents_cases.case_id = '{$params['record_id']}' ";
		$return_array['join'] = "INNER JOIN documents_cases ON (documents_cases.document_id=documents.id)";
		$return_array['join_tables'][0] = '';

		return $return_array;
	}

	function getCaseRelatedContacts($params){
		$return_array['select']=' SELECT *';
		$return_array['from']=' FROM contacts';
		$return_array['where']=" WHERE contacts.deleted=0 ";
		// $return_array['where']=" WHERE contacts.deleted=0 AND documents.hard_or_soft_doc = 'Hard_Documents' AND  documents_cases.case_id = '{$params['record_id']}' ";
		// $return_array['join'] = "INNER JOIN documents_cases ON (documents_cases.document_id=documents.id)";
		$return_array['join_tables'][0] = '';

		return $return_array;
	}
	// function getHardDocuments($params){
	// 		$main_query="SELECT
	// 		'documents' AS source_table,
	// 		d.id,
	// 		d.date_entered,
	// 		jt0.name AS cases_documents_name,
	// 		jtl0.case_id,
	// 		d.document_name,
	// 		d.subcategory_id,
	// 		d.document_revision_id,
	// 		d.doc_id,
	// 		d.doc_type,
	// 		d.doc_url,
	// 		d.assigned_user_id
	// 	FROM documents d
	// 	LEFT JOIN documents_cases jtl0 ON d.id = jtl0.document_id AND jtl0.deleted = 0
	// 	LEFT JOIN cases jt0 ON jt0.id = jtl0.case_id AND jt0.deleted = 0
	// 	WHERE d.deleted = 0 AND d.hard_or_soft_doc = 'Hard_Documents'

	// 	UNION

	// 	SELECT
	// 		'plea_pleadings' AS source_table,
	// 		plea_pleadings.id,
	// 		plea_pleadings.date_entered,
	// 		NULL AS cases_documents_name,
	// 		NULL AS case_id,
	// 		document_name AS document_name,
	// 		subcategory_id AS subcategory_id,
	// 		NULL AS document_revision_id,
	// 		NULL AS doc_id,
	// 		doc_type AS doc_type,
	// 		doc_url AS doc_url,
	// 		assigned_user_id AS assigned_user_id
	// 	FROM plea_pleadings

	// 	UNION

	// 	SELECT
	// 		'neg_negotiations' AS source_table,
	// 		neg_negotiations.id,
	// 		neg_negotiations.date_entered,
	// 		NULL AS cases_documents_name,
	// 		NULL AS case_id,
	// 		document_name AS document_name,
	// 		subcategory_id AS subcategory_id,
	// 		NULL AS document_revision_id,
	// 		NULL AS doc_id,
	// 		type AS doc_type,
	// 		NULL AS doc_url,  -- Negotiations table does not have doc_url, adjust accordingly
	// 		assigned_user_id AS assigned_user_id
	// 	FROM neg_negotiations

	// 					";
	// 		return $main_query;
	// }
	function getHardDocuments($params){
		$main_query="SELECT
		'documents' AS source_table,
		d.id,
		d.date_entered,
		jt0.name AS cases_documents_name,
		jtl0.case_id,
		d.document_name,
		d.subcategory_id,
		d.document_revision_id,
		d.doc_id,
		d.doc_type,
		d.doc_url,
		d.assigned_user_id
	FROM documents d
	LEFT JOIN documents_cases jtl0 ON d.id = jtl0.document_id AND jtl0.deleted = 0
	LEFT JOIN cases jt0 ON jt0.id = jtl0.case_id AND jt0.deleted = 0
	WHERE d.deleted = 0 AND d.hard_or_soft_doc = 'Hard_Documents'
	
	UNION
	
	SELECT
		'plea_pleadings' AS source_table,
		plea_pleadings.id,
		plea_pleadings.date_entered,
		NULL AS cases_documents_name,
		NULL AS case_id,
		document_name AS document_name,
		subcategory_id AS subcategory_id,
		NULL AS document_revision_id,
		NULL AS doc_id,
		doc_type AS doc_type,
		doc_url AS doc_url,
		assigned_user_id AS assigned_user_id
	FROM plea_pleadings
	
	UNION
	
	SELECT
		'neg_negotiations' AS source_table,
		neg_negotiations.id,
		neg_negotiations.date_entered,
		NULL AS cases_documents_name,
		NULL AS case_id,
		document_name AS document_name,
		subcategory_id AS subcategory_id,
		NULL AS document_revision_id,
		NULL AS doc_id,
		type AS doc_type,
		NULL AS doc_url,  -- Negotiations table does not have doc_url, adjust accordingly
		assigned_user_id AS assigned_user_id
	FROM neg_negotiations
	
					";
		return $main_query;
		}
	function getTemplatesExternalApiDropDown($focus = null, $name = null, $value = null, $view = null) {
		require_once('include/externalAPI/ExternalAPIFactory.php');

		$apiList = ExternalAPIFactory::getModuleDropDown('Documents');

		$apiList = array_merge(array('Sugar'=>$GLOBALS['app_list_strings']['eapm_list']['Sugar']),$apiList);
		if(!empty($value) && empty($apiList[$value])){
			$apiList[$value] = $value;
		}
		return $apiList;

	}
	function get_users(){
		$users = array();
		$users = get_user_array();
		$GLOBALS['app_list_strings']['multiple_assigned_users_list'] = get_user_array();
		return $users;
	}
	function get_user_initials(){
		global $db;
		// $query = "SELECT id, UPPER(initials_c) AS name FROM users u
		// 	INNER JOIN users_cstm uc ON (uc.id_c = u.id)
		// 	WHERE deleted = 0 AND status = 'Active' AND initials_c != '' AND initials_c IS NOT NULL AND show_on_calendar = '1'";
			$query = "SELECT id, CONCAT(first_name,' ',last_name) AS name FROM users u
			WHERE deleted = 0 AND status = 'Active' AND last_name != '' AND last_name IS NOT NULL AND show_on_calendar = '1'";
		$result = $db->query($query, false);

		$list = array();
		while (($row = $db->fetchByAssoc($result)) != null) {
			$list[$row['id']] = $row['name'];
		}
		return $list;
	}
	function get_letterhead_list(){
		global $db;
		$query = "SELECT id, document_name FROM ht_doc_temp_letter_head WHERE deleted=0 ";
		$result = $db->query($query, false);

		$list = array();
		$list['']='Select an Option';
		while (($row = $db->fetchByAssoc($result)) != null) {
			$list[$row['id']] = $row['document_name'];
		}
		return $list;
	}
	function get_tasks_list($params){
		$return_array['select']=' SELECT *';
		$return_array['from']=' FROM tasks';
		$return_array['where']=" WHERE tasks.deleted=0 AND tasks.status != 'Done' AND tasks.parent_type = 'Cases' AND tasks.parent_id = '{$params['record_id']}'";
		return $return_array;
	}

	function get_case_workflows($params){
		$bean = $GLOBALS['app']->controller->bean;
		$return_array['select']='SELECT aow_workflow.id, aow_workflow.name, aow_processed.date_entered ';
		$return_array['from']=' FROM aow_processed ';
		$return_array['join']=" INNER JOIN aow_workflow ON ( aow_workflow.deleted = 0 AND aow_processed.aow_workflow_id = aow_workflow.id  ) ";
		$return_array['where']=" WHERE aow_processed.deleted = 0  AND aow_processed.parent_type = 'Cases' AND aow_processed.parent_id = '{$bean->id}'";
		return $return_array;
	}

	function get_event_workflows($params){
		$bean = $GLOBALS['app']->controller->bean;
		$return_array['select']='SELECT aow_workflow.id, aow_workflow.name, aow_processed.date_entered ';
		$return_array['from']=' FROM aow_processed ';
		$return_array['join']=" INNER JOIN aow_workflow ON ( aow_workflow.deleted = 0 AND aow_processed.aow_workflow_id = aow_workflow.id  ) ";
		$return_array['where']=" WHERE aow_processed.deleted = 0  AND aow_processed.parent_type = 'FP_events' AND aow_processed.parent_id = '{$bean->id}'";
		return $return_array;
	}
	function get_task_workflows($params){
		$bean = $GLOBALS['app']->controller->bean;
		$return_array['select']='SELECT aow_workflow.id, aow_workflow.name, aow_processed.date_entered ';
		$return_array['from']=' FROM aow_processed ';
		$return_array['join']=" INNER JOIN aow_workflow ON ( aow_workflow.deleted = 0 AND aow_processed.aow_workflow_id = aow_workflow.id  ) ";
		$return_array['where']=" WHERE aow_processed.deleted = 0  AND aow_processed.parent_type = 'Tasks' AND aow_processed.parent_id = '{$bean->id}'";
		return $return_array;
	}
	function get_contact_insurance($params){

		global $app_list_strings;

		$bean = $GLOBALS['app']->controller->bean;
		$role = $app_list_strings['ht_vehicles_relation_role'][$_REQUEST['parent_panel_id']];
		$row_record_id = $_REQUEST['row_record_id'];
		$accountBean = BeanFactory::getBean('Accounts', $row_record_id);
		$record_id = $_REQUEST['record'];
		if(!empty($accountBean->id)){
			$join_table = "INNER JOIN ht_veh_con_in_poli ON ht_veh_con_in_poli.insu_id = def_client_insurance.id INNER JOIN ht_vehicles_accounts ON (
				ht_vehicles_accounts.id = ht_veh_con_in_poli.veh_con_relation_id
				AND ht_vehicles_accounts.account_id = '{$row_record_id}'
				AND ht_vehicles_accounts.vehicle_id = '{$record_id}'
				AND ht_vehicles_accounts.account_role = '{$role}'
			)";
		}else{
			$join_table = "INNER JOIN ht_veh_con_in_poli ON ht_veh_con_in_poli.insu_id = def_client_insurance.id INNER JOIN ht_vehicles_contacts ON (
				ht_vehicles_contacts.id = ht_veh_con_in_poli.veh_con_relation_id
				AND ht_vehicles_contacts.contact_id = '{$row_record_id}'
				AND ht_vehicles_contacts.vehicle_id = '{$record_id}'
				AND ht_vehicles_contacts.contact_role = '{$role}'
			)";
		}
		$row_module = $_REQUEST['row_module'];
		$return_array['select']='SELECT def_client_insurance.id';
		$return_array['from']=' FROM def_client_insurance ';
		$return_array['join']= $join_table;
		// print"<pre>";print_r($return_array);die;
		// $return_array['where']=" ";
		return $return_array;
	}

	function is_file_exist($module, $id){
		global $db, $log;
		if(empty($module)) return false;
		if (!isset($_REQUEST['isTempFile'])) {
			//Custom modules may have capitalizations anywhere in their names. We should check the passed in format first.
		/* 	echo '$module:'.$module;
			echo '$id:'.$id; */

			$focus = BeanFactory::newBean($module);
			$focus->retrieve($id);
			if (!$focus->ACLAccess('view')) {
				return false;
			} // if
			// Pull up the document revision, if it's of type Document
			if (isset($focus->object_name) && $focus->object_name == 'Document') {
				// It's a document, get the revision that really stores this file
				$focusRevision = new DocumentRevision();
				$focusRevision->retrieve($id);

				if (empty($focusRevision->id)) {
					// This wasn't a document revision id, it's probably actually a document id,
					// we need to grab the latest revision and use that
					$focusRevision->retrieve($focus->document_revision_id);

					if (!empty($focusRevision->id)) {
						$id = $focusRevision->id;
					}
				}
			}
			// See if it is a remote file, if so, send them that direction
			if (isset($focus->doc_url) && !empty($focus->doc_url) && $focus->doc_type == 'Local') {
				// $local_location = "/home/admin/AAA - Soft Documents.rar";

				// header('Location: ' . $focus->doc_url);
				// sugar_die("Remote file detected, location header sent.");
			}else if (isset($focus->doc_url) && !empty($focus->doc_url)) {
				return true;
			}

			if (isset($focusRevision) && isset($focusRevision->doc_url) && !empty($focusRevision->doc_url)) {
				return true;
			}
		} // if

		$temp = explode("_", $id, 2);
		if (is_array($temp)) {
			$image_field = $temp[1];
			$image_id = $temp[0];
		}

		$local_location = "upload://{$id}";

		if (isset($focus->doc_url) && !empty($focus->doc_url) && $focus->doc_type == 'Local') {
			$local_location = html_entity_decode($focus->doc_url, ENT_QUOTES);
			// var_dump($local_location);die('here');
		}

		if (!file_exists($local_location) || strpos($local_location, "..")) {
			return false;
		}
		return true;
	}
	function ht_remove_special_chars($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	   $string = preg_replace('/[^A-Za-z0-9\-\.]/', '', $string); // Removes special chars.

	   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
	}
	function sendEmail($emailTo, $emailSubject, $emailBody, $parent_id, $parent_type){
		global $db, $log, $app_list_strings;
		if(empty($emailSubject) || empty($emailBody) || empty($emailTo)){
			return false;
		};
        require_once('modules/Emails/Email.php');
        require_once('include/SugarPHPMailer.php');
        $emailObj = new Email();
        $defaults = $emailObj->getSystemDefaultEmail();
        $mail = new SugarPHPMailer();
        $mail->setMailerForSystem();
        $mail->From = $defaults['email'];
        $mail->FromName = $defaults['name'];
        $mail->ClearAllRecipients();
        $mail->ClearReplyTos();
        $mail->Subject = from_html($emailSubject);
        $mail->Body = html_entity_decode($emailBody);
        $mail->AltBody = html_entity_decode($emailBody);
        $mail->prepForOutbound();
		if(is_array($emailTo)){
			foreach($emailTo as $emails){
				$mail->AddAddress($emails);
			}
		}else{
			$mail->AddAddress($emailTo);
		}
        if (@$mail->Send()){

           if(is_array($emailTo)){
				foreach($emailTo as $id => $email){
					$emailObj = new Email();
					$emailObj->to_addrs= $email;
					$emailObj->type= 'out';
					$emailObj->deleted = '0';
					$emailObj->name = $mail->Subject;
					$emailObj->status = 'sent';
					$emailObj->description = $mail->Body;
					$emailObj->description_html = $mail->Body;
					$emailObj->from_addr = $mail->From;
					$emailObj->parent_type = $parent_type;
					$emailObj->parent_id = $id;
					$emailObj->date_sent = TimeDate::getInstance()->nowDb();
					$emailObj->modified_user_id = '1';
					$emailObj->created_by = '1';
					$emailObj->save();
				}
			}else{
					$emailObj->to_addrs= $emailTo;
					$emailObj->type= 'out';
					$emailObj->deleted = '0';
					$emailObj->name = $mail->Subject;
					$emailObj->status = 'sent';
					$emailObj->description = $mail->Body;
					$emailObj->description_html = $mail->Body;
					$emailObj->from_addr = $mail->From;
					$emailObj->parent_type = $parent_type;
					$emailObj->parent_id = $parent_id;
					$emailObj->date_sent = TimeDate::getInstance()->nowDb();
					$emailObj->modified_user_id = '1';
					$emailObj->created_by = '1';
					$emailObj->save();

			}

            return true;
        }
        return false;
    }
	function parseTemplate(SugarBean $bean, &$template){
		global $db, $log, $sugar_config;
		require_once('modules/AOW_Actions/actions/templateParser.php');
		$object_arr[$bean->module_dir] = $bean->id;
		$template->subject = str_replace("\$contact_user","\$user",$template->subject);
        $template->body_html = str_replace("\$contact_user","\$user",$template->body_html);
        $template->body = str_replace("\$contact_user","\$user",$template->body);
        $template->subject = aowTemplateParser::parse_template($template->subject, $object_arr);
        $template->body_html = aowTemplateParser::parse_template($template->body_html, $object_arr);
        $template->body = aowTemplateParser::parse_template($template->body, $object_arr);
		return true;
	}
	function random_color_part() {
		return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
	}

	function random_color() {
		return random_color_part() . random_color_part() . random_color_part();
	}
    function Modify_Date($params, $field, $value, $view){
        pre($params);
    }
	function getrelated_case_assigned_to($params, $field, $value, $view){
        // pre($params);
		global $db;
		$sql = "SELECT users.id, CONCAT_WS(' ',users.first_name, users.last_name) as name
				FROM `plea_pleadings`
				INNER JOIN plea_pleadings_cases_c ON (plea_pleadings_cases_c.deleted = 0 AND plea_pleadings_cases_c.plea_pleadings_casesplea_pleadings_idb = plea_pleadings.id)
				INNER JOIN cases ON (cases.deleted = 0 AND cases.id = plea_pleadings_cases_c.plea_pleadings_casescases_ida)
				INNER JOIN users ON (users.deleted = 0 AND cases.assigned_user_id = users.id)
				WHERE plea_pleadings.id  = '{$params->id}'
			";

		$result = $db->query($sql,true);
		$row = $db->fetchByAssoc($result);
		$link = "";
		if(isset($row['id']) && !empty($row['id'])){
			$link = '<a href="index.php?module=Users&action=DetailView&record='.$row['id'].'">
						'.$row['name'].'</a>';
		}


		return $link;
	}
    function getrelated_user_name($params, $field, $value, $view)
    {
        // echo $value;

        return "<p>HelloWOrld</p>";
    }
	function getrelated_discovery_case_assigned_to($params, $field, $value, $view){
		global $db;
		$sql = "SELECT users.id, CONCAT_WS(' ',users.first_name, users.last_name) as name
				FROM `disc_discovery`
				INNER JOIN disc_discovery_cases_c ON (disc_discovery_cases_c.deleted = 0 AND disc_discovery_cases_c.disc_discovery_casesdisc_discovery_idb = disc_discovery.id)
				INNER JOIN cases ON (cases.deleted = 0 AND cases.id = disc_discovery_cases_c.disc_discovery_casescases_ida)
				INNER JOIN users ON (users.deleted = 0 AND cases.assigned_user_id = users.id)
				WHERE disc_discovery.id  = '{$params->id}'
			";

		$result = $db->query($sql,true);
		$row = $db->fetchByAssoc($result);
		$link = "";
		if(isset($row['id']) && !empty($row['id'])){
			$link = '<a href="index.php?module=Users&action=DetailView&record='.$row['id'].'">
						'.$row['name'].'</a>';
		}


		return $link;
	}
	function get_related_document_case_assigned_to($params, $field, $value, $view){
		global $db;
		$sql = "SELECT users.id, CONCAT_WS(' ',users.first_name, users.last_name) as name
				FROM `documents`
				INNER JOIN documents_cases ON (documents_cases.deleted = 0 AND documents_cases.document_id = documents.id)
				INNER JOIN cases ON (cases.deleted = 0 AND cases.id = documents_cases.case_id)
				INNER JOIN users ON (users.deleted = 0 AND cases.assigned_user_id = users.id)
				WHERE documents.id  = '{$params->id}'
			";

		$result = $db->query($sql,true);
		$row = $db->fetchByAssoc($result);
		$link = "";
		if(isset($row['id']) && !empty($row['id'])){
			$link = '<a href="index.php?module=Users&action=DetailView&record='.$row['id'].'">
						'.$row['name'].'</a>';
		}


		return $link;
	}
	function getrelated_neg_negotiations_case_assigned_to($params, $field, $value, $view){
		global $db;
		$sql = "SELECT users.id, CONCAT_WS(' ',users.first_name, users.last_name) as name
				FROM `neg_negotiations`
				INNER JOIN neg_negotiations_cases_c ON (neg_negotiations_cases_c.deleted = 0 AND neg_negotiations_cases_c.neg_negotiations_casesneg_negotiations_idb= neg_negotiations.id)
				INNER JOIN cases ON (cases.deleted = 0 AND cases.id = neg_negotiations_cases_c.neg_negotiations_casescases_ida)
				INNER JOIN users ON (users.deleted = 0 AND cases.assigned_user_id = users.id)
				WHERE neg_negotiations.id  = '{$params->id}'
			";

		$result = $db->query($sql,true);
		$row = $db->fetchByAssoc($result);
		$link = "";
		if(isset($row['id']) && !empty($row['id'])){
			$link = '<a href="index.php?module=Users&action=DetailView&record='.$row['id'].'">
						'.$row['name'].'</a>';
		}


		return $link;
	}
	function get_all_users_with_name_and_email(){
		global $db;
		$sql = "SELECT users.id, CONCAT_WS(' ',users.first_name, users.last_name) as name,
				FROM users
			";

		$result = $db->query($sql,true);
		$all_users_with_email = array();
		while($row = $db->fetchByAssoc($result)){
			$users = BeanFactory::getBean('Users', $row['id']);
			$all_users_with_email[$users->email1] = $users->name;
		}
		return $all_users_with_email;
	}
	function getRelatedReceivedMedicalBills($params){
		$return_array['select'] =' SELECT mdoc_incoming_bills.id';
		$return_array['from']   ='  FROM `mdoc_incoming_bills` ';
		$return_array['join']= " LEFT JOIN medb_medical_bills_mdoc_incoming_bills_1_c ON (medb_medical_bills_mdoc_incoming_bills_1_c.medb_medical_bills_mdoc_incoming_bills_1mdoc_incoming_bills_idb = mdoc_incoming_bills.id) LEFT JOIN medb_medical_bills_contacts_c ON (medb_medical_bills_contacts_c.deleted = 0 AND medb_medical_bills_contactsmedb_medical_bills_idb = medb_medical_bills_mdoc_incoming_bills_1_c.medb_medical_bills_mdoc_incoming_bills_1medb_medical_bills_ida)";
		$return_array['where']=" WHERE medb_medical_bills_contacts_c.medb_medical_bills_contactscontacts_ida = '{$_REQUEST['record']}' ";
		return $return_array;
	}
	function get_user_initials_custom(){
		global $db;
		$query = "SELECT id, UPPER(initials_c) AS name FROM users u
			INNER JOIN users_cstm uc ON (uc.id_c = u.id)
			WHERE deleted = 0 AND status = 'Active' AND initials_c != '' AND initials_c IS NOT NULL";
		$result = $db->query($query, false);

		$list = array();
		while (($row = $db->fetchByAssoc($result)) != null) {
			$list[$row['id']] = $row['name'];
		}
		return $list;
	}
	function mime2ext($mime) {
		$mime_map = [
			'video/3gpp2'                                                               => '3g2',
			'video/3gp'                                                                 => '3gp',
			'video/3gpp'                                                                => '3gp',
			'application/x-compressed'                                                  => '7zip',
			'audio/x-acc'                                                               => 'aac',
			'audio/ac3'                                                                 => 'ac3',
			'application/postscript'                                                    => 'ai',
			'audio/x-aiff'                                                              => 'aif',
			'audio/aiff'                                                                => 'aif',
			'audio/x-au'                                                                => 'au',
			'video/x-msvideo'                                                           => 'avi',
			'video/msvideo'                                                             => 'avi',
			'video/avi'                                                                 => 'avi',
			'application/x-troff-msvideo'                                               => 'avi',
			'application/macbinary'                                                     => 'bin',
			'application/mac-binary'                                                    => 'bin',
			'application/x-binary'                                                      => 'bin',
			'application/x-macbinary'                                                   => 'bin',
			'image/bmp'                                                                 => 'bmp',
			'image/x-bmp'                                                               => 'bmp',
			'image/x-bitmap'                                                            => 'bmp',
			'image/x-xbitmap'                                                           => 'bmp',
			'image/x-win-bitmap'                                                        => 'bmp',
			'image/x-windows-bmp'                                                       => 'bmp',
			'image/ms-bmp'                                                              => 'bmp',
			'image/x-ms-bmp'                                                            => 'bmp',
			'application/bmp'                                                           => 'bmp',
			'application/x-bmp'                                                         => 'bmp',
			'application/x-win-bitmap'                                                  => 'bmp',
			'application/cdr'                                                           => 'cdr',
			'application/coreldraw'                                                     => 'cdr',
			'application/x-cdr'                                                         => 'cdr',
			'application/x-coreldraw'                                                   => 'cdr',
			'image/cdr'                                                                 => 'cdr',
			'image/x-cdr'                                                               => 'cdr',
			'zz-application/zz-winassoc-cdr'                                            => 'cdr',
			'application/mac-compactpro'                                                => 'cpt',
			'application/pkix-crl'                                                      => 'crl',
			'application/pkcs-crl'                                                      => 'crl',
			'application/x-x509-ca-cert'                                                => 'crt',
			'application/pkix-cert'                                                     => 'crt',
			'text/css'                                                                  => 'css',
			'text/x-comma-separated-values'                                             => 'csv',
			'text/comma-separated-values'                                               => 'csv',
			'application/vnd.msexcel'                                                   => 'csv',
			'application/x-director'                                                    => 'dcr',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document'   => 'docx',
			'application/x-dvi'                                                         => 'dvi',
			'message/rfc822'                                                            => 'eml',
			'application/x-msdownload'                                                  => 'exe',
			'video/x-f4v'                                                               => 'f4v',
			'audio/x-flac'                                                              => 'flac',
			'video/x-flv'                                                               => 'flv',
			'image/gif'                                                                 => 'gif',
			'application/gpg-keys'                                                      => 'gpg',
			'application/x-gtar'                                                        => 'gtar',
			'application/x-gzip'                                                        => 'gzip',
			'application/mac-binhex40'                                                  => 'hqx',
			'application/mac-binhex'                                                    => 'hqx',
			'application/x-binhex40'                                                    => 'hqx',
			'application/x-mac-binhex40'                                                => 'hqx',
			'text/html'                                                                 => 'html',
			'image/x-icon'                                                              => 'ico',
			'image/x-ico'                                                               => 'ico',
			'image/vnd.microsoft.icon'                                                  => 'ico',
			'text/calendar'                                                             => 'ics',
			'application/java-archive'                                                  => 'jar',
			'application/x-java-application'                                            => 'jar',
			'application/x-jar'                                                         => 'jar',
			'image/jp2'                                                                 => 'jp2',
			'video/mj2'                                                                 => 'jp2',
			'image/jpx'                                                                 => 'jp2',
			'image/jpm'                                                                 => 'jp2',
			'image/jpeg'                                                                => 'jpeg',
			'image/pjpeg'                                                               => 'jpeg',
			'application/x-javascript'                                                  => 'js',
			'application/json'                                                          => 'json',
			'text/json'                                                                 => 'json',
			'application/vnd.google-earth.kml+xml'                                      => 'kml',
			'application/vnd.google-earth.kmz'                                          => 'kmz',
			'text/x-log'                                                                => 'log',
			'audio/x-m4a'                                                               => 'm4a',
			'audio/mp4'                                                                 => 'm4a',
			'application/vnd.mpegurl'                                                   => 'm4u',
			'audio/midi'                                                                => 'mid',
			'application/vnd.mif'                                                       => 'mif',
			'video/quicktime'                                                           => 'mov',
			'video/x-sgi-movie'                                                         => 'movie',
			'audio/mpeg'                                                                => 'mp3',
			'audio/mpg'                                                                 => 'mp3',
			'audio/mpeg3'                                                               => 'mp3',
			'audio/mp3'                                                                 => 'mp3',
			'video/mp4'                                                                 => 'mp4',
			'video/mpeg'                                                                => 'mpeg',
			'application/oda'                                                           => 'oda',
			'audio/ogg'                                                                 => 'ogg',
			'video/ogg'                                                                 => 'ogg',
			'application/ogg'                                                           => 'ogg',
			'font/otf'                                                                  => 'otf',
			'application/x-pkcs10'                                                      => 'p10',
			'application/pkcs10'                                                        => 'p10',
			'application/x-pkcs12'                                                      => 'p12',
			'application/x-pkcs7-signature'                                             => 'p7a',
			'application/pkcs7-mime'                                                    => 'p7c',
			'application/x-pkcs7-mime'                                                  => 'p7c',
			'application/x-pkcs7-certreqresp'                                           => 'p7r',
			'application/pkcs7-signature'                                               => 'p7s',
			'application/pdf'                                                           => 'pdf',
			'application/octet-stream'                                                  => 'pdf',
			'application/x-x509-user-cert'                                              => 'pem',
			'application/x-pem-file'                                                    => 'pem',
			'application/pgp'                                                           => 'pgp',
			'application/x-httpd-php'                                                   => 'php',
			'application/php'                                                           => 'php',
			'application/x-php'                                                         => 'php',
			'text/php'                                                                  => 'php',
			'text/x-php'                                                                => 'php',
			'application/x-httpd-php-source'                                            => 'php',
			'image/png'                                                                 => 'png',
			'image/x-png'                                                               => 'png',
			'application/powerpoint'                                                    => 'ppt',
			'application/vnd.ms-powerpoint'                                             => 'ppt',
			'application/vnd.ms-office'                                                 => 'ppt',
			'application/msword'                                                        => 'doc',
			'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
			'application/x-photoshop'                                                   => 'psd',
			'image/vnd.adobe.photoshop'                                                 => 'psd',
			'audio/x-realaudio'                                                         => 'ra',
			'audio/x-pn-realaudio'                                                      => 'ram',
			'application/x-rar'                                                         => 'rar',
			'application/rar'                                                           => 'rar',
			'application/x-rar-compressed'                                              => 'rar',
			'audio/x-pn-realaudio-plugin'                                               => 'rpm',
			'application/x-pkcs7'                                                       => 'rsa',
			'text/rtf'                                                                  => 'rtf',
			'text/richtext'                                                             => 'rtx',
			'video/vnd.rn-realvideo'                                                    => 'rv',
			'application/x-stuffit'                                                     => 'sit',
			'application/smil'                                                          => 'smil',
			'text/srt'                                                                  => 'srt',
			'image/svg+xml'                                                             => 'svg',
			'application/x-shockwave-flash'                                             => 'swf',
			'application/x-tar'                                                         => 'tar',
			'application/x-gzip-compressed'                                             => 'tgz',
			'image/tiff'                                                                => 'tiff',
			'font/ttf'                                                                  => 'ttf',
			'text/plain'                                                                => 'txt',
			'text/x-vcard'                                                              => 'vcf',
			'application/videolan'                                                      => 'vlc',
			'text/vtt'                                                                  => 'vtt',
			'audio/x-wav'                                                               => 'wav',
			'audio/wave'                                                                => 'wav',
			'audio/wav'                                                                 => 'wav',
			'application/wbxml'                                                         => 'wbxml',
			'video/webm'                                                                => 'webm',
			'image/webp'                                                                => 'webp',
			'audio/x-ms-wma'                                                            => 'wma',
			'application/wmlc'                                                          => 'wmlc',
			'video/x-ms-wmv'                                                            => 'wmv',
			'video/x-ms-asf'                                                            => 'wmv',
			'font/woff'                                                                 => 'woff',
			'font/woff2'                                                                => 'woff2',
			'application/xhtml+xml'                                                     => 'xhtml',
			'application/excel'                                                         => 'xl',
			'application/msexcel'                                                       => 'xls',
			'application/x-msexcel'                                                     => 'xls',
			'application/x-ms-excel'                                                    => 'xls',
			'application/x-excel'                                                       => 'xls',
			'application/x-dos_ms_excel'                                                => 'xls',
			'application/xls'                                                           => 'xls',
			'application/x-xls'                                                         => 'xls',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'         => 'xlsx',
			'application/vnd.ms-excel'                                                  => 'xlsx',
			'application/xml'                                                           => 'xml',
			'text/xml'                                                                  => 'xml',
			'text/xsl'                                                                  => 'xsl',
			'application/xspf+xml'                                                      => 'xspf',
			'application/x-compress'                                                    => 'z',
			'application/x-zip'                                                         => 'zip',
			'application/zip'                                                           => 'zip',
			'application/x-zip-compressed'                                              => 'zip',
			'application/s-compressed'                                                  => 'zip',
			'multipart/x-zip'                                                           => 'zip',
			'text/x-scriptzsh'                                                          => 'zsh',
		];

		return isset($mime_map[$mime]) ? $mime_map[$mime] : false;
	}
	function getDoNotText($focus, $field='get_do_not_text', $value='', $view='DetailView'){

		$ht_sms = new ht_sms();
		$phone_status = $ht_sms->checkPhoneStatus(trim($focus->phone_mobile, " "));
		$checked = '';
		if(strpos($phone_status, 'OptOut') !== false){
			$checked = 'checked';
		}
		return '<input type="checkbox" id="get_do_not_text" '.$checked.' name="get_do_not_text" disabled>';
	}
	function getRelatedTexts($params){
		$return_array['select']=' SELECT ht_sms.id ';
		$return_array['from']=' FROM ht_sms';
		$return_array['where']=" WHERE ht_sms.deleted=0 AND ht_sms.name LIKE '%{$params['name']}%'";

		return $return_array;

	}
	function get_emails_by_assign_or_linkss(){
	$bean = $GLOBALS['app']->controller->bean;
    $return_array['select'] = 'SELECT emails.id ';
    $return_array['from'] = 'FROM emails ';
    $return_array['where'] = '';
    $return_array['join'] = " JOIN (select DISTINCT email_id from emails_email_addr_rel eear

	join email_addr_bean_rel eabr on eabr.bean_id ='$bean->id' and eabr.bean_module = '$bean->module_dir' and
	eabr.email_address_id = eear.email_address_id and eabr.deleted=0
	where eear.deleted=0 and eear.email_id not in
	(select eb.email_id from emails_beans eb where eb.bean_module ='$bean->module_dir' and eb.bean_id = '$bean->id')
	) derivedemails on derivedemails.email_id = emails.id";
    $return_array['join_tables'][0] = '';
	return $return_array;
}
