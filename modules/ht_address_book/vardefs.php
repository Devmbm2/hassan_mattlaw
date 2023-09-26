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

$dictionary['ht_address_book'] = array(
    'table' => 'ht_address_book',
    'audited' => true,
    'inline_edit' => true,
    'duplicate_merge' => true,
    'fields' => array (
		'account_name' => array(
			'required'  => false,
			'source'    => 'non-db',
			'name'      => 'account_name',
			'vname'     => 'LBL_ACCOUNT_NAME',
			'type'      => 'relate',
			'rname'     => 'name',
			'id_name'   => 'account_id',
			'link'      => 'account_ht_address_book',
			'table'     => 'accounts',
			'isnull'    => 'true',
			'module'    => 'Accounts',
		),
		'account_id' => array(
			'name'              => 'account_id',
			'rname'             => 'id',
			'vname'             => 'LBL_ACCOUNT_ID',
			'type'              => 'id',
			'table'             => 'accounts',
			'isnull'            => 'true',
			'module'            => 'Accounts',
			'dbType'            => 'id',
			'reportable'        => false,
			'massupdate'        => false,
			'duplicate_merge'   => 'disabled',
		),
		'lead_name' => array(
			'required'  => false,
			'source'    => 'non-db',
			'name'      => 'lead_name',
			'vname'     => 'LBL_LEAD_NAME',
			'type'      => 'relate',
			'rname'     => 'name',
			'id_name'   => 'lead_id',
			'link'      => 'lead_ht_address_book',
			'table'     => 'leads',
			'isnull'    => 'true',
			'module'    => 'Leads',
		),
		'lead_id' => array(
			'name'              => 'lead_id',
			'rname'             => 'id',
			'vname'             => 'LBL_LEAD_ID',
			'type'              => 'id',
			'table'             => 'leads',
			'isnull'            => 'true',
			'module'            => 'Leads',
			'dbType'            => 'id',
			'reportable'        => false,
			'massupdate'        => false,
			'duplicate_merge'   => 'disabled',
		),
		'contact_name' => array(
			'required'  => false,
			'source'    => 'non-db',
			'name'      => 'contact_name',
			'vname'     => 'LBL_CONTACT_NAME',
			'type'      => 'relate',
			'rname'     => 'name',
			'id_name'   => 'contact_id',
			'link'      => 'contact_ht_address_book',
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
),
    'relationships' => array (
),
    'optimistic_locking' => true,
    'unified_search' => true,
);
if (!class_exists('VardefManager')) {
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('ht_address_book', 'ht_address_book', array('basic','assignable','security_groups','company'));