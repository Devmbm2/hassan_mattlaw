<?php

if(ACLController::checkAccess('Tasks', 'edit', true)) {
   $module_menu[] = array(
       "index.php?module=AOR_Reports&action=tasksPerStatus",
       'Case Status, The number of Tasks that are to be Done', 
       "List" 
    );
	
}