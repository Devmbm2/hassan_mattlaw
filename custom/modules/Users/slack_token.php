<?php

	global $current_user;
	// if(!empty($current_user->slack_token)){
		// $message = "Your Slack token has already been set.";
		// SugarApplication::appendErrorMessage($message);
		// SugarApplication::redirect("index.php?module=Users&action={$_REQUEST['return_action']}&record={$current_user->id}");	
	// }
	// else{
		$slack_config = $GLOBALS['sugar_config']['slack'];
		$newURL = $slack_config['slack_url'].'/oauth/authorize?scope=client&client_id='.$slack_config['client_id'];
		header('Location: '.$newURL);
	// }