<?php
require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
// print_r("<pre>");
 // print_r($_REQUEST['tmp']);
 // foreach($_REQUEST['selected_modules'] as $subpanel_name){
 // 	echo $subpanel_name;
 // }
 	$module = $_REQUEST['module'];
	$parent_bean = BeanFactory::getBean($module, $_REQUEST['record']);
	// print_r('<pre>');print_r($_REQUEST['module']);die();
	if($parent_bean->id == '70995c53-c3a3-ac22-3000-5f06197fb2f7'){
		$download_file_name = 'Felenna Acosta McCullough';
	}
	else{
		$download_file_name = $parent_bean->name;
	}
    $selected_records = explode(',', $_REQUEST['tmp'][0]);
     print_r($selected_records);
    $selected_modules = explode(',', $_REQUEST['selected_modules'][0]);
     print"<pre>asd";print_r($selected_modules);
    $temp_files = array();
    $list_files = array();
    $print_files = array();
    $empty_file = array();
    // $empty_file_Emails = array();
	$related_modules_data = array();
	$module_name = substr($_REQUEST['module'], 0, -1);
	$date =   date("d/m/Y");
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
	foreach($related_modules_data AS $subpanel_name => $record){
		foreach($record AS $data){
			$_REQUEST['id'] = $data['record_id'];
			$_REQUEST['type'] = $data['record_type'];
			$getrevise_id = BeanFactory::getBean('Documents', $_REQUEST['id']);
			if($getrevise_id->hard_or_soft_doc == 'Soft_Documents' || $getrevise_id->hard_or_soft_doc == 'Hard_Documents')
			{
			$revise_id = $getrevise_id->document_revision_id;
				if(isset($getrevise_id->doc_id) && !empty($getrevise_id->doc_id) && $getrevise_id->doc_type == 'Google'){
					$revise_id = $getrevise_id->id;
				}
			}
			else
			{
			$getrevise_id = BeanFactory::getBean($data['record_type'], $_REQUEST['id']);
			$revise_id = $getrevise_id->id;
			}
			foreach($selected_records AS $file_name){
			if(strpos($file_name, $revise_id) !== false) {
				$list_files[$subpanel_name][] = $temp_files[$subpanel_name][] =  $file_name;
				$print_files[$data['record_type']][] = $_REQUEST['id'];
				$file_name = store_files();
				if(empty($file_name)){
						$empty_file[$subpanel_name][] = $_REQUEST['id'];
				}
			}

		}

		}
	}
	$zip = new ZipArchive;
	$zip_file_name = $download_file_name.'.zip';
	if ($zip->open($zip_file_name, ZipArchive::CREATE) === TRUE)
	{
		if(!empty($list_files)){
			foreach($list_files AS $subpanel_name => $files){
				if($zip->addEmptyDir($subpanel_name)) {
					foreach($files AS $file_name){
						$zip->addFile('test/'.$file_name, $subpanel_name.'/'.$file_name);
					}
				
				} 
		if($subpanel_name == 'Notes' || $subpanel_name == 'Emails' || $subpanel_name == 'Calls'){	
			$html = ' <div style="overflow: hidden;margin-bottom:10px;">
			            <div style="float: left; padding:2px; font-size:14px;"><b>' . $module_name . '&nbsp;Name:</b> ' . $download_file_name . '</div>
			            <div style="float: right; padding:3px;font-size:14px;"><b>Date:</b> ' . $date . '</div>
			        	</div>
			            <table autosize = "0" border=1 style="width: 100%; border-collapse: collapse; overflow: wrap;"  id="close_cases_pdf" class="table table-bordered table-responsive">
						<tbody>
						<thead>
						<tr style="font-weight:bold;font-size:18px;" >
								<td style="font-weight: bold; text-align: left;width:20%;"><span style="font-size: 14px;"><strong>Subject</strong></span></td>
								<td style="font-weight: bold; text-align: left;width:60%; "><span style="font-size: 14px;"><strong>Description</strong></span></td>
								<td style="font-weight: bold; text-align: left;width:20%;"><span style="font-size: 14px;"><strong>Created at</strong></span></td>
							</tr>
							</thead>';
			if($subpanel_name == 'Notes'){
				foreach($empty_file as $bean_name => $ids) 
				{
					foreach($ids AS $id){
						if($bean_name == 'Notes'){
						$noteBean = BeanFactory::getBean($bean_name, $id);
							$html .='<tr>
							<td style="text-align: left;"><span style="font-size: 12px;">'.$noteBean->name.'</span></td>';
						if(strlen($noteBean->description)<7500){
							$html .= '<td style="text-align: left; "><span style="font-size: 14px;">'.$noteBean->description.'</span></td>';
						}
						else{
							$html .= '<td style="text-align: left; "><span style="font-size: 12px;">'.$noteBean->description.'</span></td>';
						}
							$html .= '<td style="text-align: left;"><span style="font-size: 12px;">' . $noteBean->date_entered . '</span></td>
							</tr>';
						}
							
					}
				}
				$pdf_file_name = 'AllNotes.pdf';
			}
			if($subpanel_name == 'Emails'){
				foreach($empty_file as $bean_name => $ids) 
				{
					foreach($ids AS $id){
					if($bean_name == 'Emails'){
					$emailBean = BeanFactory::getBean($bean_name, $id);
						$html .='<tr>
							<td style="text-align: left;width:20%;"><span style="font-size: 12px;">'.$emailBean->name.'</span></td>';
					$description_txt = strip_tags($emailBean->description_html);
					if(strlen($emailBean->description_html)<7500){
							$html .= '<td style="text-align: left;width:60%; "><span style="font-size: 14px;">'.$emailBean->description.'</span></td>';
						}
					else{
						$stringCut = substr($description_txt, 0, 500);
    					$endPoint = strrpos($stringCut, ' ');
    					$description = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
						$html .= '<td style="text-align: left;width:60%; "><span style="font-size: 14px;">'.$description.'</span></td>';
					}	
							$html .= '<td style="text-align: left;width:20%;"><span style="font-size: 12px;">' . $emailBean->date_entered . '</span></td>
							</tr>';
						}
							
						}
					}
					$pdf_file_name = 'AllEmails.pdf';
				}
				if($subpanel_name == 'Calls'){
				foreach($empty_file as $bean_name => $ids) 
				{
					foreach($ids AS $id){
					if($bean_name == 'Calls'){
					$callBean = BeanFactory::getBean($bean_name, $id);
						$html .='<tr>
							<td style="text-align: left;"><span style="font-size: 12px;">'.$callBean->name.'</span></td>';
						if(strlen($callBean->description)<7500){
							$html .= '<td style="text-align: left; "><span style="font-size: 14px;">'.$callBean->description.'</span></td>';
						}
						else{
							$html .= '<td style="text-align: left; "><span style="font-size: 12px;">'.$callBean->description.'</span></td>';
						}
							$html .= '<td style="text-align: left;"><span style="font-size: 12px;">' . $callBean->date_entered . '</span></td>
							</tr>';
						}
							
						}
					}
					$pdf_file_name = 'AllCalls.pdf';
				}
				$html .= '</tbody></table>';
				try {
					$pdf = new mPDF('en', 'A4', '12', 'DejaVuSansCondensed', 10, 10, 16, 16, 9, 9);
					$pdf->SetHTMLHeader($header);
					$pdf->AddPage('P');
					$pdf->WriteHTML($html);
					// $pdf->SetDisplayMode(150);	
					$file_name_notes = $pdf_file_name; 
					$pdf->Output('test/'.$file_name_notes, 'F'); 
					$pdf->shrink_tables_to_fit = 0;
					// $list_files[$subpanel_name][] = $file_name;
				} catch (Exception $e) {
					echo 'An error occurred: ' . $e->getMessage();
				}
				$zip->addFile('test/'.$file_name_notes, $subpanel_name.'/'.$file_name_notes);
			}
			
			}
			$print_html = ' <div style="overflow: hidden;margin-bottom:10px;">
			            <div style="float: left; padding:2px; font-size:14px;"><b>' . $module_name . '&nbsp;Name:</b> ' . $download_file_name . '</div>
			            <div style="float: right; padding:3px;font-size:14px;"><b>Date:</b> ' . $date . '</div>
			        	</div>
			            <table border=1 style="width: 100%; border-collapse: collapse;"  id="close_cases_pdf" class="table table-bordered table-responsive">
						<tbody>
						<thead>
						<tr style="font-weight:bold;" >
								<td style="font-weight: bold; text-align: left;width:70%;"><span style="font-size:14px; "><strong>Document Name</strong></span></td>
								<td style="font-weight: bold; text-align: left;width:15%;"><span style="font-size:14px; "><strong>Module</strong></span></td>
								<td style="font-weight: bold; text-align: left;width:15%;"><span style="font-size:14px;"><strong>Date Created</strong></span></td>
							</tr>
							</thead>';
			foreach($print_files AS $bean_name => $print_file_names){
					foreach($print_file_names AS $file_id){
						$printBean = BeanFactory::getBean($bean_name, $file_id);
					$print_html .='<tr>';
					if($bean_name == 'Notes' || $bean_name == 'Emails' || $bean_name == 'Calls'){
						$print_html .='<td style="text-align: left;width:70%;"><span style="font-size:12px;text-overflow:wrap;">'.$printBean->name.'</span></td>';
					}
					else{
						$print_html .='<td style="text-align: left;width:70%;"><span style="font-size:12px;text-overflow:wrap;">'.$printBean->document_name.'</span></td>';
					}
							$print_html .='<td style="text-align: left;width:15%;"><span style="font-size:12px;">'.$bean_name.'</span></td><td style="text-align: left;width:15%;"><span style="font-size:12px;">'.$printBean->date_entered.'</span></td>
							</tr>';
					}
		
			}
			$print_html .= '</tbody></table>';
				try {
					$pdf = new mPDF('en', 'A4', '12', 'DejaVuSansCondensed', 10, 10, 16, 16, 9, 9);
					$pdf->SetHTMLHeader($header);
					$pdf->AddPage('P');
					$pdf->WriteHTML($print_html);	
					$file_names_print = 'DownloadZipReport.pdf'; 
					$pdf->Output('test/'.$file_names_print, 'F'); 
					print_r("<pre>");print_r($pdf);
					// $list_files[$subpanel_name][] = $file_name;
				} catch (Exception $e) {
					echo 'An error occurred: ' . $e->getMessage();
				}
				$zip->addFile('test/'.$file_names_print, $file_names_print);
		}
			
		else{
			/* die('asd'); */
			$zip->addEmptyDir('No Files To Download As Zip');
		}
		
		$zip->close();

		download_zip($zip_file_name);
		$temp_files[] = $zip_file_name;
	}
	foreach ($temp_files as $temp_file) {
		if ($temp_file && is_file($temp_file) && is_writable($temp_file) ) {
			unlink ($temp_file);
		}
	}
	if(!empty($list_files)){
			foreach($list_files AS $subpanel_name => $files){
					foreach($files AS $file_name){
						unlink('test/'.$file_name);
					}
			}
			unlink('test/'.$file_name_notes);
			unlink('test/'.$file_names_print);
		}
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
					$name = ht_remove_special_chars($comb_name);
					$file = file_get_contents($response['webContentLink']);		
					file_put_contents('test/'.$name, $file);
				//	die;
					return $name;	 	
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
			file_put_contents('test/'.$name, $file);
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