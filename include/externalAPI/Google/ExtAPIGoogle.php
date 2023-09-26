<?php

require_once 'include/externalAPI/Base/ExternalAPIBase.php';
require_once 'include/externalAPI/Base/WebDocument.php';
require_once 'include/externalAPI/Google/apiclient/src/Google/autoload.php';
require_once 'Zend/Gdata/Contacts.php';

/**
 * ExtAPIGoogle
 */
class ExtAPIGoogle extends ExternalAPIBase implements WebDocument
{
    public $supportedModules = array('Documents', 'Import');
    public $authMethod = 'oauth2';
    public $connector = 'ext_eapm_google';

    public $useAuth = true;
    public $requireAuth = true;

    protected $scopes = array(
        'https://www.googleapis.com/auth/contacts.readonly',
        Google_Service_Drive::DRIVE_METADATA_READONLY,
        Google_Service_Drive::DRIVE_READONLY,
        Google_Service_Drive::DRIVE_FILE,
        Google_Service_Drive::DRIVE,
        Google_Service_Calendar::CALENDAR,
        Google_Service_Calendar::CALENDAR_READONLY,
    );

    public $docSearch = true;
    public $needsUrl = false;
    public $sharingOptions = null;
    public $service = null;

    const APP_STRING_ERROR_PREFIX = 'ERR_GOOGLE_API_';

    public function getClient()
    {
        $client = $this->getGoogleClient();
        $eapm = $this->getLoginInfo(false);
		if ($eapm && !empty($eapm->api_data)) {
            $client->setAccessToken($eapm->api_data);
            if ($client->isAccessTokenExpired()) {
                $this->refreshToken($client);
            }
        }

        return $client;
    }

    protected function refreshToken(Google_Client $client)
    {
        /** @var Google_Auth_OAuth2 $auth */
        $auth = $client->getAuth();
        $refreshToken = $auth->getRefreshToken();
        if ($refreshToken) {
            try {
                $client->refreshToken($refreshToken);
            } catch (Google_Auth_Exception $e) {
                $GLOBALS['log']->error($e->getMessage());

                return;
            }

            $token = $client->getAccessToken();
            $this->saveToken($token);
        }
    }

    protected function saveToken($accessToken)
    {
        global $current_user;
        $bean = $this->getLoginInfo();
        if (!$bean) {
            $bean = BeanFactory::getBean('EAPM');
            $bean->assigned_user_id = $current_user->id;
            $bean->application = 'Google';
            $bean->validated = true;
        }

        $bean->api_data = $accessToken;
        $bean->save();
    }

    public function revokeToken()
    {
        $client = $this->getClient();

        try {
            $client->revokeToken();
        } catch (Google_Auth_Exception $e) {
            return false;
        }

        $eapm = $this->getLoginInfo();
        if ($eapm) {
            $eapm->mark_deleted($eapm->id);
        }

        return true;
    }

    protected function getGoogleClient()
    {
        $config = $this->getGoogleOauth2Config();

        $client = new Google_Client();
        $client->setClientId($config['properties']['oauth2_client_id']);
        $client->setClientSecret($config['properties']['oauth2_client_secret']);
        $client->setRedirectUri($config['redirect_uri']);

        $client->setAccessType('offline');
        $client->setScopes($this->scopes);
		$client->setIncludeGrantedScopes(true);   // incremental auth
		$client->setApprovalPrompt('force');
        return $client;
    }
	
	public function getEvents($calendarId, $optParams = array())
    {
		
		try {
			$client = $this->getClient();
			$service = new Google_Service_Calendar($client);
			
			$results = $service->events->listEvents($calendarId, $optParams);
			$events = $results->getItems();
		} catch (Google_Exception $e) {
            return array(
                'success' => false,
                'errorMessage' => 'Get Events Fail.' . $e->getMessage(),
            );
        }
		
        return $events;
		
    }
    protected function getGoogleOauth2Config()
    {
        $config = array();

        if (is_file('custom/modules/Connectors/connectors/sources/ext/eapm/google/config.php')) {
            require 'custom/modules/Connectors/connectors/sources/ext/eapm/google/config.php';
        } else {
            require 'modules/Connectors/connectors/sources/ext/eapm/google/config.php';
        }

        $config['redirect_uri'] = rtrim(SugarConfig::getInstance()->get('site_url'), '/')
            . '/index.php?module=EAPM&action=GoogleOauth2Redirect';

        return $config;
    }

