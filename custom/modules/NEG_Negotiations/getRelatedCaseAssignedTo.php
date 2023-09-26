<?php
	ob_clean();
	if(isset($_REQUEST['related_id']) && !empty($_REQUEST['related_id'])){
		$bean = BeanFactory::getBean('Cases', $_REQUEST['related_id']);
		$related_assigned_to = array(
			'assigned_user_id'         => $bean->assigned_user_id,
			'assigned_user_name'       => $bean->assigned_user_name,
		);
		echo json_encode($related_assigned_to);die;
	}


