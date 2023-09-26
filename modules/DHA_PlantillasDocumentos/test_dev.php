<?php

require_once('include/MVC/Controller/SugarController.php');
  
class DHA_PlantillasDocumentosController extends SugarController {

   ///////////////////////////////////////////////////////////////////////////
   function action_editview(){
      $this->view = 'edit';
      $GLOBALS['view'] = $this->view;
      
      // Nota: para que aparezca el boton de "Quitar" en el editview (y por lo tanto funcione lo siguiente), hay que
      //       quitar la propiedad 'noChange' del vardef del campo "uploadfile" (que es de tipo file)
      if(!empty($_REQUEST['deleteAttachment'])){
         ob_clean();
         //echo $this->bean->deleteAttachment($_REQUEST['isDuplicate']) ? 'true' : 'false';
         echo $this->bean->BorraArchivoPlantilla($this->bean->id) ? 'true' : 'false';
         sugar_cleanup(true);
      }
   }
   
   ///////////////////////////////////////////////////////////////////////////
   function action_download(){

      $this->view = '';
      $GLOBALS['view'] = '';

      require_once('modules/DHA_PlantillasDocumentos/download_template.php');
   } 

   ///////////////////////////////////////////////////////////////////////////   
   function action_Configuration(){
      if(is_admin($GLOBALS['current_user'])) {
         $this->view = 'config';
         $GLOBALS['view'] = $this->view;    
      }
      else {
         //sugar_die("Unauthorized access to administration");
         sugar_die($GLOBALS['app_strings']['ERR_NOT_ADMIN']); 
      }
      return true;
   }
	///////////////////////////////////////////////////////////////////////////   
   function action_DocTemplateConfiguration(){
      if(is_admin($GLOBALS['current_user'])) {
         $this->view = 'config_template';
         $GLOBALS['view'] = $this->view;    
      }
      else {
         //sugar_die("Unauthorized access to administration");
         sugar_die($GLOBALS['app_strings']['ERR_NOT_ADMIN']); 
      }
      return true;
   }   
   ///////////////////////////////////////////////////////////////////////////
	function action_htgetSelectionPanelJSON(){
		$this->view = '';
      $GLOBALS['view'] = ''; 
		
      $bean = SugarModule::get($_REQUEST['moduloplantilladocumento'])->loadBean();
      
      if(!$bean->ACLAccess('detail')){
         ACLController::displayNoAccess(true);
         sugar_cleanup(true);
      }

      set_time_limit(0);
      $GLOBALS['db']->setQueryLimit(0);

      require_once('modules/DHA_PlantillasDocumentos/MassGenerateDocument.php');
	  require_once('include/utils.php');
      $massDoc = new MassGenerateDocument();      
      $massDoc->setSugarBean($bean);
      $return_data = $massDoc->hthandleMassGenerateDocument();
	  	$GD = new Generate_Document($return_data[0], $return_data[1], $return_data[2]);
		$GD->enPDF = $enPDF;
		$GD->CargarPlantilla ();
		$related_selected = $_REQUEST['related_selected'];
		$GD->ObtenerDatos ($related_selected);
		$selection_array = array();
		$relation_labels = array();
		$relationship_fields = array(
			'medp_medical_providers_cases' => 'medical_doctor',
			'def_client_insurance_cases_1' => 'name',
			'def_defendants_cases' => 'name',
			'contacts' => 'name',
		);
		foreach($GD->relaciones AS $relation) {
			if(empty($relation))continue;
			$data_array = $GD->datos;
			foreach($data_array AS $index => $data) {
				$related_records = $data[$relation];
				$selection_array[$index]['name'] = $data['name'];
				$related_data = array();
				$label = $bean->field_defs[$relation]['vname'];
				$label = translate($label, $return_data[0]);
				$selection_array[$index]['relation'][$relation]['label'] = 	$label;
				if(isset($related_records) && sizeof($related_records) > 0){
					foreach($related_records AS $r_record) {
						$related_data[$r_record['id']] = $r_record[$relationship_fields[$relation]];
					}
					$related_data = convertArrayToITL($related_data, false);
					$selection_array[$index]['relation'][$relation]['data'] = $related_data;
				}
				else{					
					$selection_array[$index]['relation'][$relation]['data'] = convertArrayToITL(array('mandatory' => 'Please attach '.$label.' first.'), false);
				}
			}
	}   
			//echo json_encode($selection_array);
			ob_clean();
			echo html_entity_decode(json_encode($selection_array));
			die;
	}
	function action_htgeneratedocument(){
		// Ver la funcion action_massupdate en include\MVC\Controller\SugarController.php
      // Esta accion será llamada tanto desde el listview (como si fuera un massupdate) como desde el detailview (con un boton)
      
      // Si no se anula la vista por defecto, devuelve tambien el html de una vista y no es lo que se requiere aqui
      $this->view = '';
      $GLOBALS['view'] = ''; 
		
      $bean = SugarModule::get($_REQUEST['moduloplantilladocumento'])->loadBean();
      
      if(!$bean->ACLAccess('detail')){
         ACLController::displayNoAccess(true);
         sugar_cleanup(true);
      }

      set_time_limit(0);
      $GLOBALS['db']->setQueryLimit(0);

      require_once('modules/DHA_PlantillasDocumentos/MassGenerateDocument.php');
	  require_once('include/utils.php');
      $massDoc = new MassGenerateDocument();      
      $massDoc->setSugarBean($bean);
      $return_data = $massDoc->hthandleMassGenerateDocument();
	  	$GD = new Generate_Document($return_data[0], $return_data[1], $return_data[2]);
		if(!empty($_REQUEST['enPDF']) && $_REQUEST['enPDF'] == 'true')
			$GD->enPDF = $_REQUEST['enPDF'];
		$GD->CargarPlantilla ();
		if(isset($_REQUEST['related_selected']) && !is_array($_REQUEST['related_selected'])){
			$_REQUEST['related_selected'] = explode(',', $_REQUEST['related_selected']);
		}
		$related_selected = $_REQUEST['related_selected'];
		
		
		$GD->ObtenerDatos ($related_selected);
		$selection_array = array();
		$relation_labels = array();
		if(!isset($_REQUEST['from_view']) || $_REQUEST['from_view'] == ''){
			foreach($GD->relaciones AS $relation) {
				$data_array = $GD->datos;
				foreach($data_array AS $index => $data) {
					$related_records = $data[$relation];
					if(isset($related_records) && sizeof($related_records) > 0){
						foreach($related_records AS $r_record) {
							$selection_array[$index]['name'] = $data['name'];
							$selection_array[$index]['relation'][$relation]['data'][$r_record['id']] = $r_record['name'];
							$label = $bean->field_defs[$relation]['vname'];
							$label = translate($label, $return_data[0]);
							$selection_array[$index]['relation'][$relation]['label'] = 	$label;
						}
					}
				}
			}
		}
		if(isset($selection_array) && sizeof($selection_array) > 0 ){
			$_REQUEST['SELECTION_ARRAY'] = json_encode($selection_array);
			$_REQUEST['FROM_MODULE'] = $return_data[0];
			$this->view = 'customselection';
			$GLOBALS['view'] = $this->view;
			
		}else{
			  require_once("modules/DHA_PlantillasDocumentos/Generate_Document.php");
		
			 if (isset($_REQUEST['AttachToEmailGeneratedDocument']) && $_REQUEST['AttachToEmailGeneratedDocument']) {
				GenerateDocumentAndAttachToEmail ($_REQUEST['moduloplantilladocumento'], $_REQUEST['plantilladocumento_id'], $_POST['MassGenerateDocument_ids'], $enPDF);
			 }
			 else if (isset($_REQUEST['AttachToCaseGeneratedDocument']) && $_REQUEST['AttachToCaseGeneratedDocument']) {
				GenerateDocumentAndAttachToCase ($GD,$return_data[0], $return_data[1], $return_data[2]);
			 }
			 else if (isset($_REQUEST['AttachToNoteGeneratedDocument']) && $_REQUEST['AttachToNoteGeneratedDocument']) {
				GenerateDocumentAndAttachToNote ($_REQUEST['moduloplantilladocumento'], $_REQUEST['plantilladocumento_id'], $_POST['MassGenerateDocument_ids'], $enPDF);
			 }         
			else {
				$GD->GenerarInforme();
			}
		}
	
	}
   ///////////////////////////////////////////////////////////////////////////
	function action_generatedocument(){
		
      // Ver la funcion action_massupdate en include\MVC\Controller\SugarController.php
      // Esta accion será llamada tanto desde el listview (como si fuera un massupdate) como desde el detailview (con un boton)
      
      // Si no se anula la vista por defecto, devuelve tambien el html de una vista y no es lo que se requiere aqui
      $this->view = '';
      $GLOBALS['view'] = '';      

      $bean = SugarModule::get($_REQUEST['moduloplantilladocumento'])->loadBean();
      
      if(!$bean->ACLAccess('detail')){
         ACLController::displayNoAccess(true);
         sugar_cleanup(true);
      }

      set_time_limit(0);
      $GLOBALS['db']->setQueryLimit(0);

      require_once('modules/DHA_PlantillasDocumentos/MassGenerateDocument.php');
      $massDoc = new MassGenerateDocument();      
      $massDoc->setSugarBean($bean);     
      $massDoc->handleMassGenerateDocument();
	}   
   
