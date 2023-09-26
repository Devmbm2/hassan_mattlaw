<?php
ob_clean();
$bean = BeanFactory::getBean('Contacts', $_REQUEST['related_id']);

$related_data = array(
	'phone_mobile'         => $bean->phone_mobile,
	'phone_work'        =>   $bean->phone_work


);

echo json_encode($related_data);die;