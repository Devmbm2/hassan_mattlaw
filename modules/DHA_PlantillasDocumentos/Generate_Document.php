<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

//////////////////////////////////////////////////////////////////////////////
require_once('modules/DHA_PlantillasDocumentos/Generate_Document_Class.php');

//////////////////////////////////////////////////////////////////////////////
function getEmailRelationshipFieldName ($modulo){
   $m1 = 'Emails';
   $m2 = $modulo;
   
   global $db, $dictionary, $beanList;
   $rel = new Relationship;
   if($rel_info = $rel->retrieve_by_sides($m1, $m2, $db)){
      $bean = BeanFactory::getBean($m1);
      $rel_name = $rel_info['relationship_name'];
      foreach($bean->field_defs as $field => $def){
         if(isset($def['relationship']) && $def['relationship'] == $rel_name && $def['type'] == 'link') {
            return $def['name'];
         }
      }
   }
   return false;
}

//////////////////////////////////////////////////////////////////////////////
function GenerateDocument ($modulo, $plantilla_id, $ids, $enPDF) {   
   $GD = new Generate_Document($modulo, $plantilla_id, $ids);
   $GD->enPDF = $enPDF;
   $GD->CargarPlantilla ();
   $GD->ObtenerDatos ();
   $GD->GenerarInforme ();
}


//////////////////////////////////////////////////////////////////////////////
function GenerateDocument_Sugar7 ($api, $modulo, $plantilla_id, $ids, $enPDF) {   
   $GD = new Generate_Document($modulo, $plantilla_id, $ids);
   $GD->enPDF = $enPDF;
   $GD->Download = false;
   $GD->CargarPlantilla ();
   $GD->ObtenerDatos ();
   $GD->GenerarInforme ();
   
   if ($GD->Download_filename) {
      require_once('include/utils/sugar_file_utils.php');
      
      $filename = $GD->template_filename; 
      if ($GD->enPDF){
         $filename = preg_replace("#\.{$GD->template_file_ext}$#", '.pdf', $filename);
      }
      
      //$content = sugar_file_get_contents($GD->Download_filename);
      $content = file_get_contents($GD->Download_filename);
      /* echo $content;die; */
      // Ver \clients\base\api\ExportApi.php
      ob_end_clean();

      $api->setHeader("Pragma", "cache");
      $api->setHeader("Content-Type", "application/octet-stream");
      $api->setHeader("Content-Disposition", "attachment; filename=\"{$filename}\"");
      $api->setHeader("Content-transfer-encoding", "binary");
      $api->setHeader("Expires", "Mon, 26 Jul 1997 05:00:00 GMT");
      $api->setHeader("Last-Modified", TimeDate::httpTime());
      $api->setHeader("Cache-Control", "post-check=0, pre-check=0");         

      return $content;
   }
   else {
      return "";
   }
}

