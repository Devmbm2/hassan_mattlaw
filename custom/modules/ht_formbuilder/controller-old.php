<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once 'custom/modules/AOR_Reports/controller.php';

class ht_formbuilderController extends AOR_ReportsController
{
  public function action_getFieldData(){
	  global $app_strings, $beanList, $current_user;
	  $fb_type = ' ';
	  
	  // echo $fb_type;
	   // die();
	  if (!empty($_REQUEST['ht_module']) && $_REQUEST['ht_module'] != '') {
            if (isset($_REQUEST['rel_field']) && $_REQUEST['rel_field'] != '') {
                $module = getRelatedModule($_REQUEST['ht_module'], $_REQUEST['rel_field']);
            } else {
                $module = $_REQUEST['ht_module'];
            }
            $val = !empty($_REQUEST['ht_value']) ? $_REQUEST['ht_value'] : '';
            // echo getModuleFields($module, $_REQUEST['view'], $val);
             // echo getModuleFields($module, $_REQUEST['view'], $val);
			// echo $module;
			 

			$view=$_REQUEST['view'];
			$blockedModuleFields = array(
				// module = array( ... fields )
				'Users' => array(
					'id',
					'is_admin',
					'name',
					'user_hash',
					'user_name',
					'system_generated_password',
					'pwd_last_changed',
					'authenticate_id',
					'sugar_login',
					'external_auth_only',
					'deleted',
					'is_group',
				)
				);

			$fields[] = array('' => $app_strings['LBL_NONE']);
			$unset = array();

			if ($module !== '') {
				if (isset($beanList[$module]) && $beanList[$module]) {
					$mod = new $beanList[$module]();
					// echo json_encode($mod->field_defs);
					// die();
					foreach ($mod->field_defs as $name => $arr) {
						if (ACLController::checkAccess($mod->module_dir, 'list', true)) {

							if (array_key_exists($mod->module_dir, $blockedModuleFields)) {
								if (in_array($arr['name'],
										$blockedModuleFields[$mod->module_dir]
									) && !$current_user->isAdmin()
								) {
									$GLOBALS['log']->debug('hiding ' . $arr['name'] . ' field from ' . $current_user->name);
									continue;
								}
							}
							if ($arr['type'] != 'link' && ((!isset($arr['source']) || $arr['source'] != 'non-db') || ($arr['type'] == 'relate' && isset($arr['id_name']))) && (empty($valid) || in_array($arr['type'],
										$valid)) && $name != 'currency_name' && $name != 'currency_symbol'
							) {
								if (isset($arr['vname']) && $arr['vname'] !== '' ) {
									$fields[$arr['type']][$name] = rtrim(translate($arr['vname'], $mod->module_dir), ':');
									// $fields[$name]['type'] = rtrim(translate($arr['type'], $mod->module_dir), ':');
									if($arr['type'] == 'name' || $arr['type'] == 'currency')
									{
										$fields['varchar'][$name] = rtrim(translate($arr['vname'], $mod->module_dir), ':');
									}
									if($arr['type'] == 'dynamicenum' || $arr['type'] == 'relate' || $arr['type'] == 'assigned_user_name')
									{
										$fields['enum'][$name] = rtrim(translate($arr['vname'], $mod->module_dir), ':');
									}
									if($arr['type'] == 'date' || $arr['type'] == 'datetimecombo')
									{
										$fields['datetime'][$name] = rtrim(translate($arr['vname'], $mod->module_dir), ':');
									}
								}
								else {
									// $fields[$name] = $name;
							
								}
								if ($arr['type'] === 'relate' && isset($arr['id_name']) && $arr['id_name'] !== '') {
									$unset[] = $arr['id_name'];
								}
							}
						}
					} //End loop.

					foreach ($unset as $name) {
						if (isset($fields[$name])) {
							unset($fields[$name]);
						}
					}

				}
			}
			asort($fields);
			if($view == 'JSON'){
				echo json_encode($fields);
				// return $fields;
				die();
			}
			if($view == 'EditView'){
				return get_select_options_with_id($fields, $val);
			} else {
				return $fields[$val];
			}
			}
        die;
		// $bean = BeanFactory::getBean($_REQUEST['ht_module']);
      // $check = $bean->getFieldDefinitions();
	  // echo json_encode($check);
	  // die();
  }
  public function action_getRelatedOptions()
  {
	  global $db;
	  $module_name = $_REQUEST['module_name'];
	  $option_value = $_REQUEST['option_value'];
	  $bean = BeanFactory::getBean($module_name);
	  $field_defs = $bean->getFieldDefinitions();
	  if($field_defs[$option_value]["type"] != 'relate')
	  {
	  	if($option_value == 'case_sub_type')
	  {
	  	$case_type = $_REQUEST['case_type'];
	  	// echo json_encode($case_type);
	  	echo json_encode($GLOBALS["app_list_strings"][$case_type]);
		die();
	  }
	  else
	  {
		echo json_encode($GLOBALS["app_list_strings"][$field_defs[$option_value]["options"]]);
		die();
	}
	  }

	  else{
		  $name = $field_defs[$option_value]["rname"];
		  $relate_module = lcfirst($field_defs[$option_value]["module"]);
		  if($relate_module!='contacts')
		  {
		  $sql = "SELECT {$relate_module}.id, {$relate_module}.{$name} as name FROM {$relate_module}";
		  $result = $db->query($sql);
	      }
		  else{
		  $sql = "SELECT {$relate_module}.id, concat({$relate_module}.first_name,{$relate_module}.last_name) as name FROM {$relate_module}";
		  $result = $db->query($sql);
		  }
		
		  while($row = $db->fetchByAssoc($result)){
		  $data[$row["id"]] = preg_replace("/\s+/", "", $row["name"]);
		  }	
		  echo json_encode($data);
		  die();
	  }
	  
		
  }
  public function action_getIntakeForum(){
	global $db;
	$caseType = $_REQUEST['case_type'];
	$module = $_REQUEST['rel_module_old'];
	$sql = "SELECT  ht_formbuilder.name,ht_formbuilder.related_module,ht_formbuilder.id,ht_formbuilder.description,ht_formbuilder.column_size FROM ht_formbuilder WHERE ht_formbuilder.case_type='{$caseType}' AND ht_formbuilder.related_module='{$module}' ";
	$result = $db->query($sql);
	$row = $db->fetchByAssoc($result);
	echo json_encode($row);
	die();		
}
}