<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method'); 
$hook_array['after_save'][] = Array(1012, 'Duplicate after_save', 'custom/modules/FP_events/duplicate_record.php','duplicate', 'after_save');
/* $hook_array['after_save'][] = Array(100, 'Create Hold Events', 'custom/modules/FP_events/create_hold_event.php','create_hold_event', 'save_hold_event'); */
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(2, 'Get Organization Location', 'custom/modules/FP_events/org_location.php','OrgLocation', 'orglocation_method');
$hook_array['before_save'][] = Array(5, 'Create Zoom Meeting', 'custom/modules/FP_events/create_zoom_meeting.php','zoom', 'create_zoom_meeting');
$hook_array['before_save'][] = Array(5, 'Create Google Event', 'custom/modules/FP_events/create_zoom_meeting.php','zoom', 'syncCalendarEventsScheduler');
$hook_array['before_save'][] = Array(100, 'Create Hold Events', 'custom/modules/FP_events/create_hold_event.php','create_hold_event', 'save_hold_event_data');
$hook_array['before_save'][] = Array(100, 'Create Travel Event', 'custom/modules/FP_events/create_travel_event.php','create_travel_event', 'save_travel_event_data');
$hook_array['before_save'][] = Array(100, 'Create Document and Export to Google Docs', 'custom/modules/FP_events/export_event.php','create_export_event', 'show_export_event_data');
// $hook_array['before_save'][] = Array(110, 'Setting Calendar Events', 'custom/modules/FP_events/calendar_event.php','create_calendar_event', 'show_calendar_event_data');
$hook_array['before_save'][] = Array(3, 'set Attachments', 'custom/modules/FP_events/attachment_note.php','Documents_logic_hooks22', 'setAttachments22');
// $hook_array['before_delete'][] = Array(110, 'Notify Administrator', 'custom/modules/FP_events/beforeDeleteNotification.php','create_delete_notification', 'delete_notification_admin');

$hook_array['process_record'] = Array(); 
$hook_array['process_record'][] = Array(1, 'Click to Open Calendar with Event Day', 'custom/modules/FP_events/fp_events_logic_hooks.php','fp_events_class', 'click_to_open_calendar'); 
$hook_array['process_record'][] = Array(1, 'get_related_case_client', 'custom/modules/FP_events/fp_events_logic_hooks.php','fp_events_class', 'get_related_case_client'); 



?>
