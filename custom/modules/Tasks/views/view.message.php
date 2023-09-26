<?php
require_once('include/MVC/View/SugarView.php');
require_once('include/TemplateHandler/TemplateHandler.php');
require_once('custom/include/slack/slackHelper.php');
class TasksViewMESSAGE extends SugarView{
	public function __construct() {
		parent::SugarView();
	}
 	function display() {
		$record_id = $_REQUEST['record_id'];
		echo $this->getStreamHtml($record_id);
	}
	function getStreamHtml($record_id){
		global $sugar_config, $current_user;
		$Slack = new Slack($current_user->slack_token);
		$channels = $Slack->call('channels.list');
		$users = $Slack->call('users.list');
				$stream_html .='<script type="text/javascript" src="custom/modules/Tasks/slack_popup.js"></script>';
				$stream_html .= '<div id="" style="padding: 26px 14px 45px 13px";>';
				$stream_html .='<div>';
				$stream_html .= '<label for="validator" >Slack User/Channel</label><br>';
				$stream_html .='<select name="validator" id="validator" ><option value="" style="font-weight:bold;">-----Users-----</option>';
		foreach($users['members'] as $user){
				$stream_html .='<option value=@'.$user["name"].'>'.$user["name"].'</option>';
			}
			$stream_html .='<option value="" style="font-weight:bold;">-----Channels-----</option>';
		foreach($channels['channels'] as $channel){
				$stream_html .='<option value='.$channel["id"].'>'.$channel["name"].'</option>';
			}
			$stream_html .='</select><br>';
			$stream_html .='</div>';
			$stream_html .='</br>';
			$stream_html .='<div>';
			$stream_html .='<label for="sms_text" >Message</label>';
			$stream_html .='<textarea id="user_notes" name="sms_text" rows="5" cols="105" title="" tabindex="0" style="resize: none; width: 100%;" placeholder="">';
			$stream_html .='</textarea><br>';
			$stream_html .='<input type="button" value="Send Message" onclick="SendMessageToValidator(\''.$record_id.'\');" style="float:right;">';
			$stream_html .='</br>';
			$stream_html .= '<span id="send_sms_response" style="color:red;"></span>';
			$stream_html .='</div>';
			$stream_html .= '</div>';
		return $stream_html;
	}
}