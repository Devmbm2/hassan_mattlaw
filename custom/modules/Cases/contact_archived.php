<?php
   class contact_archived {
		function set_contact_archived($bean, $event, $arguments){
		  global $db;
		  if($bean->status == 'Closed'){
			$related_contacts = array();
			$roles = array('Defendant', 'Injured_Person', 'Insured_Person', 'Injured_Person', 'Client', 'Primary_Contact', 'Witness_B_A', 	'Witness_Fact_Plaintiff', 'Witness_Fact_Defendant');
			$sql = "SELECT DISTINCT contacts_cases.id, contacts_cases.contact_id, contacts_cases.contact_role
				FROM `contacts_cases`
				WHERE contacts_cases.deleted = 0 AND contacts_cases.case_id = '{$bean->id}' AND contacts_cases.contact_id != ''";
			$result = $db->query($sql, true);
			while($row = $db->fetchByAssoc($result)){
				if(in_array($row['contact_role'],  $roles)){
					$related_contacts[] = $row['contact_id'];
				}
			}
			foreach($related_contacts as $contact_id){
				$db->query("UPDATE contacts
							SET is_archived = 1
							WHERE id = '{$contact_id}'");
			}
			  
		  }
		  
		}
   }