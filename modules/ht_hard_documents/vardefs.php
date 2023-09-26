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
/* global $dictionary;
if(empty($dictionary['Document'])){
	include('modules/Documents/vardefs.php');
}
$dictionary['ht_hard_documents']=$dictionary['Document']; */
$dictionary['ht_hard_documents'] = array(
    'table' => 'ht_hard_documents',
    'audited' => true,
    'inline_edit' => true,
    'duplicate_merge' => true,
    'fields' => array (
		'user_name' => array(
			'required'  => false,
			'source'    => 'non-db',
			'name'      => 'user',
			'vname'     => 'LBL_CONTACT',
			'type'      => 'relate',
			'rname'     => 'name',
			'id_name'   => 'user_id',
			'table'     => 'users',
			'isnull'    => 'true',
			'module'    => 'Users',
			),
		'user_id' => array(
			'name'              => 'user_id',
			'rname'             => 'id',
			'vname'             => 'LBL_CONTACT_ID',
			'type'              => 'id',
			'table'             => 'users',
			'isnull'            => 'true',
			'module'            => 'Users',
			'dbType'            => 'id',
			'reportable'        => false,
			'massupdate'        => false,
			'duplicate_merge'   => 'disabled',
			'source'    => 'non-db',
    ),
	 'category_id' => 
    array (
      'name' => 'category_id',
      'vname' => 'LBL_SF_CATEGORY',
      'type' => 'enum',
      'len' => 100,
      'options' => 'incoming_or_outgoing_list',
      'reportable' => true,
      'inline_edit' => true,
      'merge_filter' => 'disabled',
	  'source'    => 'non-db',
    ),
	'subcategory_id' => 
    array (
      'name' => 'subcategory_id',
      'vname' => 'LBL_SF_SUBCATEGORY',
      'type' => 'enum',
      'len' => 100,
      'options' => 'Document_Main_Category',
      'reportable' => true,
      'inline_edit' => true,
      'merge_filter' => 'disabled',
	  'source'    => 'non-db',
	  'ext2' => 'ht_hard_documents',
    ),
	'outgoing_document' => array (
      'name' => 'outgoing_document',
      'vname' => 'LBL_OUTGOING_DOCUMENT',
      'type' => 'bool',
      'massupdate' => false,
      'studio' => 'false',
	  'ext2' => 'Documents',
	  'module' => 'Documents',
    ),
	'assigned_lawyer_cases' => 
    array (
      'name' => 'assigned_lawyer_cases',
      'label' => 'LBL_ASSIGNED_LAWYER_CASES',
      'type' => 'enum',
      'source' => 'non-db',
      'options' => 'assigned_lawyer_cases_list',
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
VardefManager::createVardef('ht_hard_documents', 'ht_hard_documents', array('basic','assignable','security_groups'));