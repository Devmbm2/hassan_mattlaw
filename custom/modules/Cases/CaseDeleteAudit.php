<?php

 if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    class casesAudit
    {
        function logAudit($bean, $event, $arguments)
        {
            $insert = "INSERT INTO cases_audit (id, parent_id, date_created, created_by, field_name, data_type, before_value_string, after_value_string, before_value_text, after_value_text)
					                   VALUES (UUID(), '{$bean->id}', NOW(), '{$GLOBALS['current_user']->id}', 'Deleted:', 'bool', '0', '1', '0', '1');";
			/* echo $insert;die; */
			$GLOBALS['db']->query($insert, true);
        }
    }