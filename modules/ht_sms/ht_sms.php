<?php
class ht_sms extends Basic
{
    public $new_schema = true;
    public $module_dir = 'ht_sms';
    public $object_name = 'ht_sms';
    public $table_name = 'ht_sms';
    public $importable = false;

    public $id;
    public $name;
    public $date_entered;
    public $date_modified;
    public $modified_user_id;
    public $modified_by_name;
    public $created_by;
    public $created_by_name;
    public $description;
    public $deleted;
    public $created_by_link;
    public $modified_user_link;
    public $assigned_user_id;
    public $assigned_user_name;
    public $assigned_user_link;
    public $SecurityGroups;
    public $sent_received;
    public $from_number;
    public $to_number;
	
    public function bean_implements($interface)
    {
        switch($interface)
        {
            case 'ACL':
                return true;
        }

        return false;
    }
	function sendMessage($mobile_numbers, $sms_body, $sl_mod, $sl_mod_id, $from_crm_user = false, $file_name = '', $auto_reply = false) {
		global $sugar_config;
		$phone_status = $this->checkPhoneStatus($mobile_numbers);
		if(!in_array($phone_status, array('OptOut', 'Block_OptOut', 'Active_OptOut'))){
			$mobile_numbers = str_replace("-", "", $mobile_numbers);
			$auth_token = $sugar_config['sms_options']['auth_token'];
			$from_number = $sugar_config['sms_options']['from_number'];
			$sms_body = htmlspecialchars_decode($sms_body, ENT_QUOTES);
			$message_type = '';
			
			if(isset($file_name) && !empty($file_name)){
				$file_location = getcwd().'/modules/SMS_Configuration/MMS_uploads/' . $file_name;
				/* echo $location;die;  */
				$file_data = file_get_contents($file_location);
				$data = array("source" => $from_number,
							 "destination" => $mobile_numbers,
							 "message" => $sms_body,
							 "file_name" => $file_name,
							 "file_data" => base64_encode($file_data)
							);
				$data = http_build_query($data);
				$curl = curl_init();
				curl_setopt_array($curl, array(
				CURLOPT_URL => "https://smsapidocs.stratustele.com/mms/send?token={$auth_token}",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $data,
				));
				$response = curl_exec($curl);
				$object = json_decode($response);
				if($object->status == 'success') {
					$call_status = "Sent";
					$message_type = "SMS";
					$sms_id = $object->data;
					$this->create_sms($sms_body, $call_status, $sl_mod, $sl_mod_id, $mobile_numbers, $from_number, $sms_id, $from_crm_user, $message_type, $file_location, $file_name, $auto_reply);
					echo json_encode(array('success' => true));
				}else{
					echo json_encode(array('success' => false, 'message' => $object->data));
				}
				
			}else{
				$data = array("source" => $from_number,
						  "destination" => $mobile_numbers,
						  "message" => $sms_body);
				$data = http_build_query($data);
				$x = file_get_contents("https://api.teleapi.net/sms/send?token={$auth_token}&{$data}");
				$object = json_decode($x);
				if($object->status == 'success') {
					$call_status = "Sent";
					$message_type = "MMS";
					$sms_id = $object->data;
					$this->create_sms($sms_body, $call_status, $sl_mod, $sl_mod_id, $mobile_numbers, $from_number, $sms_id, $from_crm_user, $message_type, $file_location, $file_name, $auto_reply);
					echo json_encode(array('success' => true));
				}else{
					echo json_encode(array('success' => false, 'message' => $object->data));
				}
			}
		}else{
			echo json_encode(array('success' => false, 'message' => 'You can not Send Messages to this Client. This Client has Opted Out.'));
		}
		
    }
	function create_sms($message, $call_status, $sl_mod, $sl_mod_id, $mobile_number = false, $from_number = '', $sms_id, $from_crm_user = false, $message_type = '', $file_location = '', $file_name = '', $auto_reply = false) {
        global $timedate, $current_user;
		$mobile_number = preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($mobile_number)), 2);
		$from_number = preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($from_number)), 2);
		$From = preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($From)), 2);
		$user_id = '';
		if(empty($current_user->id)){
			$user_id = '1';
		}else{
			$user_id = $current_user->id;
		}
		$file_id = create_guid();
        $created_user = BeanFactory::getBean('Users', $user_id);
        $create_bean = BeanFactory::newBean("ht_sms");
		$create_bean->name = "Outgoing SMS From ".$created_user->name . " (". $from_number . ")";
        $create_bean->description = $message;
        $create_bean->message_status = $call_status;
        $create_bean->sent_received = "Outgoing";
		if($auto_reply){
			$create_bean->auto_reply_sent = 1;
		}
		
        $create_bean->assigned_user_id = $user_id;
        $create_bean->modified_user_id = $user_id;
        $create_bean->created_by = $user_id;
        $create_bean->parent_type = $sl_mod;
        $create_bean->to_number = $mobile_number;
		$create_bean->from_number = $from_number;
		$create_bean->parent_id = $sl_mod_id;
		$create_bean->sms_id = $sms_id;
		$create_bean->id = $file_id;
		$create_bean->new_with_id = true;
		require_once('include/upload_file.php');
		if(!empty($file_name) && !empty($file_location)){
			$uploadfile = 'upload://'.$file_id;
			$file_data = file_get_contents($file_location);
			file_put_contents($uploadfile, $file_data);
			$create_bean->filename = $file_name;	
			unlink($file_location);
		}
		
        $create_id = $create_bean->save();
        return $create_id;
    }
	function checkPhoneStatus($phone_number){
		$select = "SELECT * FROM ht_phone_list WHERE deleted = 0 AND name LIKE '%{$phone_number}%' LIMIT 1";
		$result = $GLOBALS['db']->query($select, true);
		$row = $GLOBALS['db']->fetchByAssoc($result);
		return $row['status'];
	}
	function checkCreateUpdate($phone_number, $phone_status){
		$select = "SELECT * FROM ht_phone_list WHERE deleted = 0 AND name LIKE '%{$phone_number}%' LIMIT 1";
		$result = $GLOBALS['db']->query($select, true);
		$row = $GLOBALS['db']->fetchByAssoc($result);
		if($result->num_rows > 0){
			if(strpos($row['status'], 'OptOut') !== false && $phone_status == 'Block'){
				$phone_status = 'Block_OptOut';
			}/* else if(strpos($row['status'], 'OptOut') !== false && $phone_status == 'Active'){
				$phone_status = 'Active';
			} */
			//echo "UPDATE ht_phone_list SET status = '{$phone_status}' WHERE name LIKE '%{$phone_number}%'";die;
			$GLOBALS['db']->query("UPDATE ht_phone_list SET status = '{$phone_status}' WHERE name LIKE '%{$phone_number}%'");			
		}else{
			$ht_phone_list = new ht_phone_list();
			$ht_phone_list->name = $phone_number;
			$ht_phone_list->status = $phone_status;
			$ht_phone_list->save();
		}
	}
}