<?php
class ComplaintNumber {
      function newComplaintNumber($bean, $event, $arguments)
      {
        //Query COMPLAINTS table for the last Complaint Record
            //$complaint_id = $bean->id;
            $query = 'SELECT COUNT(*) AS totalcomplaint FROM complaints_cstm';
            $results = $bean->db->query($query, true);
            $row = $bean->db->fetchByAssoc($results);
            $total_complaint = $row['totalcomplaint'];
                //Determine the year
            $current_year = date('Y');
                //Calculate the complaint number
            $new_complaint_series = $total_complaint + 1;
	    $new_complaint_no = str_pad($new_complaint_series, 5, "0", STR_PAD_LEFT);
            $new_complaint = $current_year . "-" . $new_complaint_no;
                //Set the value
            if (empty($bean->fetched_row['new_complaint_number_c'])){
             $bean->new_complaint_number_c = $new_complaint;
            }
           }
}

