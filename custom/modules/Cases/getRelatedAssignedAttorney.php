<?php
ob_clean();
$bean = BeanFactory::getBean('Users', $_REQUEST['related_id']);
/* print"<pre>";print_r($bean);die; */
if(isset($bean->default_assistant_id) && !empty($bean->default_assistant_id)){
	$user = BeanFactory::getBean('Users', $bean->default_assistant_id);
}
$related__fields = array(
	'default_assistant_name' =>  $user->name,
	'default_assistant_id' => $bean->default_assistant_id,
);

echo json_encode($related__fields);die;