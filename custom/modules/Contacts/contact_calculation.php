<?php
   if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
   class contact_calculation {
      function calculation($bean, $event, $arguments){
		  global $db;
		$dateOfBirth = $bean->birthdate;
		$today = date("Y-m-d");
		$diff = date_diff(date_create($dateOfBirth), date_create($today));
		$bean->age_c = $diff->format('%y');
		
		$sql = "SELECT medb_medical_bills.balance 
				FROM `medb_medical_bills_contacts_c`
				LEFT JOIN medb_medical_bills ON(medb_medical_bills.deleted = 0 AND medb_medical_bills.id = medb_medical_bills_contacts_c.medb_medical_bills_contactsmedb_medical_bills_idb)
				WHERE medb_medical_bills_contacts_c.deleted = 0 AND medb_medical_bills_contacts_c.medb_medical_bills_contactscontacts_ida = '{$bean->id}' AND medb_medical_bills.lop_lien = 1";
		$total_lops_liens_c = 0;
		$total_medical_bills_c = 0;
		$result = $db->query($sql, true);
		while($row = $db->fetchByAssoc($result)){
			$total_lops_liens_c  += $row['balance'];
		}
		$bean->total_lops_liens_c = $total_lops_liens_c;
		
		$sql = "SELECT medb_medical_bills.balance, medb_medical_bills.reduction_amount 
				FROM `medb_medical_bills_contacts_c`
				LEFT JOIN medb_medical_bills ON(medb_medical_bills.deleted = 0 AND medb_medical_bills.id = medb_medical_bills_contacts_c.medb_medical_bills_contactsmedb_medical_bills_idb)
				WHERE medb_medical_bills_contacts_c.deleted = 0 AND medb_medical_bills_contacts_c.medb_medical_bills_contactscontacts_ida = '{$bean->id}' AND medb_medical_bills.lop_lien = 0";
		$result = $db->query($sql, true);
		while($row = $db->fetchByAssoc($result)){
			if($row['reduction_amount'] == '' || $row['reduction_amount'] == 0){
				$total_medical_bills_c += $row['balance'];
			}else{
				$total_medical_bills_c  += $row['reduction_amount'];
				
			}
		}
		$bean->total_medical_bills_c = $total_medical_bills_c;
      }
	  
	  function contact_calculation_confidential($bean, $event, $arguments){
		  global $app_list_strings;
		  $sum = 0;
		  $average = 0;
		  $fields = array('language_skills_c', 'financial_status_c', 'social_skills_c', 'appearance_dress_c', 'overall_jury_appeal_c', 'clients_relationships_c');
		  $count = count($fields);
		  foreach($fields as $field_name){
			  $sum += $app_list_strings['confidential_info_score'][$field_name][$bean->$field_name];
		  }
		  
		  $average = round($sum/$count ,1);
		  $bean->confidentail_calculation = $average;
	  } 
	  function contact_gender($bean, $event, $arguments){
		  global $app_list_strings;
		  if($bean->gender_c != $bean->fetched_row['gender_c']){
			if($bean->gender_c == 'Male'){
				$bean->he_she_they_c = 'he';
				$bean->him_her_them_c = 'him';
				$bean->himself_herself_themselves_c = 'himself';
				$bean->his_hers_theirs_c = 'his';
			}else if($bean->gender_c == 'Female'){
				$bean->he_she_they_c = 'she';
				$bean->him_her_them_c = 'her';
				$bean->himself_herself_themselves_c = 'herself';
				$bean->his_hers_theirs_c = 'hers';
			}
		  }
	  } 
	  function concat_name($bean, $event, $arguments){
		  global $db, $app_list_strings;
		  $sql = "SELECT * FROM contacts WHERE contacts.deleted = 0 AND contacts.id = '{$bean->id}'";
		  $result = $db->query($sql, true);
		  $row = $db->fetchByAssoc($result);
		  $salutation = str_replace($row['first_name'],"",$row['salutation']);
		  $suffix = '';
		  if(isset($row['suffix']) && !empty($row['suffix'])){
			  $suffix = ', '.$row['suffix'];
		  }
		  $bean->custom_full_name = $salutation .' '.$row['first_name'] .' '.$row['middle_name'] .' '.$row['last_name'] .''.$suffix;
	  }
   }
   
