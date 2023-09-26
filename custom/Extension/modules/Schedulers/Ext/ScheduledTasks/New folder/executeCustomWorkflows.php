<?php
$job_strings[] = 'executeCustomWorkflows';
function executeCustomWorkflows()
{
	require_once('custom/modules/AOW_WorkFlow/ht_AOW_Workflow.php');
	global $db;
	$sql = "SELECT id FROM aow_workflow WHERE run_when = 'In_Custom_Scheduler' AND deleted = 0;";
	$result = $db->query($sql);

	while ($row = $db->fetchByAssoc($result)) {
		$workflow = new ht_AOW_WorkFlow();

		$workflow->retrieve($row['id']);
		run_flow($workflow);
	}
	return true;
}

function run_flow($workflow){
	$beans = $workflow->get_flow_beans();
	if(!empty($beans)){

		foreach($beans as $bean){
			$bean->retrieve($bean->id);
			$workflow->run_actions($bean);
		}
	}
}
