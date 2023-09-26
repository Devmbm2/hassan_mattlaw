<?php
    
    ob_clean();
	global $db, $sugar_config, $app_list_strings;
	$module = $_REQUEST['module'];
	// $case_bean = BeanFactory::getBean('Cases', $_REQUEST['record']);
	$parent_bean = BeanFactory::getBean($module , $_REQUEST['record']);
	// print_r('<pre>');print_r($module);die();
	$download_file_name = $parent_bean->name;

	$selected_modules = explode(',', $_REQUEST['selected_modules']);
	$selected_modules_types = explode(',', $_REQUEST['selected_modules_types']);
	// echo $selected_modules_types;
	// die();
	$temp_files = array();
	$list_files = array();
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
	// echo "1";
	// die();
	// foreach($related_modules_data AS $subpanel_name => $record){
	// 	foreach($record AS $data){
	// 		$_REQUEST['id'] = $data['record_id'];
	// 		$_REQUEST['type'] = $data['record_type'];
	// 		$file_name = store_files();
	// 		// print_r("<pre>");print_r($file_name);
	// 		if($file_name) {
	// 			$list_files[$subpanel_name][] = $temp_files[$subpanel_name][] =  $file_name;
	// 		}
	// 	}
	// }
	// die();
$header = '<div><input type="button" id = "generate_report" value="Download Zip" onclick="related_module_files_zip_download(\''.$_REQUEST['record'].'\');" style="margin:5px 5px 0px 0;font-size:x-small;float:right;position:relative;">
<input type="button" id = "unselect_all"  name = "unselect_all"  value="Deselect All" style="margin:5px 5px 0px 0;font-size:x-small;float:right;position:relative;">
<input type="button" id = "select_all" name = "select_all" value="Select All" style="margin:5px 5px 0px 0; font-size:x-small;float:right;position:relative;">
<input type="button" id = "back_to" value="Go Back" onclick="ClosePopup_it(this); return false;" style="margin:5px 5px 0px 0;font-size:x-small;float:right;position:relative;">
</div>
<table class="table-bordered table-responsive" style="height: 60px; width: 800px; border-spacing:-2;position:relative;top:10px;margin-bottom:10px;">
<tbody>
<tr>
<td style="font-weight: bold; text-align: left;width:50%;"><span style="font-size: 12px;"><strong>Document Name</strong></span></td>
<td style="font-weight: bold; text-align: left;width:20%;"><span style="font-size: 12px;"><strong>Module</strong></span></td>
<td style="font-weight: bold; text-align: left;width:20%;"><span style="font-size: 12px;"><strong>'. $parent_bean->name .'</strong></span></td>
<td style="font-weight: bold; text-align: left;width:20%;"><span style="font-size: 12px;"><strong>Date of Document</strong></span></td>
<td style="font-weight: bold; text-align: left;width:20%;"><span style="font-size: 12px;"><strong>Type</strong></span></td>
<td style="font-weight: bold; text-align: left;width:50%;"><span style="font-size: 12px;"><strong>Selected</strong></span></td>
</tr>';
$stream_html = $header;
// $stream_html .='<select style="height:50%;width: 60%;display:none;" name="list_of_case_related_modules_type_files" id="list_of_case_related_modules_type_files" multiple >';
if(!empty($related_modules_data)){
	foreach($related_modules_data AS $subpanel_name => $record){
		foreach($record AS $data){
			$_REQUEST['id'] = $data['record_id'];
			$_REQUEST['type'] = $data['record_type'];
			$getfile_name = BeanFactory::getBean('Documents', $_REQUEST['id']);
			if($getfile_name->hard_or_soft_doc == 'Soft_Documents' || $getfile_name->hard_or_soft_doc == 'Hard_Documents')
			{
			$file_name_db = $getfile_name->document_name;
			$file_date = $getfile_name->hd_reviewed_date;
			if(empty($file_date))
			{
				$date2 = new \DateTime($getfile_name->date_entered);
				$file_date = $date2->format('m/d/Y');
			}
			}
			else if($subpanel_name == 'Pleadings' || $subpanel_name == 'Discovery' || $subpanel_name == '3RD-Non-Party' || $subpanel_name == 'Negotiations')
			{
			$getfile_name = BeanFactory::getBean($data['record_type'], $_REQUEST['id']);
			$file_name_db = $getfile_name->document_name;
			$file_date = $getfile_name->hd_reviewed_date;
			if(empty($file_date))
			{
				$date2 = new \DateTime($getfile_name->date_entered);
				$file_date = $date2->format('m/d/Y');
			}
			}
			else
			{
			$getfile_name = BeanFactory::getBean($data['record_type'], $_REQUEST['id']);
			$file_name_db = $getfile_name->document_name;
				$date2 = new \DateTime($getfile_name->date_entered);
				$file_date = $date2->format('m/d/Y');
			}
			$file_name = store_files();
			if($file_name){
			foreach($selected_modules_types as $types)
						{
						$getext = pathinfo($file_name, PATHINFO_EXTENSION);
						$ext = strtolower($getext);
					    // $check_ext = checkExt($ext);
						if($types == $ext)
						{
						$stream_html .='<tr>';
						if($subpanel_name == 'Notes'){
							$stream_html .='<td style="width:50%;">'. $getfile_name->name .'</td>';
						}
						else{
							$stream_html .='<td style="width:50%;">'. $file_name_db .'</td>';
						}
						$stream_html .='<td style="width:20%;">'. $subpanel_name .'</td>';
						if($types == 'docx')
						{
						$stream_html .='<td style="width:20%;"><a href="https://docs.google.com/gview?url='.$sugar_config['site_url'].'/upload/'. $_REQUEST['id'] .'"target="_blank">View</a></td>';
				        }
				        else if($types == 'pdf')
				        {   if (isset($getfile_name->doc_id) && !empty($getfile_name->doc_id) && $getfile_name->doc_type == 'Google')
							{
						      $stream_html .='<td style="width:20%;"><a href="https://drive.google.com/uc?id='.$getfile_name->doc_id.'" target="_blank">View</a></td>';
                              
							} else{
				        	$stream_html .='<td style="width:20%;"><a href="pdf_viewer/index.html?file='.$sugar_config['site_url'].'/upload/'. $_REQUEST['id'] .'" target="_blank">View</a></td>';
							}
						}
				        else{
				        	$stream_html .='<td style="width:20%;"><a href="upload/'. $_REQUEST['id'] .'" target="_blank">View</a></td>';
				        }
				        $stream_html .='<td style="width:20%;">'. $file_date .'</td>';
				        $stream_html .='<td style="width:20%;">'. $ext .'</td>';
						$stream_html .='<td style="width:50%;text-align:center;"><input name="checkbox" value="'. $file_name .'" type="checkbox" rel="'. $subpanel_name .'"/></td>';
						$stream_html .='</tr>';
						}
						}

		}
		else if(($subpanel_name == 'Notes' || $subpanel_name == 'Calls') && $getfile_name->filename=="") {
		$stream_html .='<tr>';
		$stream_html .='<td style="width:50%;">'. $getfile_name->name .'</td>';
		$stream_html .='<td style="width:20%;">'. $subpanel_name .'</td>';
		// $stream_html .='<td style="width:20%;">'. $getfile_name->description .'</td>';
		$shortDescription = strlen($getfile_name->description) > 100 ? '<span class="description-short">' . substr($getfile_name->description, 0, 100) . '...</span>
			   <span class="description-full" style="display: none;">' . htmlentities($getfile_name->description) . '</span>
			   <a href="#" onclick="read_more_btn(this); return false;" id="read-more-button" >Read More</a>
			   <a href="#" onclick="view_less_btn(this); return false;" id="view-less-button" style="display: none;">View Less</a>'
			: $getfile_name->description;
					$stream_html .= '<td style="width: 20%;"><span class="description-short">' . $shortDescription . '</td>';
		$stream_html .='<td style="width:20%;">'. $file_date .'</td>';
		$stream_html .='<td style="width:20%;"></td>';
		$stream_html .='<td style="width:50%;text-align:center;"><input id="notes_id"  name="checkbox" value="'. $getfile_name->id .'" type="checkbox" rel="'. $subpanel_name .'"/></td>';
		$stream_html .='</tr>';
			
		}
		else if($subpanel_name == 'Emails' && $getfile_name->has_attachment!==1) {
			$stream_html .='<tr>';
			$stream_html .='<td style="width:50%;">'. $getfile_name->name .'</td>';
			$stream_html .='<td style="width:20%;">'. $subpanel_name .'</td>';
			$stream_html .='<td style="width:20%;"><a href="index.php?action=DetailView&module=Emails&record=' . $getfile_name->id .' " target="_blank">View</a></td>';
			$stream_html .='<td style="width:20%;">'. $file_date .'</td>';
			$stream_html .='<td style="width:20%;"></td>';
			$stream_html .='<td style="width:50%;text-align:center;"><input id="emails_id"  name="checkbox" value="'. $getfile_name->id .'" type="checkbox" rel="'. $subpanel_name .'"/></td>';
			$stream_html .='</tr>';
				
			}
	}
	}
}
		else{
		}
	$stream_html .='</tbody>';
	$stream_html .='</table>';
	$stream_html .='<form action="index.php?entryPoint=related_module_files_zip_download" method = "post" id="download_zip_form">';
	$stream_html.='<input type = "hidden" id="record_id" value="'. $_REQUEST['record'] .'" name="record">';
	$stream_html.='<input type = "hidden" id="list_of_case_related_modules" value="'. $_REQUEST['selected_modules'] .'" name="selected_modules[]">';
	$stream_html.='<input type = "hidden" id="list_of_case_related_modules_types" value="'. $_REQUEST['selected_modules_types'] .'" name="selected_modules_types[]">';
	$stream_html.='<input type = "hidden" id="selected_records" value="" name="tmp[]">';
	$stream_html.='<input type = "hidden" id="selected_records_nf" value="" name="tmp_nf[]">';
	$stream_html.='<input type = "hidden" id="module" name = "module" value='.$module.'>';
	$stream_html .='</form>';
	$stream_html .='<div style = "padding-top:10px;"><input type="button" id = "generate_report" value="Download Zip" onclick="related_module_files_zip_download(\''.$_REQUEST['record'].'\');" style="margin:5px 5px 0px 0;font-size:x-small;float:right;position:relative;">
