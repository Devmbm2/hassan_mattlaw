<?php
	require_once('custom/include/GHolidays/vendor/autoload.php');
	$instance = new \Google\Holidays();
	$holidays = $instance->withApiKey('AIzaSyCqnID23cEdvAtFvxgKQoaGpgC7BcLGkeQ')
                     ->inCountry('usa')
					 ->from(date('Y-01-01'))
					 ->to(date('Y-12-01'))
                     ->list();
	$users_list = encodeMultienumValue(array_keys(get_user_array(false)));
	// print"<pre>";print_r($holidays);die;
	foreach($holidays AS $holiday){
		$eventBean = BeanFactory::newBean('FP_events');
		$eventList = $eventBean->retrieve_by_string_fields(
                                array(
                                  'gsync_id' => $holiday['id']
                                )
                              );
		if(empty($eventBean->id)){
			$eventBean->gsync_id = $holiday['id'];
		}
		$eventBean->name = $holiday['summary'];
        $eventBean->description = $holiday['creator']['displayName'].' '.$holiday['description'];

        // Get Start/End/Duration from Google Event
        $starttime = strtotime($holiday['start']['date']);
        $endtime = strtotime($holiday['end']['date']);
        $diff = abs($starttime - $endtime);
        $tmins = $diff/60;
        $hours = floor($tmins/60);
        $mins = $tmins%60;

        // Set Start/End/Duration in SuiteCRM Meeting and Assigned User
        $eventBean->date_start = date("m/d/Y h:i:sa", $starttime);
        $eventBean->date_end = date("m/d/Y h:i:sa", $endtime);
        $eventBean->duration_hours = $hours;
        $eventBean->duration_minutes = $mins;
        $eventBean->multiple_assigned_users = $users_list;
		$eventBean->save();
	
	}
?>