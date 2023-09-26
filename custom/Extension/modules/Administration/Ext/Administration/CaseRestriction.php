<?php 
$admin_option_defs = array();
$admin_option_defs['Administration']['caseRestriction'] = array('Administration', 'LBL_CASERESTRICTION_TITLE', 'LBL_CASERESTRICTION_DESCRIPTION', 'index.php?module=Administration&action=CaseRestriction');

$admin_group_header[] = array('Case Restriction','', false, $admin_option_defs,'');