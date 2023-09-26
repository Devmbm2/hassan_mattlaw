<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
	// session_start();
	class create_calendar_event{
	   function show_calendar_event_data($bean, $event, $arguments){
	   	
	   	if($bean->cases_fp_events_1cases_ida == '8464ee46-7790-11ec-918e-588a5a3fd4fa')
	   	{
	   		$bean->multiple_assigned_users = encodeMultienumValue("1");
	   		$bean->save();
	   	}

	}
}