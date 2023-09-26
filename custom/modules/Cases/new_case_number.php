<?php
class CaseNumber {
      function newCaseNumber($bean, $event, $arguments)
      {
        //Query CASES table for the last Case Record
            //$case_id = $bean->id;
            $query = 'SELECT COUNT(*) AS totalcase FROM cases_cstm';
            $results = $bean->db->query($query, true);
            $row = $bean->db->fetchByAssoc($results);
            $total_case = $row['totalcase'];
                //Determine the year
            $current_year = date('Y');
                //Calculate the case number
            $new_case_series = $total_case + 1;
	    $new_case_no = str_pad($new_case_series, 5, "0", STR_PAD_LEFT);
            $new_case = $current_year . "-" . $new_case_no;
                //Set the value
            if (empty($bean->fetched_row['new_case_number_c'])){
             $bean->new_case_number_c = $new_case;
            }
           }
}

