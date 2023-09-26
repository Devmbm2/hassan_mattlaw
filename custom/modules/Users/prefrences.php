<?php
	
	global $module_list;
	
	/* print"<pre>";print_r($GLOBALS);die; */
	$all_users = array();
	$all_users = get_user_array();
	/* $bean = BeanFactory::getBean('Users', '2365217c-d0ee-90a2-2325-59a420c6b518'); */
	/* $home_pages = $current_user->_userPreferenceFocus; */
	
	
	/* print"<pre>";print_r($new_user->_userPreferenceFocus->savePreferencesToDB()); */
	
	
	/* $home_dashlets = $current_user->_userPreferenceFocus->getPreference('global', 'displayColumns'); */
	
	/* foreach($all_users as $id => $name){
		$new_user = BeanFactory::getBean('Users', $id);
		unset($_SESSION[$new_user->user_name."_PREFERENCES"]['global']['FP_eventsQ']['displayColumns']);
		$new_user->_userPreferenceFocus->savePreferencesToDB();
		print"<pre>";print_r($_SESSION[$bean->user_name."_PREFERENCES"]['global']['FP_eventsQ']);
	} */	
	foreach($all_users as $id => $name){
		$new_user = BeanFactory::getBean('Users', $id);
		/* $new_user->setPreference('day_start_time', '01:00', 0, 'global', $new_user);
		$new_user->setPreference('day_end_time', '12:00', 0, 'global', $new_user); */
		$new_user->setPreference('default_currency_significant_digits','0', 0, 'global');
		$new_user->_userPreferenceFocus->savePreferencesToDB();
	}
	echo 'done';