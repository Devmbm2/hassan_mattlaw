<?php
require_once('include/export_utils.php');
require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
global $db, $timedate, $current_user, $app_list_strings;
$date_time = $timedate->getInstance()->nowDb();
$current_date = date('m/d/Y', strtotime($date_time));
$current_time = date('H:i:s A', strtotime($date_time));
	$header = '<p align="center" style="font-family: "Times New Roman";"><span style="font-size: small;"><strong>Client Cost Report</strong></span></p>
			  <p align="right" style="font-family: "Times New Roman"; text-align: right;"><span style="font-size: x-small;">   <strong>'.$current_date.'</strong> </span></p>';
	$html = '
		<p><span style="font-size: x-small;">  </span></p>
		<table style="width: 100%; border: 1pt none; border-spacing: 0pt;">
		<tbody>
		<tr>
		<td style="border-style: solid; border-width: .5px; padding: 2px 6px; font-weight: bold; text-align: center;"><span style="font-size: x-small;">Date</span></td>
		<td style="border-style: solid; border-width: .5px; padding: 2px 6px; font-weight: bold; text-align: center;"><span style="font-size: x-small;">Name</span></td>
		<td style="border-style: solid; border-width: .5px; padding: 2px 6px; font-weight: bold; text-align: center;"><span style="font-size: x-small;">Type</span></td>
		<td style="border-style: solid; border-width: .5px; padding: 2px 6px; font-weight: bold; text-align: center;"><span style="font-size: x-small;">Payee</span></td>
		<td style="border-style: solid; border-width: .5px; padding: 2px 6px; font-weight: bold; text-align: center;"><span style="font-size: x-small;">Invoice Number</span></td>
		<td style="border-style: solid; border-width: .5px; padding: 2px 6px; font-weight: bold; text-align: center;"><span style="font-size: x-small;">Total Amount$</span></td>
		</tr>';
		$type = 'COST_Client_Cost';
		$focus = new COST_Client_Cost();
		$searchFields = array();
		$db = DBManagerFactory::getInstance();
	    if(isset($_REQUEST['select_entire_list']) && $_REQUEST['select_entire_list'] == 0) { 
			$records = $_REQUEST['mass'];
			$records = "'" . implode("','", $records) . "'";
			$where = "{$focus->table_name}.id in ($records)";
		 } elseif (isset($_REQUEST['record']) && !empty($_REQUEST['record'])) {
			 
			$where = "{$focus->table_name}.id = '{$_REQUEST['record']}'";
		 } elseif (isset($_REQUEST['all']) ) {
			$where = '';
		 } else {
			if(!empty($_REQUEST['current_query_by_page'])) {
				$ret_array = generateSearchWhere($type, $_REQUEST['current_query_by_page']);
				$where = $ret_array['where'];
				
				$searchFields = $ret_array['searchFields'];
			} else {
				$where = '';
			}
		}
		$order_by = "";
		// Export entire list was broken because the where clause already has "where" in it
		// and when the query is built, it has a "where" as well, so the query was ill-formed.
		// Eliminating the "where" here so that the query can be constructed correctly.
		$beginWhere = substr(trim($where), 0, 5);
		if ($beginWhere == "where")
			$where = substr(trim($where), 5, strlen($where));

		$query = $focus->create_export_query($order_by,$where);
		$result = '';
		$result = $db->query($query, true, $app_strings['ERR_EXPORT_TYPE'].$type.": <BR>.".$query);
		$total= 0 ;
		while($row = $db->fetchByAssoc($result, false)) {
		$total += number_format((float)$row['total_amount'], 2, '.', '');
		$html .='<tr>
				<td style="border-style: solid; border-width: .5px; padding: 2px 6px; text-align: center;"><span style="font-size: x-small;">'.$timedate->to_display_date_time($row['date_entered']).'</span></td>
				<td style="border-style: solid; border-width: .5px; padding: 2px 6px;"><span style="font-size: x-small;">'.$row['document_name'].'</span></td>
				<td style="border-style: solid; border-width: .5px; padding: 2px 6px;"><span style="font-size: x-small;">'.$app_list_strings['cost_type_list'][$row['type']].'</span></td>
				<td style="border-style: solid; border-width: .5px; padding: 2px 6px;"><span style="font-size: x-small;">'.$row['payee'].'</span></td>
				<td style="border-style: solid; border-width: .5px; padding: 2px 6px;"><span style="font-size: x-small;">'.$row['invoice_number'].'</span></td>
				<td style="border-style: solid; border-width: .5px; padding: 2px 6px;"><span style="font-size: x-small;">$ '.$row['total_amount'].'</span></td>
				</tr>';
		}
		$html .='<tr>
		<td colspan="4"><span style="font-size: x-small;"> </span></td>
		<td style="border-style: solid; border-width: .5px; padding: 2px 6px; font-weight: bold; text-align: right;"><span style="font-size: x-small;">Total Amount Sum</span></td>
		<td style="border-style: solid; border-width: .5px; padding: 2px 6px;"><span style="font-size: x-small;">$ '.$total.'</span></td>
		</tr>
		</tbody>
		</table>';
	$pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '15', '15', '28', '28', '12', '12','L');
	$pdf->SetHTMLHeader($header);
	$pdf->AddPage();
	$pdf->WriteHTML($html);
	$pdf->Output();
	ob_clean();
	$pdf->Output("Client Cost Report.pdf", 'I');