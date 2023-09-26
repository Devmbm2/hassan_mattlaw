<?php
$case_id = $_REQUEST['id'];
$date = $_REQUEST['statue_of_limitations'];
if(!empty($case_id) && !empty($date)){
	$update = "UPDATE cases_cstm set statute_of_limitations_c = '{$date}' WHERE id_c = '{$case_id}'";
	echo $update;echo '<br>';
	$GLOBALS['db']->query($update);
	echo 'Yes Updated ...';
}
