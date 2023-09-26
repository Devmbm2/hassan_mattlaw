<?php
require_once('include/MVC/View/views/view.detail.php');
class AOW_WorkflowViewDetail extends ViewDetail {
	function display() {
		$group_team = BeanFactory::getBean('SecurityGroups',$this->bean->assigned_team);
		$team = $group_team->name;
		$this->ss->assign('Team', $team);
		parent::display();
	}	
}
