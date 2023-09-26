<?php
   if (!defined('sugarEntry') || !sugarEntry) {die('Not A Valid Entry Point');}
   class calculation_class {
     function calculation_method(&$bean, $event, $arguments) {
		global $db;
		if($bean->status == 'Voided'){
			 $db->query("UPDATE cost_client_cost SET total_amount = '0.00' WHERE id = '{$bean->id}'");
		 }
		 if($bean->number_of_ways_to_split > 0){
			  $total_amount = $bean->total_amount / $bean->number_of_ways_to_split;
			  $db->query("UPDATE cost_client_cost SET total_amount = '{$total_amount}' WHERE id = '{$bean->id}'");
			  SugarApplication::appendErrorMessage("You indicated that this cost was split between other companions in the Case. Please duplicate this cost record until all the companions’ cost splits are reflected accurately in the Case.");
		 }
	 }
}


