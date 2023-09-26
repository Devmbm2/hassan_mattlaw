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
$dictionary['ht_vehicles_accounts'] = array(
    'table' => 'ht_vehicles_accounts',
    'fields' => array(
        array('name' => 'id', 'type' => 'id'),
        array('name' => 'vehicle_id', 'type' => 'id'),
        array('name' => 'account_id', 'type' => 'id'),
	array('name' =>'vehicle_role', 'type' =>'varchar', 'len'=>'50'),
	array('name' =>'account_role', 'type' =>'varchar', 'len'=>'50')
      , array ('name' => 'date_modified','type' => 'datetime')
      , array('name' =>'deleted', 'type' =>'bool', 'len'=>'1', 'default'=>'0','required'=>false)
                                                      )                                  , 'indices' => array (
       array('name' =>'ht_vehicles_accountspk', 'type' =>'primary', 'fields'=>array('id'))
      , array('name' =>'idx_con_vehicle_vehicle', 'type' =>'index', 'fields'=>array('vehicle_id'))
      , array('name' =>'idx_con_vehicle_con', 'type' =>'index', 'fields'=>array('account_id'))
      , array('name' => 'idx_ht_vehicles_accounts', 'type'=>'alternate_key', 'fields'=>array('vehicle_id', 'account_id'))                  
                                                      )
 	  , 'relationships' => array ('ht_vehicles_accounts' => array('rhs_module'=> 'Accounts', 'rhs_table'=> 'accounts', 'rhs_key' => 'id',
							  'lhs_module'=> 'ht_vehicles', 'lhs_table'=> 'ht_vehicles', 'lhs_key' => 'id',
							  'relationship_type'=>'many-to-many',
							  'join_table'=> 'ht_vehicles_accounts', 'join_key_lhs'=>'vehicle_id', 'join_key_rhs'=>'account_id'))
                                  
)
?>
