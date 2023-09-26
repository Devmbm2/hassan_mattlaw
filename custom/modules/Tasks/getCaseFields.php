<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class getCaseFields
{
	function getCaseStatus($bean, $event, $arguments){
		global $db, $timedate;
		if($bean->parent_type = 'Cases' && !empty($bean->parent_id)){
			$caseBean = BeanFactory::getBean('Cases', $bean->parent_id);
			$bean->case_status = $GLOBALS['app_list_strings']['case_status_dom'][$caseBean->status];
		}
	}	
	function getCaseAssistant($bean, $event, $arguments){
		global $db, $timedate;
		if($bean->parent_type = 'Cases' && !empty($bean->parent_id)){
			$caseBean = BeanFactory::getBean('Cases', $bean->parent_id);
			$bean->case_assistant = $caseBean->default_assistant_lawyer_name;
		}
	}

}

