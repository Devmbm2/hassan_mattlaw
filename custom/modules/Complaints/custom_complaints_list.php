<?php

global $db;

$sql = "SELECT count(*) as count FROM complaints WHERE deleted = 0 AND (complaints.status = 'Closed' OR complaints.status = 'Adiosed')";
$result = $db->query($sql);
$row = $db->fetchByAssoc($result);
print"<pre>";print_r($row);
/* while($row = $db->fetchByAssoc($result)){
	
} */