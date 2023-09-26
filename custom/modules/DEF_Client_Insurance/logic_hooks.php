<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_ui_frame'][] = Array(1002, 'Document Templates after_ui_frame Hook', 'custom/modules/DEF_Client_Insurance/DHA_DocumentTemplatesHooks.php','DHA_DocumentTemplatesDEF_Client_InsuranceHook_class', 'after_ui_frame_method'); 
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method'); 
$hook_array['before_relationship_delete'] = Array(); 
$hook_array['before_relationship_delete'][] = Array(53, 'after_relationship_delete', 'custom/modules/DEF_Client_Insurance/case_policy_rollup_sum.php','cliins_policy_rollup_sum', 'cliins_policy_delete_record'); 
$hook_array['after_relationship_add'] = Array(); 
$hook_array['after_relationship_add'][] = Array(54, 'after_relationship_add hook', 'custom/modules/DEF_Client_Insurance/case_policy_rollup_sum.php','cliins_policy_rollup_sum', 'cliins_policy_save_record'); 
$hook_array['after_retrieve'] = Array(); 
$hook_array['after_retrieve'][] = Array(83, 'get_related_fields', 'custom/modules/DEF_Client_Insurance/um_def_retrieve_hook.php','um_def_retrieve_hook', 'get_related_fields'); 
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(50, 'Create Relations with Contacts according to roles of UM Defendent', 'custom/modules/DEF_Client_Insurance/case_role.php','def_role_class', 'add_contacts_roles_defendents'); 



?>