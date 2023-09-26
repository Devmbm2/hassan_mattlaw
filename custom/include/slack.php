<?php
class Slack{
	private $message;
	function __construct($message){
		$this->message = $message;
	}
	public function send_notification(){
		global $sugar_config;
		define('SLACK_WEBHOOK', $sugar_config['slake_web_hook']);
		$message = array('payload' => json_encode(array('text' => $this->message)));
		$c = curl_init(SLACK_WEBHOOK);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($c, CURLOPT_POST, true);
		curl_setopt($c, CURLOPT_POSTFIELDS, $message);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_exec($c);
		curl_close($c);
	}
}