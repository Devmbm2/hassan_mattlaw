<?php
ob_clean();
global $timedate, $current_user;

$stream_html  = "<script type='text/javascript' src='https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js'></script>
	  <link href='https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'/>";
$data = array();
$tz = $timedate->userTimezone($current_user);
date_default_timezone_set($tz);
$date_start = gmdate("Y-m-d H:i:s", strtotime($_REQUEST['date_start']));
$date_end = gmdate("Y-m-d H:i:s", strtotime($_REQUEST['date_end']));
$assigned_user_id = $_REQUEST['assigned_user_id'];
$record_id = $_REQUEST['record_id'];
$selected_user_ids = '^'.str_replace(",", "^,^", $_REQUEST['multiple_assigned_users']).'^';
$sql = "SELECT dr1.id, dr1.name, dr1.date_start, dr1.date_end,  dr1.assigned_user_id, dr1.multiple_assigned_users
		FROM fp_events dr1
		WHERE dr1.deleted = 0 AND dr1.id != '{$record_id}' AND ((dr1.date_start  BETWEEN '{$date_start}' AND '{$date_end}' || dr1.date_end  BETWEEN '{$date_start}' AND '{$date_end}') OR (dr1.date_start <= '{$date_start}' AND dr1.date_end >= '{$date_end}')) AND dr1.type_c != 'Deadline'";
/* echo $sql;die; */
$result = $GLOBALS['db']->query($sql, true);
if($result->num_rows <= 0){
	echo 'false';die;
}else{
	$display =false;
	$stream_html  .= '<style>
					#data {
					  font-family: arial, sans-serif;
					  border-collapse: collapse;
					  width: 100%;
					}

					#data td, th {
					  border: 1px solid #dddddd;
					  text-align: left;
					  padding: 8px;
					}
					</style>';
	$event_view = 'Creating';
	if($record_id == ''){
		$event_view = 'Creating';
	}else{
		$event_view = 'Editing';
	}
	$stream_html  .= '<span style="color:black;font-weight:bold">Here is the list of Users and the Events that conflicts with the new event you just '. $event_view .'  </span><br>';
	$stream_html  .="<table id= 'data'>
					<tr>
						<th>Users</th>
						<th>Event Name</th>
						<th>Start Date</th>
						<th>End Date</th>
					</tr>";
	while($row = $GLOBALS['db']->fetchByAssoc($result)){
		$cehck = getRelatedUsersEvents($selected_user_ids, $row['multiple_assigned_users']);
		if($cehck['result']){
			$display =true;
			
			$stream_html  .=" <tr><td>".$cehck['user_names']."</td>
							  <td></b><a href='index.php?module=FP_events&action=DetailView&record=".$row['id']."' target='_blank'><b>".$row['name']."</td>
							  <td>".$timedate->to_display_date_time($row['date_start']) ."</td>
							  <td>".$timedate->to_display_date_time($row['date_end']) ."</td>
							  </tr>";
			/* $stream_html  .="User Name's <b>".$cehck['user_names']."</b> event named <a href='index.php?module=FP_events&action=DetailView&record=".$row['id']."' target='_blank'><b>".$row['name']."</b></a> conflicts with the new event you just created. <br>"; */
		}
	}
	$stream_html .='</table><br><b>Would you like to save and continue or edit this event?</b><br><br>';
	$onClick = "";
	if(isset($_REQUEST['formName']) && !empty($_REQUEST['formName']) && $_REQUEST['formName'] != 'CalendarEditView' && $_REQUEST['redirect'] != 1){
		$onClick = 'onclick = "_form1 = document.getElementById(\''.$_REQUEST['formName'].'\');_form1.module.value=\'FP_events\';_form1.action.value=\'Save\';if(check_cancel_reset())SUGAR.ajaxUI.submitForm(_form1);"';
	}else if(isset($_REQUEST['formName']) && !empty($_REQUEST['formName']) && $_REQUEST['formName'] != 'CalendarEditView' && isset($_REQUEST['redirect']) && !empty($_REQUEST['redirect']) && $_REQUEST['redirect'] == 1){
		$onClick = 'onclick = "_form1 = document.getElementById(\''.$_REQUEST['formName'].'\');_form1.return_module.value=\'Calendar\';_form1.return_action.value=\'index\';_form1.module.value=\'FP_events\';_form1.action.value=\'Save\';if(check_cancel_reset())SUGAR.ajaxUI.submitForm(_form1);"';
	}else{
		$onClick = 'onclick = "$(\'.container-close\').click();CAL.dialog_save();location.reload(\'true\');"';
	}
	$stream_html .='<input class="button" type="button" id = "btn-continue" value="Save & Continue" '.$onClick.'  style="float:right;">';
	$stream_html .='<input type="button" id = "edit_new_event" value="Edit Current Event" onclick="$(\'.container-close\').click();" style="float:right;">';
	$stream_html .= "<script>$(document).ready(function() {
						$('#data').DataTable();
					});</script>";
	if($display){
		echo $stream_html;die;		
	}else{
		echo 'false';die;
	}
}

function getRelatedUsersEvents($selected_user_ids, $db_user_ids){
	$names = array();
	$db_user_ids = explode(',', $db_user_ids);
	$result = false;
	$all_users = get_user_array();
	/* print"<pre>";print_r($all_users); */
	foreach(explode(',', $selected_user_ids) as $id){
		/* echo '$id: '.$id;echo '<br>'; */
		if (in_array($id, $db_user_ids)){
			$result = true;
			/* echo 'users: '.$all_users[$id]; */
			$id = str_replace('^', '', $id);
			$names[] = $all_users[$id];
		}
	}
	return array('result' => $result, 'user_names' => implode(',', $names));
}