<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method'); 
/* $hook_array['after_save'][] = Array(1012, 'Duplicate after_save', 'custom/modules/FP_events/duplicate_record.php','duplicate', 'after_save'); */
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(2, 'Get Organization Location', 'custom/modules/FP_events/org_location.php','OrgLocation', 'orglocation_method');

$hook_array['process_record'] = Array(); 
$hook_array['process_record'][] = Array(1, 'Click to Open Calendar with Event Day', 'custom/modules/FP_events/fp_events_logic_hooks.php','fp_events_class', 'click_to_open_calendar'); 
$hook_array['process_record'][] = Array(1, 'get_related_case_client', 'custom/modules/FP_events/fp_events_logic_hooks.php','fp_events_class', 'get_related_case_client'); 



?>
