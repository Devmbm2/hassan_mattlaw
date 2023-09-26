<?php
/*
   Created By : Urdhva Tech Pvt. Ltd.
   Created date : 12/06/2017
   Contact at : contact@urdhva-tech.com
   Module : Google Address
*/
$admin_option_defs=array();
$admin_option_defs['Administration']['ut_gaddress_key'] = array(
        $image_path . 'ut_gaddress_key',
        'LBL_UT_ADDRESS_KEY',
        'LBL_UT_ADDRESS_KEY_DESC',
        './index.php?module=ut_Gaddress&action=key_setup',
);

$admin_option_defs['Administration']['ut_gaddress_info']= array('','LBL_GOOGLE_ADDRESS_LICENSE_TITLE','LBL_GOOGLE_ADDRESS_LICENSE','./index.php?module=ut_Gaddress&action=license');
$admin_group_header[]=array('LBL_UT_ADDRESS_KEY_TITLE','',false,$admin_option_defs);    
