<?php
require_once("custom/include/QuickBooks/vendor/autoload.php");

use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
require_once("modules/Administration/Administration.php");
require_once("modules/ht_QuickBooks/OAuth_2/Client.php");
class QBAPIClient {

	private $config;
	private $qb_api_ds;
	
	function check_access()
	{			
		$quickbooks_admin = new Administration();
		$settings_quickbooks = $quickbooks_admin->retrieveSettings('quickbooks_config');
		$access_token_expire_time = $settings_quickbooks->settings['quickbooks_config_access_token_expire_time'];				

		$date = new DateTime();
		$current_timestamp = $date->getTimestamp();

		if($current_timestamp > $access_token_expire_time)
		{
			$refresh_token_expire_time = $settings_quickbooks->settings['quickbooks_config_refresh_token_expire_time'];
			if($current_timestamp > $refresh_token_expire_time)
			{
				$GLOBALS['log']->fatal("QB ERROR : Refresh Token Time is Expired");				
				$quickbooks_admin->saveSetting('quickbooks_config', 'access_token', '');
				$quickbooks_admin->saveSetting('quickbooks_config', 'refresh_token', '');
				$quickbooks_admin->saveSetting('quickbooks_config', 'access_token_expire_time', '');
				$quickbooks_admin->saveSetting('quickbooks_config', 'refresh_token_expire_time', '');
				return false;
			}			
			$session_id = session_id();
			if (empty($session_id))
			{
			    session_start();
			}
			
			$refresh_token = $settings_quickbooks->settings['quickbooks_config_refresh_token'];
			$configs = include('modules/ht_QuickBooks/OAuth_2/config.php');
			$tokenEndPointUrl = $configs['tokenEndPointUrl'];
			$mainPage = $configs['mainPage'];
			$grant_type= 'refresh_token';
			$client_id = $settings_quickbooks->settings['quickbooks_config_client_id'];
			$client_secret = $settings_quickbooks->settings['quickbooks_config_client_secret'];
			$certFilePath = 'modules/ht_QuickBooks/OAuth_2/Certificate/cacert.pem';

			$client = new Client($client_id, $client_secret, $certFilePath);
			$result = $client->refreshAccessToken($tokenEndPointUrl, $grant_type, $refresh_token);
			if(isset($result['access_token']))
			{				
				$access_token_expires_in = $current_timestamp + $result['expires_in'];
				$refresh_token_expires_in = $current_timestamp + $result['x_refresh_token_expires_in'];

				$quickbooks_admin->saveSetting('quickbooks_config', 'access_token', $result['access_token']);
				$quickbooks_admin->saveSetting('quickbooks_config', 'refresh_token', $result['refresh_token']);
				$quickbooks_admin->saveSetting('quickbooks_config', 'access_token_expire_time', $access_token_expires_in);
				$quickbooks_admin->saveSetting('quickbooks_config', 'refresh_token_expire_time', $refresh_token_expires_in);			
			}
			else
			{
				$GLOBALS['log']->fatal("QB ERROR : Access Token is not generated");
				$quickbooks_admin->saveSetting('quickbooks_config', 'access_token', '');
				$quickbooks_admin->saveSetting('quickbooks_config', 'refresh_token', '');
				$quickbooks_admin->saveSetting('quickbooks_config', 'access_token_expire_time', '');
				$quickbooks_admin->saveSetting('quickbooks_config', 'refresh_token_expire_time', '');
				return false;
			}			
		}
		return true;
	}
	public function getQBDataServiceObj(){
		$quickbooks_admin = new Administration();
		$qb_config = $quickbooks_admin->retrieveSettings('quickbooks_config');
		
		$this->qb_api_ds = DataService::Configure(array(
			'auth_mode' => 'oauth2',
			'ClientID' => $qb_config->settings['quickbooks_config_client_id'],
			'ClientSecret' => $qb_config->settings['quickbooks_config_client_secret'],
			'accessTokenKey' => $qb_config->settings['quickbooks_config_access_token'],
			'refreshTokenKey' => $qb_config->settings['quickbooks_config_refresh_token'],
			'QBORealmID' => $qb_config->settings['quickbooks_config_company_id'],
			'baseUrl' => "Development"
		));
		$this->qb_api_ds->throwExceptionOnError(true);
		return $this->qb_api_ds;
	}
}