//////////////////////////////////////////////////////////////////////////////
function GenerateDocumentAndAttachToEmail ($modulo, $plantilla_id, $ids, $enPDF) {
   $GD = new Generate_Document($modulo, $plantilla_id, $ids);
   $GD->enPDF = $enPDF;
   $GD->Download = false;
   $GD->CargarPlantilla ();
   $GD->ObtenerDatos ();
   $GD->GenerarInforme ();
   
   $email_id = '';
   
   if ($GD->Download_filename) {
      global $app_list_strings, $current_user, $mod_strings, $sugar_config, $timedate;
      require_once('modules/Emails/Email.php');
      require_once('include/utils/sugar_file_utils.php');
      
      // Create e-mail draft
      $email = new Email();
      $email->id = create_guid();
      $email->new_with_id = true;
      
      $namePlusEmail = '';
      if (count($ids) == 1){
         $namePlusEmail = $email->getNamePlusEmailAddressesForCompose($modulo, array($ids[0]));
      }
      $subject = $mod_strings['LBL_DOC_NAME'] . ' - ' . $GD->bean_plantilla->name . ' - ' . date('Y-m-d G:i');
      
      if (isset($app_list_strings['record_type_display'][$modulo]) && count($ids) == 1){
         $email->parent_type = $modulo; 
         $email->parent_id = $ids[0];
         $email->parent_name = '';
      }
      
      //subject      
      $email->name = $subject; 
      //body
      $email->description_html = '';
      $email->description = '';
      //type is draft
      $email->type = "draft";
      $email->status = "draft";
      $email->from_name = $current_user->full_name;
      $email->from_addr = $current_user->email1;
      $email->to_addrs = $namePlusEmail;
      $email->to_addrs_names = $namePlusEmail;
      $email->to_addrs_ids = "";
      $email->to_addrs_emails = "";      
      $email->assigned_user_id = $current_user->id;      
      $email->date_start = $timedate->nowDbDate();
      $email->time_start = $timedate->asDbTime($timedate->getNow());
      
      //Save the email object
      $email->save(FALSE);
      $email_id = $email->id;
      
      // Relationship
      $EmailRelationshipFieldName = getEmailRelationshipFieldName($modulo);
      if ($EmailRelationshipFieldName !== false) {
         if (count($ids) == 1) {
            $email->load_relationship($EmailRelationshipFieldName);
            foreach ($ids as $id) {
               $email->$EmailRelationshipFieldName->add($id);
            }    
         }
      }
      
      $NoteFileName = $GD->template_filename; 
      if ($GD->enPDF){
         $NoteFileName = preg_replace("#\.{$GD->template_file_ext}$#", '.pdf', $NoteFileName);
      }
      
      // attach generated document
      $note = new Note();
      $note->modified_user_id = $current_user->id;
      $note->created_by = $current_user->id;
      $note->name = $subject;
      $note->parent_type = 'Emails';
      $note->parent_id = $email_id;
      $note->file_mime_type = $GD->Download_mimetype;
      $note->filename = $NoteFileName;
      $NoteId = $note->save();
      
      $fichero_destino = $GD->includeTrailingCharacter ($sugar_config['upload_dir'], '/') . $NoteId;
      copy($GD->Download_filename, $fichero_destino);
      sugar_chmod($fichero_destino);      
      
      if (!$GD->Sugar7Module ($modulo)) {
         // Redirect ...
         if($email_id == "") {
            echo "Unable to initiate Email Client";
            exit; 
         } else {
            if (count($ids) == 1) {
               $dURL = "index.php?action=ComposeGeneratedDocumentEmail&module=Emails&return_module=".$modulo."&return_action=DetailView&return_id=".$ids[0]."&recordId=".$email_id; 
            }
            else {
               $dURL = "index.php?action=ComposeGeneratedDocumentEmail&module=Emails&recordId=".$email_id; 
            }
            SugarApplication::redirect($dURL);
         }
      }
   }
   
   return $email_id;
}

