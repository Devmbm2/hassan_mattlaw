<?php
$entry_point_registry['send_sms'] = array(
	'file' => 'custom/include/twillio/send_sms.php',
	'auth' => true
);

$entry_point_registry['ht_outgoing_sms_response'] = array(
	'file' => 'modules/ht_sms/ht_outgoing_sms_response.php',
	'auth' => false
);