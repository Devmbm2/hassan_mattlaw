<?php

global $sugar_version;

$admin_option_defs=array();

    
$admin_option_defs['Administration']['quickbooks_config']= array('','LBL_QUICKBOOKS_LICENSE_CONFIGURATION','LBL_QUICKBOOKS_LICENSE_MESSAGE','./index.php?module=ht_QuickBooks&action=quickbooks_config');

$admin_group_header[]= array('LBL_QUICKBOOKS','',false,$admin_option_defs, '');
