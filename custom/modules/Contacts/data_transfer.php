<?php
/* 	global $db;

		$sql = "SELECT * 
				FROM `medr_medical_records_contacts_c` 
				WHERE medr_medical_records_contacts_c.deleted = 0";
		
		$data = array();
		$result = $db->query($sql, true);
		while($row = $db->fetchByAssoc($result)){
			$updateaccounts = "UPDATE medr_medical_records
									SET medr_medical_records.contact_id = '{$row['medr_medical_records_contactscontacts_ida']}'
									WHERE medr_medical_records.id = '{$row['medr_medical_records_contactsmedr_medical_records_idb']}'";
			$db->query($updateaccounts);
			
		}
		echo 'done'; */
		