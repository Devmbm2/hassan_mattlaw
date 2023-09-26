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
* ajax field configuration save
*/
$data = json_decode(htmlspecialchars_decode(urldecode($_REQUEST['answer_text'])),true);
$module = $data[0]['module'];
$aSelectedField = explode(",",$data[0]['selected_field']);
$aDefaultField =  explode(",",$data[0]['default_field']);
$oModule = BeanFactory::getBean($module);
global $current_user;
require_once('include/utils.php');
require_once('include/utils/file_utils.php');
require_once('config.php');
require_once('include/MVC/Controller/SugarController.php');
require_once('modules/ModuleBuilder/controller.php');
require_once('modules/ModuleBuilder/parsers/ParserFactory.php');
require_once("modules/Dupdetector/dupdetector_utils.php");
$admin=new Administration();
if(isset($_REQUEST['prevent_submit']) && $_REQUEST['prevent_submit'] == 'true'){
    $admin->saveSetting('checkdup','prevent_submit',true);
}
else {
     $admin->saveSetting('checkdup','prevent_submit',false);
}
$addlayoutFields = array();
$removelayoutFields = array();
foreach($aSelectedField as $field) {
    if(!empty($field)){
        $addlayoutFields[$field] = array('name' => $field,'type'=>'dupdetector');
    }
}
foreach($aDefaultField as $field) {
    if(!empty($field)) {
        $removelayoutFields[$field] = array('name' => $field);
    }
}
if(isset($_REQUEST['view']) && $_REQUEST['view'] == 'quickcreate')
    ut_addField2View($oModule, $addlayoutFields, 'quickcreate',$removelayoutFields);
else
    ut_addField2View($oModule, $addlayoutFields, 'editview',$removelayoutFields);

echo json_encode(array("result" =>'success'));
?>
