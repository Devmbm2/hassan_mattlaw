<?php
global $db;

$bean = BeanFactory::getBean('FP_events', $_REQUEST['record_id']);
/* echo $bean->date_start;echo '<br>'; */
if(isset($bean->date_start) && !empty($bean->date_start)){
   $date = explode(" ",$bean->date_start);
   $year = date('Y', strtotime($date[0]));
   $month = date('m', strtotime($date[0]));
   $day = date('d', strtotime($date[0]));
  /*  if(!empty($bean->multiple_assigned_users)){
       $users = unencodeMultienum($bean->multiple_assigned_users);  
   } */
	require_once('modules/Calendar/Calendar.php');
	$cal = new Calendar();
	$cal->init_shared();
	$params = '';
   foreach($cal->shared_ids as $id){
      $params .= '&shared_ids[]='.$id;
   }
   SugarApplication::redirect("index.php?module=Calendar&action=index&view=sharedWeek&year=".$year."&month=".$month."&day=".$day.$params);
}
		 
