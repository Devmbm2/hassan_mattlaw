<?php

global $db, $log, $sugar_config;
// get the related contact from sms number to relate the record
$From = trim($_REQUEST['From']);
$From = str_replace("+", "", $From);
$From = str_replace("-", "", $From);
$From = substr($From, -10);

$query = "SELECT assigned_user_id FROM ht_sms WHERE to_number LIKE '%{$From}%' AND deleted = 0  
	ORDER BY date_entered DESC LIMIT 1;";
	
	$result = $GLOBALS['db']->query($query);
	$LastAssign_Res = $GLOBALS['db']->fetchByAssoc($result);
    $LastUserID = $LastAssign_Res['assigned_user_id'];


$sql = "SELECT id, CONCAT(first_name,' ', last_name) AS contact_name, assigned_user_id  FROM contacts WHERE deleted = 0 AND (phone_home LIKE '%" . $From . "%' OR phone_mobile LIKE '%" . $From . "%' OR phone_work LIKE '%" . $From . "%' OR phone_other LIKE '%" . $From . "%' OR phone_fax LIKE '%" . $From . "%') Limit 1";
$result = $db->query($sql, true);
$row = $db->fetchByAssoc($result);
$UserID = $row['assigned_user_id'];
$contact_name = $row['contact_name'];
$subject = "InboundSMS From {$contact_name} (" . $_REQUEST['From'].")";
// create record in the system
// if($row['id']){
	$ht_sms = new ht_sms();
	$ht_sms->description = $_REQUEST['Body'];
	$ht_sms->name = $subject;
	$ht_sms->to_number = $_REQUEST['To'];
	$ht_sms->from_number = $_REQUEST['From'];
	$ht_sms->sent_received = $_REQUEST['SmsStatus'];
	$ht_sms->contact_id = $row['id'];
	if (!empty($LastUserID)) {
		$ht_sms->assigned_user_id = $LastUserID;
        $ht_sms->modified_user_id = $LastUserID;
	}else if (!empty($UserID)) {
		$ht_sms->assigned_user_id = $UserID;
		$ht_sms->modified_user_id = $UserID;
	}else{
		$ht_sms->assigned_user_id = "1";
		$ht_sms->modified_user_id = "1";
	}
	
	$save_sms = $ht_sms->save();
	
	if(!empty($save_sms)){
		$alert = BeanFactory::newBean('Alerts');
		$alert->name = $subject;
		$alert->description = $_REQUEST['Body'];
		$alert->url_redirect = ajaxLink('index.php?module=Contacts&action=DetailView&record='.$ht_sms->contact_id);
		$alert->target_module = 'Contacts';
		$alert->assigned_user_id = $ht_sms->assigned_user_id;
		$alert->modified_user_id = $ht_sms->assigned_user_id;
		$alert->type = 'info';
		$alert->is_read = 0;
		$alert->save();
    }
// }
