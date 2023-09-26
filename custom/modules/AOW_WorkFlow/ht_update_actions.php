<?php
	global $db;
	$sql = " SELECT
		*
	FROM
		aow_actions
	WHERE
		#aow_workflow_id = '8735ff52-225d-27d4-ceed-5db03dc1a822'
		#name LIKE '%Send defense our letter offering 5 dates to depose%'
		id IN  (SELECT aow_action_id FROM `aow_action_records` 
			WHERE action_record_id = '423610a5-a204-b3f1-366d-5dc9a534f021')
	AND deleted = 0
	ORDER BY action_order;";
	//4bab2a8a-9223-1073-6e38-5db939adcca8
	$result = $db->query($sql);
	while ($row = $db->fetchByAssoc($result)) {
		$action_id = $row['id'];
		$parameters = unserialize(base64_decode($row['parameters']));
print"<pre>";print_r($row);
print"<pre>";print_r($parameters);die;
		$parameters['value']['2'] = array(
			'pre_trial_conference_hearing_c',
            'minus',
            91,
            'day',
		);
		$parameters['value']['3'] = array(
			'pre_trial_conference_hearing_c',
            'minus',
            90,
            'day',
		);
// print"<pre>";print_r($parameters);die;
		// $parameters['field'][] = 'created_by_name';
		// $parameters['field'][] = 'modified_by_name';
		// $parameters['value_type'][] = 'Value';
		// $parameters['value_type'][] = 'Value';
		// $parameters['value'][] = '65a4acb2-4400-0405-77ef-5dbac89ce6a6';
		// $parameters['value'][] = '65a4acb2-4400-0405-77ef-5dbac89ce6a6';
		// foreach($parameters['field'] AS $field_index => $field_val){
			// if($field_val == 'date_start' || $field_val == 'date_due'){
		
				// $parameters['value'][$field_index][0] = 'pre_trial_conference_hearing_c';
			// }
		// }
		$params= base64_encode(serialize($parameters));
		// $db->query("UPDATE `aow_actions` SET `parameters`='{$params}' WHERE (`id`='{$action_id}') LIMIT 1");
	}
	
	echo 'Done';