<?php
ob_clean();
ini_set('display_errors','on'); error_reporting(E_ALL); // STRICT DEVELOPMENT
global $db;
$case_id = $_REQUEST['record'];
$sql = "SELECT
	d.id as doc_id, d.document_name
FROM
	documents d
INNER JOIN documents_cases dc ON (dc.deleted = 0 AND dc.document_id = d.id)
WHERE
	d.deleted = 0 AND d.hard_or_soft_doc = 'Hard_Documents' AND dc.case_id = '{$case_id}'";
$result = $db->query($sql, true);
$related_docs = array('' => 'Select a Document');
$header = '<table style="height: 60px; width: 800px; border-spacing:-2;" id="helloSignSelection">
<tbody>

';

$stream_html = $header;
$stream_html ='<tr><td><select style="height:50%;width: 60%;" name="list_of_case_related_docs" id="list_of_case_related_docs" >';

While($row = $db->fetchByAssoc($result)){
	$related_docs[$row['doc_id']] = $row['document_name'];
	// $stream_html .='<option value='. $row['doc_id'] .'>'. $row['document_name'] .'</option>';	
}
$stream_html .='</select></td></tr>';
$sql = "SELECT
	c.id as contact_id, CONCAT(c.first_name,' ',c.last_name) AS contact_name
FROM
	contacts c
INNER JOIN contacts_cases cc ON (cc.deleted = 0 AND cc.contact_id = c.id)
WHERE
	c.deleted = 0 AND cc.case_id = '{$case_id}'";
$result = $db->query($sql, true);
$related_contacts = array('' => 'Select a Contact');
$stream_html .='<tr><td><select style="height:50%;width: 60%;" name="list_of_case_related_contacts" id="list_of_case_related_contacts" >';
While($row = $db->fetchByAssoc($result)){
	$related_contacts[$row['contact_id']] = $row['contact_name'];
	// $stream_html .='<option value='. $row['contact_id'] .'>'. $row['contact_name'] .'</option>';	
}
$stream_html .='</select></td></tr>';

	$stream_html .='<tr><td><input type="button" id = "send_for_signature" value="Send for Signature" onclick="send_doc_for_signature(\''.$case_id.'\');"></td></tr></tbody>
</table>';
echo json_encode(array(
	'doc_list' => convertArrayToITL($related_docs, false),
	'contact_list' => convertArrayToITL($related_contacts, false) 
));die;
echo $stream_html;die;