    public function authenticate($code)
    {
        $client = $this->getClient();
        try {
            $client->authenticate($code);
        } catch (Google_Auth_Exception $e) {
            $GLOBALS['log']->error($e->getMessage());

            return false;
        }

        $token = $client->getAccessToken();
        if ($token) {
            $this->saveToken($token);
        }

        return $token;
    }

    public function uploadDoc(&$bean, $fileToUpload, $docName, $mimeType, $folderList = array())
    {
        $client = $this->getClient();
		$this->service = new Google_Service_Drive($client);

        $file = new Google_Service_Drive_DriveFile($client);
        $file->setTitle($docName);
        $file->setDescription($bean->description);
        $file->setShared(true);
        $file->setMimeType($mimeType);
		$userPermission = new Google_Service_Drive_Permission(array(
			    'value' => 'default',
                'type' => 'anyone',
                'role' =>  'writer',
                'withLink' =>  true
		));
		$parent_id = '';
		// Setup the folder you want the file in, if it is wanted in a folder
		if(isset($folderList) && sizeof($folderList) > 0) {
			foreach($folderList AS $folderName) {
				$parent = new Google_Service_Drive_ParentReference();
				$parent_id = $this->getFolderExistsCreate($folderName, $folderDesc, $parent_id);
				$parent->setId($parent_id);
			}
			$file->setParents(array($parent));
		}
		$convert = true;
		if($mimeType == 'application/pdf')
			$convert = false;
		try {
            $createdFile = $this->service->files->insert($file, array(
                'data' => file_get_contents($fileToUpload),
                'uploadType' => 'multipart',
				'mimeType' => $mimeType,
				'convert' => $convert , // To convert your file
            ));
			$this->service->permissions->insert($createdFile->id, $userPermission);
		} catch (Google_Exception $e) {
            return array(
                'success' => false,
                'errorMessage' => $GLOBALS['app_strings']['ERR_EXTERNAL_API_SAVE_FAIL'] . '.' . $e->getMessage(),
            );
        }
      
        $bean->doc_id = $createdFile->id;
        $bean->doc_url = $createdFile->alternateLink;
        $bean->file_url = $createdFile->alternateLink;

        return array(
            'success' => true,
        );
    }

    public function downloadDoc($documentId, $documentFormat)
    {
		
    }
	public function getFileContents($documentId, $documentFormat)
    {
		$client = $this->getClient();
		$this->service = new Google_Service_Drive($client);

        // $file = new Google_Service_Drive_DriveFile($client);
        
		try {
			// $response = $this->service->files->export($documentId, 'application/pdf');
            $response = $this->service->files->get($documentId);
			$exportLink = isset($response->exportLinks[$documentFormat]) ? $response->exportLinks[$documentFormat] : $response->webContentLink;
			
			// $request = new Google_Http_Request($exportLink);
			// $httpRequest = $client->getAuth()->authenticatedRequest($request);
			$content = file_get_contents($exportLink);
			// print"<pre>";print_r($content);die;
			// $content = $client->getIo()->makeRequest($request)->getResponseBody();
			//$content = $response->getBody()->getContents();
		} catch (Google_Exception $e) {
            return array(
                'success' => false,
                'errorMessage' => 'File Download Fail.' . $e->getMessage(),
            );
        }
		
        return $content;
		
    }

    public function deleteDoc($documentId)
    {
    }

    public function shareDoc($documentId, $emails)
    {
    }

