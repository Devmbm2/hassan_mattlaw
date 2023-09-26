<?php
if(isset($_REQUEST) && !empty($_REQUEST) && $_REQUEST['entryPoint'] == 'ht_outgoing_sms_response'){
	if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
		$update = "UPDATE ht_sms SET message_status = '{$_REQUEST['send_status']}', message_error_code = '{$_REQUEST['error']}' WHERE sms_id = '{$_REQUEST['id']}'";
		$GLOBALS['db']->query($update, true);		
	}
}