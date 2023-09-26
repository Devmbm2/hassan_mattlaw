<?php
require_once('include/MVC/Controller/SugarController.php');
  
class DHA_PlantillasDocumentosController extends SugarController {

   ///////////////////////////////////////////////////////////////////////////
   function action_generate_doc_wizard(){
      $this->view = 'generate_doc_wizard';
      $GLOBALS['view'] = $this->view;
      
   }
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
		$GD->RelatedSelected = $_REQUEST['related_selected'];
		$GD->CargarPlantilla ();
		$GD->ObtenerDatos();
		$selection_array = array();
		$relation_labels = array();
		$relationship_fields = array(
			'medp_medical_providers_cases' => 'medical_doctor',
			'def_client_insurance_cases_1' => 'name',
			'def_defendants_cases' => 'name',
			'contacts' => 'name',
			'accounts' => 'name'
		);
		foreach($GD->relaciones AS $relation) {
			if(empty($relation))continue;
			$data_array = $GD->datos;
			$field_name = isset($relationship_fields[$relation]) ? $relationship_fields[$relation] : 'name';
			foreach($data_array AS $index => $data) {
				$related_data = array();
				$label = $bean->field_defs[$relation]['vname'];
				$label = translate($label, $return_data[0]);
				if(empty($label)) continue;
				$selection_array[$index]['name'] = $data['name'];
				$selection_array[$index]['relation'][$relation]['label'] = 	$label;
				if(!empty($data[$relation])){
					foreach($data[$relation] AS $r_record) {
						$related_data[$r_record['id']] = $r_record[$field_name];
					}
					$related_data = convertArrayToITL($related_data, false);
					$selection_array[$index]['relation'][$relation]['data'] = $related_data;
				}
				else{
					$selection_array[$index]['relation'][$relation]['data'] = convertArrayToITL(array('mandatory' => 'Please attach '.$label.' first.'), false);						
				}
			}
		}   
		ob_clean();
		echo html_entity_decode(json_encode($selection_array));
		die;
	}
	///////////////////////////////////////////////////////////////////////////
	function action_wizardGenDoc(){
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
		$GD->RelatedSelected = $_REQUEST['related_selected'];
		$GD->CargarPlantilla ();
		$GD->ObtenerDatos();
		if($_REQUEST['preview']){
			$GD->GenerarInforme(true);
		}
		$selection_array = array();
		$relation_labels = array();
		$relationship_fields = array(
			'medp_medical_providers_cases' => 'medical_doctor',
			'def_client_insurance_cases_1' => 'name',
			'def_defendants_cases' => 'name',
			'contacts' => 'name',
			'accounts' => 'name'
		);
		
		foreach($GD->relaciones AS $relation) {
			if(empty($relation))continue;
			$data_array = $GD->datos;
			$field_name = isset($relationship_fields[$relation]) ? $relationship_fields[$relation] : 'name';
			foreach($data_array AS $index => $data) {
				$related_data = array();
				$label = $bean->field_defs[$relation]['vname'];
				$label = translate($label, $return_data[0]);
				if(empty($label)) continue;
				$selection_array[$index]['name'] = $data['name'];
				$selection_array[$index]['relation'][$relation]['label'] = 	$label;
				if(!empty($data[$relation])){
					foreach($data[$relation] AS $r_record) {
						$related_data[$r_record['id']] = $r_record[$field_name];
					}
					$related_data = convertArrayToITL($related_data, false);
					$selection_array[$index]['relation'][$relation]['data'] = $related_data;
				}
				else{
					$selection_array[$index]['relation'][$relation]['data'] = convertArrayToITL(array('mandatory' => 'Please attach '.$label.' first.'), false);
				}
			}
		}   
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

	  $multi_file = array('ccddccab-00f9-e124-9b3b-5d9e1df90693', '89dd7df0-5867-6e5c-0840-59a04eba1c43', '684d0dd0-a440-cd12-23a6-59a04e90831f');
      $massDoc = new MassGenerateDocument();      
      $massDoc->setSugarBean($bean);

      $return_data = $massDoc->hthandleMassGenerateDocument();
    //   print_r($return_data[2]);
				// die();
	  	$GD = new Generate_Document($return_data[0], $return_data[1], $return_data[2]);
		if(!empty($_REQUEST['enPDF']) && $_REQUEST['enPDF'] == 'true')
			$GD->enPDF = $_REQUEST['enPDF'];
		$GD->CargarPlantilla ();
		if(isset($_REQUEST['related_selected']) && !is_array($_REQUEST['related_selected'])){
			$related_selected = explode(',', $_REQUEST['related_selected']);
		}
		
		$GD->RelatedSelected = $related_selected;
		$GD->ObtenerDatos ();
		$selection_array = array();
		 // print"<pre>";print_r($GD->datos);die;
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
			 else if (isset($_REQUEST['AttachGeneratedDocumentToRecord']) && $_REQUEST['AttachGeneratedDocumentToRecord']) {
			 	// print_r($GD->plantilla_id);
			 	// print_r($multi_file);
			 	// die();
				if(in_array($GD->plantilla_id, $multi_file)){
					$doc_URLs = array();
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
									$doc_URLs[] = GenerateDocumentAndAttachToRecord ($GD,$return_data[0], $return_data[1], $return_data[2], false);
									//$file_names[$GD->Download_filename] = $r_record['name'].'.docx';
								}
							}
						}
					}
					$dURL = "index.php?action=DetailView&module=".$return_data[0]."&record=".$return_data[2][0];	
					$dURL .= "&".http_build_query(array('doc_url' => $doc_URLs));
					SugarApplication::redirect($dURL);
				}else{
					// HTGenerateDocumentAndAttachToRecord ($GD,$return_data[0], $return_data[1], $return_data[2]);
					GenerateDocumentAndAttachToRecord ($GD,$return_data[0], $return_data[1], $return_data[2]);
				}
			 }
			 else if (isset($_REQUEST['AttachToNoteGeneratedDocument']) && $_REQUEST['AttachToNoteGeneratedDocument']) {
				GenerateDocumentAndAttachToNote ($_REQUEST['moduloplantilladocumento'], $_REQUEST['plantilladocumento_id'], $_POST['MassGenerateDocument_ids'], $enPDF);
			 }         
			else {
				// echo "test";
				// die();
				if(in_array($GD->plantilla_id, $multi_file)){
					$GD->Download = false;
					// $related_records = $GD->datos[1]['medb_medical_bills_contacts'];
					
					$zip = new ZipArchive;
					$zip_file_name = $GD->GetTempFileName($GD->template_filename,'zip');
					if ($zip->open($zip_file_name, ZipArchive::CREATE) === TRUE)
					{
						$file_names = array();
						$file_names = generateMultiFiles($GD);
						foreach($file_names AS $Download_filename => $file_name) {
							$zip->addFile($Download_filename, $file_name);
						}
						$zip->close();
					}
					$GD->DescargarInforme($zip_file_name);
				}else{
					$GD->GenerarInforme();
					
				}
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
		
		global $app_strings, $app_list_strings, $db, $current_user, $sugar_config;
		$cstm_where = '';
		$join = '';
		
		if(isset($_REQUEST['favorites']) && !empty($_REQUEST['favorites']))
			$join = " INNER JOIN favorites f ON  (f.parent_type = 'DHA_PlantillasDocumentos' AND f.assigned_user_id = '{$current_user->id}' AND f.parent_id = mr.id ) ";
		if(isset($_REQUEST['category_id']) && !empty($category_id = $_REQUEST['category_id']) && $_REQUEST['category_id'] != "Miscellaneous")
			$cstm_where = " AND mr.category_id = '{$category_id}'  ";
		if(isset($_REQUEST['subcategory_id']) && !empty($subcategory_id = $_REQUEST['subcategory_id']))
			$cstm_where .= " AND {$app_list_strings['ht_subcategory_relation_fields'][$category_id]} =  '{$subcategory_id}' ";			
		if(isset($_REQUEST['pleading_type']) && !empty($pleading_type = $_REQUEST['pleading_type']))
			$cstm_where .= " AND pleading_types_c =  '{$pleading_type}' ";
		if(isset($_REQUEST['target_module']))
			$cstm_where .= " AND mr.modulo =  '{$_REQUEST['target_module']}' ";
		$sql = "SELECT mr.id, mr.document_name as name 
			FROM `dha_plantillasdocumentos` mr
			INNER JOIN `dha_plantillasdocumentos_cstm` mr_c ON (mr.id = mr_c.id_c)
			{$join}
			WHERE mr.deleted = 0  {$cstm_where} ";
		$result = $db->query($sql, true);
		$data = array();
		$data[''] = 'Select Templates';
		while($row = $db->fetchByAssoc($result)){
			$data[$row['id']] = $row['name'];
		}
		$data = convertArrayToITL($data);
		if(isset($_REQUEST['module_records_list'])){
			$moduleBean = BeanFactory::getBean($_REQUEST['module_records_list']);
			$beanList = $moduleBean->get_full_list();
			$records_list = array();
			$records_list[''] = 'Select Record';
			foreach($beanList AS $bean){
				$records_list[$bean->id] = $bean->name;
			}
			$records_list = convertArrayToITL($records_list);
			$data = array(
				'templates_list' => $data,
				'records_list' => $records_list
			);
		}
		echo json_encode($data);
		return true;
	}
	function action_getTempSectionList(){
			$string = file_get_contents("custom/include/doc_template_data.json");
			ob_clean();
			echo $string;
			return true;
	}
	function action_getLetterHeadList(){
		
		global $app_strings, $app_list_strings, $db, $current_user, $sugar_config;
		$template_id = $_REQUEST['record'];
		
		$sql = "SELECT d.use_letterhead FROM `dha_plantillasdocumentos` d WHERE d.id = '{$template_id}' AND d.deleted = 0";
		$result = $db->query($sql);
		$row = $db->fetchByAssoc($result);
		// echo $row["use_letterhead"];
		// die();
		if($row['use_letterhead'] == 'yes')
		{
		$sql2 = "SELECT l.id,l.document_name FROM `ht_doc_temp_letter_head` l WHERE l.deleted = 0";
		$result2 = $db->query($sql2);
		$data = array();
		$data[''] = 'Select LetterHead';
		while($row2 = $db->fetchByAssoc($result2)){
			$data[$row2['id']] = $row2['document_name'];
		}
		}
		else if($row['use_letterhead'] == 'multiple')
		{
		$sql3 = "SELECT l.id,l.document_name FROM `ht_doc_temp_multi_letterhead` l WHERE l.deleted = 0";
		$result3 = $db->query($sql3);
		$data = array();
		$data[''] = 'Select Multiple LetterHead';
		while($row3 = $db->fetchByAssoc($result3)){
			$data[$row3['id']] = $row3['document_name'];
		}
		}
		$data = convertArrayToITL($data);
		echo json_encode($data);
		return true;
		// die();
	}
