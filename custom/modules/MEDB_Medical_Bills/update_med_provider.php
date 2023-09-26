<?php

$sql = "SELECT * 
		FROM accounts_medb_medical_bills_1_c 
		WHERE deleted = 0 ";
		
$select = $GLOBALS['db']->query($sql, true);

$data = array();
While($row = $GLOBALS['db']->fetchByAssoc($select)){
	/* $data[$row['accounts_medb_medical_bills_1accounts_ida']] = $row['accounts_medb_medical_bills_1medb_medical_bills_idb']; */
	$update = "UPDATE medb_medical_bills SET account_id_c = '{$row['accounts_medb_medical_bills_1accounts_ida']}' WHERE id = '{$row['accounts_medb_medical_bills_1medb_medical_bills_idb']}'";
	$GLOBALS['db']->query($update, true);
}

echo 'done';
/* print"<pre>";print_r($data); */