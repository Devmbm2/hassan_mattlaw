<?php 
$admin_option_defs = array();
$admin_option_defs['Administration']['recycleBin'] = array('ht_recycle_bin', 'LBL_RECYCLEBIN_TITLE', 'LBL_RECYCLEBIN_DESCRIPTION', 'index.php?module=ht_recycle_bin&action=modules_list');
$admin_option_defs['Administration']['recycleBinLicense']= array('ht_recycle_bin','LBL_RECYCLE_BIN_LICENSE_TITLE','LBL_RECYCLE_BIN_LICENSE_DESC','./index.php?module=ht_recycle_bin&action=license');

$admin_group_header[] = array('Recycle Bin','', false, $admin_option_defs,'');