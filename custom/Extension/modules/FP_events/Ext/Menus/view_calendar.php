<?php

if(ACLController::checkAccess('FP_events', 'list', true)) {
   $module_menu[1] = array(
       "index.php?module=Calendar&action=index",
       'View Calendar', 
	   "List",
       'FP_events' 
    );
	
}

