<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2018 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for technical reasons, the Appropriate Legal Notices must
 * display the words "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */

$dictionary['ht_login_tracker'] = array(
    'table' => 'ht_login_tracker',
    'audited' => false,
    'inline_edit' => false,
    'duplicate_merge' => false,
    'fields' => array (
  'login_timestamp' => 
  array (
    'required' => true,
    'name' => 'login_timestamp',
    'vname' => 'LBL_LOGIN_TIMESTAMP',
    'type' => 'datetimecombo',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'false',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    // 'audited' => true,
    'inline_edit' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '20',
    'enable_range_search' => true,
    'dbType' => 'datetime',
	  'options' => 'date_range_search_dom',
  ),
  'logout_timestamp' => 
  array (
    'required' => true,
    'name' => 'logout_timestamp',
    'vname' => 'LBL_LOGOUT_TIMESTAMP',
    'type' => 'datetimecombo',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'false',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    // 'audited' => true,
    'inline_edit' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '20',
    'enable_range_search' => true,
    'dbType' => 'datetime',
	  'options' => 'date_range_search_dom',
  ),
  // 'is_user_logged_out' => 
  // array (
  //   'name' => 'is_user_logged_out',
  //   'vname' => 'LBL_IS_USER_LOGGED_OUT',
  //   'type' => 'bool',
  //   'massupdate' => true,
  //   'default' => '0',
  //   'no_default' => false,
  //   'len' => 1,
  //   'inline_edit' => false,
  // ),
  'user_session_time' => 
  array (
    'name' => 'user_session_time',
    'vname' => 'LBL_USER_WORKED_TIME',
    'type' => 'varchar',
    'inline_edit' => false,
  ),
  'ip_address' => 
  array (
    'required' => false,
    'name' => 'ip_address',
    'vname' => 'LBL_IP_ADDRESS',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'false',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    // 'audited' => true,
    'inline_edit' => '',
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '40',
    'size' => '20',
  ),
  'operating_system' => 
  array (
    'required' => false,
    'name' => 'operating_system',
    'vname' => 'LBL_OPERATING_SYSTEM',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'false',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    // 'audited' => true,
    'inline_edit' => '',
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '100',
    'size' => '20',
  ),
  'device' => 
  array (
    'required' => false,
    'name' => 'device',
    'vname' => 'LBL_DEVICE',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'false',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    // 'audited' => true,
    'inline_edit' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '100',
    'size' => '20',
  ),
  'user_agent' => 
  array (
    'required' => false,
    'name' => 'user_agent',
    'vname' => 'LBL_USER_AGENT',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'false',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    // 'audited' => true,
    'inline_edit' => '',
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '255',
    'size' => '20',
  ),
  'browser_information' => 
  array (
    'required' => false,
    'name' => 'browser_information',
    'vname' => 'LBL_BROWSER_INFORMATION',
    'type' => 'text',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'false',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    // 'audited' => true,
    'inline_edit' => '',
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '20',
    'studio' => 'visible',
    'rows' => '4',
    'cols' => '40',
  ),
  'browser' => 
  array (
    'required' => false,
    'name' => 'browser',
    'vname' => 'LBL_BROWSER',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'false',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    // 'audited' => true,
    'inline_edit' => '',
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '100',
    'size' => '20',
  ),
  'server_information' => 
  array (
    'required' => false,
    'name' => 'server_information',
    'vname' => 'LBL_SERVER_INFORMATION',
    'type' => 'text',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'false',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    // 'audited' => true,
    'inline_edit' => '',
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '20',
    'studio' => 'visible',
    'rows' => '4',
    'cols' => '40',
  ),
  'latitude_longitude' => 
  array (
    'required' => false,
    'name' => 'latitude_longitude',
    'vname' => 'LBL_LATITUDE_LONGITUDE',
    'type' => 'varchar',
  ),
  'ht_name' => 
  array (
    'required' => true,
    'name' => 'ht_name',
    'vname' => 'LBL_NAME',
    'type' => 'text',
  ),
  'login_status' => 
  array (
    'name' => 'login_status',
    'vname' => 'LBL_LOGIN_STATUS',
    'source' => 'non-db',
    'type' => 'varchar',
    'inline_edit' => false,
  ),
),
    'relationships' => array (
),
    'optimistic_locking' => true,
    'unified_search' => true,
);
if (!class_exists('VardefManager')) {
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('ht_login_tracker', 'ht_login_tracker', array('basic','assignable','security_groups'));

$dictionary['ht_login_tracker']['fields']['assigned_user_id']['massupdate'] = 0;