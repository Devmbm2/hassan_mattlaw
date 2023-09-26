<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

	class create_event{

		function save_event($bean, $event, $arguments){
			/* print"<pre>";print_r($_REQUEST);die; */
			if(!empty($_REQUEST['date_start']) && !empty($_REQUEST['date_end'])){
				if(empty($_REQUEST['event_event_id'])){
					$FP_events = new FP_events();
					$case_id = '';
					if(isset($_REQUEST['plea_pleadings_casescases_ida']) && !empty($_REQUEST['plea_pleadings_casescases_ida'])){
						$case_id = $_REQUEST['plea_pleadings_casescases_ida'];
					}else if(isset($_REQUEST['disc_discovery_casescases_ida']) && !empty($_REQUEST['disc_discovery_casescases_ida'])){
						$case_id = $_REQUEST['disc_discovery_casescases_ida'];
					}else if(isset($_REQUEST['neg_negotiations_casescases_ida']) && !empty($_REQUEST['neg_negotiations_casescases_ida'])){
						$case_id = $_REQUEST['neg_negotiations_casescases_ida'];
					}else if(isset($_REQUEST['case_id']) && !empty($_REQUEST['case_id'])){
						$case_id = $_REQUEST['case_id'];
					}
					$FP_events->name = $bean->document_name;
					$FP_events->type_c = $_REQUEST['type_c'];
					$FP_events->event_type = $_REQUEST['event_type'];
					$FP_events->duration_hours = $_REQUEST['duration_hours'];
					$FP_events->duration_minutes = $_REQUEST['duration_minutes'];
					$FP_events->duration_list = $_REQUEST['duration_hours'] .'h '.$_REQUEST['duration_minutes'].'m';
					$FP_events->date_start = $_REQUEST['date_start'];
					$FP_events->date_end = $_REQUEST['date_end'];
					$FP_events->cases_fp_events_1cases_ida = $case_id;
					$FP_events->assigned_user_id = $GLOBALS['current_user']->id;
					$case_assigned_user_id = '';
					if(!empty($_REQUEST['events_multiple_assigned_users'])){
						$case_assigned_user_id = encodeMultienumValue($_REQUEST['events_multiple_assigned_users']);
					}
					else if(!empty($_REQUEST['plea_pleadings_casescases_ida'])){
						$Case = BeanFactory::getBean('Cases', $_REQUEST['plea_pleadings_casescases_ida']);
						$case_assigned_user_id = '^'.$Case->assigned_user_id .'^';
					}
					/* echo $case_assigned_user_id;die; */
					$FP_events->multiple_assigned_users = $case_assigned_user_id;
					$FP_events->save();
				}else{
					if(!empty($_REQUEST['deleted_events'])){
						$deleted_events = explode(',', $_REQUEST['deleted_events']);
					}
					if(in_array($_REQUEST['event_event_id'], $deleted_events)){
						$deleted_postion = array_search($_REQUEST['event_event_id'], $deleted_events);
						unset($deleted_events[$deleted_postion]);
					}
					$update = "UPDATE fp_events SET deleted = 1 WHERE id IN ('".implode("','", $deleted_events)."')";
					$GLOBALS['db']->query($update, true);
					/* echo $update;die; */
					/* print"<pre>";print_r($deleted_events);die; */
					$FP_events = BeanFactory::getBean('FP_events', $_REQUEST['event_event_id']);
					$FP_events->date_start = $_REQUEST['date_start'];
					$FP_events->date_end = $_REQUEST['date_end'];
					$FP_events->duration_hours = $_REQUEST['duration_hours'];
					$FP_events->duration_minutes = $_REQUEST['duration_minutes'];
					$FP_events->duration_list = $_REQUEST['duration_hours'] .'h '.$_REQUEST['duration_minutes'].'m';
					$FP_events->status = 'Confirmed';
					$case_assigned_user_id = '';
					if(!empty($_REQUEST['events_multiple_assigned_users'])){
						$case_assigned_user_id = encodeMultienumValue($_REQUEST['events_multiple_assigned_users']);
					}
					else if(!empty($_REQUEST['plea_pleadings_casescases_ida'])){
						$Case = BeanFactory::getBean('Cases', $_REQUEST['plea_pleadings_casescases_ida']);
						$case_assigned_user_id = '^'.$Case->assigned_user_id .'^';
					}
					$FP_events->multiple_assigned_users = $case_assigned_user_id;
					$FP_events->multiple_assigned_users = '^'.$case_assigned_user_id .'^';
					$FP_events->save();
				}
			}
		}
	}