//////////////////////////////////////////////////////////////////////////////
function GenerateDocumentAndAttachToNote ($modulo, $plantilla_id, $ids, $enPDF) {
   // Nota: Cuando se llama a esta función, solo deben de haber un id y el módulo debe de estar relacionado con Notas
   //       Esto se traduce en que la llamada solo se puede producir desde el DetailView, y que el módulo debe de estar dentro de la lista $app_list_strings['record_type_display_notes']
   
   $GD = new Generate_Document($modulo, $plantilla_id, $ids);
   $GD->enPDF = $enPDF;
   $GD->Download = false;
   $GD->CargarPlantilla ();
   $GD->ObtenerDatos ();
   $GD->GenerarInforme ();
   
   $NoteId = '';
   
   if ($GD->Download_filename) {
      global $app_list_strings, $current_user, $mod_strings, $sugar_config, $timedate;
      require_once('include/utils/sugar_file_utils.php');
      
      $parent_type = $modulo;
      $parent_id = $ids[0];
      $contact_id = '';
      
      if ($modulo == 'Contacts') {
         $bean_contacts = SugarModule::get('Contacts')->loadBean();
         $bean_contacts->retrieve($parent_id);
         
         $contact_id = $parent_id;
         
         if (isset($bean_contacts->account_id) && $bean_contacts->account_id) {
            $parent_type = 'Accounts';
            $parent_id = $bean_contacts->account_id;
         }
      }      
      
      $NoteFileName = $GD->template_filename; 
      if ($GD->enPDF){
         $NoteFileName = preg_replace("#\.{$GD->template_file_ext}$#", '.pdf', $NoteFileName);
      }
      
      $note = new Note();
      $note->modified_user_id = $current_user->id;
      $note->created_by = $current_user->id;
      $note->name = $GD->bean_plantilla->name;
      $note->parent_type = $parent_type;
      $note->parent_id = $parent_id;
      $note->contact_id = $contact_id;
      $note->file_mime_type = $GD->Download_mimetype;
      $note->filename = $NoteFileName;
      $NoteId = $note->save();
      
      $fichero_destino = $GD->includeTrailingCharacter ($sugar_config['upload_dir'], '/') . $NoteId;
      copy($GD->Download_filename, $fichero_destino);
      sugar_chmod($fichero_destino);      
      
      if (!$GD->Sugar7Module ($modulo)) {
         // Redirect ...
         if($NoteId == "") {
            echo "Error creating Note '{$GD->bean_plantilla->name}'";
            exit; 
         } else {
            $dURL = "index.php?action=DetailView&module=Notes&record=".$NoteId; 
            SugarApplication::redirect($dURL);
         }
      }
   }
   
   return $NoteId;
}
////////////////////////////////////////////////////////////////////////////////////////////
function generateMultiFiles(&$GD){
	
	$file_names = array(); 
	foreach($GD->relaciones AS $relation) {
		$data_array = $GD->datos;
		foreach($data_array AS $index => $data) {
			$related_records = $data[$relation];
			if(isset($related_records) && sizeof($related_records) > 0){
				foreach($related_records AS $r_record) {
					$GD->CargarPlantilla ();
					$GD->datos[$index][$relation] = array(
						0 => $r_record
					);
					$GD->GenerarInforme();
					$file_names[$GD->Download_filename] = $r_record['name'].'.docx';
				}
			}
		}
	}
	return $file_names;
}
function GenerateDocumentAndAttachToRecord (&$GD,$modulo, $plantilla_id, $ids, $redirect = true) {
	// Nota: Cuando se llama a esta función, solo deben de haber un id y el módulo debe de estar relacionado con Notas
	//       Esto se traduce en que la llamada solo se puede producir desde el DetailView, y que el módulo debe de estar dentro de la 	lista $app_list_strings['record_type_display_notes']
	global $db, $log;
	$GD->Download = false;
	$GD->GenerarInforme ();
	$NoteId = '';

	if ($GD->Download_filename) {
		global $app_list_strings, $current_user, $mod_strings, $sugar_config, $timedate;
		require_once('include/utils/sugar_file_utils.php');
		require_once('include/externalAPI/ExternalAPIFactory.php');
		require_once 'include/UploadStream.php';
		$parent_type = $modulo;
		$parent_id = $ids[0];
		$contact_id = '';

		if ($modulo == 'Cases') {
			$bean_contacts = SugarModule::get('Cases')->loadBean();
			$bean_contacts->retrieve($parent_id);

			$contact_id = $parent_id;

			/* if (isset($bean_contacts->account_id) && $bean_contacts->account_id) {
			$parent_type = 'Accounts';
			$parent_id = $bean_contacts->account_id;
			} */
		}
		if ($modulo == 'Complaints') {
			$bean_complaints = SugarModule::get('Complaints')->loadBean();
			$bean_complaints->retrieve($parent_id);
			$case_id = $bean_complaints->acase_id_c;
		}
		$NoteFileName = $GD->template_filename; 
		$Document = new Document();
		$doc_type = 'Google';
		if ($GD->enPDF){
			$NoteFileName = preg_replace("#\.{$GD->template_file_ext}$#", '.pdf', $NoteFileName);
			// $Document->hard_or_soft_doc = 'Hard_Documents';
			$doc_type = 'Sugar';
		}else if($GD->is_PowerPoint){
			$NoteFileName = preg_replace("#\.{$GD->template_file_ext}$#", '.pptx', $NoteFileName);
			$Document->hard_or_soft_doc = 'Soft_Documents';
		}else{
			$Document->hard_or_soft_doc = 'Soft_Documents';
		}
		$date = $timedate->getInstance()->nowDb(); 
		$current_date = date('Y-m-d', strtotime($date));
		$Document->category_id = 'Outgoing';
		$Document->outgoing_document = 1;
		$Document->authors_name_c = $current_user->name;
		$Document->date_of_document_c = $current_date;
		$Document->modified_user_id = $current_user->id;
		$Document->created_by = $current_user->id;
		$Document->document_name = $NoteFileName;
		$Document->case_id = $case_id;
		$Document->parent_type = $parent_type;
		$Document->doc_type = $doc_type ;
		$Document->contact_id = $contact_id;
		$Document->filename = $NoteFileName;
		$DocumentId = $Document->save();
		$contents = file_get_contents ($GD->Download_filename);
		$revision = new DocumentRevision;
		$revision->document_id = $DocumentId;
		$revision->file = base64_encode($contents);
		$revision->filename = $Document->filename;
		$revision->revision = 1;
		$revision->doc_type = $doc_type;
		$revision->file_ext = pathinfo($GD->Download_filename, PATHINFO_EXTENSION);
		$revision->file_mime_type = $GD->Download_mimetype;
		$revision->save();
		$relation_mapping = array(
			'Contacts' => 'contacts',
			'Cases' => 'cases',
			'Leads' => 'leads',
			'MEDB_Medical_Bills' => 'medb_medical_bills_documents_1',
			'MEDR_Medical_Records' => 'medr_medical_records_documents_1',
			'MREQ_MEDB_Requests' => 'mreq_medb_requests_documents_1',
		);
		if(isset($relation_mapping[$modulo]) && $Document->load_relationship($relation_mapping[$modulo])){
			$relation_name = $relation_mapping[$modulo];
			foreach($ids as $key => $value){
				// $id = create_guid();
				// $sql = "INSERT INTO documents_cases (id, date_modified, deleted, document_id, case_id) VALUES ('{$id}', NOW(), 0, '{$DocumentId}','{$value}' )";
				// $db->query($sql);
				// $modulo_bean = BeanFactory::getBean($modulo, $value);
				$Document->$relation_name->add($value);
			}
			
			if($modulo == 'Contacts' && isset($_REQUEST['related_selected'])){
				$bill_relation = 'medb_medical_bills_contacts';
				$relation_name = $relation_mapping['MEDB_Medical_Bills'];
				$reduction_list = array('34aa3888-5044-cf46-5cd6-59a04a864e9b', '684d0dd0-a440-cd12-23a6-59a04e90831f', '89dd7df0-5867-6e5c-0840-59a04eba1c43');
				if(in_array($plantilla_id, $reduction_list)){
					$relation_name = 'medb_medical_bills_documents_reductions';
					$Document->subcategory_id  = 'LOP_Liens';
					$Document->save();
				}
				foreach($GD->datos AS $parse_data){
					if(isset($parse_data[$bill_relation]) && $Document->load_relationship($relation_name)){
						foreach($parse_data[$bill_relation] AS $related_record){
							$Document->$relation_name->add($related_record['id']);
						}
					}
				}
			}
		}
		$fichero_destino = $GD->includeTrailingCharacter ($sugar_config['upload_dir'], '/') . $revision->id;
		copy($GD->Download_filename, $fichero_destino);
		sugar_chmod($fichero_destino);
		if($doc_type == 'Google'){
			
			try {
				$api = ExternalAPIFactory::loadAPI($revision->doc_type,true);
				
				if($GD->is_PowerPoint){
					$subcategory  = 'Timeline';
				}else{
					$subcategory  = $app_list_strings['Document_Main_Category'][$Document->subcategory_id] ? $app_list_strings['Document_Main_Category'][$Document->subcategory_id] : $Document->subcategory_id;
				}
					
				if (isset($api) && $api !== false) {
					$result = $api->uploadDoc(
						$revision,
						$GD->Download_filename,
						$revision->filename,
						$revision->file_mime_type,
						array(
							'Honeylaw CRM Documents',
							$GD->bean_datos->client_c.' - '.$GD->bean_datos->contact_id1_c,
							$GD->bean_datos->name.' - '.$GD->bean_datos->new_case_number_c,
							$subcategory,
						)
					);
				} else {
					$result['success'] = false;
					// FIXME: Translate
					$GLOBALS['log']->error("Could not load the requested API (" . $revision->doc_type . ")");
					$result['errorMessage'] = 'Could not find a proper API';
				}
			} catch (Exception $e) {
				$result['success'] = false;
				$result['errorMessage'] = $e->getMessage();
				$GLOBALS['log']->error("Caught exception: (" . $e->getMessage() . ") ");
			}
			
			if (!$result['success']) {
				// sugar_rename($fichero_destino, str_replace($revision->id . '_' . $file_name, $revision->id, $fichero_destino));
				$Document->doc_type = 'Sugar';
				$Document->save();
				$revision->doc_type = 'Sugar';
				// FIXME: Translate
				if (!is_array($_SESSION['user_error_message'])) {
					$_SESSION['user_error_message'] = array();
				}

				$error_message = isset($result['errorMessage']) ? $result['errorMessage'] :
					$GLOBALS['app_strings']['ERR_EXTERNAL_API_SAVE_FAIL'];
				$_SESSION['user_error_message'][] = $error_message;

				
			} else {
				unlink($fichero_destino);
			}
			$revision->save();
		}else{
			// sugar_rename($fichero_destino, str_replace($revision->id . '_' . $file_name, $revision->id, $fichero_destino));
		}
		
		
		if (!$GD->Sugar7Module ($modulo)) {
			// Redirect ...
			if($DocumentId == "") {
				echo "Error creating Note '{$GD->bean_plantilla->name}'";
				exit; 
			} else if(!isset($_REQUEST['from_scheduler'])) {
				if(count($ids) > 1){
					$dURL = "index.php?action=DetailView&module=".$modulo."&record=".$ids[0];
				}else{
					$dURL = "index.php?action=DetailView&module=Documents&record=".$DocumentId; 				 
					if($revision->doc_type == 'Google')
						$dURL .= "&doc_url=".$revision->doc_url;
				}
				if($redirect)
					/* echo '<script>window.open("'.$dURL.'")</script>'; */
					SugarApplication::redirect($dURL);
				else
					return $revision->doc_url;
			}
		}
	}

   return $DocumentId;
}

