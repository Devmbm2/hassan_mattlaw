<?php
/*
   Created By : Urdhva Tech Pvt. Ltd.
 Created date : 09/29/2017
   Contact at : contact@urdhva-tech.com
          Web : www.urdhva-tech.com
        Skype : urdhvatech
       Module : Dupdetector 1.2
*/
$admin_option_defs=array();
$admin_option_defs['Administration']['dupdetector_config'] = array(
        'MigrateFields',
        'LBL_DUPDETECTOR_TITLE',
        'LBL_DUPDETECTOR_DESCRIPTION',
        './index.php?module=Dupdetector&action=fieldconfig'
);
$admin_group_header[]=array('LBL_DUPDETECTOR_CONFIGURATION_TITLE','',false,$admin_option_defs);    
