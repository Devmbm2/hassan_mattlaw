<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');     

class UsersActivityUsersLogicHooks
{         

    function after_login(&$bean, $event, $arguments)
    {
        global $current_user;
        $exclude = UsersActivity::checkExcludeTraking($_SERVER['REMOTE_ADDR'],$current_user->id,'Login','');
		if (!$exclude)
        {            
            $activity = new UsersActivity();
            $activity->name =  $current_user->name. " (".$current_user->user_name.")";
            $activity->assigned_user_id = $current_user->id;
            $activity->ip_address = $_SERVER['REMOTE_ADDR'];
            $activity->session_id = session_id();
            $activity->action_name = 'Login';
            $activity->module_name = '';
            $activity->item_id = '';
            $activity->item_name = '';
            unset($activity->module_dir);
            $activity->save();
			
			$timesheet_bean = BeanFactory::getBean('ht_timesheet');
			$date_now = TimeDate::getInstance()->nowDbDate();
			$timesheetBean = $timesheet_bean->retrieve_by_string_fields(
				array(
				  'name' => $current_user->name,
				  'work_date' => $date_now,
				)
			);
			if(empty($timesheet_bean->id)){
				$timesheet_bean->name =  $current_user->name;
				$timesheet_bean->work_date =  $date_now;
				$timesheet_bean->ip_address =  $activity->ip_address;
				$timesheet_bean->login =  TimeDate::getInstance()->nowDb();
				$timesheet_bean->assigned_user_id = $current_user->id;
				$timesheet_bean->save();
			}
        }
    }

    function before_logout(&$bean, $event, $arguments)
    {
        global $current_user;
        $exclude = UsersActivity::checkExcludeTraking($_SERVER['REMOTE_ADDR'],$current_user->id,'Logout','');
        if (!$exclude)
        {
            $activity = new UsersActivity();
            $activity->name =  $current_user->name. " (".$current_user->user_name.")";
            $activity->assigned_user_id = $current_user->id;
            $activity->ip_address = $_SERVER['REMOTE_ADDR'];
            $activity->session_id = session_id();
            $activity->action_name = 'Logout';
            $activity->module_name = '';
            $activity->item_id = '';
            $activity->item_name = '';
            unset($activity->module_dir);
            $activity->save();	
			
			$timesheet_bean = BeanFactory::getBean('ht_timesheet');
			$date_now = TimeDate::getInstance()->nowDbDate();
			$timesheetBean = $timesheet_bean->retrieve_by_string_fields(
				array(
				  'name' => $current_user->name,
				  'work_date' => $date_now,
				)
			);
			if(!empty($timesheet_bean->id)){
				$timesheet_bean->logout =  TimeDate::getInstance()->nowDb();
				$timesheet_bean->save();
			}
        }
    }
}


?>