<?php

if(ACLController::checkAccess('Cases', 'edit', true)) {
   $module_menu[] = array(
       "index.php?module=DHA_PlantillasDocumentos&action=generate_doc_wizard",
       'Generate Document Templates', 
       'Cases' 
    );
	
}