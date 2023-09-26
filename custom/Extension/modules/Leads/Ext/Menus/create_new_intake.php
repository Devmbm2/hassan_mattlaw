<?php

if(ACLController::checkAccess('Cases', 'edit', true)) {
   $module_menu[] = array(
       "index.php?module=Home&action=intakeForm&search_module=Leads",
       'Create New Intake', 
       'Leads' 
    );
	
}