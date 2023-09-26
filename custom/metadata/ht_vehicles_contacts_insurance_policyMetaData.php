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
$dictionary['ht_veh_con_in_poli'] = array(
    'table' => 'ht_veh_con_in_poli',
    'fields' => array(
        array('name' => 'id', 'type' => 'id'),
        array('name' => 'veh_con_relation_id', 'type' => 'id'),
        array('name' => 'insu_id', 'type' => 'id'),
		array('name' =>'insu_role', 'type' =>'varchar', 'len'=>'50'),
		array ('name' => 'date_modified','type' => 'datetime')
      , array('name' =>'deleted', 'type' =>'bool', 'len'=>'1', 'default'=>'0','required'=>false)
                                                      )                                  , 'indices' => array (
       array('name' =>'ht_vehicles_contactspk', 'type' =>'primary', 'fields'=>array('id'))
      , array('name' =>'idx_con_vehicle_con', 'type' =>'index', 'fields'=>array('veh_con_relation_id'))
      , array('name' =>'idx_con_vehicle_vehicle', 'type' =>'index', 'fields'=>array('insu_id'))
      , array('name' => 'idx_ht_vehicles_contacts', 'type'=>'alternate_key', 'fields'=>array('veh_con_relation_id','insu_id'))                  
                                                      )
 	  , 'relationships' => array ('ht_veh_con_in_poli' => array('lhs_module'=> 'DEF_Client_Insurance', 'lhs_table'=> 'def_client_insurance', 'lhs_key' => 'id',
							  'rhs_module'=> 'ht_vehicles', 'rhs_table'=> 'vehicles', 'rhs_key' => 'id',
							  'relationship_type'=>'many-to-many',
							  'join_table'=> 'ht_veh_con_in_poli', 'join_key_lhs'=>'insu_id', 'join_key_rhs'=>'veh_con_relation_id'))
                                  
)
?>
