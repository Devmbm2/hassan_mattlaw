<?php
if(ACLController::checkAccess('Calendar', 'list', true))$module_menu[]=Array("index.php?module=AOR_Reports&action=upcoming_events_per_case", 'Upcoming Events per Case', 'List');
