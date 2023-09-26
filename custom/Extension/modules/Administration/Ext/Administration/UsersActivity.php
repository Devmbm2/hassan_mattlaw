<?php

$admin_option_defs=array();
$admin_option_defs['UsersActivity']['UsersActivity']= array('MyReports','LBL_MODULE_NAME','LBL_MODULE_DESC','./index.php?module=UsersActivity&action=index');
$admin_option_defs['UsersActivity']['Config']= array('Administration','Settings','Change settings for Users Activity','./index.php?module=Administration&action=UAdmin');
$admin_group_header[]= array('LBL_MODULE_TITLE','',false,$admin_option_defs, 'LBL_TITLE_DESC');


?>