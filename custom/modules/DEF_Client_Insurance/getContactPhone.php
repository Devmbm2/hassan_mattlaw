<?php
ob_clean();
if(!empty($_REQUEST['related_id'])){
	$phone = '';
	$bean = BeanFactory::getBean('Contacts', $_REQUEST['related_id']);
	if(!empty($bean->phone_mobile)){
		$phone = $bean->phone_mobile;
	}else if(!empty($bean->phone_work)){
		$phone = $bean->phone_work;
	}else{
		$phone = $bean->phone_other;
	}
	echo $phone;die;
}
