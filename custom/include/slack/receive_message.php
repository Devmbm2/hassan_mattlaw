<?php

global $timedate, $sugar_config, $current_user;
$message = json_decode(html_entity_decode($_REQUEST['payload']), TRUE);

	$task = new Task();
	$task->assigned_user_id = $current_user->id;
	/* $task->name = $message['type']; */
	$task->name = 'Message Action From Slack';
	$task->date_start = $timedate->getInstance()->nowDb(); 
	$task->description = $message['message']['text'];
	$task->save();

	
