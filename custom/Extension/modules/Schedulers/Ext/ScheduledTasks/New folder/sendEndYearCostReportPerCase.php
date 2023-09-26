<?php
$job_strings[] = 'sendEndYearCostReportPerCase';
function sendEndYearCostReportPerCase()
{	require_once "custom/modules/AOR_Reports/end_year_cost_report.php";
	global $db;
	$customReportEndYearCost = new customReportEndYearCost();
	$customReportEndYearCost->generateEndYearCostReportHTML('F');
	$pdf = "cache/custom_reports/End Year Cost Report.pdf";
	$emails = array(0 => "Casey@MattLaw.com", 1 => 'Bookkeeper@Mattlaw.com');
	/* $emails = array(0 => "usman@helfertech.com"); */
		if(file_exists($pdf) && !empty($emails)){
			foreach($emails as $label => $emailto){
				$emailObj = new Email();
				$defaults = $emailObj->getSystemDefaultEmail();
				$mail = new SugarPHPMailer();
				$mail->setMailerForSystem();
				$mail->IsHTML(true);
				$mail->From = $defaults['email'];
				$mail->FromName = $defaults['name'];
				$mail->Subject = 'End Year Cost Report';
				$mail->Body = 'Please find attached requested End Year Cost Report.';
				$mail->prepForOutbound();
				$mail->ClearAddresses();
				$mail->AddAddress($emailto);
				$pdf_name = 'End Year Cost Report.pdf';
				$mail->AddAttachment($pdf, $pdf_name);
				if(!$mail->Send()){
					$GLOBALS['log']->fatal("{$pdf_name} have been failed to send.");
				}
				
			}
		}
	return true;
}

