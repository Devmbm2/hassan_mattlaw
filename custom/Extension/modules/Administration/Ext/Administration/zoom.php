<?php

global $sugar_version;

$admin_option_defs=array();

    
$admin_option_defs['Administration']['zoom_config']= array('','LBL_ZOOM_CONFIGURATION','LBL_ZOOM_MESSAGE','./index.php?module=FP_events&action=zoom_config');
$admin_option_defs['Administration']['user_management']= array('','LBL_USER_MANAGEMENT','LBL_USER_MESSAGE','./index.php?module=FP_events&action=user_managment');

$admin_group_header[]= array('LBL_ZOOM','',false,$admin_option_defs, '');
