<?php
/*
   Created By : Urdhva Tech Pvt. Ltd.
   Created date : 12/06/2017
   Contact at : contact@urdhva-tech.com
   Module : Google Address
*/
global $sugar_config;
$oSmarty = new Sugar_Smarty();
$oSmarty->assign('MOD', $GLOBALS['mod_strings']);   //Assign mod string
$oSmarty->assign('APP', $GLOBALS['app_strings']);   //Assign app string
$administration = new Administration();
$administration->retrieveSettings();
if(!empty($administration->settings['google_api_google_key']))
    $oSmarty->assign('g_key', $administration->settings['google_api_google_key']);   //Assign app string
else
    $oSmarty->assign('g_key', "");   //Assign app string

$licKey = isset($sugar_config['outfitters_licenses']['googleaddress']) ? $sugar_config['outfitters_licenses']['googleaddress'] : '';
require_once 'modules/ut_Gaddress/license/OutfittersLicense.php';
$oOutfittersLicense = new OutfittersLicense();
$valid = $oOutfittersLicense->doValidate('ut_Gaddress',$licKey);
if(!empty($valid['success'])) {
    
    //Clear tpl
    require_once("modules/Administration/QuickRepairAndRebuild.php");
    $action = array('clearTpls','clearSmarty','clearThemeCache');
    $oRepair = new RepairAndClear;
    $oRepair->repairAndClearAll($action, array(translate('LBL_ALL_MODULES')), false, false);
    
    echo $oSmarty->display('modules/ut_Gaddress/tpls/key_setup.tpl');
}
else {
    SugarApplication::redirect('index.php?module=ut_Gaddress&action=license');
}

 ?>