   ///////////////////////////////////////////////////////////////////////////
   function action_varlist(){

      // Se ha creado una vista nueva. Ver modules\DHA_PlantillasDocumentos\views\view.varlist.php
      $this->view = 'varlist';
      $GLOBALS['view'] = $this->view;      
   }

   ///////////////////////////////////////////////////////////////////////////
   function action_modulevarlist(){

      $this->view = '';
      $GLOBALS['view'] = '';

      require_once('modules/DHA_PlantillasDocumentos/Generate_Document.php');
      $GD = new Generate_Document($_REQUEST['moduloPlantilla'], NULL, NULL);  
      $GD->ObtenerHtmlListaVariables();
   }

   ///////////////////////////////////////////////////////////////////////////
   function action_crearplantillabasica(){
   
      require_once('modules/DHA_PlantillasDocumentos/Generate_Document.php');
      $GD = new Generate_Document($_REQUEST['moduloPlantilla'], NULL, NULL);
      $GD->CrearPlantillaBasica();
   } 

   ///////////////////////////////////////////////////////////////////////////   
   public function action_saveconfig(){
      require_once('include/utils.php');
      require_once('modules/DHA_PlantillasDocumentos/UI_Hooks.php');

      global $app_strings, $current_user, $moduleList, $sugar_config;
      
      $this->view = '';
      $GLOBALS['view'] = '';      

      if (!is_admin($current_user)) 
         sugar_die($app_strings['ERR_NOT_ADMIN']);

      require_once('modules/Configurator/Configurator.php');
      $configurator = new Configurator();
      $configurator->loadConfig();  // no es necesario
      
      
      $repair = false;
      $repair_modules = Array();
      
      //if (isset( $_REQUEST['enabled_modules'] )) {
         $DHA_templates_historical_enabled_modules = array();
         $enabled_modules = array ();         
         foreach ( explode (',', $_REQUEST['enabled_modules'] ) as $module_name ) {
            $enabled_modules [$module_name] = $module_name;
         }
         
         $modules = MailMergeReports_get_all_modules();
         $disabled_modules = array();
         foreach ( $modules as $module_name => $def) {
            if (!isset($enabled_modules[$module_name])) {
               $disabled_modules[$module_name] = $module_name;
            }
         }

         foreach ($disabled_modules as $module_name) {
            if (MailMergeReports_after_ui_frame_hook_module_enabled($module_name)) {
               $repair = true;
               $repair_modules[] = $module_name;
            }
            MailMergeReports_after_ui_frame_hook_module_remove($module_name, false);
            $DHA_templates_historical_enabled_modules[$module_name] = false;
         }
         foreach ($enabled_modules as $module_name) {
            if (!MailMergeReports_after_ui_frame_hook_module_enabled($module_name)) {
               $repair = true;
               $repair_modules[] = $module_name;
            }         
            MailMergeReports_after_ui_frame_hook_module_install($module_name, false);
            $DHA_templates_historical_enabled_modules[$module_name] = true;
         } 

         // Guardamos histórico de los módulos habilitados (esto solo sirve para el instalador del componente, para que recupere los modulos habilitados en caso de reinstalacion)
         $configurator->config['DHA_templates_historical_enabled_modules'] = $DHA_templates_historical_enabled_modules;        
      //}
      
      if ( isset( $_REQUEST['templates_roles_enabled_levels'] ) && isset( $_REQUEST['templates_roles_enabled_levels_ids'] )) {
         $DHA_templates_enabled_roles = array();
         $role_ids = explode (',', $_REQUEST['templates_roles_enabled_levels_ids']);
         $role_levels = explode (',', $_REQUEST['templates_roles_enabled_levels']);
         
         foreach($role_ids as $key => $value) {
            $DHA_templates_enabled_roles[$value] = $role_levels[$key];
         } 
         
         $configurator->config['DHA_templates_enabled_roles'] = $DHA_templates_enabled_roles;         
      }      
      
      $configurator->saveConfig();
      
      if ($repair) {
         // ANULADO DE MOMENTO, NO ESTÁ FUNCIONANDO BIEN (SUGAR SE CUELGA, ETC.)
         //MailMergeReports_repairAndClear($repair_modules);
      }
      
      //$jj = MailMergeReports_getClientFileContents('Opportunities', 'view', 'recordlist');

      echo "true";  // necesario
   }   
   
   
   ///////////////////////////////////////////////////////////////////////////
   function action_saveTemplateConfig(){
		require_once('include/utils.php');
		require_once('modules/DHA_PlantillasDocumentos/UI_Hooks.php');

		global $app_strings, $current_user, $moduleList, $sugar_config;

		$this->view = '';
		$GLOBALS['view'] = '';    
		if (!is_admin($current_user)) 
		 sugar_die($app_strings['ERR_NOT_ADMIN']);

		require_once('modules/Configurator/Configurator.php');
		$configurator = new Configurator();
		$configurator->loadConfig();  // no es necesario
		//print"<pre>";print_r($_REQUEST);die;
		$configurator->config['DHA_templates_attorneys_list'] = trim($_REQUEST['attorneys_list']); 
		$configurator->saveConfig();
		echo "true"; 
   } 
///////////////////////////////////////////////////////////////////////////
   function action_composeEmail(){
      // Se necesita en SugarCRM 7
      // Ver /custom/modules/Emails/ComposeGeneratedDocumentEmail.php
   
      $this->view = '';
      $GLOBALS['view'] = '';
      
      $email_id = $_REQUEST['recordId'];
      $module = $_REQUEST['return_module'];

      // Redirect ...
      if($email_id) {
         $dURL = "index.php?action=ComposeGeneratedDocumentEmail&module=Emails&return_module=".$module."&recordId=".$email_id; 
         SugarApplication::redirect($dURL);
      }      
   } 
	function action_getTemplatesList(){
		
		if(!empty($_REQUEST['category_id'])){
			global $app_strings, $app_list_strings, $db, $current_user, $sugar_config;
			$sub_field = '';
			$pleading_type = '';
			$category_id = $_REQUEST['category_id'];
			$subcategory_id = $_REQUEST['subcategory_id'];
			$pleading_type = $_REQUEST['pleading_type'];
			if(isset($subcategory_id) && !empty($subcategory_id))
				$sub_field = " AND {$app_list_strings['ht_subcategory_relation_fields'][$category_id]} =  '{$subcategory_id}' ";			
			if(isset($pleading_type) && !empty($pleading_type))
				$pleading_type_sql = " AND pleading_types_c =  '{$pleading_type}' ";
			$sql = "SELECT id,document_name as name FROM `dha_plantillasdocumentos` mr
				LEFT JOIN `dha_plantillasdocumentos_cstm` mr_c ON (mr.id = mr_c.id_c)
				WHERE mr.deleted = 0 AND mr.category_id = '{$category_id}'  {$sub_field} {$pleading_type_sql} ";
				//WHERE mr.deleted = 0 AND  mr.modulo = 'Cases' AND mr.category_id = '{$category_id}'  {$sub_field} {$pleading_type_sql} ";
			$result = $db->query($sql, true);
			$data = array();
			$data[''] = 'Select Templates';
			while($row = $db->fetchByAssoc($result)){
				$data[$row['id']] = $row['name'];
			}
			$data = convertArrayToITL($data);
			echo json_encode($data);
			return true;
		}
	}
	function action_getLetterHeadList(){
		
		if(!empty($_REQUEST['record'])){
			global $app_strings, $app_list_strings, $db, $current_user, $sugar_config;
			$template_id = $_REQUEST['record'];
			$templateBean = BeanFactory::getBean('DHA_PlantillasDocumentos', $template_id);
			$letterheads = $templateBean->get_linked_beans('ht_doc_temp_letter_head_dha_plantillasdocumentos','ht_doc_temp_letter_head');
			$data = array();
			$related_beans = array();
			foreach($letterheads as $key => $related_bean){
               if (!$related_bean->ACLAccess('view')){
                  continue;
               } 
				$related_beans[$related_bean->id] = $related_bean->name;
            }
			if(sizeof($related_bean) > 0){
				$data = array_merge(array('' => 'Select Letterhead'), $related_beans);
			}
			$data = convertArrayToITL($data);
			echo json_encode($data);
			return true;
		}
	}    
}
?>
