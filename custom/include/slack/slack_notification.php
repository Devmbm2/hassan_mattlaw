<?php
   if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
   class slack_notification_class {
      function slack_notification_method($bean, $event, $arguments) {
		  
		  if($_REQUEST['send_slack_notification'] == 'send'){
				require_once('custom/include/slack/slackHelper.php');
			  
				if(!empty($_REQUEST['user_id'])&& !empty($bean->id) && $_REQUEST['module'] == $bean->module_dir){
					global $sugar_config;
					/* print"<pre>req";print_r($_REQUEST);
					echo 'bean_id: '.$bean->id;
					print"<pre>";print_r($bean);
					die; */
					$current_user = BeanFactory::getBean('Users', $_SESSION['authenticated_user_id']);
					/* print"<pre>";print_r($current_user);die; */
					$Slack = new Slack($current_user->slack_token);
					$message = '';
					$message .= $_REQUEST['sms_text'];
					$message .= PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL ;
					$message .= $sugar_config['site_url'].'/index.php?module='.$_REQUEST['module'].'&action=DetailView&record='.$bean->id;
					/* echo $_REQUEST['sms_text'];die; */
					$user_ids = explode(',', $_REQUEST['user_id']);
					/*  */
					$response = array();
					foreach($user_ids as $user_id){
						/* echo $user_id;die; */
						$response[] = $Slack->call('chat.postMessage', array(
							'channel' => $user_id,
							'text'=> $message,
							'as_user' => 'true',
						 ));
					}
					/* print"<pre>";print_r($response);die; */
				}
		  			  
		  }
      }
   }
    