<?php
function display_hold_dates_fields($focus, $field, $value, $view)
{
	
    global $locale, $app_list_strings, $mod_strings;
    $html .= '<script src="custom/modules/FP_events/js/holdDatesFields.js"></script>';
    $html .= '<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">';
    $html .= "<table border='0' cellspacing='4' width='100%' id='holdDatesFields'></table>";
    $html .= "<div style='padding-top: 10px; padding-bottom:10px;'>";
	/* if ($view == 'EditView' || $view == '') { */
		$html .= "<input type=\"button\" tabindex=\"116\" class=\"button\" value=\"Add Additional\" id=\"btn_aggregatedFields\" onclick=\"insertDateField()\"/>";
    /* } */
	$html .= "</div>";

	if ($focus->id != '' && $focus->status == 'hold') {

		$html .= "<script>";
		$sql = "SELECT * FROM fp_events WHERE related_event_id = '{$focus->id}' AND deleted = 0";
		$result = $focus->db->query($sql);
		// $sql2 = "SELECT * FROM fp_events WHERE id = '{$focus->id}'  AND deleted = 0";
		// $result2 = $focus->db->query($sql2);
		// if($result2->num_rows>0)
		// {
		// $row2 = $focus->db->fetchByAssoc($result2); 
		// 	$FP_events = BeanFactory::getBean('FP_events', $row2['id']);
		// 	$data[] = array('event_id' => $FP_events->id, 'date_start' => date("m/d/Y", strtotime($FP_events->date_start)), 'date_start_hours' => date("H", strtotime($FP_events->date_start)), 'date_start_minutes' => date("i", strtotime($FP_events->date_start)), 'date_end' => date("m/d/Y", strtotime($FP_events->date_end)), 'date_end_hours' => date("H", strtotime($FP_events->date_end)), 'date_end_minutes' => date("i", strtotime($FP_events->date_end)), 'duration_hours' => $FP_events->duration_hours, 'duration_minutes' => $FP_events->duration_minutes, 'h_c' => $FP_events->status);
		// }
		if($result->num_rows>0)
		{
		// print"<pre>";print_r($result);die();
		while ($row = $focus->db->fetchByAssoc($result)) {
			$FP_events = BeanFactory::getBean('FP_events', $row['id']);
			if($FP_events->status == 'hold')
			{
			$data[] = array('event_id' => $FP_events->id, 'date_start' => date("m/d/Y", strtotime($FP_events->date_start)), 'date_start_hours' => date("H", strtotime($FP_events->date_start)), 'date_start_minutes' => date("i", strtotime($FP_events->date_start)), 'date_end' => date("m/d/Y", strtotime($FP_events->date_end)), 'date_end_hours' => date("H", strtotime($FP_events->date_end)), 'date_end_minutes' => date("i", strtotime($FP_events->date_end)), 'duration_hours' => $FP_events->duration_hours, 'duration_minutes' => $FP_events->duration_minutes, 'h_c' => $FP_events->status);
		}
	}

		
	}
	else
	{
		$sql2 = "SELECT related_event_id FROM fp_events WHERE id = '{$focus->id}' AND deleted = 0";
		$result2 = $focus->db->query($sql2);
		$row2 = $focus->db->fetchByAssoc($result2);
		$related_id = $row2["related_event_id"];
		// echo $related_id;die();
		if(!empty($related_id))
		{
		$sql3 = "SELECT * FROM fp_events WHERE related_event_id = '{$related_id}' AND deleted = 0";
		$result3 = $focus->db->query($sql3);
		$sql4 = "SELECT * FROM fp_events WHERE id = '{$related_id}'  AND deleted = 0";
		$result4 = $focus->db->query($sql4);
		$row4 = $focus->db->fetchByAssoc($result4); 
			$FP_events = BeanFactory::getBean('FP_events', $row4['id']);
			$data[] = array('event_id' => $FP_events->id, 'date_start' => date("m/d/Y", strtotime($FP_events->date_start)), 'date_start_hours' => date("H", strtotime($FP_events->date_start)), 'date_start_minutes' => date("i", strtotime($FP_events->date_start)), 'date_end' => date("m/d/Y", strtotime($FP_events->date_end)), 'date_end_hours' => date("H", strtotime($FP_events->date_end)), 'date_end_minutes' => date("i", strtotime($FP_events->date_end)), 'duration_hours' => $FP_events->duration_hours, 'duration_minutes' => $FP_events->duration_minutes, 'h_c' => $FP_events->status);
		if($result3->num_rows>0)
		{
		// print"<pre>";print_r($result);die();
		while ($row3 = $focus->db->fetchByAssoc($result3)) {
			$FP_events = BeanFactory::getBean('FP_events', $row3['id']);
			if($FP_events->id == $focus->id)
			{
				
			}
			else
			{
			$data[] = array('event_id' => $FP_events->id, 'date_start' => date("m/d/Y", strtotime($FP_events->date_start)), 'date_start_hours' => date("H", strtotime($FP_events->date_start)), 'date_start_minutes' => date("i", strtotime($FP_events->date_start)), 'date_end' => date("m/d/Y", strtotime($FP_events->date_end)), 'date_end_hours' => date("H", strtotime($FP_events->date_end)), 'date_end_minutes' => date("i", strtotime($FP_events->date_end)), 'duration_hours' => $FP_events->duration_hours, 'duration_minutes' => $FP_events->duration_minutes, 'h_c' => $FP_events->status);
			}
		}

	}
	
	}
}

		$data = (!empty($data)) ? base64_encode(json_encode($data)) : '' ;
		$html .= "fields_data = \"".$data."\";";
		$html .= "</script>";
	}
    
    return $html;
}