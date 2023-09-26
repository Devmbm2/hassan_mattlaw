<?php

$users = get_users();
$sql = "SELECT * FROM `users` WHERE deleted = 0";
$result = $GLOBALS['db']->query($sql, true);
print"<pre>";print_r($result);
$db_start = '7:00';
$db_end = '21:30';
while($row = $GLOBALS['db']->fetchByAssoc($result)){
	echo $row['id'];echo '<br>';
	$bean = BeanFactory::getBean('Users', $row['id']);
	$bean->setPreference('day_start_time', $db_start, 0, 'global', $bean);
	$bean->setPreference('day_end_time', $db_end, 0, 'global', $bean);
	$bean->savePreferencesToDB();	
}

echo 'done';