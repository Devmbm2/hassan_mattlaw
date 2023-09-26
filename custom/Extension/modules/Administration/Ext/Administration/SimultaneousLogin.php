<?php 
$admin_option_defs = array();
$admin_option_defs['Administration']['simultaneousLogin'] = array('Administration', 'LBL_SIMULTANEOUSLOGIN_TITLE', 'LBL_SIMULTANEOUSLOGIN_DESCRIPTION', 'index.php?module=Administration&action=SimultaneousLogin');

$admin_group_header[] = array('Simultaneous Login Configuration','', false, $admin_option_defs,'');