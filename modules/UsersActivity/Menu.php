<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point'); 

global $mod_strings, $app_strings, $sugar_config;

		

if(ACLController::checkAccess('UsersActivity', 'list', true))$module_menu[]=Array("index.php?module=UsersActivity&action=index&return_module=UsersActivity&return_action=DetailView", $mod_strings['LNK_LIST'],"MyReports", 'UsersActivity');

?>