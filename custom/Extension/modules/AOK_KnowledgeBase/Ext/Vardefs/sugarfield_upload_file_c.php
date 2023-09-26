<?php
 // created: 2020-04-16 03:45:16
$dictionary['AOK_KnowledgeBase']['fields']['upload_file_c']['inline_edit']= '1';
$dictionary['AOK_KnowledgeBase']['fields']['upload_file_c']['labelValue']= 'Upload File';
$dictionary['AOK_KnowledgeBase']['fields']['upload_file_c']['type']= 'file';
$dictionary['AOK_KnowledgeBase']['fields']['upload_file_c']['dbType'] = 'varchar';

$dictionary['AOK_KnowledgeBase']['fields']['file_mime_type'] =  array (
  'name' => 'file_mime_type',
  'vname' => 'LBL_FILE_MIME_TYPE',
  'type' => 'varchar',
  'len' => '100',
  'comment' => 'Attachment MIME type',
  'importable' => false,
);
$dictionary['AOK_KnowledgeBase']['fields']['file_url'] = array (
  'name' => 'file_url',
  'vname' => 'LBL_FILE_URL',
  'type' => 'function',
  'function_class' => 'UploadFile',
  'function_name' => 'get_upload_url',
  'function_params' => 
  array (
	0 => '$this',
  ),
  'source' => 'function',
  'reportable' => false,
  'comment' => 'Path to file (can be URL)',
  'importable' => false,
);