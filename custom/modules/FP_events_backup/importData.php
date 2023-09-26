<?php

global $db;
$fields = array('name','date_entered','date_modified','modified_user_id','created_by','description','deleted','assigned_user_id','duration_hours','duration_minutes','date_start','date_end','parent_type','status','type','parent_id');
$meetings = BeanFactory::getBean('Meetings');
$meetings_list = $meetings->get_full_list("", "meetings.deleted=0");

foreach($meetings_list as $number => $data){
	
	$FP_events = new FP_events();
	
	foreach($fields as $field_name){
		$FP_events->$field_name = $data->$field_name;
	
	}
	$FP_events->location_c = $data->location;
	$FP_events->save();
	if($data->parent_type = 'Cases'){
		echo $number;echo '<br>';
		/* $FP_events->load_relationship('cases_fp_events_1');
		$FP_events->cases_fp_events_1->add($data->parent_id); */
	$sql_msb = "INSERT INTO cases_fp_events_1_c (id, cases_fp_events_1fp_events_idb, cases_fp_events_1cases_ida) VALUES (UUID(), '{$FP_events->id}', '{$data->parent_id}')";
		 
		$db->query($sql_msb, true);		
	}
	
}

echo 'done';
