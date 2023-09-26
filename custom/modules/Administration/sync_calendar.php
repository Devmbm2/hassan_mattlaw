<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
global $db;
$smarty = new Sugar_Smarty();
$cfg = new Configurator();

if(isset($_REQUEST['action_overview']) && $_REQUEST['action_overview']=='save_settings') {
    $search_data = $_REQUEST['search_data'];
    if($search_data == 'checked') {
            $cfg->config['sync_events'] = $search_data;
            $update = "UPDATE schedulers SET status = 'Active' WHERE schedulers.job = 'function::syncCalendarEventsScheduler' AND deleted = 0";
            $response = 'checked';
    }else{
            $cfg->config['sync_events'] = '';
            $update = "UPDATE schedulers SET status = 'Inactive' WHERE schedulers.job = 'function::syncCalendarEventsScheduler' AND deleted = 0";
            $response = 'un_checked';
    }
    $cfg->saveConfig();
    $GLOBALS['db']->query($update, true);
    $html = "<span class='sync_events_response'>$response</span>";
    echo $html; die();
}

$smarty->assign('sync_events', $cfg->config['sync_events']);
$smarty->display("custom/modules/Administration/tpls/sync_calendar.tpl");
