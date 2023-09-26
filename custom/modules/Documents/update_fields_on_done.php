<?php
class updateFieldsOnDone {
	function update_fields_on_done($bean, $event, $arguments){
		//if(($bean->fetched_row['outgoing_document'] != $bean->outgoing_document) && $bean->outgoing_document){
		if($bean->outgoing_document == 1){
			$bean->hd_reviewed_date = $GLOBALS['timedate']->nowDbDate();
			$bean->hd_reviewed_by = $GLOBALS['current_user']->id;
		}
	}
}
