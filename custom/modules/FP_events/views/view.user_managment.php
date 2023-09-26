<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

/* require_once("modules/Administration/Administration.php"); */

class Viewuser_managment extends SugarView {

    public function preDisplay() {
        global $current_user, $sugar_config;
       /*  if (!is_admin($current_user)) {
            sugar_die("Unauthorized access to administration.");
        } */

    }

    public function display() {
		/* ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL); */
        require_once('include/Sugar_Smarty.php');
        global $sugar_config, $db;

        if (!is_admin($GLOBALS['current_user'])) {
            sugar_die('You do not have permission.');
        }
		require_once('modules/Configurator/Configurator.php');
		include_once 'custom/include/zoom/Zoom_Api.php';
		$zoom_meeting = new Zoom_Api($GLOBALS['sugar_config']['zoom']);
		$all_users = $zoom_meeting->getAllUsers();
		/* print"<pre>";print_r($response); */
		$configurator = new Configurator();
		$zoom_ss = new Sugar_Smarty();
		$zoom_ss->assign('config', $configurator->config);
		$zoom_ss->assign('MOD', $GLOBALS['mod_strings']);
		$zoom_ss->assign('APP', $GLOBALS['app_strings']);
		$zoom_ss->assign('all_users', $all_users);
		echo $zoom_ss->fetch('custom/modules/FP_events/tpls/user_managment.tpl');
    }

}
