<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class ht_login_tracker_hooks{
    function showLoginStatusHook($bean, $event, $arguments){
		global $timedate,$log;
		$now = strtotime($timedate->nowDb());
		$projected = strtotime($timedate->to_db($bean->logout_timestamp));
		$background_color = ($now > $projected) ? "red":"#04ff00" ;
		$bean->login_status = '<span class="badge" style="color: #fff;padding: 5px;width: 10px;height: 10px;background-color:'.$background_color.';">&nbsp;&nbsp;</span>';
	}
}