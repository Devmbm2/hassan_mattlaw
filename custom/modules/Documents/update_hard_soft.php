<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
	ini_set('display_errors','off'); 
	error_reporting(E_ALL); // STRICT DEVELOPMENT
	global $db;
	
	// $sql = "UPDATE `documents` SET hard_or_soft_doc = subcategory_id WHERE subcategory_id = 'Hard_Documents' OR subcategory_id = 'Soft_Documents' ";
	// $db->query($sql,true);
	$row = 1;
	$count = 1;
	
	$file_name = "custom/modules/Documents/Correspondence Hard Docs to be saved into Cases.csv";
	if (($handle = fopen($file_name, "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
			if($row == 1) {
				$row++;
				continue;
			}
			// print"<pre>123 ";print_r($data);die;
			$stat = $data['7'];
			if(isset($stat)){
				$pathBySlash = array_values(explode('\\', $stat));
				if(!empty($pathBySlash[2]) && !empty($pathBySlash[4])){
					$case_bean = BeanFactory::getBean('Cases')->retrieve_by_string_fields(array('name'=>$pathBySlash[2])); 
					if(!empty($case_bean)){
						$id = uploadDocument($case_bean, $pathBySlash[4], $data);
						print"<pre><b>  success = ";print_r($count."</b> = ");print_r($id);print"</pre>";
					}
					$count++;
				}
			}
			$row++;
		}
		fclose($handle);
	}
	
function uploadDocument(&$parent_bean, $NoteFileName, $data ){
	
	global $sugar_config, $db, $current_user;
	
	$ext = strtolower(pathinfo($NoteFileName, PATHINFO_EXTENSION));
	if ($ext == 'pdf'){
		$hard_or_soft_doc = 'Hard_Documents';
	}else if ($ext == 'docx'|| $ext == 'doc'){
		$hard_or_soft_doc = 'Soft_Documents';
	}
	$sql = "(SELECT documents.id , documents_cstm.publish_date_c,  documents.document_name ,  documents.category_id ,  documents.status_id ,  documents.document_revision_id ,  documents.assigned_user_id  ,  'Hard_Documents' panel_name  FROM documents  LEFT JOIN documents_cstm ON documents.id = documents_cstm.id_c  INNER JOIN  documents_cases ON documents.id=documents_cases.document_id AND documents_cases.case_id='{$parent_bean->id}' AND documents_cases.deleted=0

	where ( documents.hard_or_soft_doc = 'Hard_Documents' ) AND documents.deleted=0 AND documents.document_name = '{$NoteFileName}') ORDER BY documents.id asc ";
	$result = $db->query($sql);
    $row = $db->fetchByAssoc($result);
	$found = 'no';
	if(!empty($row)){
		$found = 'yes';
		$Document = BeanFactory::getBean('Documents',$row['id']);
	}else{
		$Document = BeanFactory::getBean('Documents');
	}
	$doc_type = 'Local';
	$Document->hard_or_soft_doc = $hard_or_soft_doc;
	$Document->modified_user_id = $current_user->id;
	$Document->created_by = $current_user->id;
	$Document->name = $NoteFileName;
	$Document->document_name = $NoteFileName;
	$Document->doc_url = $data['7'];
	$Document->parent_type = $parent_bean->module_dir;
	$Document->doc_type = $doc_type ;
	$Document->date_entered = $data['3'];
	$Document->date_modified = $data['3'];
	$Document->filename = $NoteFileName;
	$Document->authors_name_c = $data['10'];
	$Document->category_id = $data['8'];
	$Document->description = $data['5'];
	$sub_type = array(
		'AUTH' => 'Authorizations',
		// 'AAA' => 'Authorizations',
		'CORR' => 'Correspondence',
	);
	$Document->subcategory_id = $sub_type[$data['4']];
	$Document->date_of_document_c = $data['3'];
	$DocumentId = $Document->save();
	$id = create_guid();
	if($found == 'no'){
		$sql = "INSERT INTO documents_cases (id, date_modified, deleted, document_id, case_id) VALUES ('{$id}', NOW(), 0, '{$DocumentId}','{$parent_bean->id}' )";
		$db->query($sql);
	}
	return array($DocumentId,$found);
}
function includeTrailingCharacter($string, $character) {
	if (strlen($string) > 0) {
		if (substr($string, -1) !== $character) {
			return $string . $character;
		} else {
			return $string;
		}
	} else {
			return $character;
	}
}
function get_mime_type($extension)
{

        // our list of mime types
        $mime_types = array(
                "pdf"=>"application/pdf"
                ,"exe"=>"application/octet-stream"
                ,"zip"=>"application/zip"
                ,"docx"=>"application/msword"
                ,"doc"=>"application/msword"
                ,"xls"=>"application/vnd.ms-excel"
                ,"ppt"=>"application/vnd.ms-powerpoint"
                ,"gif"=>"image/gif"
                ,"png"=>"image/png"
                ,"jpeg"=>"image/jpg"
                ,"jpg"=>"image/jpg"
                ,"mp3"=>"audio/mpeg"
                ,"wav"=>"audio/x-wav"
                ,"mpeg"=>"video/mpeg"
                ,"mpg"=>"video/mpeg"
                ,"mpe"=>"video/mpeg"
                ,"mov"=>"video/quicktime"
                ,"avi"=>"video/x-msvideo"
                ,"3gp"=>"video/3gpp"
                ,"css"=>"text/css"
                ,"jsc"=>"application/javascript"
                ,"js"=>"application/javascript"
                ,"php"=>"text/html"
                ,"htm"=>"text/html"
                ,"html"=>"text/html"
        );
		return $mime_types[$extension];
}
	

