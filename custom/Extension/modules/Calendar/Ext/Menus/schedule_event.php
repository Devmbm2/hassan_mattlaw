<?php

   if(ACLController::checkAccess('FP_events', 'edit', true))$module_menu[]=Array("index.php?module=FP_events&action=EditView&return_module=FP_events&return_action=DetailView", $mod_strings['LNK_NEW_MEETING'],"Create", 'FP_events');