<?php

if(ACLController::checkAccess('Tasks', 'edit', true)) {
   $module_menu[] = array(
       "index.php?module=AOR_Reports&action=tasksPerCaseNotDone",
       'Tasks by Case that are not Done', 
       "List" 
    );
	
}