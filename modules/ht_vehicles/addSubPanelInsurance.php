<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

/*
ARGS:
 $_REQUEST['method']; : options: 'SaveRelationship','Save','DeleteRelationship','Delete'
 $_REQUEST['module']; : the module associated with this Bean instance (will be used to get the class name)
 $_REQUEST['record']; : the id of the Bean instance
// $_REQUEST['related_field']; : the field name on the Bean instance that contains the relationship
// $_REQUEST['related_record']; : the id of the related record
// $_REQUEST['related_']; : the
// $_REQUEST['return_url']; : the URL to redirect to
//$_REQUEST['return_type']; : when set the results of a report will be linked with the parent.
*/


require_once('include/formbase.php');

$refreshsubpanel=true;


	global $beanFiles, $beanList, $app_list_strings;
 	
	$relName = $_REQUEST['subpanel_field_name'];
	$insu_id = $_REQUEST['subpanel_id'];
	$row_module = $_REQUEST['row_module'];
	$record = $_REQUEST['record'];
	$parent_panel_id = $_REQUEST['parent_panel_id'];
	$insu_role = $app_list_strings['ht_vehicles_relation_role'][$parent_panel_id];
	
	$row_record_id = $_REQUEST['row_record_id'];
	$accountBean = BeanFactory::getBean('Accounts', $row_record_id);
	if(!empty($accountBean->id)){
		$select_query = "SELECT
			id
		FROM
			`ht_vehicles_accounts`
		WHERE
			deleted = 0
		AND account_id = '{$row_record_id}'
		AND vehicle_id = '{$record}'
		AND account_role = '{$insu_role}'";
	}else{
		$select_query = "SELECT
			id
		FROM
			`ht_vehicles_contacts`
		WHERE
			deleted = 0
		AND contact_id = '{$row_record_id}'
		AND vehicle_id = '{$record}'
		AND contact_role = '{$insu_role}'";
	}
	$result = $GLOBALS['db']->query($select_query);
	$row = $GLOBALS['db']->fetchByAssoc($result);
	if(!empty($row['id'])){
		$GLOBALS['db']->query("INSERT INTO `ht_veh_con_in_poli` (
			`id`,
			`veh_con_relation_id`,
			`insu_id`,
			`insu_role`,
			`date_modified`
		)
		VALUES
			(
				UUID(),
				'{$row['id']}',
				'{$insu_id}',
				'{$insu_role}',
				NOW()
		)");
	}
	// $focus->load_relationship($relName);
	// $focus->$relName->add($_REQUEST['subpanel_id'],$add_values);
	// $focus->save();


if ($refreshsubpanel) {
	//refresh contents of the sub-panel.
	$GLOBALS['log']->debug("Location: index.php?sugar_body_only=1&module=".$_REQUEST['module']."&subpanel=".$_REQUEST['subpanel_module_name']."&action=SubPanelViewer&inline=1&record={$record}");
	if( empty($_REQUEST['refresh_page']) || $_REQUEST['refresh_page'] != 1){
		$inline = isset($_REQUEST['inline'])?$_REQUEST['inline']: $inline;
	header("Location: index.php?sugar_body_only=1&module=".$_REQUEST['module']."&subpanel=".$_REQUEST['subpanel_module_name']."&action=SubPanelViewer&inline=$inline&record={$record}&row_record_id={$row_record_id}&row_id=".$_REQUEST['row_id']."&parent_panel_id={$parent_panel_id}");
	}
	exit;
}
