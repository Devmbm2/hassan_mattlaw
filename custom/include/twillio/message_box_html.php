<?php

require_once('include/TemplateHandler/TemplateHandler.php');
$record_id = $_REQUEST['record_id'];
$module = $_REQUEST['module'];
echo getStreamHtml($record_id, $module);
function getStreamHtml($record_id,$module){
	global $sugar_config;
	$current_user = BeanFactory::getBean('Users', $_SESSION['authenticated_user_id']);
	$contacts = BeanFactory::getBean($module, $record_id);
	$stream_html .='<script type="text/javascript" src="custom/include/twillio/slack_popup.js"></script>';
	$stream_html .= '<div id="" style="padding: 26px 14px 45px 13px";>';
	$stream_html .='<div>';
	$stream_html .= '<label for="validator" >To</label><br>';
	$stream_html .='<input style="width: 100%;" name="validator" id="validator" value="'.$contacts->phone_mobile .'" readonly>';
	$configure_slack = '';
	if(empty($contacts->phone_mobile)){
		$configure_slack = "<br>";
		$configure_slack .= "<span style='color:red'>Please Select the To number to send the message.</span>";
		$configure_slack .= "<br>";
	}
	$stream_html .='</div>';
	if(!empty($configure_slack)){
		$stream_html .=$configure_slack;
	}
	$stream_html .='</br>';
	$stream_html .='<div>';
	$stream_html .='<label for="sms_text" >Message</label>';
	$stream_html .='<textarea id="user_notes" name="sms_text" rows="5" cols="105" title="" tabindex="0" style="resize: none; width: 100%;" placeholder="">';
	$stream_html .='</textarea><br>';
	$stream_html .='<input type="button" id = "send_message" value="Send Message" onclick="SendMessageToValidator(\''.$record_id.'\' , \''.$module.'\');" style="float:right;">';
	$stream_html .='</br>';
	$stream_html .= '<span id="send_sms_response" style="color:red;"></span>';
	$stream_html .='</div>';
	$stream_html .= '</div>';
	$stream_html .= '
		<style>
		.select2-container {
			 z-index: 999999;
		}
		</style>
		';

	return $stream_html;
}