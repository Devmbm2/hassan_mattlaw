<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method'); 
$hook_array['after_save'][] = Array(2, 'Send Slack notification for creating task in crm', 'custom/modules/Tasks/tasksHook.php','tasksHook', 'send_slack_notification');  
$hook_array['process_record'] = Array(); 
$hook_array['process_record'][] = Array(12, 'Update Case Assigned to ', 'custom/modules/Tasks/update_case_assigned_to.php','ht_update_task', 'update_case_assigned_to'); 
//$hook_array['process_record'][] = Array(13, 'Update No Of Days Task Over Due ', 'custom/modules/Tasks/TaskOverdue.php','ht_task', 'task_overdue_days'); 
$hook_array['process_record'][] = Array(13, 'Get Case Status ', 'custom/modules/Tasks/getCaseFields.php','getCaseFields', 'getCaseStatus'); 
$hook_array['process_record'][] = Array(13, 'Get Case Assistant ', 'custom/modules/Tasks/getCaseFields.php','getCaseFields', 'getCaseAssistant'); 


?>
