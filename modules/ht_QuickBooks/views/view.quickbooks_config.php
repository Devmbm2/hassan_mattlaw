<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once("modules/Administration/Administration.php");

class Viewquickbooks_config extends SugarView {

    public function preDisplay() {
        global $current_user;
        global $sugar_config;
        if (!is_admin($current_user)) {
            sugar_die("Unauthorized access to administration.");
        }

    }

    public function display() {

        require_once('include/Sugar_Smarty.php');
        global $sugar_config, $db;

        if (!is_admin($GLOBALS['current_user'])) {
            sugar_die('You do not have permission.');
        }

        $quickbooks_admin = new Administration();
        $quickbooks_ss = new Sugar_Smarty();
        
		if ((isset($_POST['save_quickbooks'])) && (!empty($_POST['save_quickbooks']))) {
            // Saving quickbooks configuration
			$quickbooks_admin->saveSetting('quickbooks_config', 'access_token', '');
			$quickbooks_admin->saveSetting('quickbooks_config', 'refresh_token', '');
			$quickbooks_admin->saveSetting('quickbooks_config', 'access_token_expire_time', '');
			$quickbooks_admin->saveSetting('quickbooks_config', 'refresh_token_expire_time', '');
            $quickbooks_admin->saveSetting('quickbooks_config', 'disable_quickbooks', $_REQUEST['disable_quickbooks']);
            $quickbooks_admin->saveSetting('quickbooks_config', 'client_id', $_REQUEST['client_id']);
            $quickbooks_admin->saveSetting('quickbooks_config', 'client_secret', $_REQUEST['client_secret']);
            $quickbooks_admin->saveSetting('quickbooks_config', 'company_id', $_REQUEST['company_id']);
            $quickbooks_admin->saveSetting('quickbooks_config', 'webhook_token', $_REQUEST['webhook_token']);
                        
            SugarApplication::redirect('index.php?module=ht_QuickBooks&action=quickbooks_config');
            
        }else
        {
            $settings_quickbooks = $quickbooks_admin->retrieveSettings('quickbooks_config');
            if($settings_quickbooks->settings['quickbooks_config_disable_quickbooks'] == "on")
            {
             $quickbooks_ss->assign('disable_quickbooks', "checked");
            }else
            {
             $quickbooks_ss->assign('disable_quickbooks', "");   
            }
			
			$redirect_uri = rtrim($sugar_config['site_url'],"/").'/index.php?entryPoint=QuickBooksAccessToken';
            $quickbooks_ss->assign('client_id', $settings_quickbooks->settings['quickbooks_config_client_id']);
            $quickbooks_ss->assign('client_secret', $settings_quickbooks->settings['quickbooks_config_client_secret']);
            $quickbooks_ss->assign('company_id', $settings_quickbooks->settings['quickbooks_config_company_id']);
            $quickbooks_ss->assign('access_token', $settings_quickbooks->settings['quickbooks_config_access_token']);
            $quickbooks_ss->assign('webhook_token', $settings_quickbooks->settings['quickbooks_config_webhook_token']);
            $quickbooks_ss->assign('redirect_uri', $redirect_uri);
            
        }

        $quickbooks_ss->assign('MOD', $GLOBALS['mod_strings']);
        $quickbooks_ss->assign('APP', $GLOBALS['app_strings']);
        echo $quickbooks_ss->fetch('modules/ht_QuickBooks/tpls/quickbooks_config.tpl');
    }

}
