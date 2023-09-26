<?php
function get_discovery_processed_done(){
	$parent_id =  $_REQUEST;
	// print_r();
	// die();
$ret = array();
$ret['select'] ="SELECT id, done FROM disc_discovery";
$ret['from'] = "FROM disc_discovery";
$ret['join'] = "INNER JOIN disc_discovery_cases_c ON disc_discovery.id = disc_discovery_cases_c.disc_discovery_casesdisc_discovery_idb";
$ret['where'] = "WHERE disc_discovery.done = 1 AND disc_discovery_cases_c.disc_discovery_casescases_ida = '816e60dc-e67a-b3d4-615e-6112409795be'";
 return $ret;
 
}