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

$dictionary['ht_radiology'] = array(
    'table' => 'ht_radiology',
    'audited' => true,
    'inline_edit' => true,
    'fields' => array (
		'contact_name' => array(
			'required'  => false,
			'source'    => 'non-db',
			'name'      => 'contact_name',
			'vname'     => 'LBL_CONTACT_NAME',
			'type'      => 'relate',
			'rname'     => 'name',
			'id_name'   => 'contact_id',
			'link'      => 'contact_ht_radiology',
			'table'     => 'contacts',
			'isnull'    => 'true',
			'module'    => 'Contacts',
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
		'contact_ht_radiology' => array(
			'name' => 'contact_ht_radiology',
			'type' => 'link',
			'relationship' => 'contact_ht_radiology',
			'source'=>'non-db',
			'vname'=>'LBL_CONTACT_HT_RADIOLOGY'
		),
		'case_name' => array(
			'required'  => false,
			'source'    => 'non-db',
			'name'      => 'case_name',
			'vname'     => 'LBL_CASE_NAME',
			'type'      => 'relate',
			'rname'     => 'name',
			'id_name'   => 'case_id',
			'link'      => 'case_ht_radiology',
			'table'     => 'cases',
			'isnull'    => 'true',
			'module'    => 'Cases',
		),
		'case_id' => array(
			'name'              => 'case_id',
			'rname'             => 'id',
			'vname'             => 'LBL_CASE_ID',
			'type'              => 'id',
			'table'             => 'cases',
			'isnull'            => 'true',
			'module'            => 'Cases',
			'dbType'            => 'id',
			'reportable'        => false,
			'massupdate'        => false,
			'duplicate_merge'   => 'disabled',
		),
		'case_ht_radiology' => array(
			'name' => 'case_ht_radiology',
			'type' => 'link',
			'relationship' => 'case_ht_radiology',
			'source'=>'non-db',
			'vname'=>'LBL_CASE_HT_RADIOLOGY'
		),
		'format' => 
		array (
		  'name' => 'format',
		  'vname' => 'LBL_FORMAT',
		  'type' => 'enum',
		  'options' => 'format_list',
		),
		'attachments' => array(
			'name' => 'attachments',
			'vname' => 'LBL_MULTIPLE_ATTACHMENTS',
			'type' => 'varchar',
			'source' => 'non-db',
			'audited' => false,
			'required' => true,
			'comment' => '',
		),
		
	'notes_ht_radiology' => array(
		'name' => 'notes_ht_radiology',
		'type' => 'link',
		'relationship' => 'notes_ht_radiology',
		'source'=>'non-db',
		'vname'=>'LBL_NOTES_HT_RADIOLOGY'
	),
),
    'relationships' => array (
		'notes_ht_radiology' => array(
			'lhs_module'=> 'ht_radiology',
			'lhs_table'=> 'ht_radiology',
			'lhs_key' => 'id', 
			'rhs_module'=> 'Notes',
			'rhs_table'=> 'notes',
			'rhs_key' => 'ht_radiology_id',
			'relationship_type'=>'one-to-many',
		),
),
    'optimistic_locking' => true,
    'unified_search' => true,
);
if (!class_exists('VardefManager')) {
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('ht_radiology', 'ht_radiology', array('basic','assignable','security_groups','file'));