    public function searchDoc($keywords, $flushDocCache = false)
    {
        global $sugar_config;

        $client = $this->getClient();
        $drive = new Google_Service_Drive($client);

        $options = array(
            'maxResults' => $sugar_config['list_max_entries_per_page']
        );

        $queryString = "trashed = false ";
        if (!empty($keywords)) {
            $queryString .= "and title contains '{$keywords}'";
        }
        $options['q'] = $queryString;

        try {
            $files = $drive->files->listFiles($options);
        } catch (Google_Exception $e) {
            $GLOBALS['log']->fatal('Unable to retrieve google drive files:' . $e);
            return false;
        }

        $results = array();
        foreach ($files as $file) {
            $results[] = array(
                'url' => $file->alternateLink,
                'name' => $file->title,
                'date_modified' => $file->modifiedDate,
                'id' => $file->id
            );
        }

        return $results;
    }

    public function getLoginInfo($is_user = true)
    {
        if ($is_user) {
            return EAPM::getLoginInfo('Google');
        }

        $config = $this->getGoogleOauth2Config();

        if (isset($config['properties']['upload_to_admin']) && $config['properties']['upload_to_admin']) {
            $eapmBean = new EAPM();
            $queryArray = array(
                'assigned_user_id' => '1',
                'application' => 'Google',
                'deleted' => 0
            );

            $eapmBean = $eapmBean->retrieve_by_string_fields($queryArray, false);        
            return $eapmBean;
        }

        $eapmBean = EAPM::getLoginInfo('Google');

        return $eapmBean;
    }
	
	
	/**
	* Get the folder ID if it exists, if it doesnt exist, create it and return the ID
	*
	* @param Google_DriveService $service Drive API service instance.
	* @param String $folderName Name of the folder you want to search or create
	* @param String $folderDesc Description metadata for Drive about the folder (optional)
	* @return Google_Drivefile that was created or got. Returns NULL if an API error occured
	*/
	function getFolderExistsCreate( $folderName, $folderDesc, $parentId = 'all') {
		// List all user files (and folders) at Drive root
		
		$parentId = empty($parentId) ? 'all' : $parentId;
		$files = $this->listFilesFolders($folderName, $parentId, 'folders');
		$found = false;
		// Go through each one to see if there is already a folder with the specified name
		foreach ($files['items'] as $item) {
			if ($item['title'] == $folderName) {
				$found = true;
				return $item['id'];
				break;
			}
		}
		// If not, create one
		if ($found == false) {
			$folderInitial = array('mimeType' => 'application/vnd.google-apps.folder');
			if($parentId != 'all')
				$folderInitial['parents'] = array(array('id' => $parentId));
			$folder = new Google_Service_Drive_DriveFile($folderInitial);
			//Setup the folder to create
			$folder->setTitle($folderName);
			if(!empty($folderDesc))
				$folder->setDescription($folderDesc);
			//Create the Folder
			try {
				$createdFile = $this->service->files->insert($folder);
				// Return the created folder's id
				return $createdFile->id;
			} catch (Exception $e) {
				print "An error occurred: " . $e->getMessage();
			}
		}
	}
	/**
     *  Get the list of files or folders or both from given folder or root
     *  @param string $search complete or partial name of file or folder to search
     *  @param string $parentId parent folder id or root from which the list of
                                files or folders or both will be generated
     *  @param string $type='all' file or folder
     *  @return array list of files or folders or both from given parent directory
    */
    public function listFilesFolders($search, $parentId = 'all', $type = 'all')
    {
        $query = '';
        // Checking if search is empty the use 'contains' condition if search is empty (to get all files or folders).
        // Otherwise use '='  condition
        $condition = $search!=''?'=':'contains';
        
        // Search all files and folders otherwise search in root or  any folder
        $query .= $parentId!='all'?"'".$parentId."' in parents":"";
        
        // Check if want to search files or folders or both
        switch ($type) {
            case "files":
                $query .= $query!=''?' and ':'';
                $query .= "mimeType != 'application/vnd.google-apps.folder' 
                            and title  ".$condition." '".$search."'";
                break;
            case "folders":
                $query .= $query!=''?' and ':'';
                $query .= "mimeType = 'application/vnd.google-apps.folder' and title  = '".$search."'";
                break;
            default:
                $query .= "";
                break;
        }
        // Make sure that not list trashed files
        $query .= $query!=''?' and trashed = false':'trashed = false';
        $optParams = array('q' => $query);
        // Returns the list of files and folders as object
        $results = $this->service->files->listFiles($optParams);
		
        return $results;
    }

	
	
}
