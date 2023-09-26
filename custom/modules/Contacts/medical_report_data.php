<?php
global $db;
$sql = "SELECT id, description as short_description, treatment_description_summary 
		FROM mts_medical_treatment_summary 
		WHERE deleted = 0";
		
$result = $db->query($sql);
$count = 0;
WHILE($row = $db->fetchByAssoc($result)){
	if($row['short_description']){
		/* $db->query("UPDATE mts_medical_treatment_summary SET treatment_description_summary = CONCAT('yes     ', treatment_description_summary) WHERE id = '5a25ee08-7492-7d35-4b57-5b890ade6fe8';"); */
		/* print"<pre>";print_r($row); */
		$count++;
	}
	
	
}

echo $count;