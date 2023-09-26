<?php
global $db, $app_list_strings, $beanList;
/* print"<pre>";print_r($GLOBALS['beanList']['Accounts']); */
/* print"<pre>";print_r(array_values($app_list_strings['moduleList']));echo'<hr>';
print"<pre>";print_r($GLOBALS['beanList']); */
/* print"<pre>";print_r(implode("','", array_values($app_list_strings['moduleList']))); */
/* $bean_list = array_unique (array_merge (array_values($app_list_strings['moduleList']), array_values($GLOBALS['beanList']))); */
$modules = array_unique (array_merge (array_values($app_list_strings['moduleList']), $GLOBALS['moduleList']));
$GLOBALS['beanList']['Cases'] = 'Case';
$data = array();
foreach($modules as $value){
	$data[] = $value. '2_'. strtoupper($GLOBALS['beanList'][$value]);
}
/* unset($data[0]); */
 print"<pre>";print_r($data);
/* $list = implode("','", $data); */
/* echo $list; */
$sql = 'SELECT * 
		   FROM `user_preferences` 
		   WHERE deleted = 0 AND category NOT LIKE "%Home%" AND category NOT LIKE "%global%" AND category NOT LIKE "%ETag%" AND category IN ("'.implode('","', $data).'")';
/* $result = $db->query($sql, true); */
echo $sql;
/* while($row = $db->fetchByAssoc($result)){
	
} */