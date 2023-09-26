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
   // foreach($GD->relaciones AS $relation) {
		// $data_array = $GD->datos;
		// foreach($data_array AS $data) {
			// $related_records = $data[$relation];
			// if(isset($related_records) && sizeof($related_records) > 0){
				// foreach($related_records AS $r_record) {
					// //print"<pre>";print_r($r_record);die;
				// }
				
			// }
		// }
	   
	// }
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

function GenerateDocumentAndAttachToCase (&$GD,$modulo, $plantilla_id, $ids) {
   // Nota: Cuando se llama a esta función, solo deben de haber un id y el módulo debe de estar relacionado con Notas
   //       Esto se traduce en que la llamada solo se puede producir desde el DetailView, y que el módulo debe de estar dentro de la lista $app_list_strings['record_type_display_notes']
   global $db;
   $GD->Download = false;
    $GD->GenerarInforme ();
   
   $NoteId = '';
   
   if ($GD->Download_filename) {
      global $app_list_strings, $current_user, $mod_strings, $sugar_config, $timedate;
      require_once('include/utils/sugar_file_utils.php');
       require_once('include/upload_file.php');
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
      
      $NoteFileName = $GD->template_filename; 
      if ($GD->enPDF){
         $NoteFileName = preg_replace("#\.{$GD->template_file_ext}$#", '.pdf', $NoteFileName);
      }
      $Document = new Document();
      $Document->modified_user_id = $current_user->id;
      $Document->created_by = $current_user->id;
      $Document->document_name = $GD->bean_plantilla->name;
      $Document->parent_type = $parent_type;
      $Document->case_id = $contact_id;
      $Document->filename = $NoteFileName;
      $DocumentId = $Document->save();
      $contents = file_get_contents ($Document->filename);
	  $revision = new DocumentRevision;
	  $revision->document_id = $DocumentId;
	  $revision->file = base64_encode($contents);
	  $revision->filename = $Document->filename;
	  $revision->revision = 1;
	  $revision->doc_type = 'Sugar';
	  $revision->file_mime_type = $GD->Download_mimetype;
	  $revision->save();
	  foreach($ids as $key => $value){
		  $id = create_guid();
		  $sql = "INSERT INTO documents_cases (id, date_modified, deleted, document_id, case_id) VALUES ('{$id}', NOW(), 0, '{$DocumentId}','{$value}' )";
		  $GLOBALS['log']->fatal($sql);
		  $db->query($sql);
	  }
      $fichero_destino = $GD->includeTrailingCharacter ($sugar_config['upload_dir'], '/') . $revision->id;
      copy($GD->Download_filename, $fichero_destino);
      sugar_chmod($fichero_destino);      
      
      if (!$GD->Sugar7Module ($modulo)) {
         // Redirect ...
         if($DocumentId == "") {
            echo "Error creating Note '{$GD->bean_plantilla->name}'";
            exit; 
         } else {
			 if(count($ids) > 1){
				$dURL = "index.php?action=DetailView&module=Documents&record=".$DocumentId; 				 
			 }else{
				 $dURL = "index.php?action=DetailView&module=Cases&record=".$ids[0];
			 }
            SugarApplication::redirect($dURL);
         }
      }
   }
   
   return $DocumentId;
}

?>