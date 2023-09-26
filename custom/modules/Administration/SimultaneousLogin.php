<?php
if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');

global $db, $app_list_strings;
$cfg = new Configurator;
$smarty = new Sugar_Smarty();
if($_REQUEST['save']){
    if ($_REQUEST['loginradio'] == 'enable')
    {
        $cfg->config['simultaneouslogin'] = true;
    }
    else{
       $cfg->config['simultaneouslogin'] = false;
    }
    $cfg->saveConfig();
}
$smarty->assign('loginValue', $cfg->config['simultaneouslogin']);
$smarty->display('custom/modules/Administration/tpls/SimultaneousLogin.tpl');
echo $smarty;