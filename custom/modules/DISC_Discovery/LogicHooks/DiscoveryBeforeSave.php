<?php

class DiscoveryBeforeSave {
    public function QCProcessReview($bean, $event, $arguments) {
        global $db;
        $sql = "SELECT qc1_reason_for_fail_c,assistant_reason_for_fail_c,qc_review_remarks_c FROM disc_discovery_cstm WHERE id_c = '{$bean->id}'";
        $result = $db->query($sql);
         $checkBean = $db->fetchByAssoc($result);
        // echo $checkBean['qc1_reason_for_fail_c'];die();
            // echo $checkBean['qc1_reason_for_fail_c'];die();
            if($checkBean['qc1_reason_for_fail_c'] != $bean->qc1_reason_for_fail_c){

            $bean->qc_review_remarks_c =$checkBean['qc_review_remarks_c']."\n"."QC1 Remarks".": ".$bean->qc1_reason_for_fail_c;
            // $bean->save();
        }
        if($checkBean['assistant_reason_for_fail_c'] != $bean->assistant_reason_for_fail_c){
            $bean->qc_review_remarks_c = $checkBean['qc_review_remarks_c']."\n"."Assistant Remarks".": ".$bean->assistant_reason_for_fail_c;
            // $bean->save();
        }
        
        
    }
    public function MarkDone($bean, $event, $arguments) {
        if($bean->assistant_reviewed_c == 'assistant_pass' && $bean->done == 1 && $bean->discovery_matrix_c == 1)
        {
            $bean->done = 1;
            // $bean->save();
        }
        else{
            $bean->done = 0;
            // $bean->save();
        }
    }
    function update_no_of_days($bean, $event, $arguments){
        if($bean->day_counter_c!=NULL OR $bean->day_counter_c!=""){
            $datetime1 = date_create(date('Y-m-d'));
            $datetime2 = date_create(date("Y-m-d",strtotime($bean->date_served)));
            $interval = date_diff($datetime1, $datetime2);
            $noOfDays=$bean->day_counter_c-$interval->days;
            $bean->number_of_day_c=$noOfDays;
            // $bean->save();
        }
 }
}
