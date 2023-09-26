<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
	// session_start();
	class create_delete_notification{
	   function delete_notification_admin($bean, $event, $arguments){
	   	global $current_user;
	   	$now = new DateTime();
	   	$dateFormated = $now->format('d-m-Y H:i');
	   	$user_bean = BeanFactory::getBean('Users');
	   	$query = "users.is_admin = 1";
	   	$users = $user_bean->get_full_list('',$query);
	   	foreach($users as $user){
	   		$alert = BeanFactory::newBean('Alerts');
			$alert->name = $bean->name.' '.'has been deleted by'.' '. $current_user->user_name;
			$alert->description = "This " .$bean->name. " event has been deleted by user with name ".$current_user->user_name. " on dated ". $dateFormated ;
			$alert->url_redirect = 'index.php?module=FP_events&action=DetailView&record='.$bean->id;
			$alert->target_module = 'Event';
			$alert->assigned_user_id = $user->id;
			$alert->type = 'info';
			$alert->is_read = 0;
			$alert->save();
			// $bean->mark_undeleted($bean->id);
	   	}
	   	

	}
}