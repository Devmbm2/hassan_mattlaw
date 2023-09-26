<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

	class create_travel_event{
	   function save_travel_event_data($bean, $event, $arguments){
	   	global $db;
	   		$travel_start = $_REQUEST['travel_start_c'];
	   		$travel_end = $_REQUEST['travel_end_c'];
	   		if(!empty($travel_start && !empty($travel_end)))
	   		{
	   			$sql = "SELECT id FROM fp_events WHERE related_event_id = '{$bean->id}' AND status = 'travel' AND deleted = 0";
				$result = $db->query($sql);
					$row = $db->fetchByAssoc($result);
	   			if ($row['id'] == NULL )
			 {
	   		$duration_hours = $this->getSelectedDatesHoursMinutes2($travel_start, $travel_end, 'h');
	   		$duration_minutes = $this->getSelectedDatesHoursMinutes2($travel_start, $travel_end, 'm');
	   		$FP_events = new FP_events();
			$FP_events->name = $_REQUEST['name'].' '.'Travelling';
			$FP_events->type_c = $_REQUEST['type_c'];
			$FP_events->status = 'travel';
			$FP_events->duration_hours = $duration_hours;
			$FP_events->duration_minutes = $duration_minutes;
			$FP_events->duration_list = $duration_hours .'h '.$duration_minutes.'m';
			$FP_events->date_start = $this->formatDatetimeDB2($travel_start);
			$FP_events->date_end = $this->formatDatetimeDB2($travel_end);
			$FP_events->travel_start_c = $this->formatDatetimeDB2($travel_start);
			$FP_events->travel_end_c = $this->formatDatetimeDB2($travel_end);
			$FP_events->description = 'Travel';
			$FP_events->cases_fp_events_1cases_ida = $_REQUEST['cases_fp_events_1cases_ida'];
			$FP_events->assigned_user_id = $GLOBALS['current_user']->id;
			$FP_events->multiple_assigned_users = encodeMultienumValue($_REQUEST['multiple_assigned_users']);
			$FP_events->related_event_id = $bean->id;
			$FP_events->processed = true;
			$FP_events->save();
			
		}
		else
		{
	   		$duration_hours = $this->getSelectedDatesHoursMinutes2($travel_start, $travel_end, 'h');
	   		$duration_minutes = $this->getSelectedDatesHoursMinutes2($travel_start, $travel_end, 'm');
	   		$FP_events = BeanFactory::getBean('FP_events',$row['id']);
			$FP_events->type_c = $_REQUEST['type_c'];
			$FP_events->status = 'travel';
			$FP_events->duration_hours = $duration_hours;
			$FP_events->duration_minutes = $duration_minutes;
			$FP_events->duration_list = $duration_hours .'h '.$duration_minutes.'m';
			$FP_events->date_start = $this->formatDatetimeDB2($travel_start);
			$FP_events->date_end = $this->formatDatetimeDB2($travel_end);
			$FP_events->travel_start_c = $this->formatDatetimeDB2($travel_start);
			$FP_events->travel_end_c = $this->formatDatetimeDB2($travel_end);
			$FP_events->description = 'Travel';
			$FP_events->cases_fp_events_1cases_ida = $_REQUEST['cases_fp_events_1cases_ida'];
			$FP_events->assigned_user_id = $GLOBALS['current_user']->id;
			$FP_events->multiple_assigned_users = encodeMultienumValue($_REQUEST['multiple_assigned_users']);
			$FP_events->related_event_id = $bean->id;
			$FP_events->processed = true;
			$FP_events->save();
		}
		}
		else
		{
		}
		  } 
		
		function formatDatetimeDB2($date){
			global $timedate;
			$userDateFormat = $timedate->get_date_format();
				$date2 = DateTime::createFromFormat('m/d/Y H:i', $date);
				if($date2)
				{
					$date2 = DateTime::createFromFormat('m/d/Y H:i', $date);
					
				}
				else
				{
					$date2 = DateTime::createFromFormat('Y-m-d H:i', $date);
				}
			$dateFormated = $date2->format($userDateFormat.' H:i');
			$date3 = date($userDateFormat.' H:i', strtotime($dateFormated));
			$dbDate = $timedate->to_db($date3);
			return $dbDate;
		}
		function getSelectedDatesHoursMinutes2($start_date, $end_date, $select)
		{
			$date1 = strtotime($start_date);  
			$date2 = strtotime($end_date);
			$correct_hours = abs($date2-$date1)/(60*60); 
			$diff2 = abs($date2-$date1);
			
			$years = floor($diff2 / (365*60*60*24));  

			$months = floor(($diff2 - $years * 365*60*60*24) 
									   / (30*60*60*24));  
			$days = floor(($diff2 - $years * 365*60*60*24 -  
						 $months*30*60*60*24)/ (60*60*24)); 

			$hours = floor(($diff2 - $years * 365*60*60*24  
				   - $months*30*60*60*24 - $days*60*60*24) 
											   / (60*60)); 
			$minutes = floor(($diff2 - $years * 365*60*60*24  
			 - $months*30*60*60*24 - $days*60*60*24  
							  - $hours*60*60)/ 60);  
			if($select == 'h'){
				return $correct_hours;
			}else if($select == 'm'){
				return $minutes;
			}
		}
	}

