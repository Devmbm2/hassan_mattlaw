<?php
/*
   Created By : Urdhva Tech Pvt. Ltd.
 Created date : 09/29/2017
   Contact at : contact@urdhva-tech.com
          Web : www.urdhva-tech.com
        Skype : urdhvatech
       Module : Dupdetector 1.2
*/
/***
* check for duplicate value
*/
if(!empty($_REQUEST['module_name']) && !empty($_REQUEST['field_name']) && !empty($_REQUEST['field_value'])) {
    require_once("modules/Dupdetector/dupdetector_utils.php");
    global $dictionary;
    $field_name = $_REQUEST['field_name'];
    $module_name = $_REQUEST['module_name']; 
    $oModule = BeanFactory::getBean($module_name);
    $arg[$field_name] = trim($_REQUEST['field_value']);
    $data_array = get_duplicate_string($oModule,$arg);
    $oModule->retrieve_by_string_fields($arg);
    $link = '';
    $admin=new Administration();
        $admin->retrieveSettings('checkdup',true);
        $prevent_settings = false;
        if(isset($admin->settings['checkdup_prevent_submit']) && $admin->settings['checkdup_prevent_submit'] == true)
            $prevent_settings = true;
    if(!empty($data_array)) {
        foreach($data_array as $key => $aData) {
            if($_REQUEST['record_id'] != $aData['id'] ){
                if(isset($dictionary[$oModule->object_name]['templates']['person'])) {
                    $name = $aData['first_name']." ".$aData['last_name'];
                }
                else if(!empty($aData['name'])) {
                    $name = $aData['name'];
                }
                else
                    $name = $aData[$field_name];
                    
                $link .="<a href='index.php?module={$module_name}&action=DetailView&record={$aData['id']}' target='_blank'>{$name}</a><br />";
            }   
        }
        if(!empty($link))
            echo json_encode(array("status"=>$link,'settings'=>$prevent_settings));
        else
            echo json_encode(array("status"=>"",'settings'=>$prevent_settings)); 
    }
    else {
        echo json_encode(array("status"=>"",'settings'=>$prevent_settings));
    }
}
?>