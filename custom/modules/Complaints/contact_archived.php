<?php
   class contact_archived {
		function set_contact_archived($bean, $event, $arguments){
		  global $db;
		  if($bean->status == 'Closed'){
			$related_contacts = array();
			$roles = array('Defendant', 'Injured_Person', 'Insured_Person', 'Injured_Person', 'Client', 'Primary_Contact', 'Witness_B_A', 	'Witness_Fact_Plaintiff', 'Witness_Fact_Defendant');
			$sql = "SELECT DISTINCT contacts_complaints.id, contacts_complaints.contact_id, contacts_complaints.contact_role
				FROM `contacts_complaints`
				WHERE contacts_complaints.deleted = 0 AND contacts_complaints.complaint_id = '{$bean->id}' AND contacts_complaints.contact_id != ''";
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