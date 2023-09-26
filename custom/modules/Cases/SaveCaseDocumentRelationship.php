<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
	require_once('include/utils/sugar_file_utils.php');
	require_once('modules/DHA_PlantillasDocumentos/librerias/dharma_utils.php');
	error_reporting(E_ALL); // STRICT DEVELOPMENT
	$dir = '/home/admin';
	$cdir = scandir($dir); 
	$zip_folder_list = array('PS1');
	$count = 1;
	foreach ($cdir as $key => $value) 
	{ 
		$file_info = pathinfo($value);
		$fileName = $file_info['filename'];
		if($fileName != '' && $fileName != '.' && in_array($fileName,$zip_folder_list)){
			$ext = strtolower($file_info['extension']);
			$zip_file = $dir."/".$value;
			$zip = new ZipArchive;
			if ($zip->open($zip_file) === TRUE) {
				for( $i = 0; $i < $zip->numFiles; $i++ ){ 
					$stat = $zip->getNameIndex( $i ); 
					if(isset($stat)){
						$pathBySlash = array_values(explode('/', $stat));
						if(!empty($pathBySlash[1]) && !empty($pathBySlash[2]) && !empty($pathBySlash[3])){
							$case_bean = BeanFactory::getBean('Cases')->retrieve_by_string_fields(array('name'=>$pathBySlash[1])); 
							if($pathBySlash[2] == 'AAA'){
								$id = uploadDocument($case_bean, $pathBySlash[3], $zip, $stat);
								print"<pre><b>  success = ";print_r($count."</b> = ".$id);print"</pre>";
								$count++;
							}
						}
					}
				}
				die;
				$zip->close();
			} else {
				print"<pre>failed = ";print_r($count." = ".$fileName);print"</pre>";
				echo 'failed';
			}
		}
	}
	die;

function uploadDocument(&$parent_bean, $NoteFileName, &$zip, $fil_zip_address){
	global $sugar_config, $db, $current_user;
	$doc_found = BeanFactory::getBean('Documents')->retrieve_by_string_fields(array('document_name'=>$NoteFileName));
	if(isset($doc_found->id)){
		return $doc_found->id;
	}
	$Document = BeanFactory::getBean('Documents');
	$doc_type = 'Sugar';
	$ext = strtolower(pathinfo($NoteFileName, PATHINFO_EXTENSION));
	if ($ext == 'pdf'){
		$Document->hard_or_soft_doc = 'Hard_Documents';
	}else if ($ext == 'docx'|| $ext == 'doc'){
		$Document->hard_or_soft_doc = 'Soft_Documents';
	}
	$Document->modified_user_id = $current_user->id;
	$Document->created_by = $current_user->id;
	$Document->document_name = $NoteFileName;
	$Document->parent_type = $parent_bean->module_dir;
	$Document->doc_type = $doc_type ;
	$Document->filename = $NoteFileName;
	$DocumentId = $Document->save();
	$contents = $zip->getFromName($fil_zip_address);
	$revision = new DocumentRevision;
	$revision->document_id = $DocumentId;
	$revision->file = base64_encode($contents);
	$revision->filename = $Document->filename;
	$revision->revision = 1;
	$revision->doc_type = $doc_type;
	$revision->file_ext = $ext;
	$revision->file_mime_type = get_mime_type($ext);
	$revision->save();
	$id = create_guid();
	$sql = "INSERT INTO documents_cases (id, date_modified, deleted, document_id, case_id) VALUES ('{$id}', NOW(), 0, '{$DocumentId}','{$parent_bean->id}' )";
	$db->query($sql);
	$fichero_destino = includeTrailingCharacter ($sugar_config['upload_dir'], '/') . $revision->id;
	file_put_contents($fichero_destino, $contents);
	sugar_chmod($fichero_destino);
	return $DocumentId;
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