function action_getContactRoleList(){
	global $app_list_strings;
$related_contacts = $app_list_strings['relationship_to_case_list'];
	$contact_list = convertArrayToITL($related_contacts);
	echo json_encode($contact_list);
		return true;
	// die;
}
public function action_getRelatedContactRoles(){
    	$role_id = $_REQUEST['record'];
    	$case_id = $_REQUEST['case_id'];
    	global $db;
    	$sql = "SELECT
	c.id as contact_id, CONCAT(c.first_name,' ',c.last_name) AS contact_name
FROM
	contacts c
INNER JOIN contacts_cases cc ON (cc.deleted = 0 AND cc.contact_id = c.id)
WHERE
	c.deleted = 0 AND cc.case_id = '{$case_id}' AND cc.contact_role = '{$role_id}'";
$result = $db->query($sql, true);
$related_contacts = array();
While($row = $db->fetchByAssoc($result)){
	$related_contacts[$row['contact_id']] = $row['contact_name'];
}
echo json_encode(array(
	'contact_list' => convertArrayToITL($related_contacts, false) 
));die;
    }

	public function action_SearchDocumentTemplates(){
                global $db;
                $searchText = $_REQUEST['searcheditem'];
                $sql = "SELECT dha_plantillasdocumentos.*,dha_plantillasdocumentos_cstm.* FROM dha_plantillasdocumentos INNER JOIN dha_plantillasdocumentos_cstm on dha_plantillasdocumentos.id=dha_plantillasdocumentos_cstm.id_c WHERE dha_plantillasdocumentos.document_name LIKE '%".$searchText."%' AND dha_plantillasdocumentos.deleted=0 ORDER BY document_name ASC LIMIT 200";
                $result = $db->query($sql);
                $output=$this->generalizeCode($result);
                echo json_encode($output);
                die();
            }
            public function action_searchByCateogry(){
                global $db;
                $CategoryValue=$_POST['CategorySelectedValue'];
                $SubCategoryValue=$_POST['SubCategorySelectedValue'];
                $sql=$this->ConditionFunction($CategoryValue,$SubCategoryValue);
                $result = $db->query($sql);
                $output=$this->generalizeCode($result);
                echo json_encode($output);
              die();
            }
            public function action_searchBySubCateogry(){
                global $db;
                $CategoryValue=$_POST['CategorySelectedValue'];
                $SubCategoryValue=$_POST['SubCategorySelectedValue'];
                $sql=$this->ConditionFunction($CategoryValue,$SubCategoryValue);
                $result = $db->query($sql);
                $output=$this->generalizeCode($result);
                echo json_encode($output);
                die();
            }

            function ConditionFunction($CategoryValue,$SubCategoryValue){
                $SubCategoryAndCateogyrSubQueryVariable="";
                if($CategoryValue=='NoFilterApply' &&  $SubCategoryValue=='NoFilterApply'){

                }else if($CategoryValue=='NoFilterApply' && ($SubCategoryValue=="")){
                    $SubCategoryAndCateogyrSubQueryVariable=" (dha_plantillasdocumentos.subcategory_id IS NULL OR dha_plantillasdocumentos.subcategory_id='') AND";
                }else if($CategoryValue=='NoFilterApply' && ($SubCategoryValue!="" && $SubCategoryValue!="NoFilterApply ")){
                    $SubCategoryAndCateogyrSubQueryVariable="dha_plantillasdocumentos.subcategory_id LIKE '%". $SubCategoryValue."%' AND";
                }else if(($CategoryValue=="")&&($SubCategoryValue=="NoFilterApply")){
                    $SubCategoryAndCateogyrSubQueryVariable=" (dha_plantillasdocumentos.category_id IS NULL OR dha_plantillasdocumentos.category_id='') AND";
                }else if(($CategoryValue=="" ) && ( $SubCategoryValue=="" )){
                    $SubCategoryAndCateogyrSubQueryVariable="(dha_plantillasdocumentos.category_id IS NULL OR dha_plantillasdocumentos.category_id='') AND (dha_plantillasdocumentos.subcategory_id IS NULL OR dha_plantillasdocumentos.subcategory_id='') AND";
                }else if(($CategoryValue=="") && ($SubCategoryValue!="" && $SubCategoryValue!="NoFilterApply")){
                    $SubCategoryAndCateogyrSubQueryVariable="(dha_plantillasdocumentos.category_id IS NULL OR dha_plantillasdocumentos.category_id='') AND dha_plantillasdocumentos.subcategory_id LIKE '%". $SubCategoryValue."%' AND";
                }else if(($CategoryValue!="" && $CategoryValue!="NoFilterApply") && ($SubCategoryValue=="NoFilterApply")){
                    $SubCategoryAndCateogyrSubQueryVariable="dha_plantillasdocumentos.category_id LIKE '%". $CategoryValue."%' AND";
                }else if(($CategoryValue!="" && $CategoryValue!="NoFilterApply") && ($SubCategoryValue=="")){
                    $SubCategoryAndCateogyrSubQueryVariable="(dha_plantillasdocumentos.subcategory_id IS NULL OR dha_plantillasdocumentos.subcategory_id='') AND dha_plantillasdocumentos.category_id LIKE '%". $CategoryValue."%' AND";
                }else if(($CategoryValue!="" && $CategoryValue!="NoFilterApply") && ($SubCategoryValue!="" && $SubCategoryValue!="NoFilterApply")){
                    $SubCategoryAndCateogyrSubQueryVariable="dha_plantillasdocumentos.subcategory_id LIKE '%". $SubCategoryValue."%' AND dha_plantillasdocumentos.category_id LIKE '%".$CategoryValue."%' AND";
                }
                $sql = "SELECT dha_plantillasdocumentos.*,dha_plantillasdocumentos_cstm.* FROM dha_plantillasdocumentos INNER JOIN dha_plantillasdocumentos_cstm on dha_plantillasdocumentos.id=dha_plantillasdocumentos_cstm.id_c WHERE  ".$SubCategoryAndCateogyrSubQueryVariable."  dha_plantillasdocumentos.deleted=0 ORDER BY document_name ASC LIMIT 200";
                return $sql;
            }
            function generalizeCode($result){
                $fetched_record=array();
                if ($result->num_rows > 0) {
                    while ($record = $GLOBALS["db"]->fetchByAssoc($result)) {
                        if($record['uploadfile']!=NULL){
                            $UploadedFile='<a href="index.php?entryPoint=download_dha_document_template&type=DHA_PlantillasDocumentos&id='.$record['id'].'" class="tabDetailViewDFLink" target="_blank" style="border-bottom: 0px;color: #e56455;font-weight: bold;">
                            View File
                            </a>
                            <a href="index.php?entryPoint=download_dha_document_template&type=DHA_PlantillasDocumentos&id='.$record['id'].'" class="tabDetailViewDFLink" id="" name="'.$record['document_name'].'" style="border-bottom: 0px;color: #e56455;font-weight: bold; display:block;" download="271" days="" letter="" onclick="check(this,this.name)">
                            <img src="https://img.icons8.com/metro/50/000000/download.png" width="22" height="22" style="display:block;margin:auto;">
                            </a>';
                        }
                        $fetched_record[] =["FirstCheckBox"=>'<input title="Select this row" onclick="sListView.check_item(this, document.MassUpdate)" type="checkbox" class="checkbox" name="mass[]" value="'.$record['id'].'">','EditIconForEachRecord'=>'<a title="Edit" id="edit-'.$record['id'].'" href="index.php?module=DHA_PlantillasDocumentos&amp;offset=1&amp;stamp=1652872741080259500&amp;return_module=DHA_PlantillasDocumentos&amp;action=EditView&amp;record='.$record['id'].'">
                        <img src="themes/Honey/images/edit_inline.gif?v=V6Jf_6LIk4nKTRgtYTnxCA" border="0" alt="Edit"></a>',"id" =>$record['id'],"name"=>'<a href="?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DDHA_PlantillasDocumentos%26offset%3D1%26stamp%3D1652873006035747100%26return_module%3DDHA_PlantillasDocumentos%26action%3DDetailView%26record%3D'.$record['id'].'">
                        '.$record['document_name'].'
                        <div class="inlineEditIcon"><!--?xml-stylesheet type="text/css" href="../css/style.css" ?-->
                        <!--?xml-stylesheet type="text/css" href="../css/colourSelector.php" ?-->
                        <svg version="1.1" id="inline_edit_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                        <g class="icon" id="Icon_6_">
                            <g>
                                <path class="icon" d="M64,368v80h80l235.727-235.729l-79.999-79.998L64,368z M441.602,150.398
                                    c8.531-8.531,8.531-21.334,0-29.865l-50.135-50.135c-8.531-8.531-21.334-8.531-29.865,0l-39.468,39.469l79.999,79.998
                                    L441.602,150.398z"></path>
                            </g>
                        </g>
                        </svg>
                        </div></a>',"category" => $record['category_id'],"subCat" => $record['subcategory_id'],"preSuite" => $record['pre_suit_c'],"litigation_c" => $record['litigation_c'],'FileNames'=>$UploadedFile
                    ];
                    }
                    $output = array(
                        "data"       =>  $fetched_record
                       );
                       return $output;
                }else {
                        return array('data'=>'');
                }
            }  
}
?>
