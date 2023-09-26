<?php
	
	global $current_user, $sugar_version, $sugar_config, $beanFiles, $db;
	
	$query = "SELECT id FROM users WHERE deleted = 0 AND status = 'Active'";
	$db_result = $db->query($query);
	$users_list = array(
		'2f706d89-ee14-839e-318d-59a95cf87304',
		'7669c507-f1eb-477e-f89d-5af4811e86a0',
		'8202dffa-afd8-2b0e-93ef-59a95bf00a77',
		'906a6a67-334e-4f2a-40b8-5d10c084af1a',
		'e4cd5835-f692-69de-3b3a-591598674c54',
	);
	
	while ($db_row = $db->fetchByAssoc($db_result)){
		$user = BeanFactory::getBean('Users', $db_row['id']);
		$user->setPreference('shared_ids', $users_list);
		$user->save();
	}
	die('DONE');
?>