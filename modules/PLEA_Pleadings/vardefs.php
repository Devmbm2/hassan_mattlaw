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

$dictionary['PLEA_Pleadings'] = array(
    'table' => 'plea_pleadings',
    'audited' => true,
    'inline_edit' => true,
    'fields' => array (
	 'doc_id' =>
    array (
      'name' => 'doc_id',
      'vname' => 'LBL_DOC_ID',
      'type' => 'varchar',
      'len' => '100',
      'comment' => 'Document ID from documents web server provider',
      'importable' => false,
      'studio' => 'false',
    ),
    'doc_type' =>
    array (
      'name' => 'doc_type',
      'vname' => 'LBL_DOC_TYPE',
      'type' => 'enum',
      'function' => 'getDocumentsExternalApiDropDown',
      'len' => '100',
      'comment' => 'Document type (ex: Google, box.net, IBM SmartCloud)',
      'popupHelp' => 'LBL_DOC_TYPE_POPUP',
      'massupdate' => false,
      'options' => 'eapm_list',
      'default' => 'Sugar',
      'studio' =>
      array (
        'wirelesseditview' => false,
        'wirelessdetailview' => false,
        'wirelesslistview' => false,
        'wireless_basic_search' => false,
      ),
    ),
    'doc_url' =>
    array (
      'name' => 'doc_url',
      'vname' => 'LBL_DOC_URL',
      'type' => 'varchar',
      'len' => '255',
      'comment' => 'Document URL from documents web server provider',
      'importable' => false,
      'massupdate' => false,
      'studio' => 'false',
    ),
     'filename' =>
    array (
      'name' => 'filename',
      'vname' => 'LBL_FILENAME',
      'type' => 'varchar',
      'required' => true,
      'importable' => 'required',
      'len' => '255',
      'studio' => 'false',
    ),
  'incoming_or_outgoing' =>
  array (
    'required' => false,
    'name' => 'incoming_or_outgoing',
    'vname' => 'LBL_INCOMING_OR_OUTGOING',
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
    'options' => 'incoming_or_outgoing_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'category_id' =>
  array (
    'name' => 'category_id',
    'vname' => 'LBL_SF_CATEGORY',
    'type' => 'enum',
    'len' => 100,
    'options' => 'category_id_list',
    'reportable' => true,
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
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '20',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'subcategory_id' =>
  array (
    'name' => 'subcategory_id',
    'vname' => 'LBL_SF_SUBCATEGORY',
    'type' => 'enum',
    'len' => 100,
    'options' => 'subcategory_id_list',
    'reportable' => true,
    'required' => false,
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => 'Pleading Sub Type',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'inline_edit' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'size' => '20',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'notice_type' =>
  array (
    'required' => false,
    'name' => 'notice_type',
    'vname' => 'LBL_NOTICE_TYPE',
    'type' => 'enum',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => 'This is for Types of Notices',
    'help' => 'This is not for Hearings',
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
    'options' => 'notice_type_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'filing_sub_type' =>
  array (
    'required' => false,
    'name' => 'filing_sub_type',
    'vname' => 'LBL_FILING_SUB_TYPE',
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
    'options' => 'filing_sub_type_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'amount' =>
  array (
    'required' => false,
    'name' => 'amount',
    'vname' => 'LBL_AMOUNT',
    'type' => 'currency',
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
    'len' => 26,
    'size' => '20',
    'enable_range_search' => false,
    'precision' => 6,
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
  'orders_sub_type' =>
  array (
    'required' => false,
    'name' => 'orders_sub_type',
    'vname' => 'LBL_ORDERS_SUB_TYPE',
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
    'options' => 'orders_sub_type_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'sent_received' =>
  array (
    'required' => false,
    'name' => 'sent_received',
    'vname' => 'LBL_SENT_RECEIVED',
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
    'options' => 'sent_received_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'hearing_type' =>
  array (
    'required' => false,
    'name' => 'hearing_type',
    'vname' => 'LBL_HEARING_TYPE',
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
    'options' => 'hearing_type_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'name_of_motion' =>
  array (
    'required' => false,
    'name' => 'name_of_motion',
    'vname' => 'LBL_NAME_OF_MOTION',
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
    'len' => '90',
    'size' => '20',
  ),
  'complaint_answer_type' =>
  array (
    'required' => false,
    'name' => 'complaint_answer_type',
    'vname' => 'LBL_COMPLAINT_ANSWER_TYPE',
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
    'options' => 'complaint_answer_type_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'contact_id_c' =>
  array (
    'required' => false,
    'name' => 'contact_id_c',
    'vname' => 'LBL_HUMAN_DEFENDANT_CONTACT_ID',
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
  'human_defendant' =>
  array (
    'required' => false,
    'source' => 'non-db',
    'name' => 'human_defendant',
    'vname' => 'LBL_HUMAN_DEFENDANT',
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
    'id_name' => 'contact_id_c',
    'ext2' => 'Contacts',
    'module' => 'Contacts',
    'rname' => 'name',
    'quicksearch' => 'enabled',
    'studio' => 'visible',
  ),
  'account_id_c' =>
  array (
    'required' => false,
    'name' => 'account_id_c',
    'vname' => 'LBL_DEFENDANT_ORGANIZATION_ACCOUNT_ID',
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
  'defendant_organization' =>
  array (
    'required' => false,
    'source' => 'non-db',
    'name' => 'defendant_organization',
    'vname' => 'LBL_DEFENDANT_ORGANIZATION',
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
   'hd_reviewed_by' =>
    array (
      'inline_edit' => 1,
      'required' => false,
      'name' => 'hd_reviewed_by',
      'vname' => 'LBL_HD_REVIEWED_BY',
      'type' => 'id',
      'massupdate' => '0',
      'default' => NULL,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => false,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '36',
      'size' => '20',
    ),
    'hd_reviewed_by_name' =>
    array (
      'inline_edit' => '1',
      'required' => false,
      'source' => 'non-db',
      'name' => 'hd_reviewed_by_name',
      'vname' => 'LBL_HD_REVIEWED_BY',
      'type' => 'relate',
      'massupdate' => '0',
      'default' => NULL,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'id_name' => 'hd_reviewed_by',
      'ext2' => 'Users',
      'module' => 'Users',
      'rname' => 'name',
      'quicksearch' => 'enabled',
      'studio' => 'visible',
    ),
	'hd_reviewed_date' =>
    array (
      'name' => 'hd_reviewed_date',
      'vname' => 'LBL_HD_REVIEWED_DATE',
      'type' => 'date',
      'required' => false,
      'importable' => 'required',
      'display_default' => 'now',
      'inline_edit' => true,
      'merge_filter' => 'disabled',
      'enable_range_search' => false,
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
	'related_case_assigned_to' => array(
		'name' => 'related_case_assigned_to',
		'vname' => 'LBL_RELATED_CASE_ASSIGNED_TO',
		'type' => 'varchar',
		'len' => '255',
		'source' => 'non-db',
		'function' => array('name'=>'getrelated_case_assigned_to',
					 'returns'=>'html',
					 'include'=>'custom/include/custom_utils.php'),
	),
    // 'saved_by'=>array(
    //     'type' => 'varchar',
    //     'studio' => 'visible',
    //     'label' => 'LBL_SAVED_BY',
    //     'width' => '10%',
    //     'default' => true,
    //     'function' =>
    //     array (
    //       'name' => 'getrelated_user_name',
    //       'returns' => 'html',
    //       'include' => 'custom/include/custom_utils.php',
    //     ),
    // ),
	'related_case_assistant' => array(
		'name' => 'related_case_assistant',
		'vname' => 'LBL_RELATED_CASE_ASSISTANT',
		'type' => 'varchar',
		'source' => 'non-db',
	),
	'filing_description' =>
	  array (
		   'name' => 'filing_description',
		  'vname' => 'LBL_FILING_DESCRIPTION',
		  'type' => 'varchar',
	  ),
	'pleading_sub_type_description' =>
	  array (
		  'name' => 'pleading_sub_type_description',
		  'vname' => 'LBL_PLEADING_SUB_TYPE_DESCRIPTION',
		  'type' => 'text',
	  ),
	'duration' =>
	array(
		'name' => 'duration',
		'vname' => 'LBL_DURATION',
		'type' => 'enum',
		'source' => 'non-db',
		'options' => 'duration_dom',
		'source' => 'non-db',
		'comment' => 'Duration handler dropdown',
		'massupdate' => false,
		'reportable' => false,
		'importable' => false,
	),
	'date_start' =>
		array(
			'name' => 'date_start',
			'vname' => 'LBL_DATE',
			'type' => 'datetimecombo',
			'source' => 'non-db',
			'comment' => 'Date of start of meeting',
			'importable' => 'required',
			'required' => false,
			'enable_range_search' => true,
			'options' => 'date_range_search_dom',
			'validation' => array('type' => 'isbefore', 'compareto' => 'date_end', 'blank' => false),
		),
	'duration_hours' =>
		array(
			'name' => 'duration_hours',
			'vname' => 'LBL_DURATION_HOURS',
			'type' => 'int',
			'source' => 'non-db',
			'group' => 'duration',
			'len' => '3',
			'comment' => 'Duration (hours)',
			'importable' => 'required',
			'required' => false,
		),
    'duration_minutes' =>
		array(
			'name' => 'duration_minutes',
			'vname' => 'LBL_DURATION_MINUTES',
			'type' => 'int',
			'source' => 'non-db',
			'group' => 'duration',
			'len' => '2',
			'comment' => 'Duration (minutes)',
		),
    'date_end' =>
		array(
			'name' => 'date_end',
			'vname' => 'LBL_DATE_END',
			'type' => 'datetimecombo',
			'dbType' => 'datetime',
			'source' => 'non-db',
			'massupdate' => false,
			'comment' => 'Date meeting ends',
			'enable_range_search' => true,
			'options' => 'date_range_search_dom',
		),
	'type_c' =>
		array (
		  'required' => false,
		  'name' => 'type_c',
		  'vname' => 'LBL_TYPE',
		  'type' => 'enum',
		  'source' => 'non-db',
		  'options' => 'event_type_list',
		),
	'event_type' =>
		array(
			'required' => false,
			'name' => 'event_type',
			'vname' => 'LBL_EVENT_TYPE',
			'type' => 'enum',
			'source' => 'non-db',
			'options' => 'event_type_new_list',
		),
	'events_multiple_assigned_users' =>
		array (
		  'name' => 'events_multiple_assigned_users',
		  'vname' => 'LBL_MULTIPLE_ASSIGNED_USERS',
		  'type' => 'multienum',
		  'options' => 'multiple_assigned_users_list',
		  'function' => 'get_users',
		  'required' => false,
		),
	'author_type' =>
		array (
		  'name' => 'author_type',
		  'vname' => 'LBL_AUTHOR_TYPE',
		  'type' => 'enum',
		  'options' => 'author_type_list',
		  'required' => true,
		),
	'document_processed_description' =>
		array (
		  'name' => 'document_processed_description',
		  'vname' => 'LBL_DOCUMENT_PROCESSED_DESCRIPTION',
		  'type' => 'text',
		  'len' => '155',
		  'size' => '155',
		  'rows' => 6,
		  'cols' => 80,
		),
	'parent_name' =>
		array (
		  'required' => true,
		  'source' => 'non-db',
		  'name' => 'parent_name',
		  'vname' => 'LBL_FLEX_RELATE',
		  'type' => 'parent',
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
		  'len' => 25,
		  'size' => '20',
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
		  'len' => 255,
		  'size' => '20',
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
VardefManager::createVardef('PLEA_Pleadings', 'PLEA_Pleadings', array('basic','assignable','security_groups','file'));
