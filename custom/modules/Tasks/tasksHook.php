<?php
class tasksHook{
	function send_slack_notification($bean, $event, $arguments){
		global $timedate, $sugar_config;
		require_once('custom/include/slack/slackHelper.php');
		$current_user = BeanFactory::getBean('Users', '4391e830-e6dd-46d1-3c9c-5a68ad3343a5');
		$Slack = new Slack($current_user->slack_token);
		$slack_message_data = json_decode(html_entity_decode($_REQUEST['payload']), TRUE);
		$message  .= 'The Following Task has been created in the system. Please follow the link to fill the other information:';
		$message .= PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL ;
		$message  .= $slack_message_data['message']['text'];
		$message .= PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL ;
		$message .= $sugar_config['site_url'].'/index.php?module=Tasks&action=DetailView&record='.$bean->id;
		$user_id = $slack_message_data['user']['name'];
		$response = $Slack->call('chat.postMessage', array(
			'channel' => '@'.$user_id,
			'text'=> $message,
			'as_user' => 'true',
		 ));
	}
}