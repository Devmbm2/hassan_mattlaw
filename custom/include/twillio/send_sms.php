<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
require_once 'custom/include/twillio/vendor/autoload.php';
use Twilio\Rest\Client;
global $sugar_config;
// Your Account SID and Auth Token from twilio.com/console
$account_sid = $sugar_config['twillio']['account_id'];
$auth_token = $sugar_config['twillio']['auth_token'];
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

// A Twilio number you own with SMS capabilities
$twilio_number = $sugar_config['twillio']['from_number'];
$to_number = $_REQUEST['to_number'];
$to_number = '+1'.$to_number;

$sms_body = $_REQUEST['sms_text'];
$message ='';
$client = new Client($account_sid, $auth_token);
$message = $client->messages->create(
    /* Where to send a text message (your cell phone?) */
    $to_number,
    array(
        'from' => $twilio_number,
        'body' => $sms_body
    )
); 


if($message->sid != ''){
	$ht_sms = new ht_sms();
	$ht_sms->name = $_REQUEST['sms_text'];
	$ht_sms->description = $_REQUEST['sms_text'];
	$ht_sms->to_number = $_REQUEST['to_number'];
	$ht_sms->from_number = $twilio_number;
	$ht_sms->sent_received = 'sent';
	$ht_sms->contact_id = $_REQUEST['record_id'];
	$ht_sms->save();
}
if($message->sid == ''){
	echo 'false';die;
}else{
	echo 'true';die;
}
