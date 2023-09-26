<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(1, 'Contacts Calculation', 'custom/modules/Contacts/contact_calculation.php','contact_calculation', 'calculation'); 
$hook_array['before_save'][] = Array(2, 'Contacts Calculation', 'custom/modules/Contacts/contact_calculation.php','contact_calculation', 'contact_calculation_confidential'); 
$hook_array['before_save'][] = Array(3, 'Contacts Gender', 'custom/modules/Contacts/contact_calculation.php','contact_calculation', 'contact_gender'); 
$hook_array['before_save'][] = Array(1, 'Contacts push feed', 'modules/Contacts/SugarFeeds/ContactFeed.php','ContactFeed', 'pushFeed'); 
$hook_array['before_save'][] = Array(77, 'updateGeocodeInfo', 'modules/Contacts/ContactsJjwg_MapsLogicHook.php','ContactsJjwg_MapsLogicHook', 'updateGeocodeInfo'); 
$hook_array['before_save'][] = Array(3, 'Country Code Concatenation with phone', 'custom/modules/Contacts/countrycode_phone.php','countrycode_concatenation', 'countrycode_phone'); 
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(1, 'Update Portal', 'modules/Contacts/updatePortal.php','updatePortal', 'updateUser'); 
$hook_array['after_save'][] = Array(77, 'updateRelatedMeetingsGeocodeInfo', 'modules/Contacts/ContactsJjwg_MapsLogicHook.php','ContactsJjwg_MapsLogicHook', 'updateRelatedMeetingsGeocodeInfo'); 
$hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method'); 
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_ui_frame'][] = Array(100, 'SMS Connector', 'modules/SMS_Configuration/SMS_UIFrame.php','SMS_Class', 'SMS_Func'); 
$hook_array['after_ui_frame'][] = Array(1002, 'Document Templates after_ui_frame Hook', 'custom/modules/Contacts/DHA_DocumentTemplatesHooks.php','DHA_DocumentTemplatesContactsHook_class', 'after_ui_frame_method'); 
$hook_array['process_record'] = Array(); 
$hook_array['process_record'][] = Array(1002, 'Name Field', 'custom/modules/Contacts/contact_calculation.php','contact_calculation', 'concat_name'); 



?>