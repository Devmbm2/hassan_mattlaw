<?php
// if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
$job_strings[] = 'uploadDocumentsToDrive';

/**
 * Example scheduled job to change any 'Planned' meetings older than a month
 * to 'Not Held'.
 * @return bool
 */
function uploadDocumentsToDrive(){
    $GLOBALS['log']->fatal("check");
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
    $file = new Google_DriveFile();
    $parent = new Google_ParentReference();
    $client->setAccessToken($accessToken);
    $client->setState($accessToken);
    $selected_modules = array(
        'Authorizations','Client_Cost','Client_Insurance','Correspondence','Defendant_Insurance',
        'Discovery','3RD-Non-Party','ht_case_event','Negotiations','Pleadings','Hard_Documents',
        'Soft_Documents','Investigation','Transcripts_Statements','Trial'
    );
//    For Static Folder named Case
    $folderName = "Cases";
    $drive_main_existence = array(
        'q' => "title = '" . $folderName . "' and mimeType = 'application/vnd.google-apps.folder' and trashed=false"
    );
    $main_existence = $service->files->listFiles($drive_main_existence);
    if (empty($main_existence['items'])) {
        $file->setTitle($folderName);
        $file->setMimeType('application/vnd.google-apps.folder');
        $createdFile = $service->files->insert(
            $file,
            array(
                'mimeType' => 'application/vnd.google-apps.folder',
            )
        );
        $parent_folder_id = $createdFile['id'];
    }else{
        $parent_folder_id = $main_existence['items'][0]['id'];
    }

    $sql1 =  "SELECT cases.id,cases.name FROM cases WHERE deleted = 0";
    $result1 = $db->query($sql1, true);
    while ($row1 = $db->fetchByAssoc($result1)) {
        $case_id = $row1['id'];
        $case_name = $row1['name'];
//    For Case named Folder
        $drive_case_existence = array(
            'q' => "title = '" . $case_name . "' and mimeType = 'application/vnd.google-apps.folder' and trashed=false"
        );
        $case_existence = $service->children->listChildren($parent_folder_id, $drive_case_existence);
        if (empty($case_existence['items'])) {
            $parent->setId($parent_folder_id);
            $file->setParents(array($parent));
            $file->setTitle($case_name);
            $file->setMimeType('application/vnd.google-apps.folder');
            $createdFile = $service->files->insert(
                $file,
                array(
                    'mimeType' => 'application/vnd.google-apps.folder',
                )
            );
            $parent_case_id = $createdFile['id'];
        }else{
            $parent_case_id = $case_existence['items'][0]['id'];
        }

        $parent_bean = BeanFactory::getBean('Cases', $case_id);
        $related_modules_data = array();
        foreach($selected_modules as $subpanel_name){
            if($subpanel_name == 'Running_Bills_Liens_Medical_Bills'){
                $params = array('contact_id' => $parent_bean->id);
                $data = getRelatedReceivedMedicalBills($params);
                if(isset($data) && !empty($data)){
                    $query = $data['select']. $data['from']. $data['join']. $data['where'];
                    $result = $GLOBALS['db']->query($query, true);
                    while($row = $GLOBALS['db']->fetchByAssoc($result)){
                        $related_modules_data[$subpanel_name][] = array('record_id' => $row['id'], 'record_type' => 'MDOC_Incoming_Bills');
                    }
                }
            }else{
                $selected_module_data = $GLOBALS['app_list_strings']['related_modules_subpanels'][$subpanel_name];
                $selected_module_data_link_name = $selected_module_data['link_name'];
                $where = '';
                if(isset($selected_module_data['where_subpanel']) && !empty($selected_module_data['where_subpanel'])){
                    $where = $selected_module_data['where_subpanel'];
                }
                if ($parent_bean->load_relationship($selected_module_data_link_name)){
                    $relatedBeans = $parent_bean->get_linked_beans($selected_module_data_link_name, $selected_module_data['module'], '', '',  '', 0, $where);
                    foreach($relatedBeans AS $id => $record_data){
                        $related_modules_data[$subpanel_name][] = array('record_id' => $record_data->id, 'record_type' => $selected_module_data['module']);
                    }
                }
            }
        }
        if(!empty($related_modules_data)) {
            foreach ($related_modules_data as $subpanel_name => $record) {
                foreach ($record as $data) {
                    $_REQUEST['id'] = $data['record_id'];
                    $_REQUEST['type'] = $data['record_type'];
                    $getrevise_id = BeanFactory::getBean('Documents', $_REQUEST['id']);
                    if ($getrevise_id->hard_or_soft_doc == 'Soft_Documents' || $getrevise_id->hard_or_soft_doc == 'Hard_Documents') {

                        $revise_id = $getrevise_id->document_revision_id;
                        $filename = $getrevise_id->filename;
                        $download_location = "upload://{$revise_id}";
                        $file_meta = file_get_contents($download_location);
                        $mime_type =  mime_content_type($filename);

                        if($getrevise_id->hard_or_soft_doc == 'Soft_Documents'){
                            $drive_panel_name_existence = array(
                                'q' => "title = '" . $getrevise_id->hard_or_soft_doc . "' and mimeType = 'application/vnd.google-apps.folder' and trashed=false"
                            );
                            $panel_existence = $service->children->listChildren($parent_case_id, $drive_panel_name_existence);
                            if (empty($panel_existence['items'])) {
                                $parent->setId($parent_case_id);
                                $file->setParents(array($parent));
                                $file->setTitle('Soft_Documents');
                                $file->setMimeType('application/vnd.google-apps.folder');
                                $createdFile1 = $service->files->insert(
                                    $file,
                                    array(
                                        'mimeType' => 'application/vnd.google-apps.folder',
                                    )
                                );
                                $case_specific_panel = $createdFile1['id'];
                            }else{
                                $case_specific_panel = $panel_existence['items'][0]['id'];
                            }
                            //=============Upload File=============
                            $drive_panel_file_existence = array(
                                'q' => "title = '" . $filename . "' and mimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' and trashed=false"
                            );
                            $file_existence = $service->children->listChildren($case_specific_panel, $drive_panel_file_existence);
                            if(empty($file_existence['items'])){
                                $parent->setId($case_specific_panel);
                                $file->setParents(array($parent));
                                $file->setTitle($filename);
                                $file->setDescription('This is a '.$mime_type.' document');
                                $file->setMimeType('application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                                $createdFile = $service->files->insert(
                                    $file,
                                    array(
                                        'data' => $file_meta,
                                        'mimeType' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                        'uploadType' => 'multipart'
                                    )
                                );
                            }
                        }elseif($getrevise_id->hard_or_soft_doc == 'Hard_Documents'){
                            $drive_panel_name_existence = array(
                                'q' => "title = '" . $getrevise_id->hard_or_soft_doc . "' and mimeType = 'application/vnd.google-apps.folder' and trashed=false"
                            );
                            $panel_existence = $service->children->listChildren($parent_case_id, $drive_panel_name_existence);
                            if (empty($panel_existence['items'])) {
                                $parent->setId($parent_case_id);
                                $file->setParents(array($parent));
                                $file->setTitle('Hard_Documents');
                                $file->setMimeType('application/vnd.google-apps.folder');
                                $createdFile1 = $service->files->insert(
                                    $file,
                                    array(
                                        'mimeType' => 'application/vnd.google-apps.folder',
                                    )
                                );
                                $case_specific_panel = $createdFile1['id'];
                            }else{
                                $case_specific_panel = $panel_existence['items'][0]['id'];
                            }
                            //=============Upload File=============
                            $drive_panel_file_existence = array(
                                'q' => "title = '" . $filename . "' and mimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' and trashed=false"
                            );
                            $file_existence = $service->children->listChildren($case_specific_panel, $drive_panel_file_existence);
                            if(empty($file_existence['items'])){
                                $parent->setId($case_specific_panel);
                                $file->setParents(array($parent));
                                $file->setTitle($filename);
                                $file->setDescription('This is a '.$mime_type.' document');
                                $file->setMimeType('application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                                $createdFile = $service->files->insert(
                                    $file,
                                    array(
                                        'data' => $file_meta,
                                        'mimeType' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                        'uploadType' => 'multipart'
                                    )
                                );
                            }
                        }
                    } else if ($subpanel_name == 'Pleadings') {
                        $getrevise_id = BeanFactory::getBean('PLEA_Pleadings', $_REQUEST['id']);
                        $revise_id = $getrevise_id->id;
                        $filename = $getrevise_id->filename;
                        $download_location = "upload://{$revise_id}";
                        $file_meta = file_get_contents($download_location);
                        $mime_type =  mime_content_type($filename);

                        $drive_panel_name_existence = array(
                            'q' => "title = '" . $subpanel_name . "' and mimeType = 'application/vnd.google-apps.folder' and trashed=false"
                        );
                        $panel_existence = $service->children->listChildren($parent_case_id, $drive_panel_name_existence);
                        if (empty($panel_existence['items'])) {
                            $parent->setId($parent_case_id);
                            $file->setParents(array($parent));
                            $file->setTitle('Pleadings');
                            $file->setMimeType('application/vnd.google-apps.folder');
                            $createdFile1 = $service->files->insert(
                                $file,
                                array(
                                    'mimeType' => 'application/vnd.google-apps.folder',
                                )
                            );
                            $case_specific_panel = $createdFile1['id'];
                        }else{
                            $case_specific_panel = $panel_existence['items'][0]['id'];
                        }
                        //=============Upload File=============
                        $drive_panel_file_existence = array(
                            'q' => "title = '" . $filename . "' and mimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' and trashed=false"
                        );
                        $file_existence = $service->children->listChildren($case_specific_panel, $drive_panel_file_existence);
                        if(empty($file_existence['items'])){
                            $parent->setId($case_specific_panel);
                            $file->setParents(array($parent));
                            $file->setTitle($filename);
                            $file->setDescription('This is a '.$mime_type.' document');
                            $file->setMimeType('application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                            $createdFile = $service->files->insert(
                                $file,
                                array(
                                    'data' => $file_meta,
                                    'mimeType' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                    'uploadType' => 'multipart'
                                )
                            );
                        }
                    } else if ($subpanel_name == 'Discovery' || $subpanel_name == '3RD-Non-Party') {
                        $getrevise_id = BeanFactory::getBean('DISC_Discovery', $_REQUEST['id']);
                        $revise_id = $getrevise_id->id;
                        $filename = $getrevise_id->filename;
                        $download_location = "upload://{$revise_id}";
                        $file_meta = file_get_contents($download_location);
                        $mime_type =  mime_content_type($filename);

                        if($subpanel_name == 'Discovery'){
                            $drive_panel_name_existence = array(
                                'q' => "title = '" . $subpanel_name . "' and mimeType = 'application/vnd.google-apps.folder' and trashed=false"
                            );
                            $panel_existence = $service->children->listChildren($parent_case_id, $drive_panel_name_existence);
                            if (empty($panel_existence['items'])) {
                                $parent->setId($parent_case_id);
                                $file->setParents(array($parent));
                                $file->setTitle('Discovery');
                                $file->setMimeType('application/vnd.google-apps.folder');
                                $createdFile1 = $service->files->insert(
                                    $file,
                                    array(
                                        'mimeType' => 'application/vnd.google-apps.folder',
                                    )
                                );
                                $case_specific_panel = $createdFile1['id'];
                            }else{
                                $case_specific_panel = $panel_existence['items'][0]['id'];
                            }
                            //=============Upload File=============
                            $drive_panel_file_existence = array(
                                'q' => "title = '" . $filename . "' and mimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' and trashed=false"
                            );
                            $file_existence = $service->children->listChildren($case_specific_panel, $drive_panel_file_existence);
                            if(empty($file_existence['items'])){
                                $parent->setId($case_specific_panel);
                                $file->setParents(array($parent));
                                $file->setTitle($filename);
                                $file->setDescription('This is a '.$mime_type.' document');
                                $file->setMimeType('application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                                $createdFile = $service->files->insert(
                                    $file,
                                    array(
                                        'data' => $file_meta,
                                        'mimeType' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                        'uploadType' => 'multipart'
                                    )
                                );
                            }
                        }elseif ($subpanel_name == '3RD-Non-Party'){
                            $drive_panel_name_existence = array(
                                'q' => "title = '" . $subpanel_name . "' and mimeType = 'application/vnd.google-apps.folder' and trashed=false"
                            );
                            $panel_existence = $service->children->listChildren($parent_case_id, $drive_panel_name_existence);
                            if (empty($panel_existence['items'])) {
                                $parent->setId($parent_case_id);
                                $file->setParents(array($parent));
                                $file->setTitle('3RD-Non-Party');
                                $file->setMimeType('application/vnd.google-apps.folder');
                                $createdFile1 = $service->files->insert(
                                    $file,
                                    array(
                                        'mimeType' => 'application/vnd.google-apps.folder',
                                    )
                                );
                                $case_specific_panel = $createdFile1['id'];
                            }else{
                                $case_specific_panel = $panel_existence['items'][0]['id'];
                            }
                            //=============Upload File=============
                            $drive_panel_file_existence = array(
                                'q' => "title = '" . $filename . "' and mimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' and trashed=false"
                            );
                            $file_existence = $service->children->listChildren($case_specific_panel, $drive_panel_file_existence);
                            if(empty($file_existence['items'])){
                                $parent->setId($case_specific_panel);
                                $file->setParents(array($parent));
                                $file->setTitle($filename);
                                $file->setDescription('This is a '.$mime_type.' document');
                                $file->setMimeType('application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                                $createdFile = $service->files->insert(
                                    $file,
                                    array(
                                        'data' => $file_meta,
                                        'mimeType' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                        'uploadType' => 'multipart'
                                    )
                                );
                            }
                        }
                    } else if ($subpanel_name == 'Negotiations') {
                        $getrevise_id = BeanFactory::getBean('NEG_Negotiations', $_REQUEST['id']);
                        $revise_id = $getrevise_id->id;
                        $filename = $getrevise_id->filename;
                        $download_location = "upload://{$revise_id}";
                        $file_meta = file_get_contents($download_location);
                        $mime_type =  mime_content_type($filename);

                        $drive_panel_name_existence = array(
                            'q' => "title = '" . $subpanel_name . "' and mimeType = 'application/vnd.google-apps.folder' and trashed=false"
                        );
                        $panel_existence = $service->children->listChildren($parent_case_id, $drive_panel_name_existence);
                        if (empty($panel_existence['items'])) {
                            $parent->setId($parent_case_id);
                            $file->setParents(array($parent));
                            $file->setTitle('Negotiations');
                            $file->setMimeType('application/vnd.google-apps.folder');
                            $createdFile1 = $service->files->insert(
                                $file,
                                array(
                                    'mimeType' => 'application/vnd.google-apps.folder',
                                )
                            );
                            $case_specific_panel = $createdFile1['id'];
                        }else{
                            $case_specific_panel = $panel_existence['items'][0]['id'];
                        }
                        //=============Upload File=============
                        $drive_panel_file_existence = array(
                            'q' => "title = '" . $filename . "' and mimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' and trashed=false"
                        );
                        $file_existence = $service->children->listChildren($case_specific_panel, $drive_panel_file_existence);
                        if(empty($file_existence['items'])){
                            $parent->setId($case_specific_panel);
                            $file->setParents(array($parent));
                            $file->setTitle($filename);
                            $file->setDescription('This is a '.$mime_type.' document');
                            $file->setMimeType('application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                            $createdFile = $service->files->insert(
                                $file,
                                array(
                                    'data' => $file_meta,
                                    'mimeType' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                    'uploadType' => 'multipart'
                                )
                            );
                        }
                    } else if ($subpanel_name == 'Client_Cost') {
                        $getrevise_id = BeanFactory::getBean('COST_Client_Cost', $_REQUEST['id']);
                        $revise_id = $getrevise_id->id;
                        $filename = $getrevise_id->filename;
                        $download_location = "upload://{$revise_id}";
                        $file_meta = file_get_contents($download_location);
                        $mime_type =  mime_content_type($filename);

                        $drive_panel_name_existence = array(
                            'q' => "title = '" . $subpanel_name . "' and mimeType = 'application/vnd.google-apps.folder' and trashed=false"
                        );
                        $panel_existence = $service->children->listChildren($parent_case_id, $drive_panel_name_existence);
                        if (empty($panel_existence['items'])) {
                            $parent->setId($parent_case_id);
                            $file->setParents(array($parent));
                            $file->setTitle('Client_Cost');
                            $file->setMimeType('application/vnd.google-apps.folder');
                            $createdFile1 = $service->files->insert(
                                $file,
                                array(
                                    'mimeType' => 'application/vnd.google-apps.folder',
                                )
                            );
                            $case_specific_panel = $createdFile1['id'];
                        }else{
                            $case_specific_panel = $panel_existence['items'][0]['id'];
                        }
                        //=============Upload File=============
                        $drive_panel_file_existence = array(
                            'q' => "title = '" . $filename . "' and mimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' and trashed=false"
                        );
                        $file_existence = $service->children->listChildren($case_specific_panel, $drive_panel_file_existence);
                        if(empty($file_existence['items'])){
                            $parent->setId($case_specific_panel);
                            $file->setParents(array($parent));
                            $file->setTitle($filename);
                            $file->setDescription('This is a '.$mime_type.' document');
                            $file->setMimeType('application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                            $createdFile = $service->files->insert(
                                $file,
                                array(
                                    'data' => $file_meta,
                                    'mimeType' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                    'uploadType' => 'multipart'
                                )
                            );
                        }
                    }
                }
            }
        }
    }
    return true;
}
