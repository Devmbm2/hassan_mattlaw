<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class ht_task
{
	function task_overdue_days($bean, $event, $arguments){
		global $db, $timedate;
		$current_date = date('Y-m-d');
		$sql = "SELECT * FROM tasks where tasks.deleted = 0 AND tasks.id  = '{$bean->id}'";
		$result = $db->query($sql, true);
		while($row = $db->fetchByAssoc($result)){
			if(!empty($row['date_due'])){
				$due_date = date('Y-m-d', strtotime($row['date_due']));
				$diff = date_diff(date_create($due_date), date_create($current_date));
				$days = $diff->format("%R%a");
				if ($days > 0){
					$bean->no_of_days = $diff->format("%a");
				}else{
					$bean->no_of_days = 0;
				}
			}
		}
	}

}

