<?php

if(ACLController::checkAccess('Cases', 'edit', true)) {
   $module_menu[] = array(
       "index.php?module=Cases&action=index&archive_cases_basic=true&clear_query=true",
       'Archived Cases', 
       'Cases' 
    );
	
}