<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
require_once 'custom/include/twillio/vendor/autoload.php';
use Twilio\Rest\Client;
class sms_utils {

    function sendbytwilio($mobile_numbers, $template_name, $sms_body, $sl_mod, $sl_mod_id) {
		global $sugar_config;
		// Your Account SID and Auth Token from twilio.com/console
		$account_sid = $sugar_config['twillio']['account_id'];
		$auth_token = $sugar_config['twillio']['auth_token'];
		// In production, these should be environment variables. E.g.:
		// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

		// A Twilio number you own with SMS capabilities
		$twilio_number = $sugar_config['twillio']['from_number'];
		$mobile_numbers_array = explode(",", $mobile_numbers);
		$client = new Client($account_sid, $auth_token);
        for ($ce = 0; $ce < count($mobile_numbers_array); $ce++) {

            $sms_body = htmlspecialchars_decode($sms_body, ENT_QUOTES);
            // $post = array(
                // "From" => trim($row_tw['tw_from_number']),
                // "To" => "+" . trim($mobile_numbers_array[$ce]),
                // "Body" => $sms_body
            // );
			try{
				$message = $client->messages->create(
				/* Where to send a text message (your cell phone?) */
				"+1" . trim($mobile_numbers_array[$ce]),
				array(
					'from' => $twilio_number,
					'body' => $sms_body
				)
			);
			} catch (Exception $e) {
				echo json_encode(array('message' => $e->getMessage(),'success' => false));
				die;
			}
			// print"<pre>123";print_r($message->id);die;
            // $result_sms = json_decode($result, true);
            //$GLOBALS['log']->fatal(print_r($result_sms,true));
            if (!empty($message->__get('sid'))) {
                $call_status = "Sent";
				$this->create_sms($template_name, $sms_body, $call_status, $sl_mod, $sl_mod_id, $mobile_numbers_array[$ce], $twilio_number);
				echo json_encode(array('success' => true));
            }
            //Create the sms
            // return $this->create_sms($template_name, $sms_body, $call_status, $sl_mod, $sl_mod_id, $mobile_numbers_array[$ce], $twilio_number);
        }
    }

    

    function create_sms($template_name, $message, $call_status, $sl_mod, $sl_mod_id, $mobile_number = false, $twilio_number = '') {
        global $timedate;
        global $current_user;
        $create_bean = BeanFactory::newBean("ht_sms");
        if (!empty($mobile_number) ) {
            $create_bean->name = "SMS Sent To " . $mobile_number;
        } else {
            $create_bean->name = "SMS Sent";
		}
        $create_bean->description = $message;
        $create_bean->status = $call_status;
        $create_bean->sent_received = "sent";

        $create_bean->set_created_by = false;
        $create_bean->update_date_entered = false;
        $create_bean->update_date_modified = false;
        $create_bean->update_modified_by = false;

        $create_bean->assigned_user_id = $current_user->id;
        $create_bean->modified_user_id = $current_user->id;
        $create_bean->created_by = $current_user->id;
        $create_bean->parent_type = $sl_mod;
        $create_bean->to_number = $mobile_number;
		$create_bean->from_number = $twilio_number;
		$create_bean->parent_id = $sl_mod_id;
		if ($sl_mod == "Contacts") {
            $create_bean->contact_id = $sl_mod_id;
        }
        $create_id = $create_bean->save();
        $RelCall = BeanFactory::getBean('ht_sms', $create_id);
        //Creating Relationships
        // if ($sl_mod == "Contacts") {
            // $RelCall->load_relationship('contact_ht_sms');
            // $RelCall->contact_ht_sms->add($sl_mod_id);
        // }
        // if ($sl_mod == "Leads") {
            // $RelCall->load_relationship('leads');
            // $RelCall->leads->add($sl_mod_id);
        // }
        return $create_id;
    }
    
}
