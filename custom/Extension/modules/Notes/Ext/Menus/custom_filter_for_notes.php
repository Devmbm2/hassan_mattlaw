<?php

if(ACLController::checkAccess('Cases', 'edit', true)) {
	global $current_user;
	if($current_user->is_admin){
		$module_menu[] = array(
			"index.php?module=Notes&action=index&custom_notes_filter=true&clear_query=true",
			'Notes (Not attached To Contacts Or Cases)','List', 
			'Notes' 
		);
	}	
}