<?php
	
	global $current_user, $sugar_version, $sugar_config, $beanFiles, $db;
	
	$users_array = get_user_array(false);
	
	$shared_ids = array();
	$user = array();
	$shared_ids_colors = array();
	foreach($users_array AS $user_id => $user_name){
		$shared_ids_colors[$user_id] = random_color();
		$shared_ids[] = $user_id;
	}
	foreach($users_array AS $id => $name){
		$user = array();
		$user = BeanFactory::getBean('Users', $id);
		$GLOBALS['current_user'] = $user;
		$user->setPreference('shared_ids', $shared_ids);
		$user->setPreference('shared_ids_colors', $shared_ids_colors);
		// $user->savePreferencesToDB();
		$user->processed = true;
		$user->save(false);
	}
	die('DONE');
?>