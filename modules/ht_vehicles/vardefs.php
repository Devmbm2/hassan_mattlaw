<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2017 SalesAgility Ltd.
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
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
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
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */

$dictionary['ht_vehicles'] = array(
    'table' => 'ht_vehicles',
    'audited' => true,
    'inline_edit' => true,
    'duplicate_merge' => true,
    'fields' => array (
  'name' => 
  array (
    'name' => 'name',
    'vname' => 'LBL_NAME',
    'type' => 'name',
    'link' => true,
    'dbType' => 'varchar',
    'len' => '255',
    'unified_search' => false,
    'full_text_search' => 
    array (
      'boost' => 3,
    ),
    'required' => true,
    'importable' => 'required',
    'duplicate_merge' => 'disabled',
    'merge_filter' => 'disabled',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'inline_edit' => true,
    'reportable' => true,
    'size' => '20',
  ),
  'vin_number' => 
  array (
    'required' => false,
    'name' => 'vin_number',
    'vname' => 'LBL_VIN_NUMBER',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'inline_edit' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '20',
    'size' => '20',
  ),
  'vehicle_license_plate_number' => 
  array (
    'required' => false,
    'name' => 'vehicle_license_plate_number',
    'vname' => 'LBL_VEHICLE_LICENSE_PLATE_NUMBER',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'inline_edit' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '12',
    'size' => '20',
  ),
  'vehicle_type' => 
  array (
    'required' => false,
    'name' => 'vehicle_type',
    'vname' => 'LBL_VEHICLE_TYPE',
    'type' => 'enum',
    'massupdate' => 0,
    'default' => 'Car',
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'inline_edit' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',
    'options' => 'vehicle_type_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'vehicle_no' => 
  array (
    'required' => false,
    'name' => 'vehicle_no',
    'vname' => 'LBL_VEHICLE_NO',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'audited' => false,
    'inline_edit' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'vehicle_make' => 
  array (
    'required' => false,
    'name' => 'vehicle_make',
    'vname' => 'LBL_VEHICLE_MAKE',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'inline_edit' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '24',
    'size' => '20',
  ),
  'vehicle_year' => 
  array (
    'required' => false,
    'name' => 'vehicle_year',
    'vname' => 'LBL_VEHICLE_YEAR',
    'type' => 'int',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'inline_edit' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '4',
    'size' => '20',
    'enable_range_search' => false,
    'disable_num_format' => '',
    'min' => false,
    'max' => false,
  ),
  'vehicle_color' => 
  array (
    'required' => false,
    'name' => 'vehicle_color',
    'vname' => 'LBL_VEHICLE_COLOR',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'inline_edit' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '12',
    'size' => '20',
  ),
	'contacts' =>
		array(
			'name' => 'contacts',
			'type' => 'link',
			'relationship' => 'ht_vehicles_contacts',
			'module' => 'Contacts',
			'bean_name' => 'Contact',
			'source' => 'non-db',
			'vname' => 'LBL_CONTACTS',
		),
		'accounts' =>
		array(
			'name' => 'accounts',
			'type' => 'link',
			'relationship' => 'ht_vehicles_accounts',
			'module' => 'Accounts',
			'bean_name' => 'Account',
			'source' => 'non-db',
			'vname' => 'LBL_ACCOUNTS',
		),
	),
    'relationships' => array (
		'ht_vehicles_contacts' => array(
			'lhs_module' => 'ht_vehicles',
			'lhs_table' => 'ht_vehicles',
			'lhs_key' => 'id',
			'rhs_module' => 'Contacts',
			'rhs_table' => 'contacts',
			'rhs_key' => 'id',
			'relationship_type' => 'many-to-many',
			'join_table' => 'ht_vehicles_contacts',
			'join_key_lhs' => 'vehicle_id',
			'join_key_rhs' => 'contact_id',
		),
		'ht_vehicles_accounts' => array(
			'lhs_module' => 'ht_vehicles',
			'lhs_table' => 'ht_vehicles',
			'lhs_key' => 'id',
			'rhs_module' => 'Accounts',
			'rhs_table' => 'accounts',
			'rhs_key' => 'id',
			'relationship_type' => 'many-to-many',
			'join_table' => 'ht_vehicles_accounts',
			'join_key_lhs' => 'vehicle_id',
			'join_key_rhs' => 'account_id',
		),
		// 'ht_vehicles_cases' => array(
			// 'lhs_module' => 'ht_vehicles',
			// 'lhs_table' => 'ht_vehicles',
			// 'lhs_key' => 'id',
			// 'rhs_module' => 'Cases',
			// 'rhs_table' => 'cases',
			// 'rhs_key' => 'id',
			// 'relationship_type' => 'many-to-many',
			// 'join_table' => 'ht_vehicles_cases',
			// 'join_key_lhs' => 'case_id',
			// 'join_key_rhs' => 'vehicle_id',
		// ),
	),
    'optimistic_locking' => true,
    'unified_search' => true,
);
if (!class_exists('VardefManager')) {
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('ht_vehicles', 'ht_vehicles', array('basic','assignable','security_groups'));