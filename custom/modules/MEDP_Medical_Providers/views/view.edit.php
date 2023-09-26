<?php
/* require_once('modules/Leads/views/view.edit.php'); */

class MEDP_Medical_ProvidersViewEdit extends ViewEdit {
 	public function __construct(){
 		parent::__construct();
		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
 	}
 	function display(){
		parent::display();
 	}	
}
