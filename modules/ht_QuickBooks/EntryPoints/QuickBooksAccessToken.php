<?php

if (!defined('sugarEntry') || !sugarEntry)
{
    die('Not A Valid Entry Point');
}

require("modules/ht_QuickBooks/OAuth_2/Client.php");
require_once("modules/Administration/Administration.php");
$configs = include('modules/ht_QuickBooks/OAuth_2/config.php');
$validate = "1";

$session_id = session_id();
if (empty($session_id))
{
    session_start();
}
$authorizationRequestUrl = $configs['authorizationRequestUrl'];
$tokenEndPointUrl = $configs['tokenEndPointUrl'];
$client_id = $configs['client_id'];
$client_secret = $configs['client_secret'];
$scope = $configs['oauth_scope'];
$redirect_uri = $configs['oauth_redirect_uri'];


$response_type = 'code';
$state = 'RandomState';
$include_granted_scope = 'false';
$grant_type= 'authorization_code';
$certFilePath = 'modules/ht_QuickBooks/OAuth_2/Certificate/cacert.pem';


$client = new Client($client_id, $client_secret, $certFilePath);


if (!isset($_GET["code"]))
{    
    unset($_SESSION['access_token']);
    unset($_SESSION['refresh_token']);
    $authUrl = $client->getAuthorizationURL($authorizationRequestUrl, $scope, $redirect_uri, $response_type, $state);
    header("Location: ".$authUrl);
    exit();
}
else
{
    $code = $_GET["code"];
    $responseState = $_GET['state'];
    if(strcmp($state, $responseState) != 0){
      throw new Exception("The state is not correct from Intuit Server. Consider your app is hacked.");
    }
	try{
		$result = $client->getAccessToken($tokenEndPointUrl,  $code, $redirect_uri, $grant_type);
	} catch(Exception $e) {
	  echo 'Message: ' .$e->getMessage();die;
	}
    
	$_SESSION['access_token'] = $result['access_token'];
    $_SESSION['refresh_token'] = $result['refresh_token'];

    $date = new DateTime();
	$current_timestamp = $date->getTimestamp();	
	
	$access_token_expires_in = $current_timestamp + $result['expires_in'];
	$refresh_token_expires_in = $current_timestamp + $result['x_refresh_token_expires_in'];

	$quickbooks_admin = new Administration();

	$quickbooks_admin->saveSetting('quickbooks_config', 'access_token', $result['access_token']);
    $quickbooks_admin->saveSetting('quickbooks_config', 'refresh_token', $result['refresh_token']);
    $quickbooks_admin->saveSetting('quickbooks_config', 'access_token_expire_time', $access_token_expires_in);
    $quickbooks_admin->saveSetting('quickbooks_config', 'refresh_token_expire_time', $refresh_token_expires_in);
    
    // JS to close popup and refresh parent page
    echo '<script type="text/javascript">
                window.opener.location.href = window.opener.location.href;
                window.close();
              </script>';

}

?>
