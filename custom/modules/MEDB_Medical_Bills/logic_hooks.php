<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_ui_frame'][] = Array(1002, 'Document Templates after_ui_frame Hook', 'custom/modules/MEDB_Medical_Bills/DHA_DocumentTemplatesHooks.php','DHA_DocumentTemplatesMEDB_Medical_BillsHook_class', 'after_ui_frame_method'); 
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(200, 'Balance Rollup Sum', 'custom/modules/MEDB_Medical_Bills/contact_balance_rollup_sum.php','balance_rollup_sum', 'balance_save_record'); 
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method'); 



?>