<input type="button" id = "unselect_all"  name = "unselect_all"  value="Deselect All" style="margin:5px 5px 0px 0;font-size:x-small;float:right;position:relative;">
<input type="button" id = "select_all" name = "select_all" value="Select All" style="margin:5px 5px 0px 0; font-size:x-small;float:right;position:relative;">
<input type="button" id = "back_to" value="Go Back" onclick="ClosePopup_it(this); return false;" style="margin:5px 5px 0px 0;font-size:x-small;float:right;position:relative;">
</div>';
	echo $stream_html;die;
function store_files(){
	global $db, $sugar_config, $beanList;
		require_once("data/BeanFactory.php");
		$file_type = ''; // bug 45896
		ini_set('zlib.output_compression', 'Off');//bug 27089, if use gzip here, the Content-Length in header may be incorrect.
		// cn: bug 8753: current_user's preferred export charset not being honored
		$GLOBALS['current_user']->retrieve($_SESSION['authenticated_user_id']);
		$GLOBALS['current_language'] = $_SESSION['authenticated_user_language'];
		$app_strings = return_application_language($GLOBALS['current_language']);
		$mod_strings = return_module_language($GLOBALS['current_language'], 'ACL');
		$file_type = strtolower($_REQUEST['type']);
		if (!isset($_REQUEST['isTempFile'])) {
			//Custom modules may have capitalizations anywhere in their names. We should check the passed in format first.
			require_once('include/modules.php');
			$module = $db->quote($_REQUEST['type']);
			if (empty($beanList[$module])) {
				//start guessing at a module name
				$module = ucfirst($file_type);
				if (empty($beanList[$module])) {
					die($app_strings['ERROR_TYPE_NOT_VALID']);
				}
			}
			$bean_name = $beanList[$module];
			if (!file_exists('modules/' . $module . '/' . $bean_name . '.php')) {
				die($app_strings['ERROR_TYPE_NOT_VALID']);
			}

			$focus = BeanFactory::newBean($module);
			$focus->retrieve($_REQUEST['id']);
			if (!$focus->ACLAccess('view')) {
				die($mod_strings['LBL_NO_ACCESS']);
			} // if
			// Pull up the document revision, if it's of type Document
			if (isset($focus->object_name) && $focus->object_name == 'Document') {
				// It's a document, get the revision that really stores this file
				$focusRevision = new DocumentRevision();
				$focusRevision->retrieve($_REQUEST['id']);

				if (empty($focusRevision->id)) {
					// This wasn't a document revision id, it's probably actually a document id,
					// we need to grab the latest revision and use that
					$focusRevision->retrieve($focus->document_revision_id);

					if (!empty($focusRevision->id)) {
						$_REQUEST['id'] = $focusRevision->id;
					}
				}
			}
			// See if it is a remote file, if so, send them that direction
			if (isset($focus->doc_id) && !empty($focus->doc_id) && $focus->doc_type == 'Google') {
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
				try {
					//echo $focus->doc_id; 
					$response = $service->files->get($focus->doc_id);
					$ext = $response['fileExtension'];
					$name=$focus->document_name;
					$id=$focus->id;
					$comb_name=$name.$id.".".$ext;
					return $comb_name; 	
				} catch (Google_Exception $e) {
					return array(
						'success' => false,
						'errorMessage' => 'File Download Fail.' . $e->getMessage(),
					);
				}
			}else if (isset($focus->doc_url) && !empty($focus->doc_url)) {
				// header('Location: ' . $focus->doc_url);
				/* sugar_die("Remote file detected, location header sent."); */
			}
			
			if (isset($focusRevision) && isset($focusRevision->doc_url) && !empty($focusRevision->doc_url)) {
				// header('Location: ' . $focusRevision->doc_url);
				/* sugar_die("Remote file detected, location header sent."); */
			}

		} // if
		$temp = explode("_", $_REQUEST['id'], 2);
		if (is_array($temp) && sizeof($temp) > 1) {
			$image_field = $temp[1];
			$image_id = $temp[0];
		}
		if (isset($_REQUEST['ieId']) && isset($_REQUEST['isTempFile'])) {
			$local_location = sugar_cached("modules/Emails/{$_REQUEST['ieId']}/attachments/{$_REQUEST['id']}");
		} elseif (isset($_REQUEST['isTempFile']) && $file_type == "import") {
			$local_location = "upload://import/{$_REQUEST['tempName']}";
		} else {
			$local_location = "upload://{$_REQUEST['id']}";
		}

		if (isset($_REQUEST['isTempFile']) && ($_REQUEST['type'] == "SugarFieldImage")) {
			$local_location = "upload://{$_REQUEST['id']}";
		}

		if (isset($_REQUEST['isTempFile']) && ($_REQUEST['type'] == "SugarFieldImage") && (isset($_REQUEST['isProfile'])) && empty($_REQUEST['id'])) {
			$local_location = "include/images/default-profile.png";
		}
		if (isset($focus->doc_url) && !empty($focus->doc_url) && $focus->doc_type == 'Local') {
			$local_location = $focus->doc_url;
		}
		
		if (!file_exists($local_location) || strpos($local_location, "..")) {
			return false;
		} else {
			$doQuery = true;

			if ($file_type == 'documents') {
				// cn: bug 9674 document_revisions table has no 'name' column.
				$query = "SELECT filename name FROM document_revisions INNER JOIN documents ON documents.id = document_revisions.document_id ";
				$query .= "WHERE document_revisions.id = '" . $db->quote($_REQUEST['id']) . "' ";
			} elseif ($file_type == 'kbdocuments') {
				$query = "SELECT document_revisions.filename name	FROM document_revisions INNER JOIN kbdocument_revisions ON document_revisions.id = kbdocument_revisions.document_revision_id INNER JOIN kbdocuments ON kbdocument_revisions.kbdocument_id = kbdocuments.id ";
				$query .= "WHERE document_revisions.id = '" . $db->quote($_REQUEST['id']) . "'";
			} elseif ($file_type == 'notes') {
				$query = "SELECT filename name, file_mime_type FROM notes ";
				$query .= "WHERE notes.id = '" . $db->quote($_REQUEST['id']) . "'";
			} elseif (!isset($_REQUEST['isTempFile']) && !isset($_REQUEST['tempName']) && isset($_REQUEST['type']) && $file_type != 'temp' && isset($image_field)) { //make sure not email temp file.
				$file_type = ($file_type == "employees") ? "users" : $file_type;
				//$query = "SELECT " . $image_field ." FROM " . $file_type . " LEFT JOIN " . $file_type . "_cstm cstm ON cstm.id_c = " . $file_type . ".id ";

				// Fix for issue #1195: because the module was created using Module Builder and it does not create any _cstm table,
				// there is a need to check whether the field has _c extension.
				$query = "SELECT " . $image_field . " FROM " . $file_type . " ";
				if (substr($image_field, -2) == "_c") {
					$query .= "LEFT JOIN " . $file_type . "_cstm cstm ON cstm.id_c = " . $file_type . ".id ";
				}
				$query .= "WHERE " . $file_type . ".id= '" . $db->quote($image_id) . "'";

				//$query .= "WHERE " . $file_type . ".id= '" . $db->quote($image_id) . "'";
			} elseif (!isset($_REQUEST['isTempFile']) && !isset($_REQUEST['tempName']) && isset($_REQUEST['type']) && $file_type != 'temp') { //make sure not email temp file.
				$query = "SELECT filename name FROM " . $file_type . " ";
				$query .= "WHERE " . $file_type . ".id= '" . $db->quote($_REQUEST['id']) . "'";
			} elseif ($file_type == 'temp') {
				$doQuery = false;
			}
			// Fix for issue 1506 and issue 1304 : IE11 and Microsoft Edge cannot display generic 'application/octet-stream' (which is defined as "arbitrary binary data" in RFC 2046).
			if (isset($focus->doc_url) && !empty($focus->doc_url) && $focus->doc_type == 'Local') {
				$doQuery = $query = false;
				$name = $focus->id.'_'.$focus->document_name;
				$download_location  = $local_location;
			}
			$mime_type = mime_content_type($local_location);
			if ($mime_type == null || $mime_type == '') {
				$mime_type = 'application/octet-stream';
			}

			if ($doQuery && isset($query)) {
				$rs = $GLOBALS['db']->query($query);
				$row = $GLOBALS['db']->fetchByAssoc($rs);

				if (empty($row)) {
					// die($app_strings['ERROR_NO_RECORD']);
				}

				if (isset($image_field)) {
					$name = $row[$image_field];
				} else {
					$file_name= explode(".",$row['name']);
					// print"<pre>";print_r($file_name);die;
					$name = $file_name[0].'_'.$_REQUEST['id'];
					if(!empty($file_name[1]))
						$name .= '.'.$file_name[1];
				}
				// expose original mime type only for images, otherwise the content of arbitrary type
				// may be interpreted/executed by browser
				if (isset($row['file_mime_type']) && strpos($row['file_mime_type'], 'image/') === 0) {
					$mime_type = $row['file_mime_type'];
				}
				if (isset($_REQUEST['field'])) {
					$id = $row[$id_field];
					$download_location = "upload://{$id}";
				} else {
					$download_location = "upload://{$_REQUEST['id']}";
				}

			} else {
				if (isset($_REQUEST['tempName']) && isset($_REQUEST['isTempFile'])) {
					// downloading a temp file (email 2.0)
					$download_location = $local_location;
					$name = isset($_REQUEST['tempName']) ? $_REQUEST['tempName'] : '';
				} else {
					if (isset($_REQUEST['isTempFile']) && ($_REQUEST['type'] == "SugarFieldImage")) {
						$download_location = $local_location;
						$name = isset($_REQUEST['tempName']) ? $_REQUEST['tempName'] : '';
					}
				}
			}
			if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT'])) {
				$name = urlencode($name);
				$name = str_replace("+", "_", $name);
			}
			$name = ht_remove_special_chars($name);
			$file = file_get_contents($download_location);
				
			// file_put_contents('test/'.$name, $file);
			return $name;	
		}
	}
	
	function download_zip($file_name){
		$base_name = basename($file_name);

		ini_set('zlib.output_compression','Off');

		if(isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT'])) {
		 $base_name = urlencode($base_name);
		 $base_name = str_replace("+", "_", $base_name);
		}

		header("Pragma: public");
		header("Cache-Control: maxage=1, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"".$base_name."\";");
		// disable content type sniffing in MSIE
		header("X-Content-Type-Options: nosniff");
		header("Content-Length: " . filesize($file_name));
		header("Expires: 0");

		@ob_end_clean();
		ob_start();
		readfile($file_name);
		@ob_flush();
	}
function checkExt($ext)
{
	$selected_modules_types = explode(',', $_REQUEST['selected_modules_types']);
	foreach($selected_modules_types as $types)
	{
		if($types == $ext)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}