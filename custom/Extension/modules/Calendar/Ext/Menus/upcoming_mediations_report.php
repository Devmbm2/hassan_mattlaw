<?php
if(ACLController::checkAccess('Calendar', 'list', true))$module_menu[]=Array("index.php?module=AOR_Reports&action=upcoming_mediations_report", 'Upcoming Mediations', 'List', "FP_events");
