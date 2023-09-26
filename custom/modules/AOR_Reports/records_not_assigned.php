<?php
	global $sugar_config, $db;
	$execute_queries = array();
	$execute_queries['Documents']['query'] = "SELECT d.id, d.document_name AS name FROM documents d
	LEFT JOIN documents_cases dc ON (dc.document_id = d.id AND dc.deleted = 0) 
	WHERE d.deleted = 0 AND dc.case_id IS NULL
	AND d.id NOT IN (SELECT d.id AS name FROM documents d
	INNER JOIN documents_contacts dc ON (dc.document_id = d.id AND dc.deleted = 0) 
	WHERE d.deleted = 0)";
	$execute_queries['Documents']['label'] = 'Documents';
	
	$execute_queries['PLEA_Pleadings']['query'] = "SELECT d.id, d.document_name AS name FROM plea_pleadings d
	LEFT JOIN plea_pleadings_cases_c dc ON (dc.plea_pleadings_casesplea_pleadings_idb = d.id AND dc.deleted = 0) 
	WHERE d.deleted = 0 AND dc.plea_pleadings_casescases_ida IS NULL";
	$execute_queries['PLEA_Pleadings']['label'] = 'Pleadings';
	
	$execute_queries['NEG_Negotiations']['query'] = "SELECT d.id, d.document_name AS name FROM neg_negotiations d
	LEFT JOIN neg_negotiations_cases_c dc ON (dc.neg_negotiations_casesneg_negotiations_idb = d.id AND dc.deleted = 0) 
	WHERE d.deleted = 0 AND dc.neg_negotiations_casescases_ida IS NULL";
	$execute_queries['NEG_Negotiations']['label'] = 'Negotiations';
	
	$execute_queries['DISC_Discovery']['query'] = "SELECT d.id, d.document_name AS name FROM disc_discovery d
	LEFT JOIN disc_discovery_cases_c dc ON (dc.disc_discovery_casesdisc_discovery_idb = d.id AND dc.deleted = 0) 
	WHERE d.deleted = 0 AND dc.disc_discovery_casescases_ida IS NULL";
	$execute_queries['DISC_Discovery']['label'] = 'Discovery';
	
	$execute_queries['COST_Client_Cost']['query'] = "SELECT d.id, d.document_name AS name FROM cost_client_cost d
	LEFT JOIN cost_client_cost_cases_c dc ON (dc.cost_client_cost_casescost_client_cost_idb = d.id AND dc.deleted = 0) 
	WHERE d.deleted = 0 AND dc.cost_client_cost_casescases_ida IS NULL";
	$execute_queries['COST_Client_Cost']['label'] = 'Client Cost';
	
	foreach($execute_queries AS $module => $list){
		$result = $db->query($list['query'], true);
		if($result->num_rows > 0){
			echo "<h1>{$list['label']}:<h1>";
			echo "<h1>Total number of {$list['label']} which are not attached to Cases: ".$result->num_rows."<h1>";
			echo "<div style='max-height:200px;overflow:auto;' class='list-view-rounded-corners'><table class='list view table-responsive'><tbody>
			<tr><td></td><td>Document Name</td></tr>";
			$count = 1;
			while($row = $db->fetchByAssoc($result)){
				if($count%2){
					$style="oddListRowS1";
				}else{
					$style="evenListRowS1";
				}
				echo "<tr id='q_{$row['id']}' class='".$style."'> 
					<td>".$count."</td>
					<td><a href='index.php?module={$module}&action=DetailView&record={$row['id']}' target='_blank'>{$row['name']}</a></td>	
				</tr>";
				$count++;
			}
			echo "</tbody></table></div>";
		}
	}
	
	