<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class user_session_logout_hook{
    public function trackSessionLogout($event, $args){
        global $current_user,$log,$db,$timedate;
        require_once('modules/htLoginTrackerLicenseAddon/license/htLoginTrackerOutfittersLicense.php');
		$validate_license = htLoginTrackerOutfittersLicense::isValid('htLoginTrackerLicenseAddon');
		if($validate_license === true){
		// if(true){
            $session_timeout = ini_get("session.gc_maxlifetime");
            if (!empty($_SESSION)){
                if(!empty($current_user->id)){
                    if($_REQUEST['action']!="Authenticate"){
                        $sql = "SELECT * FROM ht_login_tracker WHERE deleted=0 AND assigned_user_id='{$current_user->id}' ORDER BY date_entered DESC LIMIT 1";
                        $result = $db->query($sql);
                        $row = $db->fetchByAssoc($result);
                        if($row){
                            $logout_timestamp = date('Y-m-d H:i:s',strtotime('+'.$session_timeout.' seconds',strtotime($timedate->nowDb())));
                            $user_session_time = $this->getSessionUsedTime($row['login_timestamp'],  $logout_timestamp);
                            $sql = "UPDATE ht_login_tracker SET logout_timestamp='{$logout_timestamp}', user_session_time='{$user_session_time}' WHERE id='{$row['id']}'";
                            $result = $db->query($sql);
                        }
                    } 
                }
            }
        }
    }
    private function getSessionUsedTime($to,$from){
		$datetime1 = new DateTime($to);
		$datetime2 = new DateTime($from);
		$interval = $datetime1->diff($datetime2);
		return  $interval->format('%h')." Hours ".$interval->format('%i')." Minutes";
	}
}