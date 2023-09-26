<?php
   if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
   class clone_name {
      function before_save($bean, $event, $arguments) {
		$bean->name = $bean->companion;
      } 
	  function calculation($bean, $event, $arguments) {
			global $db;
			if(!empty($bean->contact_id_c)){
				$related_contact = BeanFactory::getBean('Contacts', $bean->contact_id_c);
				$bean->age = $related_contact->age_c;
				$sql = "SELECT medb_medical_bills.balance, medb_medical_bills.total_charges 
				FROM `medb_medical_bills_contacts_c`
				LEFT JOIN medb_medical_bills ON(medb_medical_bills.deleted = 0 AND medb_medical_bills.id = medb_medical_bills_contacts_c.medb_medical_bills_contactsmedb_medical_bills_idb)
				WHERE medb_medical_bills_contacts_c.deleted = 0 AND medb_medical_bills_contacts_c.medb_medical_bills_contactscontacts_ida = '{$bean->id}'";
				$total_lops_liens_c = 0;
				$total_charges = 0;
				$balance = 0;
				$total_medical_bills_c = 0;
				$result = $db->query($sql, true);
				while($row = $db->fetchByAssoc($result)){
					$total_lops_liens_c  += $row['balance'];
					$total_charges  += $row['total_charges'];
				}
				$bean->total_lops_liens = $total_charges;
				$bean->balance = $balance;
				$bean->total_medical_bills = $related_contact->total_medical_bills_c;
			}
      }
	  
   }
?>      
