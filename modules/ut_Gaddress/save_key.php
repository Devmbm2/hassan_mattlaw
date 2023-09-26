<?php
/*
   Created By : Urdhva Tech Pvt. Ltd.
   Created date : 12/06/2017
   Contact at : contact@urdhva-tech.com
   Module : Google Address
*/
global $current_user,$db,$app_list_strings,$beanList;
require_once("modules/Administration/QuickRepairAndRebuild.php");
if(!empty($_REQUEST['g_key'])) {
    $administration = new Administration();
    $category = 'google_api';
    $key = 'google_key';
    $value = $_REQUEST['g_key'];
    $administration->saveSetting($category, $key, $value);
    SugarApplication::appendErrorMessage("Key updated succesfully.");
    //Clear tpl
    require_once("modules/Administration/QuickRepairAndRebuild.php");
    $action = array('clearTpls','clearSmarty','clearThemeCache');
    $oRepair = new RepairAndClear;
    //$oRepair->clearSmarty();
    $oRepair->repairAndClearAll($action, array(translate('LBL_ALL_MODULES')), false, false);
 }
 else{
    SugarApplication::appendErrorMessage("Error : Could not save API key.");
 }
$params = array(
        'module'=> 'Administration',
        'action'=> 'index',
    );

SugarApplication::redirect('index.php?' . http_build_query($params));