<?php
require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
global $db, $timedate, $current_user, $app_list_strings;

$date_time = $timedate->getInstance()->nowDb();
$current_date = date('Y/m/d', strtotime($date_time));
$current_time = date('H:i:s A', strtotime($date_time));
$case_bean = BeanFactory::getBean('Cases', $_REQUEST['record']);
$header = '<table style="table-layout: fixed;height: 60px; width: 800px;" border="0">
	
		<tr border="0" style="height: 51px; color: white;border:none;">
			<td  style="width: 100%; height: 51px;border:none;"><span style="color:black;font-size:14px;"><b>'.$case_bean->name.' Damages Report</b></span></td>
			<td></td><td></td><td></td>
		</tr>
		
	
		
		      
    
</table>';

$html = '<table style="border-collapse:collapse; table-layout:fixed;width:100%word-wrap:break-word;" border="1">
		<thead>
		<tr>
		<td  style="width:70%;font-size: 14px;font-weight: bold;"><strong>Name</strong></td>
		<td  style="width:30%;font-size: 14px;font-weight: bold;text-align:center; "><strong>Value($)</strong></td>
		</tr>
		</thead>
';

$relatedBeans = "SELECT * FROM `ht_damages` WHERE case_id='".$_REQUEST['record']."'";
$result = $db->query($relatedBeans, true);
While($row = $db->fetchByAssoc($result)){
	$ht_Damages = BeanFactory::getBean('ht_Damages', $row['id']);
	$html .='<tr>
				<td><span style="font-size: 15px;">'. $ht_Damages->name . '</span></td>
				<td style="text-align:center;"><span style="font-size: 15px;">'. sprintf("%.2f",$ht_Damages->value_c) . '</span></td>
				
			</tr>';	

}


$html .='</table>'; 

$pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '6', '6', '20', '3', '3', '3','3');

$pdf->SetHTMLHeader($header);
$pdf->AddPage('P');
$pdf->WriteHTML($html);
$pdf->Output();
ob_clean();
$pdf->Output($case_bean->name." Damages Report.pdf", 'I');