<?php 
$admin_option_defs = array();
$admin_option_defs['Administration']['exportDocPassword'] = array('Administration', 'LBL_EXPORTDOCPASSWORD_TITLE', 'LBL_EXPORTDOCPASSWORD_DESCRIPTION', 'index.php?module=Administration&action=ExportDocPassword');

$admin_group_header[] = array('Export Password Configuration','', false, $admin_option_defs,'');