<?php

if(ACLController::checkAccess('FP_events', 'list', true)) {
   $module_menu[] = array(
       "index.php?module=AOR_Reports&action=DetailView&record=e53d48b4-de2d-d4ed-c1d5-6012ce237bfd",
       'View Hold Events', 
	   "List",
       'FP_events' 
    );
	
}

