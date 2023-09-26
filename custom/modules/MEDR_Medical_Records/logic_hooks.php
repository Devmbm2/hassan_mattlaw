<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_ui_frame'][] = Array(1002, 'Document Templates after_ui_frame Hook', 'custom/modules/MEDR_Medical_Records/DHA_DocumentTemplatesHooks.php','DHA_DocumentTemplatesMEDR_Medical_RecordsHook_class', 'after_ui_frame_method'); 
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(1, 'save related address of organization to medical address detailview', 'custom/modules/MEDR_Medical_Records/Save_RelatedOrganizationAddress.php','Save_RelatedOrganizationAddress', 'save_related_address'); 
$hook_array['before_save'][] = Array(191, 'add date range', 'custom/modules/MEDR_Medical_Records/date_range.php','date_range', 'specific_date_range'); 
$hook_array['process_record'] = Array(); 
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method'); 



?>