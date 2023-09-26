<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method'); 
$hook_array['after_save'][] = Array(85, 'after_save hook', 'custom/modules/DEF_Defendants/case_def_rollup_sum.php','def_rollup_sum', 'create_def_save_record'); 
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(50, 'Create Relations with Contacts according to roles of Defendent', 'custom/modules/DEF_Defendants/case_role.php','def_role_class', 'add_contacts_roles_defendents'); 
$hook_array['before_delete'] = Array(); 
$hook_array['before_delete'][] = Array(83, 'def_delete_record', 'custom/modules/DEF_Defendants/case_def_rollup_sum.php','def_rollup_sum', 'def_delete_record'); 
$hook_array['after_retrieve'] = Array(); 
$hook_array['after_retrieve'][] = Array(83, 'get_related_fields', 'custom/modules/DEF_Defendants/def_retrieve_hook.php','def_retrieve_hook', 'get_related_fields'); 
$hook_array['before_relationship_delete'] = Array(); 
$hook_array['before_relationship_delete'][] = Array(84, 'after_relationship_delete', 'custom/modules/DEF_Defendants/case_def_rollup_sum.php','def_rollup_sum', 'def_delete_record'); 
$hook_array['after_relationship_add'] = Array(); 
$hook_array['after_relationship_add'][] = Array(85, 'after_relationship_add hook', 'custom/modules/DEF_Defendants/case_def_rollup_sum.php','def_rollup_sum', 'def_save_record'); 
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_ui_frame'][] = Array(1002, 'Document Templates after_ui_frame Hook', 'custom/modules/DEF_Defendants/DHA_DocumentTemplatesHooks.php','DHA_DocumentTemplatesDEF_DefendantsHook_class', 'after_ui_frame_method'); 



?>