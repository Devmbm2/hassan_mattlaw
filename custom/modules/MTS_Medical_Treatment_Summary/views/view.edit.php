<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class MTS_Medical_Treatment_SummaryViewEdit extends ViewEdit
{
	function __construct(){
        parent::__construct();
		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
    }
	public function  display(){
		parent::display();
		echo "<script type='text/javascript' src='custom/modules/MTS_Medical_Treatment_Summary/js/edit.js'></script> ";
	}
}

?>