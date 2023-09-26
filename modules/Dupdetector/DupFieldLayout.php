<?php
/*
   Created By : Urdhva Tech Pvt. Ltd.
 Created date : 09/29/2017
   Contact at : contact@urdhva-tech.com
          Web : www.urdhva-tech.com
        Skype : urdhvatech
       Module : Dupdetector 1.2
*/
/****
* ajax retrieve to configure fields
*/
if(!empty($_REQUEST['module_selected']))
{
    global $current_user;
    require_once('include/utils.php');
    require_once('include/utils/file_utils.php');
    require_once('config.php');
    require_once('include/MVC/Controller/SugarController.php');
    require_once('modules/ModuleBuilder/controller.php');
    require_once('modules/ModuleBuilder/parsers/ParserFactory.php');
    require_once("modules/Dupdetector/dupdetector_utils.php");
    $module_name = $_REQUEST['module_selected'];
    $oModule = BeanFactory::getBean($module_name);
    $aFieldList = fetch_field_list($oModule,$oModule->module_dir,'all');
    if(isset($_REQUEST['view']) && $_REQUEST['view'] == 'quickcreate') {
        $deffile ='quickcreatedefs';
        $view ='QuickCreate';
    } else {
        $deffile ='editviewdefs';
        $view ='EditView';
    }
    $aFieldListSelected = array();
    $path = "modules/{$oModule->module_dir}/metadata/{$deffile}.php";
    if(sugar_is_file("custom/{$path}"))
    {
        include_once("custom/{$path}");   
    }
    else
    {
        include_once("{$path}");   
    }
     $fieldindefs = array();
    if(isset($viewdefs [$oModule->module_dir][$view]['panels']))
    {
        $module_view = $viewdefs [$oModule->module_dir][$view]['panels'];
        foreach($module_view as $panelName => $panel){
                foreach($panel as $rowIndex => $panelRow) {
                    foreach($panelRow as $columnIndex => $panelColumn) {
                        if(is_array($panelColumn) && isset($panelColumn['name']) && isset($panelColumn['type']) && $panelColumn['type'] == 'dupdetector') {
                             $aFieldListSelected[$panelColumn['name']] = $aFieldList[$panelColumn['name']];
                             if(isset($aFieldList[$panelColumn['name']]))
                                 unset($aFieldList[$panelColumn['name']]);
                            $fieldName =  $panelColumn['name'];
                        }
                        else if(is_array($panelColumn) && isset($panelColumn['name'])) {
                            $fieldName = $panelColumn['name'];
                        }
                        else {
                            $fieldName = $panelColumn;
                        }
                        $fieldindefs[$fieldName] = $fieldName;
                }
            }
        }
    }
    foreach($aFieldList as $key=>$value){
      if(!array_key_exists($key,$fieldindefs)) {
        unset($aFieldList[$key]);
       }  
    }
    $default_field = '';
    $selected_field = '';
     //Column 1
    foreach ($aFieldList as $field_name => $field_label) {
            $default_field .= " <li class='ui-state-default sortable'  id='{$field_name}' name='{$field_name}'>{$field_label}</li> ";
    }
    //Column 2
    foreach ($aFieldListSelected as $field_name =>$field_label) {
            $selected_field .= " <li class='ui-state-default sortable'  id='{$field_name}' name='{$field_name}' >{$field_label}</li> ";
    }
    $return_array = array('default_field_li' =>$default_field,'selected_field_li'=>$selected_field);
    echo json_encode($return_array);
}
?>
