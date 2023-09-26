<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will
// be automatically rebuilt in the future.
 $hook_version = 1;
$hook_array = Array();
// position, file, function
$hook_array['after_ui_frame'] = Array();
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method');
$hook_array['before_save'] = Array();
$hook_array['process_record'] = Array();
//$hook_array['before_save'][] = Array(102, 'calculations', 'custom/modules/NEG_Negotiations/clone_name.php','clone_name', 'before_save');
$hook_array['before_save'][] = Array(199, 'Update fields on done', 'custom/modules/NEG_Negotiations/update_fields_on_done.php','updateFieldsOnDone', 'update_fields_on_done');
$hook_array['process_record'][] = Array(12, 'Update Case Assigned to ', 'custom/modules/NEG_Negotiations/update_case_assigned_to.php','update_neg_negotiations', 'update_case_assigned_to');
$hook_array['after_save'][] = Array(1, 'Create Event', 'custom/modules/Documents/create_event.php','create_event', 'save_event');
$hook_array['before_save'][] = Array(13, 'SavedBy', 'custom/modules/PLEA_Pleadings/saved_by.php','SavedBy', 'saved_by');
?>
