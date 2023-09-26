<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class user_logic_hooks{
	function addToALLUserRole($bean, $event, $arguments){
		$role = BeanFactory::getBean('ACLRoles', 'ht_login_tracker_id');
		$roles_users = $role->get_linked_beans('users', 'User');
		$role_array =  array();
		foreach($roles_users as $role_user){
			$role_array [] = $role_user->id;
		}
		if(!in_array($bean->id,$role_array)){
			$role->set_relationship('acl_roles_users', array('role_id' => $role->id, 'user_id' => $bean->id), false);
		}
		$role->save();
	}
	function trackLogout($bean, $event, $arguments){
		global $db,$timedate,$log;
		require_once('modules/htLoginTrackerLicenseAddon/license/htLoginTrackerOutfittersLicense.php');
		$validate_license = htLoginTrackerOutfittersLicense::isValid('htLoginTrackerLicenseAddon');
		if($validate_license === true){
		// if(true){
			if(!empty($bean->id)){
				$logout_timestamp = $timedate->nowDb();
				$sql = "SELECT * FROM ht_login_tracker WHERE deleted=0 AND assigned_user_id='{$bean->id}' ORDER BY date_entered DESC LIMIT 1";
				$result = $db->query($sql);
				$row = $db->fetchByAssoc($result);
				if($row){
					$logout_timestamp = $timedate->nowDb();
					$user_session_time = $this->getSessionUsedTime($row['login_timestamp'],  $logout_timestamp);
					$sql = "UPDATE ht_login_tracker SET logout_timestamp='{$logout_timestamp}', user_session_time='{$user_session_time}' WHERE id='{$row['id']}'";
					$result = $db->query($sql);
				}
			}
		}
	}
	function trackLogin($bean, $event, $arguments){
		global $timedate;
		require_once('modules/htLoginTrackerLicenseAddon/license/htLoginTrackerOutfittersLicense.php');
		$validate_license = htLoginTrackerOutfittersLicense::isValid('htLoginTrackerLicenseAddon');
		if($validate_license === true){
		// if(true){
			$browser = get_browser(null, true);
			$login_tracker = new ht_login_tracker();
			$login_tracker->assigned_user_id = $bean->id;
			$login_tracker->login_timestamp = $timedate->nowDb();
			$login_tracker->ip_address = $this->getClientIP();
			$login_tracker->browser_information = base64_encode(json_encode($browser));
			$login_tracker->server_information = base64_encode(json_encode($_SERVER));
			$login_tracker->user_agent = $_SERVER['HTTP_USER_AGENT'];
			$login_tracker->operating_system = $browser['platform_description'];
			$login_tracker->device = $browser['device_name'];
			$login_tracker->browser = $browser['parent'];
			$login_tracker->latitude_longitude = $this->getCoordinate($this->getClientIP());
			$login_tracker->ht_name = "{$bean->full_name} | {$login_tracker->ip_address} | {$login_tracker->browser} | {$login_tracker->device} | ".$timedate->to_display_date_time($login_tracker->login_timestamp);
			$login_tracker->description = "{$bean->full_name} logged in from ip {$login_tracker->ip_address} using {$login_tracker->browser} on device {$login_tracker->device} at ".$timedate->to_display_date_time($login_tracker->login_timestamp);
			$login_tracker->save();
		}
	}
	private function getClientIP(){
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	private function getCoordinate($ip_address){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "http://ip-api.com/php/".$ip_address,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
				"Content-Type:application/json"
			),
		));
		$response = curl_exec($curl);
		$response = unserialize($response);
		curl_close($curl);
		if($response['status']=="success"){
			return  $response['lat'].','.$response['lon'];
		}else{
			return "";
		}
	}
	private function getSessionUsedTime($to,$from){
		$datetime1 = new DateTime($to);
		$datetime2 = new DateTime($from);
		$interval = $datetime1->diff($datetime2);
		return  $interval->format('%h')." Hours ".$interval->format('%i')." Minutes";
	}
}