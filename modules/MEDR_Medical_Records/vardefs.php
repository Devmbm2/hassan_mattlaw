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

$dictionary['MEDR_Medical_Records'] = array(
    'table' => 'medr_medical_records',
    'audited' => true,
    'inline_edit' => true,
    'fields' => array (
  'date_range_end' => 
  array (
    'required' => false,
    'name' => 'date_range_end',
    'vname' => 'LBL_DATE_RANGE_END',
    'type' => 'date',
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
    'size' => '20',
    'enable_range_search' => false,
  ),
  'date_range_start' => 
  array (
    'required' => false,
    'name' => 'date_range_start',
    'vname' => 'LBL_DATE_RANGE_START',
    'type' => 'date',
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
    'size' => '20',
    'enable_range_search' => false,
  ),
  'account_id_c' => 
  array (
    'required' => false,
    'name' => 'account_id_c',
    'vname' => 'LBL_MEDICAL_PROVIDER_ACCOUNT_ID',
    'type' => 'id',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => false,
    'inline_edit' => true,
    'reportable' => false,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 36,
    'size' => '20',
  ),
  'medical_provider' => 
  array (
    'required' => false,
    'source' => 'non-db',
    'name' => 'medical_provider',
    'vname' => 'LBL_MEDICAL_PROVIDER',
    'type' => 'relate',
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
    'len' => '255',
    'size' => '20',
    'id_name' => 'account_id_c',
    'ext2' => 'Accounts',
    'module' => 'Accounts',
    'rname' => 'name',
    'quicksearch' => 'enabled',
    'studio' => 'visible',
  ),
  'name_of_doctor' => 
  array (
    'required' => false,
    'name' => 'name_of_doctor',
    'vname' => 'LBL_NAME_OF_DOCTOR',
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
    'len' => '30',
    'size' => '20',
  ),
  'secret_notes' => 
  array (
    'required' => false,
    'name' => 'secret_notes',
    'vname' => 'LBL_SECRET_NOTES',
    'type' => 'text',
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
    'size' => '20',
    'studio' => 'visible',
    'rows' => '2',
    'cols' => '10',
  ),
  'primary_address_street' => array (
		  'name' => 'primary_address_street',
		  'vname' => 'LBL_PRIMARY_ADDRESS_STREET',
		  'type' => 'varchar',
		  'len' => '150',
		  'group' => 'primary_address',
		  'comment' => 'Street address for primary address',
		  'merge_filter' => 'enabled',
		),
		
		'primary_address_city' => array (
		  'name' => 'primary_address_city',
		  'vname' => 'LBL_PRIMARY_ADDRESS_CITY',
		  'type' => 'varchar',
		  'len' => '100',
		  'group' => 'primary_address',
		  'comment' => 'City for primary address',
		  'merge_filter' => 'enabled',
		),
		
		'primary_address_state' => array (
		  'name' => 'primary_address_state',
		  'vname' => 'LBL_PRIMARY_ADDRESS_STATE',
		  'type' => 'varchar',
		  'len' => '100',
		  'group' => 'primary_address',
		  'comment' => 'State for primary address',
		  'merge_filter' => 'enabled',
		),
		
		'primary_address_postalcode' => array (
		  'name' => 'primary_address_postalcode',
		  'vname' => 'LBL_PRIMARY_ADDRESS_POSTALCODE',
		  'type' => 'varchar',
		  'len' => '20',
		  'group' => 'primary_address',
		  'comment' => 'Postal code for primary address',
		  'merge_filter' => 'enabled',
		),
		
		'primary_address_country' => array (
		  'name' => 'primary_address_country',
		  'vname' => 'LBL_PRIMARY_ADDRESS_COUNTRY',
		  'type' => 'varchar',
		  'group' => 'primary_address',
		  'comment' => 'Country for primary address',
		  'merge_filter' => 'enabled',
		),
		'contact_name' => array(
				'required'  => false,
				'source'    => 'non-db',
				'name'      => 'contact_name',
				'vname'     => 'LBL_CONTACT',
				'type'      => 'relate',
				'rname'     => 'name',
				'id_name'   => 'contact_id',
				'link'      => 'contact_medr_medical_records',
				'table'     => 'contacts',
				'isnull'    => 'true',
				'module'    => 'Contacts',
				'db_concat_fields' => array (
					0 => 'first_name',
					1 => 'last_name',
				 ),
			),
		'contact_id' => array(
				'name'              => 'contact_id',
				'rname'             => 'id',
				'vname'             => 'LBL_CONTACT_ID',
				'type'              => 'id',
				'table'             => 'contacts',
				'isnull'            => 'true',
				'module'            => 'Contacts',
				'dbType'            => 'id',
				'reportable'        => false,
				'massupdate'        => false,
				'duplicate_merge'   => 'disabled',
			),
		'contact_medr_medical_records' => array(
			'name' => 'contact_medr_medical_records',
			'type' => 'link',
			'relationship' => 'contact_medr_medical_records',
			'source'=>'non-db',
			'vname'=>'LBL_CONTACT_MEDR_MEDICAL_RECORDS'
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
VardefManager::createVardef('MEDR_Medical_Records', 'MEDR_Medical_Records', array('basic','assignable','security_groups','file'));