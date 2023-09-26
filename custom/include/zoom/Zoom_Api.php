<?php  
//Include Firebase Library and Dependencies
require_once 'php-jwt-master/src/BeforeValidException.php';
require_once 'php-jwt-master/src/ExpiredException.php';
require_once 'php-jwt-master/src/SignatureInvalidException.php';
require_once 'php-jwt-master/src/JWT.php';

use \Firebase\JWT\JWT;


class Zoom_Api
{
	private $zoom_api_key = '';
	private $zoom_api_secret = '';	
	private $user_email = '';	
	function __construct($credentials) {
		$this->zoom_api_key = $credentials['application_key'];
		$this->zoom_api_secret = $credentials['application_secret'];
		$this->user_email = $credentials['email'];
	}	
	
	//function to generate JWT
	private function generateJWTKey() {
		$key = $this->zoom_api_key;
		$secret = $this->zoom_api_secret;
		$token = array(
			"iss" => $key,
			"exp" => time() + 3600 //60 seconds as suggested
		);
		return JWT::encode( $token, $secret );
	}	
	
	//function to create meeting
    public function createMeeting($data = array())
    {
		$post_time  = $data['start_date'];
		$start_time = gmdate("Y-m-d\TH:i:s", strtotime($post_time));

		$createMeetingArray = array();
		if (!empty($data['alternative_host_ids'])) {
		    if (count($data['alternative_host_ids']) > 1) {
			$alternative_host_ids = implode(",", $data['alternative_host_ids']);
		    } else {
			$alternative_host_ids = $data['alternative_host_ids'][0];
		    }
		}


		$createMeetingArray['topic']      = $data['topic'];
		$createMeetingArray['agenda']     = !empty($data['agenda']) ? $data['agenda'] : "";
		$createMeetingArray['type']       = !empty($data['type']) ? $data['type'] : 2; //Scheduled
		$createMeetingArray['start_time'] = $start_time;
		$createMeetingArray['timezone']   = 'Asia/Tashkent';
		$createMeetingArray['password']   = !empty($data['password']) ? $data['password'] : "";
		$createMeetingArray['duration']   = !empty($data['duration']) ? $data['duration'] : 60;

		$createMeetingArray['settings']   = array(
            		'join_before_host'  => !empty($data['join_before_host']) ? true : false,
            		'host_video'        => !empty($data['option_host_video']) ? true : false,
            		'participant_video' => !empty($data['option_participants_video']) ? true : false,
            		'mute_upon_entry'   => !empty($data['option_mute_participants']) ? true : false,
            		'enforce_login'     => !empty($data['option_enforce_login']) ? true : false,
            		'auto_recording'    => !empty($data['option_auto_recording']) ? $data['option_auto_recording'] : "none",
            		'alternative_hosts' => isset($alternative_host_ids) ? $alternative_host_ids : ""
        	);

		return $this->sendRequest($createMeetingArray);
	}	
	
	//function to send request
    protected function sendRequest($data)
    {
		//Enter_Your_Email
		$request_url = "https://api.zoom.us/v2/users/{$this->user_email}/meetings";
		$headers = array(
			"authorization: Bearer ".$this->generateJWTKey(),
			"content-type: application/json",
			"Accept: application/json",
		);
		$postFields = json_encode($data);
		$ch = curl_init();
		curl_setopt_array($ch, array(
		CURLOPT_URL => $request_url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $postFields,
		CURLOPT_HTTPHEADER => $headers,
		));

		$response = curl_exec($ch);
		$err = curl_error($ch);
		curl_close($ch);
		if (!$response) {
			return $err;
		}
		return json_decode($response);
	}
	public function getAllUsers()
    {
		//Enter_Your_Email
		$request_url = "https://api.zoom.us/v2/users";
		$headers = array(
			"authorization: Bearer ".$this->generateJWTKey(),
			"content-type: application/json",
			"Accept: application/json",
		);
		$ch = curl_init();
		curl_setopt_array($ch, array(
		CURLOPT_URL => $request_url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => $headers,
		));
		$response = curl_exec($ch);
		$err = curl_error($ch);
		curl_close($ch);
		if (!$response) {
			return $err;
		}
		$response = json_decode($response);
		/* print"<pre>";print_r($response->users); */
		$type = array(
			1 => 'Basic',
			2 => 'Licensed',
			3 => 'On-prem',
		);
		$users = array();
		foreach($response->users as $no => $users_data){
			$users[$no]['first_name'] = $users_data->first_name;
			$users[$no]['last_name'] = $users_data->last_name;
			$users[$no]['email'] = $users_data->email;
			$users[$no]['status'] = $users_data->status;
			$users[$no]['type'] = $type[$users_data->type];
		}
        return $users;
	}
	public function createUser($data)
    {
		//Enter_Your_Email
		$request_url = "https://api.zoom.us/v2/users";
		$headers = array(
			"authorization: Bearer ".$this->generateJWTKey(),
			"content-type: application/json",
			"Accept: application/json",
		);
		$postFields = json_encode($data);
		$ch = curl_init();
		curl_setopt_array($ch, array(
		CURLOPT_URL => $request_url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $postFields,
		CURLOPT_HTTPHEADER => $headers,
		));

		$response = curl_exec($ch);
		$err = curl_error($ch);
		curl_close($ch);
		if (!$response) {
			return $err;
		}
		return json_decode($response);
	}
}

