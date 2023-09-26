<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$dashletData['UsersActivityDashlet']['searchFields'] = array(
    'pcua_actions' => array(
        'name'  => 'pcua_actions',
        'vname' => 'LBL_ACTION',
        'type'  => 'enum',
    ),
    'pcua_ids' => array(
        'name'  => 'pcua_ids',
        'vname' => 'LBL_USERS',
        'type'  => 'user_name',
    ),
    'pcua_date_start' => array(
        'name'  => 'pcua_date_start',
        'vname' => 'LBL_DATE_START',
        'type'  => 'datepicker',
    ),
    'pcua_date_end' => array(
        'name'  => 'pcua_date_end',
        'vname' => 'LBL_DATE_END',
        'type'  => 'datepicker',
    ),
);
?>
