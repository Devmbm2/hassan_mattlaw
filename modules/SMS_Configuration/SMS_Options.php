<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
require_once('modules/SMS_Configuration/SMS_Utils.php');
$sms_utils = new sms_utils();
$sms = new ht_sms();

if (isset($_REQUEST['action']) && trim($_REQUEST['action'] === "get_sms_body")) {

    $mobile = trim($_REQUEST['mobile']);
    $modulefrom = trim($_REQUEST['modulefrom']);
    $recid = trim($_REQUEST['recid']);
    echo "<div class='panel-body panel-collapse collapse in' id='detailpanel_-1'>"
    . "<div class='tab-content'><div class='row edit-view-row'>"
    . "<font color='red' style='text-align: center;'><span id='errr_msg' style='display:none'><b>Empty message cant be send.</b></span></font>"
    . "<div id='loading_sms' style='display:none'><div style='display: flex;justify-content: center;'><image src='modules/SMS_Configuration/images/sms_loading.gif'/></div></div>"
    . "<div class='col-xs-12 col-sm-6 edit-view-row-item'>"
    . "<div class='col-xs-12 col-sm-8 edit-view-field ' type='varchar'>"
    . '
<div>
<div>
</div>
	'
    . "</div>"
    . "</div>"
	. "<div class='col-xs-12 col-sm-6 edit-view-row-item'>"
    . "<div class='col-xs-12 col-sm-4 label'>"
    . "Send to Numbers (format +1):</div>"
    . "<div class='col-xs-12 col-sm-8 edit-view-field ' type='varchar'>"
    . "<input id='mobile_numbers' name='mobile_numbers'  value=". $mobile ." style='width:inherit;'>" 
    . "</div>"
    . "</div>"
    . "<div class='col-xs-12 col-sm-6 edit-view-row-item'>"
    . "<div class='col-xs-12 col-sm-4 label'>"
    . "SMS Message:</div>"
    . "<div class='col-xs-12 col-sm-8 edit-view-field ' type='varchar'>"
    . "<textarea spellcheck='true' id='sms_description' rows='3' cols='90' style='width:inherit;'></textarea>"
    . "</div>"
    . "<input type='hidden' name='sl_mod' id='sl_mod' value='$modulefrom'/>"
    . "<input type='hidden' name='sl_mod_id' id='sl_mod_id' value='$recid'/>"
    . "</div>"
    . "</div></div></div>";
}
if (isset($_REQUEST['action']) && trim($_REQUEST['action'] === "get_sms_data")) {
	
    $module = trim($_REQUEST['record_module']);
    $record_id = trim($_REQUEST['record_id']);
	$bean = BeanFactory::getBean($module, $record_id);
	if(!empty($bean) && $bean->id){
		$related_module_query = '';
		if($module == 'Contacts' || $module == 'Leads'){
			$related_module_query = " AND (from_number = '{$bean->phone_mobile}' OR  to_number = '{$bean->phone_mobile}') AND from_number IS NOT NULL AND from_number != '' AND to_number IS NOT NULL AND to_number != ''";
		}else if($module == 'Accounts'){
			$related_module_query = " AND (from_number = '{$bean->phone_office}' OR to_number = '{$bean->phone_office}') AND from_number IS NOT NULL AND from_number != '' AND to_number IS NOT NULL AND to_number != ''";
		}else if($module == 'ht_sms'){
			if($bean->sent_received == 'Outgoing'){
				$related_module_query = " AND (from_number = '{$bean->to_number}' OR to_number = '{$bean->to_number}') AND from_number IS NOT NULL AND from_number != '' AND to_number IS NOT NULL AND to_number != ''";				
			}else if($bean->sent_received == 'Incoming'){
				$related_module_query = " AND (from_number = '{$bean->from_number}' OR to_number = '{$bean->from_number}') AND from_number IS NOT NULL AND from_number != '' AND to_number IS NOT NULL AND to_number != ''";					
			}
		}
		$filter4 = '';
		if(isset($_REQUEST['record_ids']) && !empty($_REQUEST['record_ids']) && $_REQUEST['record_ids']!='undefined' ){
			$id = $this->detectTableOrigin($module_name,"id");
			$ids = explode(",",$_REQUEST['record_ids']);
			$ids = "'".implode("','",$ids)."'";
			$filter4 = " && id NOT IN ({$ids})";
		}
		$query = "SELECT * FROM ht_sms WHERE deleted = 0 {$related_module_query } {$filter4} ORDER BY date_entered ASC LIMIT 30";
		/* echo $query; */
		$result = $GLOBALS['db']->query($query, true);
		/* print"<pre>123";print_r($result); */
		$total_count = $result->num_rows;
		$data = array();
		while($row = $GLOBALS['db']->fetchByAssoc($result)){
			$record_ids[] = $row['id'];
			$heading = '';
			$display_image = '';
			$row['description'] = nl2br(html_entity_decode($row['description']));
			if(isset($row['filename']) && !empty($row['filename'])){
				$uploadfile = "upload/{$row['id']}";
				$imageData = base64_encode(file_get_contents($uploadfile));
				$src = 'data: '.mime_content_type($uploadfile).';base64,'.$imageData;
				$display_image = '<br><img style="width:150px;height:150px;" src="' . $src . '">';
			}
			$row['display_image'] = $display_image;
			if($row['sent_received'] == 'Outgoing'){
				$userBean = "SELECT CONCAT_WS('', first_name, last_name) as name FROM users WHERE deleted = 0 AND id = '{$row['assigned_user_id']}'";
				$result = $GLOBALS['db']->query($userBean, true);
				$row = $GLOBALS['db']->fetchByAssoc($result);
				/* $userBean = BeanFactory::getBean('Users', $row['assigned_user_id']); */
				$heading = $row['name'] .' | ';
			}else{
				$heading = $bean->name .' | ';
			}
			$heading .=  $row['date_entered'].' | '.$GLOBALS['app_list_strings']['delivery_status_dom'][$row['message_status']];
			$row['heading'] = $heading;
			$data[] = $row;
		}
		/* print"<pre>123";print_r($data); */
		$sms_data = array(
			'data' => $data,
			'record_ids'=>$record_ids,
			'total_count'=>$total_count,
		);
		echo json_encode($sms_data);die;
	}
}

