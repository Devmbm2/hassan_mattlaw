<?php
if (!defined('sugarEntry') || !sugarEntry) {die('Not A Valid Entry Point');}
class new_records_class {
   function new_records_method(&$bean, $event, $arguments) {
      global $db;
      $from_date = $bean->from_date;
      $to_date = $bean->to_date;
      $user_id = $bean->user_id_c;
      $arrs = array(
       	        array('link' => 'mr_monitor_records_cases', 'table' => 'cases'),
       	        array('link' => 'mr_monitor_records_cost_client_cost', 'table' => 'cost_client_cost'),
       	        array('link' => 'mr_monitor_records_comp_companions', 'table' => 'comp_companions'),
       	        array('link' => 'mr_monitor_records_contacts', 'table' => 'contacts'),
       	        array('link' => 'mr_monitor_records_def_defendants', 'table' => 'def_defendants'),
       	        array('link' => 'mr_monitor_records_disc_discovery', 'table' => 'disc_discovery'),
       	        array('link' => 'mr_monitor_records_documents', 'table' => 'documents'),
       	        array('link' => 'mr_monitor_records_fp_events', 'table' => 'fp_events'),
       	        array('link' => 'mr_monitor_records_leads', 'table' => 'leads'),
       	        array('link' => 'mr_monitor_records_mreq_medb_requests', 'table' => 'mreq_medb_requests'),
       	        array('link' => 'mr_monitor_records_medr_medical_records', 'table' => 'medr_medical_records'),
       	        array('link' => 'mr_monitor_records_mts_medical_treatment_summary', 'table' => 'mts_medical_treatment_summary'),
       	        array('link' => 'mr_monitor_records_neg_negotiations', 'table' => 'neg_negotiations'),
       	        array('link' => 'mr_monitor_records_plea_pleadings', 'table' => 'plea_pleadings'),
       	        array('link' => 'mr_monitor_records_mdoc_incoming_bills', 'table' => 'mdoc_incoming_bills'),
       	        array('link' => 'mr_monitor_records_medb_medical_bills', 'table' => 'medb_medical_bills'),
		array('link' => 'mr_monitor_records_tasks', 'table' => 'tasks'),
		array('link' => 'mr_monitor_records_def_client_insurance', 'table' => 'def_client_insurance'),
		array('link' => 'mr_monitor_records_notes_1', 'table' => 'notes'),
		array('link' => 'mr_monitor_records_accounts_1', 'table' => 'accounts'),
		array('link' => 'mr_monitor_records_emails_1', 'table' => 'emails'),
	      );
      //New Records Report
      foreach ($arrs as $arr) {
	//Delete all exiting relationship records
	$link = $arr['link'];
	$table = $arr['table'];
	if ($bean->load_relationship($link)) {
	   $mods = $bean->$link->getBeans();
            if (is_array($mods) && !empty($mods)) {
                foreach ($mods as $mod) {
	   	    $bean->$link->delete($bean->id, $mod->id);
                }               
            }
        }
	//Add relationships by condition
	$sql = "SELECT id FROM $table WHERE deleted = 0 AND date_modified <= '$to_date' and modified_user_id = '$user_id' and date_modified >= '$from_date'";
        $result = $db->query($sql, true);
        while ($row = $db->fetchByAssoc($result))
        {
             $recID = $row['id'];
             $bean->load_relationship($link);
             $bean->$link->add($recID);
        }
      }
   }//end func
}//end class


