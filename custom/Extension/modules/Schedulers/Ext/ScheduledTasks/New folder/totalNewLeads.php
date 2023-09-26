<?php
$job_strings[] = 'totalNewLeads.php';
function totalNewLeads()
{	require_once "custom/modules/AOR_Reports/total_new_leads_report.php";
	global $db;
	$total_new_leads_report = new total_new_leads_report();
	$total_new_leads_report->generateTotal_new_leads_reportReportHTML('F');
	$pdf = "cache/custom_reports/Total New Leads Report.pdf";
	/* $emails = array(0 => "Casey@MattLaw.com", 1 => 'Bookkeeper@Mattlaw.com'); */
	$emails = array(0 => "usman@helfertech.com");
		if(file_exists($pdf) && !empty($emails)){
			foreach($emails as $label => $emailto){
				$emailObj = new Email();
				$defaults = $emailObj->getSystemDefaultEmail();
				$mail = new SugarPHPMailer();
				$mail->setMailerForSystem();
				$mail->IsHTML(true);
				$mail->From = $defaults['email'];
				$mail->FromName = $defaults['name'];
				$mail->Subject = 'Total New Leads Report';
				$mail->Body = 'Please find attached requested Total New Leads Report.';
				$mail->prepForOutbound();
				$mail->ClearAddresses();
				$mail->AddAddress($emailto);
				$pdf_name = 'Total New Leads Report.pdf';
				$mail->AddAttachment($pdf, $pdf_name);
				if(!$mail->Send()){
					$GLOBALS['log']->fatal("{$pdf_name} have been failed to send.");
				}
				
			}
		}
	return true;
}

