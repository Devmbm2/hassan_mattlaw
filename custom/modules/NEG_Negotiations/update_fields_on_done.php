<?php
class updateFieldsOnDone {
	function update_fields_on_done($bean, $event, $arguments){
		if(($bean->fetched_row['done'] != $bean->done) && $bean->done){
			$bean->hd_reviewed_date = $GLOBALS['timedate']->nowDbDate();
			$bean->hd_reviewed_by = $GLOBALS['current_user']->id;
		}
	}
}
