<?php
if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');

class ht_timesheetLogicHook {
	
    function updateDayField(&$bean, $event, $arguments) {
        // before_save
        if (!empty($bean->work_date) && $bean->work_date != $bean->fetched_row['work_date']) {
            $bean->day = date('l', strtotime($bean->work_date));;
        }
    }
}


?>