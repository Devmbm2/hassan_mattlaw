<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
	ini_set('display_errors','off');
	error_reporting(E_ALL); // STRICT DEVELOPMENT
	global $db;

	$sql = "SELECT * FROM documents where doc_type = 'Local'";
	$result = $db->query($sql);
	$found = $not_found = $count = 0;
	$html.= '<table id="report_table" class="striped border bordered" >
                <thead>
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>Directory</th>
					<th>Status</th>
				</tr>
			</thead>
			<tr>';
	while($row = $db->fetchByAssoc($result)){
		$count++;
		if(file_exists($row['doc_url'])){
			$found++;
			$found_status = 'Yes';
		}else{
			$not_found++;
			$found_status = 'No';
		}
		if($count%2){
			$class = "oddListRowS1";
		}else{
			$class = "evenListRowS1";
		}
		$html .='<tr style="border-bottom: 1px solid black;" class="'.$class.'">';
		$html .='<td>'.$count.'</td>';
		$html .='<td><a target="_blank" href="index.php?module=Documents&action=DetailView&record='.$row['id'].'">'.$row['document_name'].'</a></td>';
		$html .='<td>'.$row['doc_url'].'</td>';
		$html .='<td>'.$found_status.'</td>';
		$html .='</tr>';
	}
	$html .='<tr><td>Total Found</td><td>'.$found.'</td><td>Total Not Found</td><td>'.$not_found.'</td>';
	$html .='</tr>';
	$html .= '</tbody></table>';
	echo $html;
