<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(1, 'Cases push feed', 'modules/Cases/SugarFeeds/CaseFeed.php','CaseFeed', 'pushFeed'); 
$hook_array['before_save'][] = Array(10, 'Save case updates', 'modules/AOP_Case_Updates/CaseUpdatesHook.php','CaseUpdatesHook', 'saveUpdate'); 
$hook_array['before_save'][] = Array(11, 'Save case events', 'modules/AOP_Case_Events/CaseEventsHook.php','CaseEventsHook', 'saveUpdate'); 
$hook_array['before_save'][] = Array(12, 'Case closure prep', 'modules/AOP_Case_Updates/CaseUpdatesHook.php','CaseUpdatesHook', 'closureNotifyPrep'); 
$hook_array['before_save'][] = Array(77, 'updateGeocodeInfo', 'modules/Cases/CasesJjwg_MapsLogicHook.php','CasesJjwg_MapsLogicHook', 'updateGeocodeInfo'); 
$hook_array['before_save'][] = Array(100, 'update custom fields', 'custom/modules/Cases/UpdateCustomFields.php','UpdateCustomFields', 'update_custom_fields'); 
$hook_array['before_save'][] = Array(50, 'Create a Work Flow that trigger that fires after PRe-Suit 1', 'custom/modules/Cases/workflow_status_change.php','case_workflow', 'status_change'); 
$hook_array['before_save'][] = Array(50, 'statute_of_limitations_calculations', 'custom/modules/Cases/case_calculation.php','case_calculation', 'statute_of_limitations_calculations'); 
$hook_array['before_save'][] = Array(50, 'Create Relations with Contacts according to roles', 'custom/modules/Cases/case_role.php','case_role_class', 'add_contacts_roles'); 
$hook_array['before_save'][] = Array(50, ' [a.fee_minus_referral_c] = [a.firm_fee_c] minus [a.referral_fee_c]', 'custom/modules/Cases/case_calculation.php','case_calculation', 'calculate_fee_minus_referral_c'); 
$hook_array['before_save'][] = Array(50, ' sum of all running bill/lien records related to the injured_person_c contact', 'custom/modules/Cases/case_calculation.php','case_calculation', 'calculate_total_medical_bill'); 
$hook_array['before_save'][] = Array(50, 'Litigation Workflow trigger before Save', 'custom/modules/Cases/workflow_status_change.php','case_workflow', 'litigation_workflow'); 
$hook_array['before_save'][] = Array(50, 'Workflow Opt Out trigger before Save', 'custom/modules/Cases/workflow_status_change.php','case_workflow', 'Opt_Out_workflow'); 
$hook_array['process_record'] = Array(); 
$hook_array['process_record'][] = Array(1005, 'calculate_no_of_days', 'custom/modules/Cases/case_calculation.php','case_calculation', 'calculate_no_of_days'); 
$hook_array['after_delete'] = Array(); 
$hook_array['after_delete'][] = Array(1, 'On deleteion Audit entry', 'custom/modules/Cases/CaseDeleteAudit.php','casesAudit', 'logAudit'); 
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(10, 'Send contact case closure email', 'modules/AOP_Case_Updates/CaseUpdatesHook.php','CaseUpdatesHook', 'closureNotify'); 
$hook_array['after_save'][] = Array(77, 'updateRelatedMeetingsGeocodeInfo', 'modules/Cases/CasesJjwg_MapsLogicHook.php','CasesJjwg_MapsLogicHook', 'updateRelatedMeetingsGeocodeInfo'); 
$hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method'); 
$hook_array['after_save'][] = Array(1, 'Save related case role', 'custom/modules/Cases/case_role.php','case_role_class', 'case_role_method'); 
$hook_array['after_relationship_add'] = Array(); 
// $hook_array['after_relationship_add'][] = Array(9, 'Assign account', 'modules/AOP_Case_Updates/CaseUpdatesHook.php','CaseUpdatesHook', 'assignAccount');
$hook_array['after_relationship_add'][] = Array(9, 'Assign account', 'custom/modules/AOP_Case_Updates/custom_CaseUpdatesHook.php','custom_CaseUpdatesHook', 'assignAccount'); 
$hook_array['after_relationship_add'][] = Array(10, 'Send contact case email', 'modules/AOP_Case_Updates/CaseUpdatesHook.php','CaseUpdatesHook', 'creationNotify'); 
$hook_array['after_relationship_add'][] = Array(77, 'addRelationship', 'modules/Cases/CasesJjwg_MapsLogicHook.php','CasesJjwg_MapsLogicHook', 'addRelationship'); 
$hook_array['after_retrieve'] = Array(); 
$hook_array['after_retrieve'][] = Array(10, 'Filter HTML', 'modules/AOP_Case_Updates/CaseUpdatesHook.php','CaseUpdatesHook', 'filterHTML'); 
$hook_array['after_relationship_delete'] = Array(); 
$hook_array['after_relationship_delete'][] = Array(77, 'deleteRelationship', 'modules/Cases/CasesJjwg_MapsLogicHook.php','CasesJjwg_MapsLogicHook', 'deleteRelationship'); 
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_ui_frame'][] = Array(1002, 'Document Templates after_ui_frame Hook', 'custom/modules/Cases/DHA_DocumentTemplatesHooks.php','DHA_DocumentTemplatesCasesHook_class', 'after_ui_frame_method'); 



?>