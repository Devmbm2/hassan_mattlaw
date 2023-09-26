<?php
ob_clean();
if(isset($_REQUEST['related_id']) && !empty($_REQUEST['related_id'])){
	$case = BeanFactory::getBean('Cases', $_REQUEST['related_id']);
	if(!empty($case->assigned_user_id)){
		echo $case->assigned_user_id;die;
	}
}



