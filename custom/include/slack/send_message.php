<?php
require_once('custom/include/slack/slackHelper.php');
if(!empty($_REQUEST['user_id'])&& !empty($_REQUEST['record_id'])&& !empty($_REQUEST['module']) ){
	global $sugar_config;
	$current_user = BeanFactory::getBean('Users', $_SESSION['authenticated_user_id']);
	$Slack = new Slack($current_user->slack_token);
	$message .= $_REQUEST['sms_text'];
	$message .= PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL ;
	$message .= $sugar_config['site_url'].'/index.php?module='.$_REQUEST['module'].'&action=DetailView&record='.$_REQUEST['record_id'];
	$user_ids = explode(',', $_REQUEST['user_id']);
	$users = $Slack->call('users.list');
	foreach($users['members'] as $user){
		if(!$user['deleted'])
		$all_users_chanels[$user["name"]] = $user["name"];
	}
	$channels = $Slack->call('channels.list');
	foreach($channels['channels'] as $channel){
		if(!$channel['is_archived'])
		$all_users_chanels[$channel["id"]] = $channel["name"];
	}
	/* print"<pre>";print_r($all_users_chanels); */
	/* print"<pre>";print_r($_REQUEST['user_id']);die; */
	$response =  array();
	foreach($user_ids as $user_id){
		$response[$user_id] = $Slack->call('chat.postMessage', array(
			'channel' => $user_id,
			'text'=> $message,
			'as_user' => 'true',
		 ));
		
	}
	$all_sent = true;
	foreach($response as $user_id => $status){
		if(!$status['ok']){
			$all_sent = false;
			$response_show[$all_users_chanels[$user_id]] = $status['error'];
		}
	}
	if(!$all_sent){
	   /* print"<pre>";print_r($response_show);die; */
		echo json_encode($response_show);die;
	}else{
		echo 'sent';die;
	}
	
	
}