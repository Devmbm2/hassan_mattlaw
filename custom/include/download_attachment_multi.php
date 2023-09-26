<?php
	if (!defined('sugarEntry') || !sugarEntry) {
		die('Not A Valid Entry Point');
	}
	global $db, $sugar_config, $app_list_strings;
	if ((!isset($_REQUEST['isProfile']) &&  empty($_REQUEST['uid'])) || empty($_REQUEST['module']) || !isset($_SESSION['authenticated_user_id'])) {
		die("Not a Valid Entry Point");
	} else {
		$records = $_REQUEST['uid'];
		$_REQUEST['type'] = $_REQUEST['module'];
		$download_file_name = $app_list_strings['moduleList'][$_REQUEST['module']];
		$records = explode(',', $records);
		$temp_files = array();
		$list_files = array();
		
		foreach($records AS $record){
			$_REQUEST['id'] = $record;
			$file_name = store_files();
			if($file_name) {
				$list_files[] = $temp_files[] =  $file_name;
			}
		}
		/* print"<pre>";print_r($list_files);die; */
		if(isset($_REQUEST['merge'])){
			try{
				require_once('custom/include/PDFMerger/PDFMerger.php');
				$pdf = new PDFMerger;
				foreach($list_files AS $file_name){
					$pdf->addPDF('test/'.$file_name);
				}
				// $view_file = 'test/'.$download_file_name.'.pdf';
				$view_file = $download_file_name.'.pdf';
				$pdf->merge('download', $view_file);
				// $pdf->merge('file', $_SERVER['DOCUMENT_ROOT'] .$view_file);
				// die($_SERVER['DOCUMENT_ROOT'] .$view_file);
				// header('Location: pdf_viewer/index.html?file=/'.$view_file);
			} catch (Exception $e) {
				echo $e->getMessage();
				die;
			}
		}else{
			$zip = new ZipArchive;
			$zip_file_name = $download_file_name.'.zip';
			if ($zip->open($zip_file_name, ZipArchive::CREATE) === TRUE)
			{
				foreach($list_files AS $file_name){
					$zip->addFile('test/'.$file_name, $file_name);
				}
				$zip->close();
				download_zip($zip_file_name);
				$temp_files[] = $zip_file_name;
			}
		}
		foreach ($temp_files as $temp_file) {
			if ($temp_file && is_file($temp_file) && is_writable($temp_file) ) {
				unlink ($temp_file);
			}
		}
		
	}

function store_files(){
	global $db, $sugar_config, $beanList;
		require_once("data/BeanFactory.php");
		$file_type = ''; // bug 45896
		ini_set('zlib.output_compression',
			'Off');//bug 27089, if use gzip here, the Content-Length in header may be incorrect.
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
			if (isset($focus->doc_url) && !empty($focus->doc_url) && $focus->doc_type == 'Local') {
				// $local_location = "/home/admin/AAA - Soft Documents.rar";
				
				header('Location: ' . $focus->doc_url);
				// sugar_die("Remote file detected, location header sent.");
			}else if (isset($focus->doc_url) && !empty($focus->doc_url)) {
				 header('Location: ' . $focus->doc_url);
				/* sugar_die("Remote file detected, location header sent."); */
			}
			
			if (isset($focusRevision) && isset($focusRevision->doc_url) && !empty($focusRevision->doc_url)) {
				 header('Location: ' . $focusRevision->doc_url);
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
					/* print"<pre>";print_r($file_name);die; */
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
