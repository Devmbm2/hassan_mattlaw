<?php
class updateFieldsOnSave {
	function hd_reviewed_null($bean, $event, $arguments){
		 
		global $db;
		
		$sql = "SELECT id FROM disc_discovery WHERE id='{$bean->id}'  ";
		$record_discovery = $db->query($sql);

		if ($record_discovery->num_rows == 0) {
		 $bean->hd_reviewed_by=Null;
		 $bean->hd_reviewed_date=Null;

		}
		else{

		}
		}
	}

