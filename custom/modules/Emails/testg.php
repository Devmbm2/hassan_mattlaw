<?php
   // $GLOBALS['log']->fatal("check");
    global $db;
    require_once 'google-api-php-client/src/Google_Client.php';
    require_once 'google-api-php-client/src/contrib/Google_DriveService.php';
    $source_id = 'ext_eapm_google';
    $source = SourceFactory::getSource($source_id);
    $properties = $source->getProperties();
    $client_id = $properties['oauth2_client_id'];
    $client_secret = $properties['oauth2_client_secret'];
    $client = new Google_Client();
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    // $client->setRedirectUri('http://localhost/mattlaw_crm/index.php?module=EAPM&action=GoogleOauth2Redirect');
    $client->setScopes(array('https://www.googleapis.com/auth/drive'));
    $tokenPath = 'custom/include/calendar-work/drive_token.json';
    $sql = "SELECT eapm.api_data from eapm where assigned_user_id = 1 AND deleted = 0";
    $result = $db->query($sql);
    $record = $GLOBALS["db"]->fetchByAssoc($result);
    if (!empty($record)) {
        $api_data = $record['api_data'];

        $api_data = str_replace("&quot;", '"', $api_data);
        file_put_contents($tokenPath, $api_data);
    }
    if (file_exists($tokenPath)) {
        $accessToken = file_get_contents($tokenPath);
    }
    $service = new Google_DriveService($client);
    $client->setAccessToken($accessToken);
    $client->setState($accessToken);
     echo "working here"; 
    //  try {
    //     $fileId = '1f9uElkH_54C2YNDPw6Y942DmcPZfdxdO';
    //     $file = $service->files->get($fileId);
    //     print_r($file);
    //     $content = $file->getBody()->getContents();
    //     // Save the file to your local server
    //     $localFilePath = 'upload/test.pdf'; // Replace with your desired file path and name
    //     file_put_contents($localFilePath, $content);
    //     echo 'File downloaded and saved successfully!';
    // } catch (Exception $e) {
    //     echo 'Error: ' . $e->getMessage();
    // }
    $documentId="1f9uElkH_54C2YNDPw6Y942DmcPZfdxdO"; 
    try {
        // $response = $this->service->files->export($documentId, 'application/pdf');
        $response = $service->files->get($documentId);
        $exportLink =  $response['webContentLink'];
        echo $exportLink; 
        // $request = new Google_Http_Request($exportLink);
        // $httpRequest = $client->getAuth()->authenticatedRequest($request);
        $content = file_get_contents($exportLink);
         print"<pre>";print_r($response);die;
        // $content = $client->getIo()->makeRequest($request)->getResponseBody();
        //$content = $response->getBody()->getContents();
    } catch (Google_Exception $e) {
        return array(
            'success' => false,
            'errorMessage' => 'File Download Fail.' . $e->getMessage(),
        );
    }

    $localFilePath = 'upload/test.pdf';
    file_put_contents($localFilePath, $content);


