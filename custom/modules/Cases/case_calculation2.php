<?php
   class case_calculation {
		function Setfilter_5($bean, $event, $arguments){
		  global $db, $app_list_strings;
		  $filter_5_total = 0;
		 $sql = "SELECT * 
				 FROM `cases_cstm`
				 WHERE cases_cstm.id_c = '{$bean->id}'";
			$result = $db->query($sql, true);
			$row = $db->fetchByAssoc($result);
		   $no_of_days_status = $app_list_strings['case_status_dom_days'][$bean->status];
			$bean->filter_5 = $row[$no_of_days_status];
		}
		function Setfilter_6($bean, $event, $arguments){
		  global $db, $app_list_strings;
		  $filter_6_total = 0;
		 $sql = "SELECT * 
				 FROM `cases_cstm`
				 WHERE cases_cstm.id_c = '{$bean->id}'";
			$result = $db->query($sql, true);
			$row = $db->fetchByAssoc($result);
		   $no_of_days_status = $app_list_strings['case_status_dom_days'][$bean->status];
			$bean->filter_6 = $row[$no_of_days_status];
		}
		function calculate_no_of_days($bean, $event, $arguments){
		  global $db, $app_list_strings;
		  $no_of_days = 0;
		 $sql = "SELECT * 
				 FROM `cases_cstm`
				 WHERE cases_cstm.id_c = '{$bean->id}'";
			$result = $db->query($sql, true);
			$row = $db->fetchByAssoc($result);
		   $no_of_days_status = $app_list_strings['case_status_dom_days'][$bean->status];
			$no_of_days = $row[$no_of_days_status];
			$bean->case_status_no_of_days = $no_of_days;
		}
		function calculate_fee_minus_referral_c($bean, $event, $arguments){
		  $bean->fee_minus_referral_c = $bean->firm_fee_c - $bean->referral_fee_c;
		}
		function calculate_total_medical_bill($bean, $event, $arguments){
			global $db;
			if(!empty($bean->contact_id2_c)){
				$total_medical_bills_c = 0;
				$sql = "SELECT medb_medical_bills.balance, medb_medical_bills.reduction_amount 
					FROM `medb_medical_bills_contacts_c`
					LEFT JOIN medb_medical_bills ON(medb_medical_bills.deleted = 0 AND medb_medical_bills.id = medb_medical_bills_contacts_c.medb_medical_bills_contactsmedb_medical_bills_idb)
					WHERE medb_medical_bills_contacts_c.deleted = 0 AND medb_medical_bills_contacts_c.medb_medical_bills_contactscontacts_ida = '{$bean->contact_id2_c}' AND medb_medical_bills.lop_lien = 0";
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
				
		}
		function statute_of_limitations_calculations($bean, $event, $arguments){
			if(strpos($bean->type, 'Medical_Malpractice') !== false){ 
				$new_date = $this->CalculateDateLeapYear($bean->date_of_incident_c, 2);
				$bean->statute_of_limitations_c = $new_date;
				$bean->statute_of_limitations_2nd_c = $new_date;
			}else if(strpos($bean->type, 'Medical_Malpractice_Death') !== false){ 
				$new_date = $this->CalculateDateLeapYear($bean->date_of_incident_c, 2);
				$bean->statute_of_limitations_c = $new_date;
				$bean->statute_of_limitations_2nd_c = $new_date;
			}
			else if(strpos($bean->type, 'Death') !== false){
				$new_date = $this->CalculateDateLeapYear($bean->date_of_incident_c, 4);
				$bean->statute_of_limitations_c = $new_date;
				$bean->statute_of_limitations_2nd_c = $new_date;
			}else{
				$new_date = $this->CalculateDateLeapYear($bean->date_of_incident_c, 4);
				$bean->statute_of_limitations_c = $new_date;
				$bean->statute_of_limitations_2nd_c = $new_date;
			}
		}
		function CalculateDateLeapYear($input_date, $years){
			$input_date = strtotime($input_date);
			$input_date = strtotime("+ 1 days", $input_date);
			$first_date = date('Y-m-d', $input_date); 
			$last_date = strtotime("+ {$years} year", $input_date);
			$last_date = date('Y-m-d', $last_date);
			$first_year = date('Y', strtotime($first_date));
			$last_year = date('Y', strtotime($last_date));
			$leap_count = 0;
			for($year=$first_year; $year<=$last_year; $year++){  
				If ($this->isLeap($year)){
					$leap_count++;  
				}
			}
			$last_date = strtotime($last_date);
			$last_date = strtotime("+ {$leap_count} days" , $last_date);
			$last_date = date('Y-m-d', $last_date);
			return $last_date;
		}
		function isLeap($year){  
			return (date('L', mktime(0, 0, 0, 1, 1, $year))==1);  
		}
   }