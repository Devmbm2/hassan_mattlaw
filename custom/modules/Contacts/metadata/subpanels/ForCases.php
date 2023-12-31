<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */

// $Id: ForCases.php 13782 2006-06-06 17:58:55Z majed $
$subpanel_layout = array(
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopCreateButton'),
		array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Contacts'),
	),

	'where' => '',
	
	

	'list_fields' => array(
		'first_name'=>array(
			'name'=>'first_name',
			'usage' => 'query_only',
		),
		'last_name'=>array(
			'name'=>'last_name',
		 	'usage' => 'query_only',
		),
		'salutation'=>array(
			'name'=>'salutation',
		 	'usage' => 'query_only',
		),
		'name'=>array(
			'name'=>'name',		
			'vname' => 'LBL_LIST_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
		 	'module' => 'Contacts',
			'width' => '23%',
		),
		'account_name'=>array(
			'name'=>'account_name',
		 	'module' => 'Accounts',
		 	'target_record_key' => 'account_id',
		 	'target_module' => 'Accounts',
			'widget_class' => 'SubPanelDetailViewLink',
		 	'vname' => 'LBL_LIST_ACCOUNT_NAME',
			'width' => '22%',
			'sortable'=>false,
		),
		'account_id'=>array(
			'usage'=>'query_only',
			
		),
		'contact_case_fields'=>array(
                        'usage' => 'query_only',
                ),
                'contact_case_id'=>array(
                        'usage' => 'query_only',
                ),
                'contact_role'=>array(
                        'name'=>'contact_role',
                        'vname' => 'LBL_CASE_CONTACT_ROLE',
                        'width' => '10%',
                        'sortable'=>false,
		),
		'email'=>array(
			'name'=>'email',
			'vname' => 'LBL_LIST_EMAIL',
			'widget_class' => 'SubPanelEmailLink',
			'width' => '30%',
			'sortable' => false,
		),
		'phone_work'=>array (
			'name'=>'phone_work',		
			'vname' => 'LBL_LIST_PHONE',
			'width' => '15%',
		),
		'edit_button'=>array(
			'vname' => 'LBL_EDIT_BUTTON',
			'widget_class' => 'SubPanelEditCaseContactButton',
			'case_contact_role_id'=>'case_contact_role_id',
		 	'module' => 'Contacts',
			'width' => '5%',
		),
		'remove_button'=>array(
			'vname' => 'LBL_REMOVE',
			'widget_class' => 'SubPanelRemoveButton',
		 	'module' => 'Contacts',
			'width' => '5%',
		),
	),
);		
?>