if (isset($_REQUEST['action']) && trim($_REQUEST['action'] === "send_sms")) {

    global $sugar_config;
	/* echo $_REQUEST['file_data'];echo'<br>';
	$file_data = file_get_contents($_REQUEST['file_data']);
	print"<pre>";print_r($_FILES);*/
	/* print"<pre>";print_r($_REQUEST);die;  */
    $mobile_numbers = $_REQUEST['mobile_numbers'];
    $template_name = trim($_REQUEST['template_name']);
    $message = $_REQUEST['body'];
    $sl_mod = trim($_REQUEST['sl_mod']);
    $sl_mod_id = trim($_REQUEST['sl_mod_id']);
    echo $sms->sendMessage($mobile_numbers, $message, $sl_mod, $sl_mod_id, '', $_REQUEST['file_name']);
    // print_r(explode(",",$mobile_numbers));
}

if (isset($_REQUEST['action']) && trim($_REQUEST['action'] === "upload")) {

	if(count($_FILES["file"]["name"]) > 0)
	{
		$file_data = file_get_contents($_FILES["file"]["tmp_name"][0]);
		/* echo $file_data; */
		/* print"<pre>";print_r($_FILES["file"]); */
		$file_name = $_FILES["file"]["name"][0];
		$tmp_name = $_FILES["file"]['tmp_name'][0];
		/* echo $tmp_name;echo '<br>'; */
		$file_array = explode(".", $file_name);
		$file_extension = end($file_array);
		$location = getcwd().'/modules/SMS_Configuration/MMS_uploads/' . $file_name;
		/* echo 'name:'.$tmp_name;die;
		 echo $location;echo '<br>'; echo $tmp_name;
		die; */
		//move_uploaded_file($tmp_name, $location);
		if(move_uploaded_file($tmp_name, $location)){
			echo 'done';die;
		}else{
			echo 'not done';die;
		}
	 
	}
}

if (isset($_REQUEST['action']) && trim($_REQUEST['action'] === "remove_upload")) {

	if(isset($_REQUEST["file_name"]) && !empty($_REQUEST["file_name"]))
	{
		$location = getcwd().'/modules/SMS_Configuration/MMS_uploads/'.$_REQUEST["file_name"];
		unlink($location);
	}
}