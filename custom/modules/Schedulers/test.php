<?php

SendEmailStatueOfLimitation();
echo 'done';echo '<br>';
function SendEmailStatueOfLimitation(){
	global $db, $sugar_config;
	$query = "SELECT cases.id, cases_cstm.statute_of_limitations_c 
			  FROM cases
			  LEFT JOIN cases_cstm ON (cases.deleted = 0 AND cases_cstm.id_c = cases.id)
			  WHERE deleted = 0 AND cases.status != 'Closed' AND cases.status LIKE '%PreSuit%'";
	$emails = array('usman@helfertech.com');
	/* $emails = array('Matt@mattlaw.com', 'chance@mattlaw.com', 'meghan@mattlaw.com', 'beth@mattlaw.com'); */
	$notification = array(	'Month' => array(6, 5, 4, 3, 2, 1),
							'Week'  => array(3, 2, 1),
							'Day'   => array(6, 5, 4, 3, 2, 1, 0),
					   );
	$intervals = array('Month', 'Week', 'Day');
	foreach($intervals as $interval){
		foreach($notification[$interval] as $range){
			// CURRENT_DATE()
			$query_range = "cases_cstm.statute_of_limitations_c  = DATE_ADD(CURRENT_DATE(), INTERVAL $range $interval) ";
			$sql = $query. " AND " .$query_range;
			/* echo $sql;echo '<br>'; */
			$result = $db->query($sql);
			while($row = $db->fetchByAssoc($result)){
				$case_bean = BeanFactory::getBean('Cases', $row['id']);
				echo 'Case ID:   ' . $case_bean->id;echo '<br>';
				echo 'Interval:  ' . $interval. '  range:  '. $range;echo '<br>';echo '<hr>';
				$template = new EmailTemplate();
				$template->retrieve('5c6959e6-1bd7-491e-4a4c-5e1038fd786a');
				$template->subject = str_replace('$range', $range, $template->subject);
				$template->subject = str_replace('$interval', $interval, $template->subject);
				$template->body_html = str_replace('$range', $range, $template->body_html);
				$template->body_html = str_replace('$interval', $interval, $template->body_html);
				$template->body_html = str_replace('$RECORD', $row['id'], $template->body_html);
				$template->subject = str_replace('$NAME', $case_bean->name, $template->subject);
				$template->body_html = str_replace('$NAME', $case_bean->name, $template->body_html);
				$template->body_html = str_replace('$URL', $sugar_config['site_url'], $template->body_html);
				parseTemplate($case_bean, $template);
				/* $to_emails[$range][] = $invoice_assigned_user->email1; */
				/* sendEmail($emails, $template->subject, $template->body_html, '', ''); */
				/* echo $row['id'];echo '<br>'; */
				print"<pre>";print_r($template->subject);echo '<hr>';
				print"<pre>";print_r($template->body_html);echo '<hr>';
			}
			
		}
		
	}
	return true;
}
