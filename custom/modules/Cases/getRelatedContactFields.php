<?php
ob_clean();
$bean = BeanFactory::getBean('Contacts', $_REQUEST['related_id']);

$related_contact_fields = array(
	'judge_assistant_c' =>  $bean->assistant,
	'judge_asst_phone_c' => $bean->assistant_phone,
	'judge_web_page_c' =>   $bean->judge_web_page_c,
	'judge_asst_email_c' => $bean->email1,
);

echo json_encode($related_contact_fields);die;