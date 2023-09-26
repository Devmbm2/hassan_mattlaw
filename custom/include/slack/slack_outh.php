<?php
/* print"<pre>123";print_r($_REQUEST);die;  */
if(isset($_REQUEST['code']) && !empty($_REQUEST['code'])){
	global $db, $sugar_config;
	$current_user_id=$_SESSION['authenticated_user_id'];
	$slack_config = $GLOBALS['sugar_config']['slack'];
	$url = "https://slack.com/api/oauth.access?client_id={$slack_config['client_id']}&client_secret={$slack_config['client_secret']}&code={$_REQUEST['code']}";
	/* $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true ); */
	// This is what solved the issue (Accepting gzip encoding)
	/* curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");      */
	/* $slack_response = curl_exec($ch); */
	$slack_response = file_get_contents($url);
	/* curl_close($ch); */
	$slack_response = json_decode($slack_response,true);
	/* print"<pre>";print_r($slack_response);die; */
	/* $GLOBALS['log']->fatal('slack_response');
	$GLOBALS['log']->fatal($slack_response); */
	$result = $db->query($sql = "UPDATE users
					SET slack_token='{$slack_response['access_token']}'
					WHERE users.id='{$current_user_id}'
					");
	$message = "Your Slack has been configured successfully. Now you can send slack messages from any module/record's detail view using Send Slack Notification button.";
	SugarApplication::appendErrorMessage($message);
	SugarApplication::redirect("index.php?module=Users&record={$current_user_id}&action=EditView");
}