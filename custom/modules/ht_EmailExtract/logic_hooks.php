<?php 
 
 $hook_version = 1;
 $hook_array = Array();
$hook_array['before_save'][] = Array(10, 'Get all configuration field for email extraction module', 'custom/modules/ht_EmailExtract/EmailConfiguration.php','emailConfig', 'configuration');
