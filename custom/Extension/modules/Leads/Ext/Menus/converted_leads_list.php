<?php

if(ACLController::checkAccess('Leads', 'list', true)) {
   $module_menu[] = array(
       "index.php?module=Leads&action=index&archive_leads_basic=true&clear_query=true",
       'Archived Leads', 
       'List' 
    );
	
}
