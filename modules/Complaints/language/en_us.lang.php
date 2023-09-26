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
 * FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
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
 * reasonably feasible for technical reasons, the Appropriate Legal Notices must
 * display the words "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

$mod_strings = array(
    'ERR_DELETE_RECORD' => 'You must specify a record number to delete the account.',
    'LBL_TOOL_TIP_BOX_TITLE' => 'KnowledgeBase Suggestions',
    'LBL_TOOL_TIP_TITLE' => 'Title: ',
    'LBL_TOOL_TIP_BODY' => 'Body: ',
    'LBL_TOOL_TIP_INFO' => 'Additional Info: ',
    'LBL_TOOL_TIP_USE' => 'Use as: ',
    'LBL_SUGGESTION_BOX' => 'Suggestions',
    'LBL_NO_SUGGESTIONS' => 'No Suggestions',
    'LBL_RESOLUTION_BUTTON' => 'Resolution',
    'LBL_SUGGESTION_BOX_STATUS' => 'Status',
    'LBL_SUGGESTION_BOX_TITLE' => 'Title',
    'LBL_SUGGESTION_BOX_REL' => 'Relevance',

    'LBL_ACCOUNT_ID' => 'Account ID',
    'LBL_ACCOUNT_NAME' => 'Account Name:',
    'LBL_ACCOUNTS_SUBPANEL_TITLE' => 'Accounts',
    'LBL_ACTIVITIES_SUBPANEL_TITLE' => 'Activities',
    'LBL_BUGS_SUBPANEL_TITLE' => 'Bugs',
    'LBL_COMPLAINT_NUMBER' => 'Complaint Number:',
    'LBL_COMPLAINT' => 'Complaint:',
    'LBL_CONTACT_NAME' => 'Contact Name:',
    'LBL_CONTACT_ROLE' => 'Role:',
    'LBL_CONTACTS_SUBPANEL_TITLE' => 'Contacts',
    'LBL_DEFAULT_SUBPANEL_TITLE' => 'Complaints',
    'LBL_DESCRIPTION' => 'Description:',
    'LBL_HISTORY_SUBPANEL_TITLE' => 'History',
    'LBL_INVITEE' => 'Contacts',
    'LBL_MEMBER_OF' => 'Account',
    'LBL_MODULE_NAME' => 'Complaints',
    'LBL_MODULE_TITLE' => 'Complaints: Home',
    'LBL_NEW_FORM_TITLE' => 'New Complaint',
    'LBL_NUMBER' => 'Number:',
    'LBL_PRIORITY' => 'Priority:',
    'LBL_PROJECTS_SUBPANEL_TITLE' => 'Projects',
    'LBL_DOCUMENTS_SUBPANEL_TITLE' => 'Documents',
    'LBL_RESOLUTION' => 'Resolution:',
    'LBL_SEARCH_FORM_TITLE' => 'Complaint Search',
    'LBL_STATUS' => 'Status:',
    'LBL_SUBJECT' => 'Subject:',
    'LBL_LIST_ASSIGNED_TO_NAME' => 'Assigned User',
    'LBL_LIST_ACCOUNT_NAME' => 'Account Name',
    'LBL_LIST_ASSIGNED' => 'Assigned To',
    'LBL_LIST_CLOSE' => 'Close',
    'LBL_LIST_FORM_TITLE' => 'Complaint List',
    'LBL_LIST_LAST_MODIFIED' => 'Last Modified',
    'LBL_LIST_MY_COMPLAINTS' => 'My Open Complaints',
    'LBL_LIST_NUMBER' => 'Num.',
    'LBL_LIST_PRIORITY' => 'Priority',
    'LBL_LIST_STATUS' => 'Status',
    'LBL_LIST_SUBJECT' => 'Subject',

    'LNK_COMPLAINT_LIST' => 'View Complaints',
    'LNK_NEW_COMPLAINT' => 'Create Complaint',
    'LBL_LIST_DATE_CREATED' => 'Date Created',
    'LBL_ASSIGNED_TO_NAME' => 'Assigned to',
    'LBL_TYPE' => 'Type',
    'LBL_WORK_LOG' => 'Work Log',
    'LNK_IMPORT_COMPLAINTS' => 'Import Complaints',

    'LBL_CREATED_USER' => 'Created User',
    'LBL_MODIFIED_USER' => 'Modified User',
    'LBL_PROJECT_SUBPANEL_TITLE' => 'Projects',
    'LBL_COMPLAINT_INFORMATION' => 'OVERVIEW',

    // SNIP
    'LBL_UPDATE_TEXT' => 'Updates - Text', //Field for Complaint updates with text only
    'LBL_INTERNAL' => 'Internal Update',
    'LBL_AOP_COMPLAINT_UPDATES' => 'Complaint Updates',
    'LBL_AOP_COMPLAINT_UPDATES_THREADED' => 'Complaint Updates Threaded',
    'LBL_COMPLAINT_UPDATES_COLLAPSE_ALL' => 'Collapse All',
    'LBL_COMPLAINT_UPDATES_EXPAND_ALL' => 'Expand All',
    'LBL_AOP_COMPLAINT_ATTACHMENTS' => 'Attachments: ',

    'LBL_AOP_COMPLAINT_EVENTS' => 'Complaint Events',
    'LBL_COMPLAINT_ATTACHMENTS_DISPLAY' => 'Complaint Attachments:',
    'LBL_ADD_COMPLAINT_FILE' => 'Add file',
    'LBL_REMOVE_COMPLAINT_FILE' => 'Remove file',
    'LBL_SELECT_COMPLAINT_DOCUMENT' => 'Select document',
    'LBL_CLEAR_COMPLAINT_DOCUMENT' => 'Clear document',
    'LBL_SELECT_INTERNAL_COMPLAINT_DOCUMENT' => 'Internal CRM document',
    'LBL_SELECT_EXTERNAL_COMPLAINT_DOCUMENT' => 'External file',
    'LBL_CONTACT_CREATED_BY_NAME' => 'Created by contact',
    'LBL_CONTACT_CREATED_BY' => 'Created by',
    'LBL_COMPLAINT_UPDATE_FORM' => 'Updates - Attachment form', //Form for attachements on case updates
	'LBL_COUNTRY' => 'Country',
	
	'LBL_Z_BAD_DRIVER_3_NAME' => 'Bad Driver 3 Name',
	'LBL_Z_EMPLOYER_DRIVER_3_NAME' => 'Owner Bad Vehicle 3 Name',
	'LBL_Z_BAD_DRIVER_4_NAME' => 'Bad Driver 4 Name',
	'LBL_Z_OWNER_BAD_VEHICLE_4_NAME' => 'Owner Bad Vehicle 4 Name',
	'LBL_Z_EMPLOYER_DRIVER_4_NAME' => 'Employer Driver 4 Name',
	
);

?>
