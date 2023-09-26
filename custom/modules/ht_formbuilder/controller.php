<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once 'custom/modules/AOR_Reports/controller.php';

class ht_formbuilderController extends AOR_ReportsController
{
  public function action_getFieldData(){
	  global $app_strings, $beanList, $current_user;
	  $fb_type = ' ';
	  if (!empty($_REQUEST['ht_module']) && $_REQUEST['ht_module'] != '') {
            if (isset($_REQUEST['rel_field']) && $_REQUEST['rel_field'] != '') {
                $module = getRelatedModule($_REQUEST['ht_module'], $_REQUEST['rel_field']);
            } else {
                $module = $_REQUEST['ht_module'];
            }
            $val = !empty($_REQUEST['ht_value']) ? $_REQUEST['ht_value'] : '';
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
  }
  public function action_getRelatedOptions()
  {
	  global $db;
	  $module_name = $_REQUEST['module_name'];
	  $option_value = $_REQUEST['option_value'];
	  $offset = $_REQUEST['offset'];
	  $bean = BeanFactory::getBean($module_name);
	  $field_defs = $bean->getFieldDefinitions();
	  // echo json_encode($field_defs;
	  // die();
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
		  $sql = "SELECT {$relate_module}.id, {$relate_module}.{$name} as name FROM {$relate_module} LIMIT 300";
		  $result = $db->query($sql);
	      }
		  else{
		  $sql = "SELECT {$relate_module}.id, concat({$relate_module}.first_name,{$relate_module}.last_name) as name FROM {$relate_module} LIMIT 300";
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
	$question_type = $_REQUEST['question_type'];
	$type_id = $_REQUEST['type_id'];
	if($type_id == 'case_type')
	{
	$sql = "SELECT  ht_formbuilder.name,ht_formbuilder.related_module,ht_formbuilder.id,ht_formbuilder.description,ht_formbuilder.column_size,ht_formbuilder.condition_description FROM ht_formbuilder WHERE ht_formbuilder.case_type='{$caseType}' AND ht_formbuilder.related_module='{$module}' AND ht_formbuilder.question_type='{$question_type}' AND ht_formbuilder.deleted=0 ";
    }
    else
    {
    	$sql = "SELECT  ht_formbuilder.name,ht_formbuilder.related_module,ht_formbuilder.id,ht_formbuilder.description,ht_formbuilder.column_size,ht_formbuilder.condition_description FROM ht_formbuilder WHERE ht_formbuilder.case_sub_type='{$caseType}' AND ht_formbuilder.related_module='{$module}' AND ht_formbuilder.question_type='{$question_type}' AND ht_formbuilder.deleted=0 ";
    }	
	$result = $db->query($sql);
	$row = $db->fetchByAssoc($result);
	echo json_encode($row);
	die();		
}
public function action_saveLogicForm(){
	global $db;
	$counter = 0;
	$formID = $_REQUEST['formID'];
	$logicsqlcount = "SELECT ht_formbuilder.condition_description FROM ht_formbuilder WHERE ht_formbuilder.id='{$formID}' AND ht_formbuilder.deleted=0";
	$resultcount = $db->query($logicsqlcount);
	$row = $db->fetchByAssoc($resultcount);
	$logicresult = $row['condition_description'];
	$json = str_replace('"', "'", $logicresult);
	$json1 = str_replace('&quot;', '"', $json);
	$decode = json_decode($json1,true);
	$if = $_REQUEST['field-selected'];
	$state = $_REQUEST['field-state'];
	$value = $_REQUEST['field-value'];
	$do = $_REQUEST['field-do'];
	if($do == 'hide-multiple' || $do == 'show-multiple')
	{
 		$field = implode(',', $_REQUEST['field-selected2']);
	}
	else
	{
	$field = $_REQUEST['field-selected2'];
	}
	if(empty($decode))
	{
	$conditionLogicArray = [
	[
		"Id"=>0,
		"IF"=>$if,
		"State"=>$state,
		"Value"=>$value,
		"Do"=>$do,
		"Field"=>$field,
	]
];
	}
else
{
	foreach($decode as $key=>$logic)
	{
	
	 $conditionLogicArray[] =
		[
		"Id"=>$logic['Id'],
		"IF"=>$logic['IF'],
		"State"=>$logic['State'],
		"Value"=>$logic['Value'],
		"Do"=>$logic['Do'],
		"Field"=>$logic['Field'],
];
$counter = $logic['Id']+1;
if($logic['IF']==$if && $logic['State']==$state && $logic['Value']==$value && $logic['Do']==$do && $logic['Field']==$field)
{
echo "error";
die();
}
}
$conditionLogicArray[] = 
		[
		"Id"=>$counter++,
		"IF"=>$if,
		"State"=>$state,
		"Value"=>$value,
		"Do"=>$do,
		"Field"=>$field,
	
];
	}
	$conditionLogic = json_encode($conditionLogicArray);
	$sql = "UPDATE ht_formbuilder set ht_formbuilder.condition_description = '{$conditionLogic}' WHERE ht_formbuilder.id='{$formID}' AND ht_formbuilder.deleted=0";
	$result = $db->query($sql);
	// $row = $db->fetchByAssoc($result);
	echo json_encode($result);
	die();		
}
public function action_getSaveLogicDetail()
{
	
	global $db;
	$formid = $_POST['formid'];
	$conditionLogicQuery = "SELECT ht_formbuilder.condition_description FROM ht_formbuilder WHERE ht_formbuilder.id='{$formid}' AND ht_formbuilder.deleted=0";
	$resultcount = $db->query($conditionLogicQuery);
	$row = $db->fetchByAssoc($resultcount);
	$logicresult = $row['condition_description'];
	$json = str_replace('"', "'", $logicresult);
	$json1 = str_replace('&quot;', '"', $json);
	echo $json1;
	
}
public function action_updateLogicForm()
{
	global $db;
	$formid=$_POST['formid'];
	$json = str_replace('"', "'", $_POST['condition_description']);
	$conditionLogic = str_replace('&quot;', '"', $json);
    $sql = "UPDATE ht_formbuilder set ht_formbuilder.condition_description = '{$conditionLogic}' WHERE ht_formbuilder.id='{$formid}' AND ht_formbuilder.deleted=0";
	$result = $db->query($sql);
	if($result)
	{
		echo "true";
	}else{
		echo "false";
	}
}
public function action_updateNewLogicForm()
{
	global $db;
	$formid=$_POST['formid'];
	$updated_record = str_replace('"', "'", $_POST['updated_record']);
	$updated_record = str_replace('&quot;', '"', $updated_record);
	$updated_record_decode = json_decode($updated_record);
	$conditionLogicQuery = "SELECT ht_formbuilder.condition_description FROM ht_formbuilder WHERE ht_formbuilder.id='{$formid}' AND ht_formbuilder.deleted=0";
	$resultcount = $db->query($conditionLogicQuery);
	$row = $db->fetchByAssoc($resultcount);
	$logicresult = $row['condition_description'];
	$json = str_replace('"', "'", $logicresult);
	$json1 = str_replace('&quot;', '"', $json);
	$json1 = json_decode($json1);

	for ($i=0; $i <sizeof($json1) ; $i++) { 
		if($json1[$i]->IF == $updated_record_decode->IF &&
		$json1[$i]->State == $updated_record_decode->State &&
		$json1[$i]->Value == $updated_record_decode->Value &&
		$json1[$i]->Do == $updated_record_decode->Do &&
		$json1[$i]->Field == $updated_record_decode->Field)
		{
			echo "error";
			die();
		}
		if($json1[$i]->Id == $updated_record_decode->Id)
		{
            $json1[$i]->IF = $updated_record_decode->IF;
            $json1[$i]->State = $updated_record_decode->State;
            $json1[$i]->Value = $updated_record_decode->Value;
            $json1[$i]->Do = $updated_record_decode->Do;
            $json1[$i]->Field = $updated_record_decode->Field;
		}
		
	}
	$conditionLogic_decode = json_encode($json1);
	// print_r($conditionLogic_decode);
	// die();
    $sql = "UPDATE ht_formbuilder set ht_formbuilder.condition_description = '{$conditionLogic_decode}' WHERE ht_formbuilder.id='{$formid}' AND ht_formbuilder.deleted=0";
	$result = $db->query($sql);
	if($result)
	{
		echo "true";
	}else{
		echo "false";
	}
}
}