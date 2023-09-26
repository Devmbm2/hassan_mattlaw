<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_ui_frame'][] = Array(1002, 'Document Templates after_ui_frame Hook', 'custom/modules/MREQ_MEDB_Requests/DHA_DocumentTemplatesHooks.php','DHA_DocumentTemplatesMREQ_MEDB_RequestsHook_class', 'after_ui_frame_method'); 
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(199, 'Name Concat', 'custom/modules/MREQ_MEDB_Requests/name_concat.php','NameConcat', 'concatName'); 
$hook_array['before_save'][] = Array(10, 'related_running_bill_client', 'custom/modules/MREQ_MEDB_Requests/MREQ_MEDB_Requests_hook.php','MREQ_MEDB_Requests_hook', 'related_running_bill_client'); 
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method'); 
$hook_array['process_record'] = Array(); 
$hook_array['process_record'][] = Array(10, 'related_running_bill_client', 'custom/modules/MREQ_MEDB_Requests/MREQ_MEDB_Requests_hook.php','MREQ_MEDB_Requests_hook', 'related_running_bill_client'); 



?>