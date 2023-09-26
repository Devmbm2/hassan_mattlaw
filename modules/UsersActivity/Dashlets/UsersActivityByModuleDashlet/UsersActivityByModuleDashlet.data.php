<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$dashletData['UsersActivityByModuleDashlet']['searchFields'] = array(
        'pcua_modules' => array(
                'name'  => 'pcua_modules',
                'vname' => 'LBL_MODULE',
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
        )
        );
?>
