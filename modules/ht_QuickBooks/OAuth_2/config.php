<?php
global $sugar_config;

require_once("modules/Administration/Administration.php");
$quickbooks_admin = new Administration();

$settings_quickbooks = $quickbooks_admin->retrieveSettings('quickbooks_config');

$url = rtrim($sugar_config['site_url'],"/")."/modules/ht_QuickBooks/OAuth_2";

$GLOBALS['log']->fatal(rtrim($sugar_config['site_url'],"/"));

return array(
  'authorizationRequestUrl' => 'https://appcenter.intuit.com/connect/oauth2', //Example https://appcenter.intuit.com/connect/oauth2',
  'tokenEndPointUrl' => 'https://oauth.platform.intuit.com/oauth2/v1/tokens/bearer', //Example https://oauth.platform.intuit.com/oauth2/v1/tokens/bearer',  
  'client_id' => $settings_quickbooks->settings['quickbooks_config_client_id'], //Example 'Q0wDe6WVZMzyu1SnNPAdaAgeOAWNidnVRHWYEUyvXVbmZDRUfQ',
  'client_secret' => $settings_quickbooks->settings['quickbooks_config_client_secret'], //Example 'R9IttrvneexLcUZbj3bqpmtsu5uD9p7UxNMorpGd',
  'oauth_scope' => 'com.intuit.quickbooks.accounting', //Example 'com.intuit.quickbooks.accounting',
  'openID_scope' => 'openid profile email', //Example 'openid profile email',
  'oauth_redirect_uri' => rtrim($sugar_config['site_url'],"/").'/index.php?entryPoint=QuickBooksAccessToken', //Example https://d1eec721.ngrok.io/OAuth_2/OAuth2PHPExample.php',
  'openID_redirect_uri' => $url.'/OAuthOpenIDExample.php',//Example 'https://d1eec721.ngrok.io/OAuth_2/OAuthOpenIDExample.php',
  'mainPage' => $url.'/index.php', //Example https://d1eec721.ngrok.io/OAuth_2/index.php',
  'refreshTokenPage' => $url.'/RefreshToken.php', //Example https://d1eec721.ngrok.io/OAuth_2/RefreshToken.php'
)
 ?>
