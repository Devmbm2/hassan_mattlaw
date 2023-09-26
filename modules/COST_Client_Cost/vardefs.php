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

$dictionary['COST_Client_Cost'] = array(
    'table' => 'cost_client_cost',
    'audited' => true,
    'inline_edit' => true,
    'fields' => array (
  'check_number' => 
  array (
    'required' => false,
    'name' => 'check_number',
    'vname' => 'LBL_CHECK_NUMBER',
    'type' => 'varchar',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => 'If Cost status  field equals Paid by Check',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'inline_edit' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '6',
    'size' => '20',
  ),
  'contact_id_c' => 
  array (
    'required' => false,
    'name' => 'contact_id_c',
    'vname' => 'LBL_COMPANION_CONTACT_ID',
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
  'companion' => 
  array (
    'required' => false,
    'source' => 'non-db',
    'name' => 'companion',
    'vname' => 'LBL_COMPANION',
    'type' => 'relate',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => 'If Case type field contains Companions',
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
    'id_name' => 'contact_id_c',
    'ext2' => 'Contacts',
    'module' => 'Contacts',
    'rname' => 'name',
    'quicksearch' => 'enabled',
    'studio' => 'visible',
  ),
  'number_of_ways_to_split' => 
  array (
    'required' => false,
    'name' => 'number_of_ways_to_split',
    'vname' => 'LBL_NUMBER_OF_WAYS_TO_SPLIT',
    'type' => 'enum',
    'massupdate' => 0,
    'default' => '0',
    'no_default' => false,
    'comments' => '',
    'help' => 'If Case type field contains Companion',
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
    'options' => 'number_of_ways_to_split_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'contact_id1_c' => 
  array (
    'required' => false,
    'name' => 'contact_id1_c',
    'vname' => 'LBL_DEPONENT_CONTACT_ID',
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
  'deponent' => 
  array (
    'required' => false,
    'source' => 'non-db',
    'name' => 'deponent',
    'vname' => 'LBL_DEPONENT',
    'type' => 'relate',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => 'If Cost type field equals Videographer Charges or Court Reporting for Depo',
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
    'id_name' => 'contact_id1_c',
    'ext2' => 'Contacts',
    'module' => 'Contacts',
    'rname' => 'name',
    'quicksearch' => 'enabled',
    'studio' => 'visible',
  ),
  'description' => 
  array (
    'name' => 'description',
    'vname' => 'LBL_DESCRIPTION',
    'type' => 'text',
    'comment' => 'Full text of the note',
    'rows' => '3',
    'cols' => '40',
    'required' => false,
    'massupdate' => 0,
    'no_default' => false,
    'comments' => 'Full text of the note',
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
  ),
  'invoice_number' => 
  array (
    'required' => false,
    'name' => 'invoice_number',
    'vname' => 'LBL_INVOICE_NUMBER',
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
  'paid_date' => 
  array (
    'required' => false,
    'name' => 'paid_date',
    'vname' => 'LBL_PAID_DATE',
    'type' => 'date',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => 'Copy date when Cost status field changes to contain “Paid”',
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
  'total_amount' => 
  array (
    'required' => false,
    'name' => 'total_amount',
    'vname' => 'LBL_TOTAL_AMOUNT',
    'type' => 'currency',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => 'Change to $0.00 when Cost status field changes to “Voided”',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'inline_edit' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 26,
    'size' => '20',
    'enable_range_search' => false,
    'precision' => 1,
  ),
  'currency_id' => 
  array (
    'required' => false,
    'name' => 'currency_id',
    'vname' => 'LBL_CURRENCY',
    'type' => 'currency_id',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => false,
    'inline_edit' => true,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 36,
    'size' => '20',
    'dbType' => 'id',
    'studio' => 'visible',
    'function' => 
    array (
      'name' => 'getCurrencyDropDown',
      'returns' => 'html',
    ),
  ),
  'status' => 
  array (
    'name' => 'status',
    'vname' => 'LBL_STATUS',
    'type' => 'enum',
    'Comment' => 'Document status for Meta-Data framework',
    'required' => false,
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
    'len' => 100,
    'size' => '20',
    'options' => 'invoice_status_dom',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'type' => 
  array (
    'required' => false,
    'name' => 'type',
    'vname' => 'LBL_TYPE',
    'type' => 'enum',
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
    'len' => 100,
    'size' => '20',
    'options' => 'cost_type_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'account_id_c' => 
  array (
    'required' => false,
    'name' => 'account_id_c',
    'vname' => 'LBL_PAYEE_ACCOUNT_ID',
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
  'quickbook_id' => 
  array (
    'required' => false,
    'name' => 'quickbook_id',
    'vname' => 'LBL_QUICKBOOK_ID',
    'type' => 'varchar',
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
  ),
  'payee' => 
  array (
    'required' => false,
    'source' => 'non-db',
    'name' => 'payee',
    'vname' => 'LBL_PAYEE',
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
  'assigned_lawyer_cases' =>
	array (
        'name' => 'assigned_lawyer_cases',
		'label' => 'LBL_ASSIGNED_LAWYER_CASES',
		'type' => 'enum',
		'source' => 'non-db',
        'options' => 'assigned_lawyer_cases_list',
      ),
   'case_status' => 
	  array (
		 'name' => 'case_status',
		  'vname' => 'LBL_STATUS',
		  'type' => 'enum',
		  'source' => 'non-db',
		  'options' => 'case_status_dom',
	  ),
	 'case_type' => 
	  array (
		 'name' => 'case_type',
		  'vname' => 'LBL_CASE_TYPE',
		  'type' => 'enum',
		  'source' => 'non-db',
		  'options' => 'case_type_list',
	  ),
	  'parent_name' => 
		array (
		  'required' => false,
		  'source' => 'non-db',
		  'name' => 'parent_name',
		  'vname' => 'LBL_FLEX_RELATE',
		  'type' => 'parent',
		  'massupdate' => 0,
		  'comments' => '',
		  'help' => '',
		  'importable' => 'false',
		  'duplicate_merge' => 'disabled',
		  'duplicate_merge_dom_value' => '0',
		  'audited' => 1,
		  'reportable' => 0,
		  'len' => 255,
		  'options' => 'parent_type_display_discovery',
		  'studio' => 'visible',
		  'type_name' => 'parent_type',
		  'id_name' => 'parent_id',
		  'parent_type' => 'record_type_display',
		),
	'parent_type' => 
		array (
		  'required' => false,
		  'name' => 'parent_type',
		  'vname' => 'LBL_PARENT_TYPE',
		  'type' => 'parent_type',
		  'massupdate' => 0,
		  'comments' => '',
		  'help' => '',
		  'importable' => 'false',
		  'dbType' => 'varchar',
		  'studio' => 'hidden',
		),
	'parent_id' => 
		array (
		  'required' => false,
		  'name' => 'parent_id',
		  'vname' => 'LBL_PARENT_ID',
		  'type' => 'id',
		  'massupdate' => 0,
		  'comments' => '',
		  'help' => '',
		  'importable' => 'false',
		  'duplicate_merge' => 'disabled',
		  'duplicate_merge_dom_value' => 0,
		  'audited' => 0,
		  'reportable' => 0,
		  'len' => 255,
		),
	'recovery_of_costs' => array (
		  'inline_edit' => '1',
		  'required' => false,
		  'name' => 'recovery_of_costs',
		  'vname' => 'LBL_RECOVERY_OF_COSTS',
		  'type' => 'radioenum',
		  'massupdate' => '0',
		  'default' => 'outstanding_open_case_cost',
		  'comments' => '',
		  'help' => '',
		  'importable' => 'true',
		  'duplicate_merge' => 'disabled',
		  'duplicate_merge_dom_value' => '0',
		  'audited' => false,
		  'reportable' => true,
		  'unified_search' => false,
		  'merge_filter' => 'disabled',
		  'len' => 100,
		  'size' => '20',
		  'options' => 'recovery_of_costs_dom',
		  'studio' => 'visible',
		  'dbType' => 'enum',
		  'separator' => '<br>',
		),
	'lost_unreimbursed_costs' => 
		array (
		  'required' => false,
		  'name' => 'lost_unreimbursed_costs',
		  'vname' => 'LBL_LOST_UNREIMBURSED_COSTS',
		  'type' => 'currency',
		  'massupdate' => 0,
		  'no_default' => false,
		  'comments' => '',
		  'help' => 'If “Recovered and partially paid” is checked then a money data field should open for that record and the user must enter the amount of the partial payment',
		  'importable' => 'true',
		  'duplicate_merge' => 'disabled',
		  'duplicate_merge_dom_value' => '0',
		  'audited' => false,
		  'inline_edit' => true,
		  'reportable' => true,
		  'unified_search' => false,
		  'merge_filter' => 'disabled',
		  'len' => 26,
		  'size' => '20',
		  'enable_range_search' => false,
		  'precision' => 1,
		),
	'other_status_type_explain' => 
		  array (
			'name' => 'other_status_type_explain',
			'vname' => 'LBL_OTHER_STATUS_TYPE_EXPLAIN',
			'type' => 'text',
			'comment' => 'Full text of the note',
			'rows' => '3',
			'cols' => '40',
			'required' => false,
			'massupdate' => 0,
			'no_default' => false,
			'comments' => 'Full text of the note',
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
VardefManager::createVardef('COST_Client_Cost', 'COST_Client_Cost', array('basic','assignable','security_groups','file'));