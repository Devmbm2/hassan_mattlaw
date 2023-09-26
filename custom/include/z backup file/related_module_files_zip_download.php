<?php
  // namespace Dompdf;
   require_once 'custom/include/dompdf/autoload.inc.php';
   use Dompdf\Dompdf;
	require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
	$parent_bean =BeanFactory::getBean('Cases', $_REQUEST['record_id']);
	// print_r('<pre>');print_r($_REQUEST['module']);die();
	$download_file_name = $parent_bean->name;
    $selected_records = explode(',', $_REQUEST['tmp']);
    $selected_modules = explode(',', $_REQUEST['selected_modules']);
    // print"<pre>asd";
	//print_r($selected_ids);die; 
    $temp_files = array();
    $list_files = array();
	$related_modules_data = array();
	foreach($selected_modules as $subpanel_name){
		if($subpanel_name == 'Running_Bills_Liens_Medical_Bills'){
			$params = array('contact_id' => $parent_bean->id);
			$data = getRelatedReceivedMedicalBills($params);
			if(isset($data) && !empty($data)){
				$query = $data['select']. $data['from']. $data['join']. $data['where'];
				$result = $GLOBALS['db']->query($query, true);
				while($row = $GLOBALS['db']->fetchByAssoc($result)){
					$related_modules_data[$subpanel_name][] = array('record_id' => $row['id'], 'record_type' => 'MDOC_Incoming_Bills');
				}
			}
		} 
		else{
			$selected_module_data = $GLOBALS['app_list_strings']['related_modules_subpanels'][$subpanel_name];
			$selected_module_data_link_name = $selected_module_data['link_name'];
			$where = '';
			if(isset($selected_module_data['where_subpanel']) && !empty($selected_module_data['where_subpanel'])){
				$where = $selected_module_data['where_subpanel'];
			}
			if ($parent_bean->load_relationship($selected_module_data_link_name)){
				$relatedBeans = $parent_bean->get_linked_beans($selected_module_data_link_name, $selected_module_data['module'], '', '',  '', 0, $where);
				foreach($relatedBeans AS $id => $record_data){
					$related_modules_data[$subpanel_name][] = array('record_id' => $record_data->id, 'record_type' => $selected_module_data['module']);
					
				}
			}
			
		}
		if ($subpanel_name == 'Notes'){
			$selected_ids = explode(',', $_REQUEST['selected_ids']);
			$css = ' body  {
							font-size: 10px; /* Default font size */
						}
						span {
							font-size: 10px !important; /* Minimum font size for paragraphs */
						}
						.page-break {
							page-break-before: always;
						}
					';
			$html = '<style>
			td {
				word-wrap: break-word;
			}
			</style>
			<table border="1" style="width: 100%; overflow: wrap; border-collapse: collapse; table-layout: fixed;" id="close_cases_pdf" autosize="1">
            <thead>
                <tr style="font-weight: bold; font-size: 20px;">
                    <td style="font-weight: bold; text-align: left; width: 20%;"><p style="font-size: 20px;"><strong>Subject</strong></p></td>
                    <td style="font-weight: bold; text-align: left; width: 70%;"><p style="font-size: 20px;"><strong>Description</strong></p></td>
                    <td style="font-weight: bold; text-align: left; width: 20%;"><p style="font-size: 20px;"><strong>Created at</strong></p></td>
                </tr>
            </thead>';
			foreach ($selected_ids as $id) {
				$noteBean = BeanFactory::getBean('Notes', $id);
				$html .= '<tr>
							<td style="text-align: left; width: 20%; padding: 10px;"><p style="font-size: 18px;">' . $noteBean->name . '</p></td>
							<td style="text-align: left; width: 70%; padding: 10px;"><p style=" overflow: hidden; font-size: 18px;  word-wrap: break-word;">' . $noteBean->description . '</p></td>
							<td style="text-align: left; width: 20%; padding: 10px;"><p style="font-size: 18px;">' . $noteBean->date_entered . '</p></td>
						</tr>';
			}	

			$html .= '</tbody></table>';
			
			try {
				$dompdf = new Dompdf();
				$dompdf->loadHtml($html);
				$dompdf->setPaper('A4', 'portrait');
				$dompdf->render();
				$dompdf->stream("codexworld", array("Attachment" => 0));
				die;
				// $pdf = new mPDF('en', 'A4', '20', 'DejaVuSansCondensed', 10, 10, 16, 16, 9, 9);
				// $pdf->WriteHTML($css, 1);	
				// $pdf->shrink_tables_to_fit = 1;
				// $pdf->SetHTMLHeader($header);
				// $pdf->AddPage('P');
				// $pdf->WriteHTML($html);	
				// $pdf_filename = 'AllNotes.pdf'; 
				//  echo "<pre>"; print_r($pdf); echo "</pre>";
				// die;
				// $pdf->Output($pdf_filename, 'I'); 
				// die;
				// $list_files[$subpanel_name][] = $pdf_filename;
			} catch (Exception $e) {
				//echo 'An error occurred: ' . $e->getMessage();
			}
			

			}
			if ($subpanel_name == 'Emails'){
				$selected_ids = explode(',', $_REQUEST['emailsValues']);
				$html = ' <table border=1 style="width: 100%; border-collapse: collapse;"  id="close_cases_pdf" class="table table-bordered table-responsive">
							<tbody>
							<thead>
							<tr style="font-weight:bold;font-size:18px;" >
									<td style="font-weight: bold; text-align: left; width:60%;"><span style="font-size: 18px;"><strong>Subject</strong></span></td>
									<td style="font-weight: bold; text-align: left; width:20%;"><span style="font-size: 18px;"><strong>To</strong></span></td>
									<td style="font-weight: bold; text-align: left; width:20%;"><span style="font-size: 18px;"><strong>From</strong></span></td>
								</tr>
								</thead>';
					foreach($selected_ids as $id) 
					{
						$EmailBean = BeanFactory::getBean('Emails', $id);
						//echo "<pre>"; print_r($EmailBean); echo "</pre>";   die;
						$html .='<tr>
								<td style="text-align: left; width:60%;"><span style="font-size: 16px;">'.$EmailBean->name.'</span></td>
								<td style="text-align: left; width:20%;"><span style="font-size: 16px;">'.$EmailBean->to_addrs_names.'</span></td>
								<td style="text-align: left; width:20%;"><span style="font-size: 16px;">'.$EmailBean->from_addr_name.'</span></td>
								</tr>';
					}
					//die;
				$html .= '</tbody></table>';				
				
				try {
					$pdf = new mPDF('en', 'A4', '12', 'DejaVuSansCondensed', 10, 10, 16, 16, 9, 9);
					$pdf->SetHTMLHeader($header);
					$pdf->AddPage('P');
					$pdf->WriteHTML($html);	
					$pdf_filename = 'AllEmails.pdf'; 
					$pdf->Output('test/'.$pdf_filename, 'F');
					//die; 
					$list_files[$subpanel_name][] = $pdf_filename;
				} catch (Exception $e) {
					echo 'An error occurred: ' . $e->getMessage();
				}
			
				}
		
	}
	foreach($related_modules_data AS $subpanel_name => $record){
		foreach($record AS $data){
			$_REQUEST['id'] = $data['record_id'];
			$_REQUEST['type'] = $data['record_type'];
			 echo $subpanel_name; echo $_REQUEST['type'];die();
			$getrevise_id = BeanFactory::getBean('Documents', $_REQUEST['id']);
			if($getrevise_id->hard_or_soft_doc == 'Soft_Documents' || $getrevise_id->hard_or_soft_doc == 'Hard_Documents')
			{
			$revise_id = $getrevise_id->document_revision_id;
			}
			else if($subpanel_name == 'Pleadings')
			{
			$getrevise_id = BeanFactory::getBean('PLEA_Pleadings', $_REQUEST['id']);
			$revise_id = $getrevise_id->id;
			}
			else if($subpanel_name == 'Discovery' || $subpanel_name == '3RD-Non-Party')
			{
			$getrevise_id = BeanFactory::getBean('DISC_Discovery', $_REQUEST['id']);
			$revise_id = $getrevise_id->id;
			}
			else if($subpanel_name == 'Negotiations')
			{
			$getrevise_id = BeanFactory::getBean('NEG_Negotiations', $_REQUEST['id']);
			$revise_id = $getrevise_id->id;
			}
			else if($subpanel_name == 'Client_Cost')
			{
			$getrevise_id = BeanFactory::getBean('COST_Client_Cost', $_REQUEST['id']);
			$revise_id = $getrevise_id->id;
			}
			else if($subpanel_name == 'Emails')
			{
			$getrevise_id = BeanFactory::getBean('Notes')
			->retrieve_by_string_fields(
			array('Parent_type'=>'Emails' , 'Parent_id'=> $_REQUEST['id'] )
			);
			$revise_id = $getrevise_id->id;
			}
			else if($subpanel_name == 'Notes')
			{
			$getrevise_id = BeanFactory::getBean('Notes', $_REQUEST['id']);
			$revise_id = $getrevise_id->id;
			}
			foreach($selected_records AS $file_name){
				// echo $revise_id;
			if(strpos($file_name, $revise_id) !== false) {
				$list_files[$subpanel_name][] = $temp_files[$subpanel_name][] =  $file_name;
			}
		}
		}
	}
	$zip = new ZipArchive;
	$zip_file_name = $download_file_name.'.zip';
	if ($zip->open($zip_file_name, ZipArchive::CREATE) === TRUE) {
		if (!empty($list_files)) {
			foreach ($list_files as $subpanel_name => $files) {
				if ($zip->addEmptyDir($subpanel_name)) {
					foreach ($files as $file_name) {
						//$zip->addFile($file_name, $subpanel_name.'/'.$file_name);
						$zip->addFile('test/'.$file_name, $subpanel_name.'/'.$file_name);

					}
				}
			}
		} else{
			/* die('asd'); */
			$zip->addEmptyDir('No Files To Download As Zip');
		}
		
		$zip->close();
		download_zip($zip_file_name);
		$temp_files[] = $zip_file_name;
	}
	foreach ($temp_files as $temp_file) {
		if ($temp_file && is_file($temp_file) && is_writable($temp_file) ) {
			unlink ($temp_file);
		}
	}
	function download_zip($file_name){
		$base_name = basename($file_name);

		ini_set('zlib.output_compression','Off');

		if(isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT'])) {
		 $base_name = urlencode($base_name);
		 $base_name = str_replace("+", "_", $base_name);
		}

		header("Pragma: public");
		header("Cache-Control: maxage=1, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"".$base_name."\";");
		// disable content type sniffing in MSIE
		header("X-Content-Type-Options: nosniff");
		header("Content-Length: " . filesize($file_name));
		header("Expires: 0");

		@ob_end_clean();
		ob_start();
		readfile($file_name);
		@ob_flush();
	}