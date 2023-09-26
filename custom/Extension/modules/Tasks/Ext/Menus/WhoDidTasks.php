<?php

if(ACLController::checkAccess('Tasks', 'list', true)) {
   $module_menu[] = array(
       "index.php?module=AOR_Reports&action=WhoDidTasks",
       'Last Week Tasks Done And Assigned Days', 
	   "List"
    );
	
}