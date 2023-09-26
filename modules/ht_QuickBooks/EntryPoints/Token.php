<?php

if (!defined('sugarEntry') || !sugarEntry)
{
    die('Not A Valid Entry Point');
}

require_once('modules/DT_QuickBooks/EntryPoints/Token_utils.php');
require_once("modules/Administration/Administration.php");

$quickbooks_admin = new Administration();

$GLOBALS['log']->fatal("----------------- QB Webhooks  --------------------");

$settings_quickbooks = $quickbooks_admin->retrieveSettings('quickbooks_config');
$webhooksToken = $settings_quickbooks->settings['quickbooks_config_webhook_token'];
$disable_quickbooks = $settings_quickbooks->settings['quickbooks_config_disable_quickbooks'];

if($disable_quickbooks == "on")
{
	$GLOBALS['log']->fatal("----------------- QuickBooks is Disabled  --------------------");
	exit();
}

$quickbooks_utils = new quickbooks_utils();

if (isset($_SERVER['HTTP_INTUIT_SIGNATURE'])){
	$output .='Body of the request was :'.PHP_EOL;
	$requestBody = json_decode(file_get_contents("php://input"));	
	$payloadHash = hash_hmac('sha256',file_get_contents("php://input"),$webhooksToken);
	$singatureHash = bin2hex(base64_decode($_SERVER['HTTP_INTUIT_SIGNATURE']));
	if($payloadHash == $singatureHash){		
		foreach ($requestBody->eventNotifications[0]->dataChangeEvent->entities as $eventdata) {
			$name = $eventdata->name;
			$id = $eventdata->id;
			$operation = $eventdata->operation;			
			$GLOBALS['log']->fatal("name=".$name." id=".$id." operation=".$operation);
			$result = $quickbooks_utils->qb_response($name,$id,$operation);
		}		
		$output .= PHP_EOL.'Request is verified'.PHP_EOL;
	}else{
		$output .=PHP_EOL."Unable to verify request, using a token of '".$webhooksToken."' the payload hash was ".$payloadHash.' while the intuit signature was '.$singatureHash.PHP_EOL;

		$output.=print_r(file_get_contents("php://input"),TRUE);
	}
	$output .= 'Executing a Change Data Capture';

	$GLOBALS['log']->fatal("Output=".print_r($output, true));	
}
/*else if (isset($_REQUEST['action']) && trim($_REQUEST['action'] === "sync_to_qb")) {
		$record_id = $_REQUEST['record_id'];
		$quickbooks_id = $_REQUEST['quickbooks_id'];
		$GLOBALS['log']->fatal("else condition record_id=".$record_id." quickbooks_id=".$quickbooks_id);
		$result = $quickbooks_utils->update_contact_to_quickbooks($record_id,$quickbooks_id);		
}*/
else if(isset($_REQUEST['action']) && trim($_REQUEST['action'] === "create_to_qb")) {			
		$record_id = $_REQUEST['record_id'];	
		$GLOBALS['log']->fatal("created contact record_id=".$record_id);
		$result = $quickbooks_utils->create_contact_in_quickbooks($record_id);
		if(!$result)
		{
			$GLOBALS['log']->fatal("false from create_contact_in_quickbooks");
			echo "false";
		}
		echo "true";
}
else
{	
	$GLOBALS['log']->fatal("else condition of quickbook entry point");
	/*echo "<pre>";
	$name="Invoice";
	$id="103";
	$operation="Update";
	$result = $quickbooks_utils->qb_response($name,$id,$operation);
	print_r($result);
	die("Called");*/
	die();
}