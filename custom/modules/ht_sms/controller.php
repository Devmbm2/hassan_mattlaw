<?php
class ht_smsController extends SugarController
{
	function action_update_phone_list_status() {
		$this->view = "";
		ob_clean();
		$bean = BeanFactory::getBean('ht_sms', $_REQUEST['record']);
		$from = '';
		if($bean->sent_received == 'Outgoing'){
			$from = $bean->to_number;
		}else if($bean->sent_received == 'Incoming'){
			$from = $bean->from_number;
		}
		$ht_sms = new ht_sms();
		$ht_sms->checkCreateUpdate($from, $_REQUEST['status']);
		SugarApplication::redirect("index.php?module=ht_sms&action=DetailView&record={$_REQUEST['record']}");
	} 
	function action_link_document() {
		$this->view = "link_document";
	}  
	function action_save_link_document() {
		/* die('asd'); */
		/* ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL); */
		global $db, $current_user;
		$this->view = NULL;
		$doc_id = create_guid();
		$revision = new DocumentRevision;
		$file = "upload/{$_REQUEST['record']}";
		$contents = file_get_contents($file);
		$filename = 'MMS';
		if(isset($_REQUEST['file_name']) && !empty($_REQUEST['file_name'])){
			$filename = $_REQUEST['file_name'];
		}
		
		$file_info = new finfo(FILEINFO_MIME_TYPE);
		$mime_type = $file_info->buffer(file_get_contents($file));
		$ext  = mime2ext($mime_type);
		/* print"<pre>";print_r($ext);die; */
		$revision->document_id = $doc_id;
		$revision->filename = $filename.'.'.$ext;
		$revision->revision = 1;
		$revision->created_by= '1';
		$revision->file_mime_type = $mime_type;
		$revision->save();
		file_put_contents("upload/{$revision->id}", $contents);
		$doc_query = "INSERT INTO documents
						 (id, date_entered, date_modified, modified_user_id, created_by,
						 assigned_user_id,  document_name, doc_id, doc_type, doc_url, document_revision_id) VALUES 
						 ('{$doc_id}', NOW(), NOW(), '{$current_user->id}', '{$current_user->id}', '{$current_user->id}', '{$filename}', 
						 '{$doc_id}', '','', '{$revision->id}')";
		$db->query($doc_query,true);
		if(isset($_REQUEST['parent_id']) && !empty($_REQUEST['parent_id']) && $_REQUEST['parent_type'] == 'Cases'){
			$doc_case_query = "INSERT INTO documents_cases
						 (id, date_modified, document_id, case_id) VALUES 
						 (UUID(), NOW(),  '{$doc_id}', '{$_REQUEST['parent_id']}')";
			$db->query($doc_case_query,true);
		}else if(isset($_REQUEST['parent_id']) && !empty($_REQUEST['parent_id']) && $_REQUEST['parent_type'] == 'Contacts'){
			$doc_contact_query = "INSERT INTO documents_contacts
						 (id, date_modified, document_id, contact_id) VALUES 
						 (UUID(), NOW(),  '{$doc_id}', '{$_REQUEST['parent_id']}')";
			$db->query($doc_contact_query,true);
		}
		/* else if(isset($_REQUEST['parent_id']) && !empty($_REQUEST['parent_id']) && $_REQUEST['parent_type'] == 'Accounts'){
			$doc_account_query = "INSERT INTO documents_accounts
						 (id, date_modified, document_id, account_id) VALUES 
						 (UUID(), NOW(),  '{$doc_id}', '{$_REQUEST['parent_id']}')";
			$db->query($doc_account_query,true);
		} */
		SugarApplication::appendErrorMessage("Document has been Created with the MMS file and Linked to the Selected Record. You can edit the Document record.");
		SugarApplication::redirect("index.php?module=Documents&action=DetailView&record={$doc_id}"); 
	}
}
?>