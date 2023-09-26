<?php

if(ACLController::checkAccess('Tasks', 'edit', true)) {
   $module_menu[] = array(
       "index.php?module=AOR_Reports&action=tasksDueDays",
       '<b>Tasks, Number of Days Over Due, Due, OR Soon to be Due</b>', 
       "List"
    );
	
}