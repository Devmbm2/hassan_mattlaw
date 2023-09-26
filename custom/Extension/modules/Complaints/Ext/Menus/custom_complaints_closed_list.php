<?php

if(ACLController::checkAccess('Complaints', 'edit', true)) {
   $module_menu[] = array(
       "index.php?module=Complaints&action=index&archive_complaints_basic=true&clear_query=true",
       'Archived Complaints', 
       'Complaints' 
    );
	
}