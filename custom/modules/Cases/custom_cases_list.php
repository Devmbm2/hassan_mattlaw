<?php

global $db;

$sql = "SELECT count(*) as count FROM cases WHERE deleted = 0 AND (cases.status = 'Closed' OR cases.status = 'Adiosed')";
$result = $db->query($sql);
$row = $db->fetchByAssoc($result);
print"<pre>";print_r($row);
/* while($row = $db->fetchByAssoc($result)){
	
} */