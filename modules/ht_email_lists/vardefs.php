<?php
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
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
 ********************************************************************************/

$dictionary['ht_email_lists'] = array(
	'table'=>'emails',
	'audited'=>true,
		'duplicate_merge'=>true,
		'fields'=>array (
		'date_sent' => array (
			'name'			=> 'date_sent',
			'vname'			=> 'LBL_DATE_SENT',
			'type'			=> 'datetime',
			'enable_range_search'=> true,
			'options'=> 'date_range_search_dom',
		),
		'type' => array (
			'name' => 'type',
			'vname' => 'LBL_LIST_TYPE',
			'type' => 'enum',
			'options' => 'dom_email_types',
			'len' => 100,
			'massupdate'=>false,
			'comment' => 'Type of email (ex: draft)',
		),
		'status' => array (
			'name' => 'status',
			'vname' => 'LBL_STATUS',
			'type' => 'enum',
			'len' => 100,
			'options' => 'ht_email_status_dom',
		),
		'parent_type' => array (
			'name' => 'parent_type',
			'type' => 'varchar',
			'reportable'=>false,
			'len' => 100,
			'comment' => 'Identifier of Sugar module to which this email is associated (deprecated as of 4.2)',
		),
		'parent_id' => array (
			'name' => 'parent_id',
			'type' => 'id',
			'len' => '36',
			'reportable'=>false,
			'comment' => 'ID of Sugar object referenced by parent_type (deprecated as of 4.2)',
		),
		'exclude_email_list' => array (
            'name' => 'exclude_email_list',
            'label' => 'LBL_MULTISELECT_EMAIL_LIST',
            'type' => 'multienum',
			'function' => 'getEmailsNames',
			'source'=> 'non-db',
		),	
		'from_addr' => array (
			'name' => 'from_addr',
            'type' => 'multienum',
			'function' => 'getFromAddress',
			'source'=> 'non-db',
		),
		'to_addrs_names' => array(
            'name' => 'to_addrs_names',
            'type' => 'varchar',
            'vname' => 'to_addrs_names',
            'source' => 'non-db',
        ),
   'parent_name'=>
 	array(
		'name'=> 'parent_name',
		'parent_type'=>'record_type_display' ,
		'type_name'=>'parent_type',
		'id_name'=>'parent_id',
		'vname'=>'LBL_LIST_RELATED_TO',
		'type'=>'parent',
		'group'=>'parent_name',
		'source'=>'non-db',
		'options'=> 'parent_type_display',
		),		
),
	'relationships'=>array (
),
	'optimistic_locking'=>true,
		'unified_search'=>true,
	);
if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('ht_email_lists','ht_email_lists', array('basic','assignable'));
