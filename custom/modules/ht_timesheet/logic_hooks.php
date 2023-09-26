<?php

 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(77, 'updateDayField', 'custom/modules/ht_timesheet/ht_timesheetLogicHook.php','ht_timesheetLogicHook', 'updateDayField'); 
?>