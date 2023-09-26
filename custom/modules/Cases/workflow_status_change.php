<?php

class case_workflow {
	function status_change($bean, $event, $arguments)
	{
		global $db;
		if($bean->fetched_row['status'] == 'PreSuit_1' && $bean->fetched_row['status'] != $bean->status && !in_array($bean->status, array('Closed', 'Referred_Out', 'Appeal_Pending', 'Pending_Signed_Closing'))){
			$sql = "SELECT securitygroups_users.user_id, email_addresses.email_address
					FROM `securitygroups_users` 
					LEFT JOIN email_addr_bean_rel ON (email_addr_bean_rel.deleted = 0 AND email_addr_bean_rel.bean_id = securitygroups_users.user_id)
					LEFT JOIN email_addresses ON (email_addresses.deleted = 0 AND email_addresses.id = email_addr_bean_rel.email_address_id)
					WHERE securitygroups_users.deleted = 0 AND securitygroups_users.securitygroup_id = '8fefcaac-f51e-3cc6-39e4-5ad378b75321'";
			$result = $db->query($sql);
			$security_group_users = array();
			while($row = $db->fetchByAssoc($result)){
				$security_group_users[$row['user_id']] = $row['email_address'];
			}
			$template = new EmailTemplate();
			$template->retrieve('884af950-6696-2f03-c3cf-5c5c152e22cc');
			parseTemplate($bean, $template);
			sendEmail($security_group_users, $template->subject, $template->body_html, $bean->id, "Cases");
		} 
		
	}
	
	function litigation_workflow($bean, $event, $arguments)
	{
		global $db;
		if(($bean->pre_trial_conference_hearing_c != $bean->fetched_row['pre_trial_conference_hearing_c'] || $bean->court_venue_c != $bean->fetched_row['court_venue_c']) && (!empty($bean->court_venue_c)) && (!empty($bean->pre_trial_conference_hearing_c))){
			require_once('custom/modules/AOW_WorkFlow/ht_AOW_Workflow.php');
			$sql = "SELECT id FROM aow_workflow WHERE run_when = 'In_Custom_Scheduler' AND deleted = 0;";
			$result = $db->query($sql);
			while ($row = $db->fetchByAssoc($result)) {
				$workflow = new ht_AOW_WorkFlow();
			
				$workflow->retrieve($row['id']);
				$workflow->run_actions($bean);
			// print"<pre>";print_r($workflow);die;
			}
			// return true;
		} 
		
		//Update "Status" field to "Lit 5." When pre_trial_conference_hearing_c filled in
		if(empty($bean->fetched_row['pre_trial_conference_hearing_c']) && !empty($bean->pre_trial_conference_hearing_c)){
			$bean->status = 'Lit_5';
		}
		
	}
	function Opt_Out_workflow($bean, $event, $arguments)
	{
		$workflow_status = $bean->workflow_end_status_c;
		if($workflow_status == 'Opt_Out'){
			$alert = BeanFactory::newBean('Alerts');
			$alert->name = $bean->status.' '.'Workflow Opting Out For Case'.' '. $bean->name;
			$alert->description = $bean->workflow_opt_out_reason_c;
			$alert->url_redirect = 'index.php?module=Cases&action=DetailView&record='.$bean->id;
			$alert->target_module = 'Case';
			$alert->assigned_user_id = $bean->assigned_user_id;
			$alert->type = 'info';
			$alert->is_read = 0;
			$alert->save();
		}
		
	}
}

