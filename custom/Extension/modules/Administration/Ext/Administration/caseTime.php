<?php 
$admin_option_defs = array();
$admin_option_defs['Administration']['caseTime'] = array('Administration', 'LBL_CASETIME_TITLE', 'LBL_CASETIME_DESCRIPTION', 'index.php?module=Administration&action=CaseTime');

$admin_group_header[] = array('Case Time','', false, $admin_option_defs,'');