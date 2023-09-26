<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

		global $db;

		$sql = "SELECT DISTINCT a.id, LTRIM(RTRIM(LEFT(a.name,(LOCATE(' ',a.name))))) as unique_name, 	a.contact_id_c, a.account_id_c
			FROM medp_medical_providers a
			JOIN (SELECT DISTINCT  medp_medical_providers.id, LTRIM(RTRIM(LEFT(medp_medical_providers.name,(LOCATE(' ',			medp_medical_providers.name))))) as unique_name, medp_medical_providers.contact_id_c, medp_medical_providers.account_id_c, COUNT(*)
			FROM medp_medical_providers 
			GROUP BY 	unique_name, medp_medical_providers.contact_id_c, medp_medical_providers.account_id_c
			HAVING count(*) > 1 ) b
			ON a.name LIKE CONCAT('%',unique_name, '%') 
			WHERE a.deleted = 0 AND a.name LIKE '%Advance%'";
		
		$data = array();
		$result = $db->query($sql, true);
		while($row = $db->fetchByAssoc($result)){
			echo $row['contact_id_c'];echo'<hr>';
			echo $row['account_id_c'];echo'<hr>';
			/* if(empty($row['contact_id_c']) || empty($row['account_id_c'])){ */
				/* $index = $row['unique_name'].'_'.$row['contact_id_c'].'_'.$row['account_id_c']; */
				$data[$row['unique_name']][] = $row['id'];
			/* } */
		}
			/* print"<pre>";print_r($data);die; */
		echo 'done';
		
		
		foreach($data as $data_part){
			move_merge_data($data_part[0],$data_part);
			save_data($data_part[0],$data_part);
		}
		die('test');
		function save_data($parent_id, $data_part){
				global $db, $current_user;
				/* echo $parent_id;die; */
				unset($data_part[0]);
				/* print"<pre>";print_r($data_part);die; */
				if(is_array($data_part) && isset($data_part) && !empty($data_part)){
					foreach($data_part as $key => $ids){
						/* $sql = "SELECT * 
								FROM `accounts` 
								LEFT JOIN accounts_cstm ON(accounts_cstm.id_c = accounts.id)
								WHERE accounts.deleted = 0 AND accounts.id = '{$ids}'
								";
						$result = $db->query($sql, true);
						while($row = $db->fetchByAssoc($result)){
						
						
						} */
						$updatemedp_medical_providers = "UPDATE medp_medical_providers
									SET medp_medical_providers.deleted = '2'
									WHERE medp_medical_providers.id = '{$ids}'";
						$db->query($updatemedp_medical_providers);
					}
					

				}
		}
		
		
		function move_merge_data($parent_id, $data_part){
			global $db, $current_user;
			unset($data_part[0]);
			if(is_array($data_part) && isset($data_part) && !empty($data_part)){
				foreach($data_part as $key => $ids){
					// contacts
					$sql1 = "SELECT * 
							FROM `contacts_medp_medical_providers_1_c` 
							WHERE deleted = 0 AND contacts_medp_medical_providers_1medp_medical_providers_idb = '{$ids}'
							";
							/* echo $sql1;die; */
					$result1 = $db->query($sql1, true);
					while($row1 = $db->fetchByAssoc($result1)){
						
						$contacts_medp_medical_providers_1_c_insert = "INSERT INTO contacts_medp_medical_providers_1_c (id, contacts_medp_medical_providers_1medp_medical_providers_idb, contacts_medp_medical_providers_1contacts_ida, date_modified)
										VALUES (UUID(), '{$parent_id}', '{$row1['contacts_medp_medical_providers_1contacts_ida']}', NOW())";
						$db->query($contacts_medp_medical_providers_1_c_insert);
						$update_medical_contact = "UPDATE contacts_medp_medical_providers_1_c
										SET contacts_medp_medical_providers_1_c.deleted = '2'
										WHERE contacts_medp_medical_providers_1_c.id = '{$row1['id']}'";
						$db->query($update_medical_contact);
					}
					
					// cases
					$sql1 = "SELECT * 
							FROM `medp_medical_providers_cases_c` 
							WHERE deleted = 0 AND medp_medical_providers_casesmedp_medical_providers_ida = '{$ids}'
							";
					$result1 = $db->query($sql1, true);
					while($row1 = $db->fetchByAssoc($result1)){
						
						$medp_medical_providers_cases_c = "INSERT INTO medp_medical_providers_cases_c (id, medp_medical_providers_casesmedp_medical_providers_ida, medp_medical_providers_casescases_idb, date_modified)
										VALUES (UUID(), '{$parent_id}', '{$row1['medp_medical_providers_casescases_idb']}', NOW())";
						$db->query($medp_medical_providers_cases_c);
						$update_medp_medical_providers_cases_c = "UPDATE medp_medical_providers_cases_c
										SET medp_medical_providers_cases_c.deleted = '2'
										WHERE medp_medical_providers_cases_c.id = '{$row1['id']}'";
						$db->query($update_medp_medical_providers_cases_c);
					}
					
				}
			}
		}