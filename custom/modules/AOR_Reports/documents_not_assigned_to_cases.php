<?php
	global $sugar_config, $db;
	$execute_queries = array();
	$execute_queries['Documents']['query'] = "SELECT d.id, d.document_name AS name FROM documents d
	LEFT JOIN documents_cases dc ON (dc.document_id = d.id AND dc.deleted = 0) 
	WHERE d.deleted = 0 AND dc.case_id IS NULL
	AND (`d`.date_entered BETWEEN '2019-09-02 00:00:00'
		AND '2019-09-09 00:00:00') AND d.id NOT IN (SELECT d.id AS name FROM documents d
	INNER JOIN documents_contacts dc ON (dc.document_id = d.id AND dc.deleted = 0) 
	WHERE d.deleted = 0)";
	$execute_queries['Documents']['label'] = 'Documents';
	
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
	
	