function HTGenerateDocumentAndAttachToRecord (&$GD,$modulo, $plantilla_id, $ids, $redirect = true) {
	// Nota: Cuando se llama a esta función, solo deben de haber un id y el módulo debe de estar relacionado con Notas
	//       Esto se traduce en que la llamada solo se puede producir desde el DetailView, y que el módulo debe de estar dentro de la 	lista $app_list_strings['record_type_display_notes']
	$contact_list = $_REQUEST['mandatory_select'];
	global $db, $log;
	$c1 = array();
	$NoteId = '';
	if(isset($contact_list) && $modulo == 'Cases'){

	$header_bean = SugarModule::get('ht_doc_temp_letter_head')->loadBean();
	$header_id = $_REQUEST['letterhead_id'];
	$header_bean->retrieve($header_id);
	$header_download_location = $header_bean->get_file_name($header_id, $header_bean->file_ext);
	
					foreach($GD->relaciones AS $relation) {
						$data_array = $GD->datos;
						foreach($data_array AS $index => $data) {
							$related_records = $data[$relation];
							if(isset($related_records) && sizeof($related_records) > 0){
								foreach($related_records AS $key => $r_record) {
									$GD->CargarPlantilla ();
									$GD->datos[$index][$relation] = array(
										0 => $r_record
									);
									$GD->Download = false;
									$GD->GenerarInforme ();
									if(file_exists($header_download_location) && !empty($header_id)){
									$merge = new Phpdocx\Utilities\DocxUtilities();
									$merge->mergeDocx($header_download_location, $GD->Download_filename, 'uploads/finalGD-'.$r_record['id'].'.docx', array('mergeType' => 1));
									// sugar_chmod($temp_dowload_loc, 0777);
									$htcontents = 'uploads/finalGD-'.$r_record['id'].'.docx';
								}
								else
								{
									$htcontents = $GD->Download_filename;
								}
									if($key == 0){
										$c2 = $htcontents;
									}
									else{
									$c1[] = $htcontents;
								}
								} 
							}
						}
					}
					// die();
			$myOptions = array('mergeType' => 0);	
	$newDocx = new Phpdocx\BatchProcessing\MultiMerge();
	$newDocx->mergeDocx($c2,$c1,'uploads/test-update-final-'.$plantilla_id.'.docx',$myOptions);
                 
       $GD->Download_filename = 'uploads/test-update-final-'.$plantilla_id.'.docx';
       unlink($c2);
       foreach ($c1 as $key => $filename) {
       	unlink($filename);
       	// code...
       }
       
       // die();
	}
	else{
		$GD->Download = false;
	$GD->GenerarInforme ();
	}           
if ($GD->Download_filename) {
	// print_r($convert);
		global $app_list_strings, $current_user, $mod_strings, $sugar_config, $timedate;
		require_once('include/utils/sugar_file_utils.php');
		require_once('include/externalAPI/ExternalAPIFactory.php');
		require_once 'include/UploadStream.php';
		$parent_type = $modulo;
		$parent_id = $ids[0];
		$contact_id = '';

		if ($modulo == 'Cases') {
			$bean_contacts = SugarModule::get('Cases')->loadBean();
			$bean_contacts->retrieve($parent_id);

			$contact_id = $parent_id;

			/* if (isset($bean_contacts->account_id) && $bean_contacts->account_id) {
			$parent_type = 'Accounts';
			$parent_id = $bean_contacts->account_id;
			} */
		}
		if ($modulo == 'Complaints') {
			$bean_complaints = SugarModule::get('Complaints')->loadBean();
			$bean_complaints->retrieve($parent_id);
			$case_id = $bean_complaints->acase_id_c;
		}
		$NoteFileName = $GD->template_filename; 
		$Document = new Document();
		$doc_type = 'Google';
		if ($GD->enPDF){
			$NoteFileName = preg_replace("#\.{$GD->template_file_ext}$#", '.pdf', $NoteFileName);
			// $Document->hard_or_soft_doc = 'Hard_Documents';
			$doc_type = 'Sugar';
		}else if($GD->is_PowerPoint){
			$NoteFileName = preg_replace("#\.{$GD->template_file_ext}$#", '.pptx', $NoteFileName);
			$Document->hard_or_soft_doc = 'Soft_Documents';
		}else{
			$Document->hard_or_soft_doc = 'Soft_Documents';
		}
		$date = $timedate->getInstance()->nowDb(); 
		$current_date = date('Y-m-d', strtotime($date));
		$Document->category_id = 'Outgoing';
		$Document->outgoing_document = 1;
		$Document->authors_name_c = $current_user->name;
		$Document->date_of_document_c = $current_date;
		$Document->modified_user_id = $current_user->id;
		$Document->created_by = $current_user->id;
		$Document->document_name = $NoteFileName;
		$Document->case_id = $case_id;
		$Document->parent_type = $parent_type;
		$Document->doc_type = $doc_type ;
		$Document->contact_id = $contact_id;
		$Document->filename = $NoteFileName;
		$DocumentId = $Document->save();
		$contents = file_get_contents ($GD->Download_filename);
		$revision = new DocumentRevision;
		$revision->document_id = $DocumentId;
		$revision->file = base64_encode($contents);
		$revision->filename = $Document->filename;
		$revision->revision = 1;
		$revision->doc_type = $doc_type;
		$revision->file_ext = pathinfo($GD->Download_filename, PATHINFO_EXTENSION);
		$revision->file_mime_type = $GD->Download_mimetype;
		$revision->save();
		$relation_mapping = array(
			'Contacts' => 'contacts',
			'Cases' => 'cases',
			'Leads' => 'leads',
			'MEDB_Medical_Bills' => 'medb_medical_bills_documents_1',
			'MEDR_Medical_Records' => 'medr_medical_records_documents_1',
			'MREQ_MEDB_Requests' => 'mreq_medb_requests_documents_1',
		);
		if(isset($relation_mapping[$modulo]) && $Document->load_relationship($relation_mapping[$modulo])){
			$relation_name = $relation_mapping[$modulo];
			foreach($ids as $key => $value){
				// $id = create_guid();
				// $sql = "INSERT INTO documents_cases (id, date_modified, deleted, document_id, case_id) VALUES ('{$id}', NOW(), 0, '{$DocumentId}','{$value}' )";
				// $db->query($sql);
				// $modulo_bean = BeanFactory::getBean($modulo, $value);
				$Document->$relation_name->add($value);
			}
			
			if($modulo == 'Contacts' && isset($_REQUEST['related_selected'])){
				$bill_relation = 'medb_medical_bills_contacts';
				$relation_name = $relation_mapping['MEDB_Medical_Bills'];
				$reduction_list = array('34aa3888-5044-cf46-5cd6-59a04a864e9b', '684d0dd0-a440-cd12-23a6-59a04e90831f', '89dd7df0-5867-6e5c-0840-59a04eba1c43');
				if(in_array($plantilla_id, $reduction_list)){
					$relation_name = 'medb_medical_bills_documents_reductions';
					$Document->subcategory_id  = 'LOP_Liens';
					$Document->save();
				}
				foreach($GD->datos AS $parse_data){
					if(isset($parse_data[$bill_relation]) && $Document->load_relationship($relation_name)){
						foreach($parse_data[$bill_relation] AS $related_record){
							$Document->$relation_name->add($related_record['id']);
						}
					}
				}
			}
		}

		$fichero_destino = $GD->includeTrailingCharacter ($sugar_config['upload_dir'], '/') . $revision->id;
		copy($GD->Download_filename, $fichero_destino);
		sugar_chmod($fichero_destino);
		// print_r($GD->Download_filename);
		// print_r($fichero_destino);
		// print_r($contents);
		// die();
		if($doc_type == 'Google'){
			
			try {
				$api = ExternalAPIFactory::loadAPI($revision->doc_type,true);
				
				if($GD->is_PowerPoint){
					$subcategory  = 'Timeline';
				}else{
					$subcategory  = $app_list_strings['Document_Main_Category'][$Document->subcategory_id] ? $app_list_strings['Document_Main_Category'][$Document->subcategory_id] : $Document->subcategory_id;
				}
					
				if (isset($api) && $api !== false) {
					$result = $api->uploadDoc(
						$revision,
						$GD->Download_filename,
						$revision->filename,
						$revision->file_mime_type,
						array(
							'Honeylaw CRM Documents',
							$GD->bean_datos->client_c.' - '.$GD->bean_datos->contact_id1_c,
							$GD->bean_datos->name.' - '.$GD->bean_datos->new_case_number_c,
							$subcategory,
						)
					);
				} else {
					$result['success'] = false;
					// FIXME: Translate
					$GLOBALS['log']->error("Could not load the requested API (" . $revision->doc_type . ")");
					$result['errorMessage'] = 'Could not find a proper API';
				}
			} catch (Exception $e) {
				$result['success'] = false;
				$result['errorMessage'] = $e->getMessage();
				$GLOBALS['log']->error("Caught exception: (" . $e->getMessage() . ") ");
			}
			
			if (!$result['success']) {
				// sugar_rename($fichero_destino, str_replace($revision->id . '_' . $file_name, $revision->id, $fichero_destino));
				$Document->doc_type = 'Sugar';
				$Document->save();
				$revision->doc_type = 'Sugar';
				// FIXME: Translate
				if (!is_array($_SESSION['user_error_message'])) {
					$_SESSION['user_error_message'] = array();
				}

				$error_message = isset($result['errorMessage']) ? $result['errorMessage'] :
					$GLOBALS['app_strings']['ERR_EXTERNAL_API_SAVE_FAIL'];
				$_SESSION['user_error_message'][] = $error_message;

				
			} else {
				unlink($fichero_destino);
				unlink($GD->Download_filename);
			}
			$revision->save();
		}else{
			// sugar_rename($fichero_destino, str_replace($revision->id . '_' . $file_name, $revision->id, $fichero_destino));
		}
		
		
		if (!$GD->Sugar7Module ($modulo)) {
			// Redirect ...
			if($DocumentId == "") {
				echo "Error creating Note '{$GD->bean_plantilla->name}'";
				exit; 
			} else if(!isset($_REQUEST['from_scheduler'])) {
				if(count($ids) > 1){
					$dURL = "index.php?action=DetailView&module=".$modulo."&record=".$ids[0];
				}else{
					$dURL = "index.php?action=DetailView&module=Documents&record=".$DocumentId; 				 
					if($revision->doc_type == 'Google')
						$dURL .= "&doc_url=".$revision->doc_url;
				}
				if($redirect)
					/* echo '<script>window.open("'.$dURL.'")</script>'; */
					SugarApplication::redirect($dURL);
				else
					return $revision->doc_url;
			}
		}
	}
	

   return $DocumentId;
}
?>