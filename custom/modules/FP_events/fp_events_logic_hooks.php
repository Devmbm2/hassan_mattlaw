<?php

   class fp_events_class {
      function click_to_open_calendar($bean, $event, $arguments){
		  /* echo $bean->date_start;echo '<br>'; */
		  if(isset($bean->date_start) && !empty($bean->date_start)){
			   $date = explode(" ",$bean->date_start);
			   $year = date('Y', strtotime($date[0]));
			   $month = date('m', strtotime($date[0]));
			   $day = date('d', strtotime($date[0]));
			   if(!empty($bean->multiple_assigned_users)){
				 $users = unencodeMultienum($bean->multiple_assigned_users);  
			   }
			   $params = '';
			   foreach($users as $id){
				    $params .= '&shared_ids[]='.$id;
			   }
			  $bean->view_event_on_calendar = "<a href='index.php?module=Calendar&action=index&view=sharedWeek&year=".$year."&month=".$month."&day=".$day.$params."' target='_blank'>Click to Open Calendar</a>";
		  }
		 
      }  
	  function get_related_case_client($bean, $event, $arguments){
		  global $db;
			$case = "SELECT cases_fp_events_1_c.cases_fp_events_1cases_ida as id, cases.name as name
					FROM `cases_fp_events_1_c`
					LEFT JOIN cases ON(cases.deleted = 0 AND cases.id = cases_fp_events_1_c.cases_fp_events_1cases_ida) 
					WHERE cases.deleted = 0 AND cases_fp_events_1_c.cases_fp_events_1fp_events_idb = '{$bean->id}'";
					$result = $db->query($case, true);
					$related_case = $db->fetchByAssoc($result);
			
			$contact = "SELECT fp_events_contacts_c.fp_events_contactscontacts_idb as id, CONCAT_WS(' ', contacts.first_name, contacts.last_name) as name
					FROM `fp_events_contacts_c`
					LEFT JOIN contacts ON(contacts.deleted = 0 AND contacts.id = fp_events_contacts_c.fp_events_contactscontacts_idb) 
					WHERE contacts.deleted = 0 AND fp_events_contacts_c.fp_events_contactsfp_events_ida = '{$bean->id}'";
					$result = $db->query($contact, true);
					$related_contact = $db->fetchByAssoc($result);
					
			if(isset($related_case['id']) && !empty($related_case['id'])){
				$bean->case_client = "<a style = 'color: black;font-weight: bold;font-size: 13px;'  href=index.php?module=Cases&action=DetailView&record=" .$related_case['id']." target='_blank'>".$related_case['name']."</a>";
			}else{
				$bean->case_client = "<a style = 'color: black;font-weight: bold;font-size: 13px;'  href=index.php?module=Contacts&action=DetailView&record=" .$related_contact['id']." target='_blank'>".$related_contact['name']."</a>";
			}		
		  }

   }