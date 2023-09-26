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

$dictionary['ht_sms'] = array(
    'table' => 'ht_sms',
    'audited' => true,
    'inline_edit' => true,
    'duplicate_merge' => true,
    'fields' => array (
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
  'from_number' => 
  array (
    'required' => false,
    'name' => 'from_number',
    'vname' => 'LBL_FROM_NUMBER',
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
    'len' => '255',
    'size' => '20',
  ),
  'to_number' => 
  array (
    'required' => false,
    'name' => 'to_number',
    'vname' => 'LBL_TO_NUMBER',
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
    'len' => '255',
    'size' => '20',
  ),
  'contact_name' => array(
    'required'  => false,
    'source'    => 'non-db',
    'name'      => 'contact_name',
    'vname'     => 'LBL_CONTACT',
    'type'      => 'relate',
    'rname'     => 'name',
    'id_name'   => 'contact_id',
    'link'      => 'contact_ht_sms',
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
		'parent_name' => 
			array (
			'required' => false,
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
			'options' => 'parent_type_display_sms',
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
		'message_status' => 
			array (
			'required' => false,
			'name' => 'message_status',
			'vname' => 'LBL_MESSAGE_STATUS',
			'type' => 'enum',
			'options' => 'delivery_status_dom',
			),
		'message_type' => 
			array (
			'required' => false,
			'name' => 'message_type',
			'vname' => 'LBL_MESSAGE_TYPE',
			'type' => 'enum',
			'options' => 'message_type_dom',
			),
		'message_error_code' => 
			array (
			'required' => false,
			'name' => 'message_error_code',
			'vname' => 'LBL_MESSAGE_ERROR_CODE',
			'type' => 'enum',
			'options' => 'delivery_status_error_dom',
			),
		'sms_id' => array(
			'name'              => 'sms_id',
			'vname'             => 'LBL_SMS_ID',
			'type'              => 'id',
			'dbType'            => 'id',
			),
		'auto_reply_sent' => array (
		  'name' => 'auto_reply_sent',
		  'vname' => 'LBL_AUTO_REPLY_SENT',
		  'type' => 'bool',
		  'default' => '0',
		  'reportable' => false,
		  'comment' => 'Record if the Auto Reply has been sent.',
		),
		'file_mime_type' => 
			array (
			  'name' => 'file_mime_type',
			  'vname' => 'LBL_FILE_MIME_TYPE',
			  'type' => 'varchar',
			  'len' => '100',
			  'comment' => 'Attachment MIME type',
			  'importable' => false,
			),
		'file_url' => 
			array (
			  'name' => 'file_url',
			  'vname' => 'LBL_FILE_URL',
			  'type' => 'function',
			  'function_class' => 'UploadFile',
			  'function_name' => 'get_upload_url',
			  'function_params' => 
			  array (
				0 => '$this',
			  ),
			  'source' => 'function',
			  'reportable' => false,
			  'comment' => 'Path to file (can be URL)',
			  'importable' => false,
			),
		'filename' => 
			array (
			  'name' => 'filename',
			  'vname' => 'LBL_FILENAME',
			  'type' => 'file',
			  'dbType' => 'varchar',
			  'len' => '255',
			  'reportable' => true,
			  'comment' => 'File name associated with the note (attachment)',
			  'importable' => false,
			),
		  'sms_body' => 
			array (
			  'name' => 'sms_body',
			  'vname' => 'LBL_SMS_BODY',
			  'type' => 'html',
			  'required' => false,
			  'massupdate' => 0,
			  'no_default' => false,
			  'comments' => 'Full text of the note',
			  'help' => '',
			  'importable' => 'true',
			  'duplicate_merge' => 'disabled',
			  'duplicate_merge_dom_value' => '0',
			  'audited' => false,
			  'reportable' => true,
			  'source' => 'non-db',
			  'unified_search' => false,
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
VardefManager::createVardef('ht_sms', 'ht_sms', array('basic','assignable','security_groups'));