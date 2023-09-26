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
$dictionary['contacts_complaints'] = array(
    'table' => 'contacts_complaints',
    'fields' => array(
        array('name' => 'id', 'type' => 'id'),
        array('name' => 'contact_id', 'type' => 'id'),
        array('name' => 'complaint_id', 'type' => 'id'),
	array('name' =>'contact_role', 'type' =>'varchar', 'len'=>'50'),
	array('name' =>'complaint_role', 'type' =>'varchar', 'len'=>'50')
      , array ('name' => 'date_modified','type' => 'datetime')
      , array('name' =>'deleted', 'type' =>'bool', 'len'=>'1', 'default'=>'0','required'=>false)
                                                      )                                  , 'indices' => array (
       array('name' =>'contacts_complaintspk', 'type' =>'primary', 'fields'=>array('id'))
      , array('name' =>'idx_con_complaint_con', 'type' =>'index', 'fields'=>array('contact_id'))
      , array('name' =>'idx_con_complaint_complaint', 'type' =>'index', 'fields'=>array('complaint_id'))
      , array('name' => 'idx_contacts_complaints', 'type'=>'alternate_key', 'fields'=>array('contact_id','complaint_id'))                  
                                                      )
 	  , 'relationships' => array ('contacts_complaints' => array('lhs_module'=> 'Contacts', 'lhs_table'=> 'contacts', 'lhs_key' => 'id',
							  'rhs_module'=> 'Complaints', 'rhs_table'=> 'complaints', 'rhs_key' => 'id',
							  'relationship_type'=>'many-to-many',
							  'join_table'=> 'contacts_complaints', 'join_key_lhs'=>'contact_id', 'join_key_rhs'=>'complaint_id'))
                                  
)
?>
