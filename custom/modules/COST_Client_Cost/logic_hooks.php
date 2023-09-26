<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_save'] = Array(); 
$hook_array['before_save'] = Array(); 
// $hook_array['before_save'][] = Array(20, 'Create Bills in QuickBooks', 'custom/modules/COST_Client_Cost/QBBillsIntegration.php','QBBillsIntegration', 'QBBillsOperations'); 
$hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method'); 
$hook_array['after_save'][] = Array(1, 'Calculations', 'custom/modules/COST_Client_Cost/calculation.php','calculation_class', 'calculation_method'); 
$hook_array['after_save'][] = Array(70, 'after_save', 'custom/modules/COST_Client_Cost/case_rollup_sum.php','rollup_sum', 'save_record'); 
$hook_array['before_delete'] = Array(); 
$hook_array['before_delete'][] = Array(80, 'delete_record', 'custom/modules/COST_Client_Cost/case_rollup_sum.php','rollup_sum', 'delete_record'); 
$hook_array['before_relationship_delete'] = Array(); 
$hook_array['before_relationship_delete'][] = Array(81, 'after_relationship_delete', 'custom/modules/COST_Client_Cost/case_rollup_sum.php','rollup_sum', 'delete_record'); 
$hook_array['after_relationship_add'] = Array(); 
$hook_array['after_relationship_add'][] = Array(82, 'after_relationship_add hook', 'custom/modules/COST_Client_Cost/case_rollup_sum.php','rollup_sum', 'save_record'); 



?>
