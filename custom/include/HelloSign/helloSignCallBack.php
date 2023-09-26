<?php
	ini_set('display_errors','on'); error_reporting(E_ALL); // STRICT DEVELOPMENT
	if(!empty($_REQUEST['signature_id'])){
		$signature_id = $_REQUEST['signature_id'];
		$hSignBean = BeanFactory::newBean('ht_hello_sign');
		$beanList = $hSignBean->retrieve_by_string_fields(
                                array('signature_id' => $signature_id)
                              );
		$beanList->signed = '1';
		$beanList->save();
		echo '<h3>Thank you for Signing the Document</h3>';
	}