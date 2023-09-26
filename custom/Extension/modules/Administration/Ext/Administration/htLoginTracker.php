<?php 
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
$admin_option_defs = array();
$admin_option_defs['Administration']['LBL_LOGIN_TRACKER'] = array('Administration', 'LBL_LOGIN_TRACKER_LISCENCE', 'LBL_LOGIN_TRACKER_LISCENCE_DESC', './index.php?module=htLoginTrackerLicenseAddon&action=license');
$admin_group_header[]= array('LBL_LOGIN_TRACKER','',false,$admin_option_defs, '');