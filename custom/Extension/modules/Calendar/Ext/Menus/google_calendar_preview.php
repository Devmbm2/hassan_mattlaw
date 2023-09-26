<?php

   if(ACLController::checkAccess('FP_events', 'edit', true))$module_menu[]=Array("index.php?module=FP_events&action=Googlepreview&return_module=FP_events&return_action=DetailView", $mod_strings['LNK_GOOGLE_CALENDAR'],"Create", 'FP_events');