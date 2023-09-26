<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');


global $mod_strings,$app_strings;
if(ACLController::checkAccess('ht_email_lists', 'list', true))$module_menu[]=Array("index.php?module=ht_email_lists&action=index&return_module=ht_email_lists&return_action=DetailView", $mod_strings['LNK_LIST'],"ht_email_lists");



?>
