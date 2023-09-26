<?php

class UpdateCustomFields {
	function update_custom_fields($bean, $event, $arguments)
	{
		global $db;
		
		/*if($bean->fetched_row['new_case_number_c'] != $bean->new_case_number_c){
			$db->query(" UPDATE cases_cstm SET new_case_number_c = '{$bean->new_case_number_c}' WHERE id_c = '{$bean->id}' ");
		}*/
		if($bean->fetched_row['date_of_incident_c'] != $bean->date_of_incident_c){
			$db->query(" UPDATE cases SET date_of_incident_c = '{$bean->date_of_incident_c}'  WHERE id = '{$bean->id}' ");
		}
		
	}
}

