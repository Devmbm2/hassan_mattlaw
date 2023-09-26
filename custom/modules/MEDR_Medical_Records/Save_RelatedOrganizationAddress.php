<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class Save_RelatedOrganizationAddress{
	
	function save_related_address($bean, $event, $arguments){
		
		if(!empty($bean->medical_provider)){
			
			$account_id = $bean->account_id_c;
			$focus = new Account(); 
			$account = $focus->retrieve($account_id);
			$bean->primary_address_street = $account->billing_address_street;
			$bean->primary_address_city = $account->billing_address_city;
			$bean->primary_address_state = $account->billing_address_state;
			$bean->primary_address_postalcode = $account->billing_address_postalcode;
			$bean->primary_address_country = $account->billing_address_country;
		}
		else{
			$bean->primary_address_street = '';
			$bean->primary_address_city = '';
			$bean->primary_address_state = '';
			$bean->primary_address_postalcode = '';
			$bean->primary_address_country = '';
		}
		
		
	}
}