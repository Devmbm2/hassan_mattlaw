<?php
$admin_option_defs=array();
$admin_option_defs['email_extraction_configuration']['Config']= array('Administration','Email Extraction Configuration','Create Email Extraction Configuration','./index.php?module=Administration&action=email_extraction_config');
$admin_group_header[]= array('LBL_EMAIL_EXRACT_CONFIG','',false,$admin_option_defs, 'LBL_EMAIL_EXRACT_CONFIG_DESC');