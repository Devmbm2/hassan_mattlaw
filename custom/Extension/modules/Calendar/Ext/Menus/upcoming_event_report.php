<?php
if(ACLController::checkAccess('Calendar', 'list', true))$module_menu[]=Array("index.php?module=AOR_Reports&action=upcoming_events_report", 'Upcoming Trials & Vacations Report', 'List');
