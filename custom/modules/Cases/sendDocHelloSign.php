<?php
ob_clean();
// ini_set('display_errors','on'); error_reporting(E_ALL); // STRICT DEVELOPMENT
require_once 'custom/include/HelloSign/vendor/autoload.php';
$apikey = '68d893058f15164cdc55e51aa5ec7bf1e266ffb2918d0a8a4c343253917d47d7';
$module = 'Documents';
$_REQUEST['id'] = '443b6c85-58a2-f88f-9190-5f084dae75c7';
$focus = BeanFactory::newBean($module);
$focus->retrieve($_REQUEST['selected_doc']);
if (isset($focus->doc_url) && !empty($focus->doc_url)){
	$location = html_entity_decode($focus->doc_url, ENT_QUOTES);
}else{
	$location = "upload://{$focus->document_revision_id}";
}
try{
$contact_bean = BeanFactory::getBean('Contacts', $_REQUEST['selected_contact']);
$client = new HelloSign\Client($apikey);
$request = new HelloSign\SignatureRequest;
$request->enableTestMode();
$request->setTitle($focus->name);
$request->setSubject('Honey Law Document to Sign');
$request->setMessage('Please sign this Document');
$request->addSigner($contact_bean->email1, $contact_bean->name);
// $request->addCC('waqas@helfertech.com');
$request->setSigningRedirectUrl('http://sandbox.helfertech.net/helloSignIntegration.php');
$request->addFile($location); //Adding file from local

$response = $client->sendSignatureRequest($request);
$SignatureList = $response->getSignatures()->toArray();
foreach($SignatureList AS $signatures){
	$hSignBean = BeanFactory::newBean('ht_hello_sign');
	$hSignBean->name = $focus->name;
	$hSignBean->parent_type = $focus->module_dir;
	$hSignBean->parent_id= $focus->id;
	$hSignBean->contact_id= $contact_bean->id;
	$hSignBean->signature_id= $signatures['signature_id'];
	$hSignBean->save();
}
echo 'Signature Document '.$focus->name.' has been sent to '.$contact_bean->name.' successfully.';die;
// SugarApplication::redirect("index.php?module=Cases&action=DetailView&record=".$focus->id);
}catch(Exception $e) {
	echo $e->getMessage();
}