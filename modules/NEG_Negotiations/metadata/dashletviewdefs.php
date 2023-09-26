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

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

global $current_user;

$dashletData['NEG_NegotiationsDashlet']['searchFields'] = array(
    'document_name' => 
      array (
        'name' => 'document_name',
        'default' => true,
        'width' => '10%',
      ),
      'category_id' => 
      array (
        'name' => 'category_id',
        'default' => true,
        'width' => '10%',
      ),
      'subcategory_id' => 
      array (
        'name' => 'subcategory_id',
        'default' => true,
        'width' => '10%',
      ),
      'active_date' => 
      array (
        'name' => 'active_date',
        'default' => true,
        'width' => '10%',
      ),
      'exp_date' => 
      array (
        'name' => 'exp_date',
        'default' => true,
        'width' => '10%',
      ),
      'case_type_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'label' => 'LBL_CASE_TYPE',
        'width' => '10%',
        'name' => 'case_type_c',
      ),
      'done' => 
      array (
        'type' => 'bool',
        'default' => true,
        'label' => 'LBL_DONE',
        'width' => '10%',
        'name' => 'done',
      ),
      'sent_rec' => 
      array (
        'type' => 'enum',
        'studio' => 'visible',
        'label' => 'LBL_SENT_REC',
        'width' => '10%',
        'default' => true,
        'name' => 'sent_rec',
      ),
      'assigned_lawyer_cases' => 
      array (
        'name' => 'assigned_lawyer_cases',
        'label' => 'LBL_ASSIGNED_LAWYER_CASES',
        'type' => 'enum',
        'width' => '10%',
        'options' => 'assigned_lawyer_cases_list',
        'default' => true,
      ),
      'case_status' => 
      array (
        'name' => 'case_status',
        'label' => 'LBL_CASE_STATUS',
        'type' => 'enum',
        'width' => '10%',
        'options' => 'case_status_dom',
        'default' => true,
      ),
);
$dashletData['NEG_NegotiationsDashlet']['columns'] = array(
    'date_entered' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
  'date_of_negotiation_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_DATE_OF_NEGOTIATION',
    'width' => '10%',
  ),
  'neg_negotiations_cases_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_NEG_NEGOTIATIONS_CASES_FROM_CASES_TITLE',
    'id' => 'NEG_NEGOTIATIONS_CASESCASES_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'document_name' => 
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
  ),
  'type' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'default' => true,
  ),
  'defendant' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_DEFENDANT',
    'id' => 'CONTACT_ID2_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'amount' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
   'uploadfile' => 
  array (
    'type' => 'file',
    'label' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '10%',
	 'studio' => 'visible',
    'default' => true,
    'displayParams' => 
    array (
      'module' => 'NEG_Negotiations',
    ),
  ),
  'related_case_assigned_to' => 
  array (
    'type' => 'varchar',
	'label' => 'LBL_RELATED_CASE_ASSIGNED_TO',
    'vname' => 'LBL_RELATED_CASE_ASSIGNED_TO',
    'width' => '10%',
    'default' => true,
	'sortable' => false,
  ),
 
  'done' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_DONE',
    'width' => '10%',
  ),
  'sent_rec' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SENT_REC',
    'width' => '10%',
    'default' => true,
  ),
);