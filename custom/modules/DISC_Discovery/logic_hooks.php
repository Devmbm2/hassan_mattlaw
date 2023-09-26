<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will
// be automatically rebuilt in the future.
 $hook_version = 1;
$hook_array = Array();
// position, file, function
$hook_array['after_ui_frame'] = Array();
$hook_array['after_ui_frame'][] = Array(1002, 'Document Templates after_ui_frame Hook', 'custom/modules/DISC_Discovery/DHA_DocumentTemplatesHooks.php','DHA_DocumentTemplatesDISC_DiscoveryHook_class', 'after_ui_frame_method');
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(1, 'Create Event', 'custom/modules/Documents/create_event.php','create_event', 'save_event');
$hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method');
$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(199, 'Update fields on done', 'custom/modules/NEG_Negotiations/update_fields_on_done.php','updateFieldsOnDone', 'update_fields_on_done');
$hook_array['before_save'][] = Array(200, 'setting hd-reviewed to zero', 'custom/modules/DISC_Discovery/hd_reviewed_null.php','updateFieldsOnSave', 'hd_reviewed_null');
$hook_array['before_save'][] = Array(3, 'set Attachments', 'custom/modules/DISC_Discovery/attachment_note.php','Documents_logic_hooks', 'setAttachments');
$hook_array['after_delete'] = Array();
$hook_array['after_delete'][] = Array(201, 'setting deleted column to 1 in quality ontrol remarks table', 'custom/modules/DISC_Discovery/update_deleted_column.php','updateFieldsOnDelete', 'update_deleted_column');
$hook_array['process_record'] = Array();
$hook_array['process_record'][] = Array(12, 'Update Case Assigned to ', 'custom/modules/DISC_Discovery/update_case_assigned_to.php','update_disc_discovery', 'update_case_assigned_to');


?>
