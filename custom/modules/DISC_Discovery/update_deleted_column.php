<?php
class updateFieldsOnDelete {
	function update_deleted_column($bean, $event, $arguments){
		 
		global $db;
            $GLOBALS['log']->fatal(('logic hook called'));
		$sql = 	"UPDATE quality_control_remarks SET deleted = 1  WHERE module_name='Discovery' AND record_id = '{$bean->id}'";
        $result = $db->query($sql, true);
       
		}
	}

