<?php
require_once('include/TemplateHandler/TemplateHandler.php');
require_once('custom/include/slack/slackHelper.php');
require_once('custom/include/custom_utils.php');
$record_id = $_REQUEST['record_id'];
$module = $_REQUEST['module'];

echo getStreamHtml($record_id, $module);
function getStreamHtml($record_id,$module){
	global $sugar_config, $db;
	$current_user = BeanFactory::getBean('Users', $_SESSION['authenticated_user_id']);
	$Slack = new Slack($current_user->slack_token);
	$channels = $Slack->call('channels.list');
	$users = $Slack->call('users.list');
	/* print"<pre>";print_r($users);die; */
		$sql = "SELECT users.id, CONCAT_WS(' ',users.first_name, users.last_name) as name 
				FROM users WHERE users.status = 'Active' AND users.employee_status = 'Active'";

		$result = $db->query($sql,true);
		$all_users_with_email = array();
		while($row = $db->fetchByAssoc($result)){
			$u = BeanFactory::getBean('Users', $row['id']);
			$parts=explode('@',$u->email1);
			if($parts[1] == 'legacore.com'){
				$u->email1 = $parts[0]."@mattlaw.com";
				$all_users_with_email[strtolower($u->email1)][] = $u->name;
			}
			else if($u->email1 == 'Joyce@MattLaw.com'){
				$u->email1 = "jayashree03@gmail.com";
				$all_users_with_email[strtolower($u->email1)][] = $u->name;
			}
			else{
				$all_users_with_email[strtolower($u->email1)][] = $u->name;
			}
			
		}
		/* $all_users= array_flip($all_users_with_email); */
		/* print"<pre>";print_r($all_users_with_email); */
	
	$stream_html .='<script type="text/javascript" src="custom/include/slack/slack_popup.js"></script>';
	$stream_html .= '<div id="" style="padding: 26px 14px 45px 13px";>';
	$stream_html .='<div>';
	$stream_html .= '<label for="validator" >Slack User/Channel</label><br>';
	$stream_html .='<select style="width: 100%;" name="validator" id="validator" multiple ><option value="" style="font-weight:bold;">-----Users-----</option>';
	$configure_slack = '';
	$display_name = '';
	$count = 0;
	if(!empty($users['error']) && $users['error'] == 'not_authed'){
		$configure_slack = "<br>";
		$configure_slack .= "<span style='color:red'>Oops! It seems you didn't configure your slack. Please go to your profile and click on Configure Slack button. Please connect to honey support if you need help.</span>";
		$configure_slack .= "<br>";
	}else{
		// usort($users["members"], function($a, $b) {
        //     return strcmp($a["name"], $b["name"]);
        // });
		foreach($users['members'] as $user){
			/* echo $user["profile"]["email"];echo'<br>'; */
			/* echo $all_users_with_email[$user["profile"]["email"]]; */
			if(!$user['deleted']){
				if(empty($all_users_with_email[strtolower($user["profile"]["email"])])){
					/* continue; */
					$display_name = $user["name"];
					if(!empty($display_name)){
						// $stream_html .='<option value=@'.$user["name"].'>'. $display_name .'</option>';						
					}
				}else{
					$display_name = $all_users_with_email[strtolower($user["profile"]["email"])];
					foreach($all_users_with_email[strtolower($user["profile"]["email"])] as $u_name){
						if(!empty($u_name)){
							$stream_html .='<option value=@'.$user["name"].'>'. $u_name .'</option>';												
						}
					}
				}
				
				$count++;				
			}
		}
		/* echo $count; */
		$stream_html .='<option value="" style="font-weight:bold;">-----Channels-----</option>';
		foreach($channels['channels'] as $channel){
			if(!$channel['is_archived'])
			$stream_html .='<option value='.$channel["id"].'>'.$channel["name"].'</option>';
		}
	}
	$stream_html .='</select><br>';
	$stream_html .='</div>';
	if(!empty($configure_slack)){
		$stream_html .=$configure_slack;
	}
	$stream_html .='</br>';
	$stream_html .='<div>';
	$stream_html .='<label for="sms_text" >Message</label>';
	$stream_html .='<textarea id="user_notes" name="sms_text" rows="5" cols="105" title="" tabindex="0" style="resize: none; width: 100%;" placeholder="">';
	$stream_html .='</textarea><br>';
	$stream_html .='<input type="button" id = "send_message" value="Send Message" onclick="SendMessageToValidator(\''.$record_id.'\' , \''.$module.'\', \''.$_REQUEST['form_name'].'\');" style="float:right;">';
	$stream_html .='</br>';
	$stream_html .= '<span id="send_sms_response" style="color:red;"></span>';
	$stream_html .='</div>';
	$stream_html .= '</div>';
	$stream_html .= '
		<style>
		.select2-container {
			 z-index: 999999;
		}
		.select2-container--default .select2-results > .select2-results__options{
		max-height: 250px !important
	}
		</style>
		';
	$stream_html .= '
		<script>
		$( document ).ready(function() {
			$("#validator").select2();
		});
		</script>
		';
	return $stream_html;
}