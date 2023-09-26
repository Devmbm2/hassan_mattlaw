<?php
$entry_point_registry['slack_outh'] = array(
	'file' => 'custom/include/slack/slack_outh.php', 
	'auth' => false
);

$entry_point_registry['MessageBox'] = array(
	'file' => 'custom/include/slack/message_box_html.php',
	'auth' => false
);

$entry_point_registry['SendMessage'] = array(
	'file' => 'custom/include/slack/send_message.php',
	'auth' => false
);
// Entry point receiving messages for creating tasks 
$entry_point_registry['ReceiveMessages'] = array(
	'file' => 'custom/include/slack/receive_message.php',
	'auth' => false
);