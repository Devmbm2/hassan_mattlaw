<?php
class lead_calculation{
	
	function lead_from_web($bean, $event, $arguments){
		if($_REQUEST['entryPoint'] == 'WebToPersonCapture'){
			$bean->created_by = '65a4acb2-4400-0405-77ef-5dbac89ce6a6';
			$bean->modified_user_id = '65a4acb2-4400-0405-77ef-5dbac89ce6a6';
			$bean->assigned_user_id = '65a4acb2-4400-0405-77ef-5dbac89ce6a6';
		}
	}
}