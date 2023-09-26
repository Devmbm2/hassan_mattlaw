<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

	class create_hold_event{
	   function save_hold_event_data($bean, $event, $arguments){
		   global $timedate;
		   $bean->status = 'hold';
		   $relate_id_check =  $bean->related_event_id;
		//    if($relate_id_check)
		// {
		    /* print"<pre>";print_r($_REQUEST);die; */
			$start_date = $_REQUEST['start_date'];
			$end_date = $_REQUEST['end_date'];
			// print"<pre>";print_r($end_date);
			$data = array();
			foreach($start_date as $no => $date){

				if(!empty($date[0]) && !empty($end_date[$no][0])){
					 // print"<pre>";print_r($date[0]);
					 // die(); 
					$start_d = $date[0].' '.$date[1].':'.$date[2];
					$end_d = $end_date[$no][0].' '.$end_date[$no][1].':'.$end_date[$no][2];
					// echo $start_d;echo $end_d;
					$duration_hours = $this->getSelectedDatesHoursMinutes($start_d, $end_d, 'h');
					$duration_minutes = $this->getSelectedDatesHoursMinutes($start_d, $end_d, 'm');
					// echo $duration_hours;echo $duration_minutes;die();
					$event_data = array('id' => $bean->id, 'event_id' => $_REQUEST['event_id'][$no], 'date_start' => $start_d, 'date_start_h' => $date[1], 'date_start_m' => $date[2], 'date_end' => $end_d, 'date_end_h' => $end_date[$no][1], 'date_end_m' => $end_date[$no][2], 'duration_hours' => $duration_hours, 'duration_minutes' => $duration_minutes, 'h_c' => $_REQUEST['h_c'][$no]);

					if(empty($_REQUEST['h_c'][$no])){
						if(!empty($relate_id_check))
						{
							if($_REQUEST['event_id'][$no] != $relate_id_check)
							{
							$update = "UPDATE fp_events SET deleted = 1 WHERE id = '".$_REQUEST['event_id'][$no]."'";
							$GLOBALS['db']->query($update, true);
							}
						}
						else if (empty($relate_id_check)) {
							// code...
							if($_REQUEST['event_id'][$no] != $bean->id)
					{
						$update = "UPDATE fp_events SET deleted = 1 WHERE id = '".$_REQUEST['event_id'][$no]."'";
						$GLOBALS['db']->query($update, true);
					}
						}
						
					}else if($_REQUEST['h_c'][$no] == 'Confirmed' && empty($relate_id_check)){
						echo "1";
						// die();
						if(!empty($event_data['date_start']) && !empty($event_data['date_end']) && !empty($event_data['date_start_h']) && !empty($event_data['date_start_m']) && !empty($event_data['date_end_h']) && !empty($event_data['date_end_m'])){
							$bean->date_start = $this->formatDatetimeDB($event_data['date_start'],$event_data['event_id']);
							$bean->date_end = $this->formatDatetimeDB($event_data['date_end'],$event_data['event_id']);
							$bean->duration_hours = $event_data['duration_hours'];
							$bean->duration_minutes = $event_data['duration_minutes'];
							$bean->duration_list = $event_data['duration_hours'] .'h '.$event_data['duration_minutes'].'m';
							$bean->status = $event_data['h_c'];
							echo $event_data['h_c'];;
							// die();
							if($_REQUEST['event_id'][$no] != $bean->id)
							{
							
							$update = "UPDATE fp_events SET deleted = 1 WHERE id = '".$_REQUEST['event_id'][$no]."'";
							$GLOBALS['db']->query($update, true);
							}
							// $update = "UPDATE fp_events SET deleted = 1 WHERE id = '".$_REQUEST['event_id'][$no]."'";
							// $GLOBALS['db']->query($update, true);
						}
					}
					else if($_REQUEST['h_c'][$no] == 'Confirmed' && !empty($relate_id_check)){

						if(!empty($event_data['date_start']) && !empty($event_data['date_end']) && !empty($event_data['date_start_h']) && !empty($event_data['date_start_m']) && !empty($event_data['date_end_h']) && !empty($event_data['date_end_m'])){
							$FP_events = BeanFactory::getBean('FP_events', $relate_id_check);
							// print_r('<pre>');print_r($FP_events);die();
							$FP_events->date_start = $this->formatDatetimeDB($event_data['date_start'],$event_data['event_id']);
							$FP_events->date_end = $this->formatDatetimeDB($event_data['date_end'],$event_data['event_id']);
							$FP_events->duration_hours = $event_data['duration_hours'];
							$FP_events->duration_minutes = $event_data['duration_minutes'];
							$FP_events->duration_list = $event_data['duration_hours'] .'h '.$event_data['duration_minutes'].'m';
							$FP_events->status = $event_data['h_c'];
							$FP_events->mark_undeleted($relate_id_check);
							$FP_events->processed = true;
							$FP_events->save();
							// if($bean->status == 'hold'){
							// $update = "UPDATE fp_events SET deleted = 1 WHERE id = '".$bean->id."'";
							// $GLOBALS['db']->query($update, true);
							// }
							if($_REQUEST['event_id'][$no] != $FP_events->id)
							{
							
							$update = "UPDATE fp_events SET deleted = 1 WHERE id = '".$_REQUEST['event_id'][$no]."'";
							$GLOBALS['db']->query($update, true);
							}
						}
					}else{
						$event_id = $this->save_hold_event($event_data);
					}
				}
			}
		// }
	}
		function save_hold_event($event_data =array()){
			if(isset($event_data) && !empty($event_data)){
				 // print"<pre>outside";print_r($event_data); die();
				if(empty($event_data['event_id'])){
					if(!empty($event_data['date_start']) && !empty($event_data['date_end']) && !empty($event_data['date_start_h']) && !empty($event_data['date_start_m']) && !empty($event_data['date_end_h']) && !empty($event_data['date_end_m'])){
						 // print"<pre>inside";print_r($event_data); die();
						$FP_events = new FP_events();
						$FP_events->name = $_REQUEST['name'].' '.'HOLD';
						$FP_events->type_c = $_REQUEST['type_c'];
						$FP_events->status = $event_data['h_c'];
						$FP_events->duration_hours = $event_data['duration_hours'];
						$FP_events->duration_minutes = $event_data['duration_minutes'];
						$FP_events->duration_list = $event_data['duration_hours'] .'h '.$event_data['duration_minutes'].'m';
						/* $FP_events->date_start = date("Y-m-d h:i:s", strtotime($event_data['date_start']));
						$FP_events->date_end = date("Y-m-d h:i:s", strtotime($event_data['date_end'])); */
						$FP_events->date_start = $this->formatDatetimeDB($event_data['date_start'],$event_data['event_id']);
						$FP_events->date_end = $this->formatDatetimeDB($event_data['date_end'],$event_data['event_id']);
						$FP_events->cases_fp_events_1cases_ida = $_REQUEST['cases_fp_events_1cases_ida'];
						$FP_events->assigned_user_id = $GLOBALS['current_user']->id;
						$FP_events->multiple_assigned_users = encodeMultienumValue($_REQUEST['multiple_assigned_users']);
						$FP_events->related_event_id = $event_data['id'];
						$FP_events->processed = true;
						// echo $FP_events->date_start;
						// die();
						$FP_events->save();
						return $FP_events->id;
					}
				}else{
					if(!empty($event_data['date_start']) && !empty($event_data['date_end']) && !empty($event_data['date_start_h']) && !empty($event_data['date_start_m']) && !empty($event_data['date_end_h']) && !empty($event_data['date_end_m'])){
						$FP_events = BeanFactory::getBean('FP_events', $event_data['event_id']);
						$FP_events->date_start = $this->formatDatetimeDB($event_data['date_start'],$event_data['event_id']);
						$FP_events->date_end = $this->formatDatetimeDB($event_data['date_end'],$event_data['event_id']);
						$FP_events->duration_hours = $event_data['duration_hours'];
						$FP_events->duration_minutes = $event_data['duration_minutes'];
						$FP_events->duration_list = $event_data['duration_hours'] .'h '.$event_data['duration_minutes'].'m';
						$FP_events->status = $event_data['h_c'];
						$FP_events->related_event_id = $bean->id;
						$FP_events->processed = true;
						$FP_events->save();
						return $FP_events->id;
					}
				}
			}
		}
		function formatDatetimeDB($date,$event_id){
			global $timedate;
			$userDateFormat = $timedate->get_date_format();
			if(!empty($event_id))
			{
				$date2 = DateTime::createFromFormat('Y-m-d H:i', $date);
				if($date2)
				{
					$date2 = DateTime::createFromFormat('Y-m-d H:i', $date);
				}
				else
				{
					$date2 = DateTime::createFromFormat('m/d/Y H:i', $date);
				}
			}
			else
			{
				$date2 = DateTime::createFromFormat('m/d/Y H:i', $date);
				if($date2)
				{
					$date2 = DateTime::createFromFormat('m/d/Y H:i', $date);
					
				}
				else
				{
					$date2 = DateTime::createFromFormat('Y-m-d H:i', $date);
				}
			}
			$dateFormated = $date2->format($userDateFormat.' H:i');
			$date3 = date($userDateFormat.' H:i', strtotime($dateFormated));
			$dbDate = $timedate->to_db($date3);
			return $dbDate;
		}
		function getSelectedDatesHoursMinutes($start_date, $end_date, $select)
		{
			$date3 = DateTime::createFromFormat('m/d/Y H:i', $start_date);
			$date4 = DateTime::createFromFormat('m/d/Y H:i', $end_date);
			$dateFormated = $date3->format('d-m-Y H:i');
			$dateFormated2 = $date4->format('d-m-Y H:i');
			$date1 = strtotime($dateFormated);  
			$date2 = strtotime($dateFormated2);
			// echo $date1;
			// echo $date2;
			// die();
			$diff = abs($date2 - $date1); 
			// echo $diff;
			// echo $date2;
			// die();
			$years = floor($diff / (365*60*60*24));  

			$months = floor(($diff - $years * 365*60*60*24) 
									   / (30*60*60*24));  
			$days = floor(($diff - $years * 365*60*60*24 -  
						 $months*30*60*60*24)/ (60*60*24)); 

			$hours = floor(($diff - $years * 365*60*60*24  
				   - $months*30*60*60*24 - $days*60*60*24) 
											   / (60*60)); 
			
			$minutes = floor(($diff - $years * 365*60*60*24  
			 - $months*30*60*60*24 - $days*60*60*24  
							  - $hours*60*60)/ 60);  
			if($select == 'h'){
				return $hours;
			}else if($select == 'm'){
				return $minutes;
			}
		}
	}

