<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

		global $db;

		$sql = "SELECT a.id, LTRIM(RTRIM(LEFT(a.name,(LOCATE(' ',a.name))))) as unique_name, 			email_addresses.email_address, a.phone_office

			FROM accounts a
			LEFT JOIN accounts_cstm ON(accounts_cstm.id_c = a.id)
					LEFT JOIN email_addr_bean_rel ON(email_addr_bean_rel.deleted = 0 AND email_addr_bean_rel.bean_id = a.id)
					LEFT JOIN email_addresses ON(email_addresses.deleted = 0 AND email_addr_bean_rel.email_address_id = email_addresses.id)
					JOIN (SELECT accounts.id, LTRIM(RTRIM(LEFT(accounts.name,(LOCATE('-',accounts.name))))) as unique_name, email_addresses.email_address,  accounts.phone_office, COUNT(*)
					FROM accounts 
					LEFT JOIN accounts_cstm ON(accounts_cstm.id_c = accounts.id)
					LEFT JOIN email_addr_bean_rel ON(email_addr_bean_rel.deleted = 0 AND email_addr_bean_rel.bean_id = accounts.id)
					LEFT JOIN email_addresses ON(email_addresses.deleted = 0 AND email_addr_bean_rel.email_address_id = email_addresses.id)
					
					HAVING count(*) > 1 ) b
					ON a.name LIKE CONCAT('%',unique_name, '%')
					OR email_addresses.email_address = b.email_address
					OR a.phone_office = b.phone_office
					WHERE a.deleted = 0";
		
		$data = array();
		$result = $db->query($sql, true);
		while($row = $db->fetchByAssoc($result)){
			$data[$row['unique_name']][] = $row['id'];
		}
			/* print"<pre>";print_r($data);die; */
		echo 'done';
		
		
		foreach($data as $data_part){
			
			update_medical_provider_account_data($data_part[0],$data_part);
			/* update_medical_report_account_data($data_part[0],$data_part);  */
			/* save_data($data_part[0],$data_part); */
			/* move_merge_data($data_part[0],$data_part); */
		}
		die('test');
		function save_data($parent_id, $data_part){
				global $db, $current_user;
				/* echo $parent_id;die; */
				unset($data_part[0]);
				/* print"<pre>";print_r($data_part);die; */
				if(is_array($data_part) && isset($data_part) && !empty($data_part)){
					foreach($data_part as $key => $ids){
						$sql = "SELECT * 
								FROM `accounts` 
								LEFT JOIN accounts_cstm ON(accounts_cstm.id_c = accounts.id)
								WHERE accounts.deleted = 0 AND accounts.id = '{$ids}'
								";
						$result = $db->query($sql, true);
						while($row = $db->fetchByAssoc($result)){
						
						$ht_address_book = new ht_address_book();
						$ht_address_book->name  =  $row['name'];
						$ht_address_book->description  =  $row['description'];
						$ht_address_book->phone_fax  =  $row['phone_fax'];
						$ht_address_book->phone_alternate  =  $row['phone_alternate'];
						$ht_address_book->billing_address_street  =  $row['billing_address_street'];
						$ht_address_book->billing_address_city  =  $row['billing_address_city'];
						$ht_address_book->billing_address_state  =  $row['billing_address_state'];
						$ht_address_book->billing_address_postalcode  = $row['billing_address_postalcode'];
						$ht_address_book->billing_address_country  = $row['billing_address_country'];
						$ht_address_book->website  = $row['website'];
						$ht_address_book->phone_office  = $row['phone_office'];
						$ht_address_book->shipping_location_address  =  $row['shipping_location_address'];
						$ht_address_book->shipping_address_city  =  $row['shipping_address_city'];
						$ht_address_book->shipping_address_state  =  $row['shipping_address_state'];
						$ht_address_book->shipping_address_postalcode  = $row['shipping_address_postalcode'];
						$ht_address_book->shipping_address_country  = $row['shipping_address_country'];
						$ht_address_book->account_id  = $parent_id;
						$ht_address_book->assigned_user_id  = $current_user->id;
						$ht_address_book->save();
						
						}
						$updateaccounts = "UPDATE accounts
									SET accounts.deleted = '2'
									WHERE accounts.id = '{$ids}'";
						$db->query($updateaccounts);
					}
					

				}
		}
		
		
		function move_merge_data($parent_id, $data_part){
			global $db, $current_user;
			unset($data_part[0]);
			if(is_array($data_part) && isset($data_part) && !empty($data_part)){
				foreach($data_part as $key => $ids){
					// cases
					$sql1 = "SELECT * 
							FROM `accounts_cases` 
							WHERE accounts_cases.deleted = 0 AND accounts_cases.account_id = '{$ids}'
							";
					$result1 = $db->query($sql1, true);
					while($row1 = $db->fetchByAssoc($result1)){
						
						$accounts_cases_insert = "INSERT INTO accounts_cases (id, account_id, case_id, date_modified)
										VALUES (UUID(), '{$parent_id}', '{$row1['case_id']}', NOW())";
						$db->query($accounts_cases_insert);
						$updatecase = "UPDATE accounts_cases
										SET accounts_cases.deleted = '2'
										WHERE accounts_cases.id = '{$row1['id']}'";
						$db->query($updatecase);
					}
					// leads
					$sql2 = "SELECT * 
							FROM `leads` 
							WHERE leads.deleted = 0 AND leads.account_id = '{$ids}'
							";
					$result2 = $db->query($sql2, true);
					while($row2 = $db->fetchByAssoc($result2)){
						$updateleads = "UPDATE leads
										SET leads.account_id = '{$parent_id}'
										WHERE leads.id = '{$row2['id']}'";
						$db->query($updateleads);
					}
					// contacts
					$sql3 = "SELECT * 
							FROM `accounts_contacts` 
							WHERE accounts_contacts.deleted = 0 AND accounts_contacts.account_id = '{$ids}'
							";
					$result3 = $db->query($sql3, true);
					while($row3 = $db->fetchByAssoc($result3)){
						$accounts_contacts_insert = "INSERT INTO accounts_contacts (id, contact_id, account_id, date_modified)
										VALUES (UUID(), '{$row3['contact_id']}', '{$parent_id}', NOW())";
						$db->query($accounts_contacts_insert);
						$updatecontacts = "UPDATE accounts_contacts
										SET accounts_contacts.deleted = '2'
										WHERE accounts_contacts.id = '{$row3['id']}'";
						$db->query($updatecontacts);
					}
					// documents
					$sql4 = "SELECT * 
							FROM `documents_accounts` 
							WHERE documents_accounts.deleted = 0 AND documents_accounts.account_id = '{$ids}'
							";
					$result4 = $db->query($sql4, true);
					while($row4 = $db->fetchByAssoc($result4)){
						$documents_accounts_insert = "INSERT INTO documents_accounts (id, document_id, account_id, date_modified)
										VALUES (UUID(), '{$row4['document_id']}', '{$parent_id}', NOW())";
						$db->query($documents_accounts_insert);
						$updatedocuments = "UPDATE documents_accounts
										SET documents_accounts.deleted = '2'
										WHERE documents_accounts.id = '{$row4['id']}'";
						$db->query($updatedocuments);
					}
					// notes
					$sql5 = "SELECT * 
							FROM `notes` 
							WHERE notes.deleted = 0 AND notes.parent_id = '{$ids}'
							";
					$result5 = $db->query($sql5, true);
					while($row5 = $db->fetchByAssoc($result5)){
						$updatenotes = "UPDATE notes
										SET notes.parent_id = '{$parent_id}'
										WHERE notes.id = '{$row5['id']}'";
						$db->query($updatenotes);
					}
					
					// calls
					$sql6 = "SELECT * 
							FROM `calls` 
							WHERE calls.deleted = 0 AND calls.parent_id = '{$ids}'
							";
					$result6 = $db->query($sql6, true);
					while($row6 = $db->fetchByAssoc($result6)){
						$updatecalls = "UPDATE calls
										SET calls.parent_id = '{$parent_id}'
										WHERE calls.id = '{$row6['id']}'";
						$db->query($updatecalls);
					}
					
					// tasks
					$sql7 = "SELECT * 
							FROM `tasks` 
							WHERE tasks.deleted = 0 AND tasks.parent_id = '{$ids}'
							";
					$result7 = $db->query($sql7, true);
					while($row7 = $db->fetchByAssoc($result7)){
						$updatetasks = "UPDATE tasks
										SET tasks.parent_id = '{$parent_id}'
										WHERE tasks.id = '{$row7['id']}'";
						$db->query($updatetasks);
					}
					
					// fp events
					$sql8 = "SELECT * 
							FROM `fp_events`
							LEFT JOIN fp_events_cstm ON (fp_events.deleted = 0 AND fp_events_cstm.id_c = fp_events.id)
							WHERE fp_events_cstm.account_id_c = '{$ids}'
							";
							
					$result8 = $db->query($sql8, true);
					while($row8 = $db->fetchByAssoc($result8)){
						$updateevenets = "UPDATE fp_events_cstm
										SET fp_events_cstm.account_id_c = '{$parent_id}'
										WHERE fp_events_cstm.id_c = '{$row8['id']}'";
						$db->query($updateevenets);
					}
				}
			}
		}
		// FOR medical Summary Report
		function update_medical_report_account_data($parent_id, $data_part){
			global $db, $current_user;
			unset($data_part[0]);
			if(is_array($data_part) && isset($data_part) && !empty($data_part)){
				foreach($data_part as $key => $ids){
						// cases
						$sql1 = "SELECT mts_medical_treatment_summary.id, mts_medical_treatment_summary.account_id_c
									FROM `mts_medical_treatment_summary`
									WHERE mts_medical_treatment_summary.deleted = 0 AND mts_medical_treatment_summary.account_id_c = '{$ids}'";
						$result1 = $db->query($sql1, true);
						while($row1 = $db->fetchByAssoc($result1)){

							$updatemts_medical_treatment_summary = "UPDATE mts_medical_treatment_summary
											SET mts_medical_treatment_summary.account_id_c = '{$parent_id}'
											WHERE mts_medical_treatment_summary.id = '{$row1['id']}'";
							$db->query($updatemts_medical_treatment_summary);
						}
				}
			}
		}
		
		// FOR medical Provider module
		function update_medical_provider_account_data($parent_id, $data_part){
			global $db, $current_user;
			unset($data_part[0]);
			if(is_array($data_part) && isset($data_part) && !empty($data_part)){
				foreach($data_part as $key => $ids){
						// cases
						$sql1 = "SELECT medp_medical_providers.id, medp_medical_providers.account_id_c 
									FROM `medp_medical_providers`
									WHERE deleted = 0 AND medp_medical_providers.account_id_c = '{$ids}'";
						$result1 = $db->query($sql1, true);
						while($row1 = $db->fetchByAssoc($result1)){
							/* print"<pre>";print_r($row1); */
							$updatemedp_medical_providers = "UPDATE medp_medical_providers
											SET medp_medical_providers.account_id_c = '{$parent_id}'
											WHERE medp_medical_providers.id = '{$row1['id']}'";
							$db->query($updatemedp_medical_providers);
						}
				}
			}
		}