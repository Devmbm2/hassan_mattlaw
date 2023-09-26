<?php

 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['process_record'] = Array(); 
$hook_array['process_record'][] = Array(1, 'Name Field UPDATE SMS module', 'modules/ht_sms/sms_name_update.php','ht_sms_class', 'sms_update_name'); 
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_ui_frame'][] = Array(100, 'SMS Connector', 'modules/SMS_Configuration/SMS_UIFrame.php', 'SMS_Class', 'SMS_Func');