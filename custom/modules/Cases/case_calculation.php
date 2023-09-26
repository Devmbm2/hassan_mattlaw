<?php
class case_calculation
{
	function Setfilter_5($bean, $event, $arguments)
	{
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
	function Setfilter_6($bean, $event, $arguments)
	{
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
	function calculate_no_of_days($bean, $event, $arguments)
	{
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
	function calculate_fee_minus_referral_c($bean, $event, $arguments)
	{
		$bean->fee_minus_referral_c = $bean->firm_fee_c - $bean->referral_fee_c;
	}
	function calculate_total_medical_bill($bean, $event, $arguments)
	{
		global $db;
		if (!empty($bean->contact_id2_c)) {
			$total_medical_bills_c = 0;
			$sql = "SELECT medb_medical_bills.balance, medb_medical_bills.reduction_amount 
					FROM `medb_medical_bills_contacts_c`
					LEFT JOIN medb_medical_bills ON(medb_medical_bills.deleted = 0 AND medb_medical_bills.id = medb_medical_bills_contacts_c.medb_medical_bills_contactsmedb_medical_bills_idb)
					WHERE medb_medical_bills_contacts_c.deleted = 0 AND medb_medical_bills_contacts_c.medb_medical_bills_contactscontacts_ida = '{$bean->contact_id2_c}' AND medb_medical_bills.lop_lien = 0";
			$result = $db->query($sql, true);
			while ($row = $db->fetchByAssoc($result)) {
				if ($row['reduction_amount'] == '' || $row['reduction_amount'] == 0) {
					$total_medical_bills_c += $row['balance'];
				} else {
					$total_medical_bills_c  += $row['reduction_amount'];
				}
			}
			$bean->total_medical_bills_c = $total_medical_bills_c;
		}
	}
	function statute_of_limitations_calculations($bean, $event, $arguments)
	{

		global $db, $app_list_strings;
		$sql = "SELECT * 
				   FROM `sol_time`
				   WHERE case_type = '{$bean->type}' AND state_id='{$bean->state_of_incident}'";
			$result = $db->query($sql, true);
			// echo($result);

		if ($result->num_rows > 0) 
		{
			$row = $db->fetchByAssoc($result);

			$sol = (int)$row['sol'];

			if ($row['sol_category'] == 'Years') {
				$new_date = $this->CalculateDateLeapYear($bean->date_of_incident_c, $sol);
				$bean->statute_of_limitations_c = $new_date;
				$bean->statute_of_limitations_2nd_c = $new_date;
			}
			else if ($row['sol_category'] == 'Months') {
				$new_date = $this->CalculateDateLeapMonth($bean->date_of_incident_c, $sol);
				$bean->statute_of_limitations_c = $new_date;
				$bean->statute_of_limitations_2nd_c = $new_date;
			}
			else if ($row['sol_category'] == 'Days') {
				$new_date = $this->CalculateDateLeapDay($bean->date_of_incident_c, $sol);
				$bean->statute_of_limitations_c = $new_date;
				$bean->statute_of_limitations_2nd_c = $new_date;
			}
			else if ($row['sol_category'] == 'None') {
				if (strpos($bean->type, 'Medical_Malpractice') !== false) {
					$new_date = $this->CalculateDateLeapYear($bean->date_of_incident_c, 2);
					$bean->statute_of_limitations_c = $new_date;
					$bean->statute_of_limitations_2nd_c = $new_date;
				} else if (strpos($bean->type, 'Medical_Malpractice_Death') !== false) {
					$new_date = $this->CalculateDateLeapYear($bean->date_of_incident_c, 2);
					$bean->statute_of_limitations_c = $new_date;
					$bean->statute_of_limitations_2nd_c = $new_date;
				} else if (strpos($bean->type, 'Death') !== false) {
					$new_date = $this->CalculateDateLeapYear($bean->date_of_incident_c, 4);
					$bean->statute_of_limitations_c = $new_date;
					$bean->statute_of_limitations_2nd_c = $new_date;
				} else {
					$new_date = $this->CalculateDateLeapYear($bean->date_of_incident_c, 4);
					$bean->statute_of_limitations_c = $new_date;
					$bean->statute_of_limitations_2nd_c = $new_date;
				}
			}
		}
		else {
			// print_r('here');
			if (strpos($bean->type, 'Medical_Malpractice') !== false) {
				$new_date = $this->CalculateDateLeapYear($bean->date_of_incident_c, 2);
				$bean->statute_of_limitations_c = $new_date;
				$bean->statute_of_limitations_2nd_c = $new_date;
			} else if (strpos($bean->type, 'Medical_Malpractice_Death') !== false) {
				$new_date = $this->CalculateDateLeapYear($bean->date_of_incident_c, 2);
				$bean->statute_of_limitations_c = $new_date;
				$bean->statute_of_limitations_2nd_c = $new_date;
			} else if (strpos($bean->type, 'Death') !== false) {
				$new_date = $this->CalculateDateLeapYear($bean->date_of_incident_c, 4);
				$bean->statute_of_limitations_c = $new_date;
				$bean->statute_of_limitations_2nd_c = $new_date;
			} else {
				$new_date = $this->CalculateDateLeapYear($bean->date_of_incident_c, 4);
				$bean->statute_of_limitations_c = $new_date;
				$bean->statute_of_limitations_2nd_c = $new_date;
			}
	}
}
	function CalculateDateLeapYear($input_date, $years)
	{
		// echo($years);
		// die();
		$input_date = strtotime($input_date);
		// $input_date = strtotime("+ 1 days", $input_date);
		$first_date = date('Y-m-d', $input_date);
		$last_date = strtotime("+ {$years} year", $input_date);
		$last_date = date('Y-m-d', $last_date);
		// $first_year = date('Y', strtotime($first_date));
		// $last_year = date('Y', strtotime($last_date));
		// $leap_count = 0;
		// for ($year = $first_year; $year <= $last_year; $year++) {
		// 	if ($this->isLeap_year($year)) {
		// 		$leap_count++;
		// 	}
		// }
		$last_date = strtotime($last_date);
		// $last_date = strtotime("+ {$leap_count} days", $last_date);
		$last_date = date('Y-m-d', $last_date);
		return $last_date;
	}
	function isLeap_year($year)
	{
		return (date('L', mktime(0, 0, 0, 1, 1, $year)) == 1);
	}

	function CalculateDateLeapMonth($input_date, $months)
	{
		// echo($months);
		// die();
		$input_date = strtotime($input_date);
		// $input_date = strtotime("+ 1 days", $input_date);
		$first_date = date('Y-m-d', $input_date);
		$last_date = strtotime("+ {$months} months", $input_date);
		$last_date = date('Y-m-d', $last_date);
		// $first_year = date('Y', strtotime($first_date));
		// $last_year = date('Y', strtotime($last_date));
		// $leap_count = 0;
		// for ($year = $first_year; $year <= $last_year; $year++) {
		// 	if ($this->isLeap_month($year)) {
		// 		$leap_count++;
		// 	}
		// }
		$last_date = strtotime($last_date);
		// $last_date = strtotime("+ {$leap_count} days", $last_date);
		$last_date = date('Y-m-d', $last_date);
		return $last_date;
	}
	function isLeap_month($year)
	{
		return (date('L', mktime(0, 0, 0, 1, 1, $year)) == 1);
	}
	function CalculateDateLeapDay($input_date, $days)
	{
		$input_date = strtotime($input_date);
		// $input_date = strtotime("+ 1 days", $input_date);
		$first_date = date('Y-m-d', $input_date);
		$last_date = strtotime("+ {$days} days", $input_date);
		$last_date = date('Y-m-d', $last_date);
		// $first_year = date('Y', strtotime($first_date));
		// $last_year = date('Y', strtotime($last_date));
		// $leap_count = 0;
		// for ($year = $first_year; $year <= $last_year; $year++) {
		// 	if ($this->isLeap_day($year)) {
		// 		$leap_count++;
		// 	}
		// }
		$last_date = strtotime($last_date);
		// $last_date = strtotime("+ {$leap_count} days", $last_date);
		$last_date = date('Y-m-d', $last_date);
		return $last_date;
	}
	function isLeap_day($year)
	{
		return (date('L', mktime(0, 0, 0, 1, 1, $year)) == 1);
	}

	function CalculateDateLeapNone($input_date, $years)
	{
		$input_date = strtotime($input_date);
		// $input_date = strtotime("+ 1 days", $input_date);
		$first_date = date('Y-m-d', $input_date);
		$last_date = strtotime("+ {$years} year", $input_date);
		$last_date = date('Y-m-d', $last_date);
		// $first_year = date('Y', strtotime($first_date));
		// $last_year = date('Y', strtotime($last_date));
		// $leap_count = 0;
		// for ($year = $first_year; $year <= $last_year; $year++) {
		// 	if ($this->isLeap_None($year)) {
		// 		$leap_count++;
		// 	}
		// }
		$last_date = strtotime($last_date);
		// $last_date = strtotime("+ {$leap_count} days", $last_date);
		$last_date = date('Y-m-d', $last_date);
		return $last_date;
	}
	function isLeap_None($year)
	{
		return (date('L', mktime(0, 0, 0, 1, 1, $year)) == 1);
	}
}
