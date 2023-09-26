<?php
class Documents_logic_hooks22{
	function setAttachments22($bean, $event, $arguments){
			global $db, $log, $sugar_config, $current_user;
			$target_dir = "upload/attachments/";
			$uploads_dir = 'upload/';
			$attached_files_upload = scandir($target_dir);
			$attachments_id =array();
			$attachments_name =array();
			$attachments_types =array();
			$attachments_id   = explode(",", $_POST['case_attachments_file_id'][0]);
			$attachments_name = explode(",", $_POST['case_attachments_file_name'][0]);
			$attachments_types = explode(",", $_POST['case_attachments_file_types'][0]);
			//  print"<pre>";print_r($_POST);die;
			foreach($attachments_id as $key => $file_id){

				$sql = "SELECT *
						FROM notes
						WHERE id = '{$file_id}'";
				$result = $db->query($sql, true);
				if($db->getRowCount($result) < 1){
					if (in_array($file_id, $attached_files_upload)){
						require_once('include/upload_file.php');
						$source = $target_dir.$file_id;
						$destination = $uploads_dir.$file_id;
						rename($source, $destination);
						$note = new Note();
						$note->id = $file_id;
						$note->new_with_id = true;
						$note->name  =  $attachments_name[$key];
						$note->filename  =  $attachments_name[$key];
						$note->file_mime_type  =  $attachments_types[$key];
						$note->document_id  =  $bean->id;
						$note->save();
						unlink($source);
					}
				}
			}
			// if(isset($_POST['case_attachments_file_id'])){
			// 	$sql = "UPDATE notes
			// 			SET deleted=1, date_modified = NOW()
			// 			WHERE document_id='{$bean->id}'  AND id NOT IN ('".implode("','", $attachments_id)."')";
			// 	$db->query($sql, true);

			// }
	}
}
