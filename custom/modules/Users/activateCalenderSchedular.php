<?php
global $db;
$search_data = $_REQUEST['search_data'];
if($search_data == 1){
    $update = "UPDATE schedulers SET status = 'Active' WHERE schedulers.job = 'function::syncCalendarEventsScheduler' AND deleted = 0";
    $GLOBALS['db']->query($update, true);
}else{
    $update = "UPDATE schedulers SET status = 'Inactive' WHERE schedulers.job = 'function::syncCalendarEventsScheduler' AND deleted = 0";
    $GLOBALS['db']->query($update, true);
}
echo 1; die();

