<?php

$job_strings[] = 'runMEDBRequestedWorkflow';
function runMEDBRequestedWorkflow($bean)
{
   require_once('custom/modules/AOW_WorkFlow/ht_AOW_Workflow.php');
   
   $condition=BeanFactory::getBean('AOW_Conditions');
   $query = "aow_conditions.field='status_id' AND aow_conditions.value='Requested'";
   $conditions = $condition->get_full_list("",$query);
   // die();
            foreach($conditions as $con){
               $workflow_id = BeanFactory::getBean('AOW_WorkFlow',$con->aow_workflow_id);
               // print_r($workflow_id);
                $workflow = new ht_AOW_WorkFlow();
                // $workflow->run_bean_flows($mreq_medb_request,$con->aow_workflow_id);
                // $workflow->run_bean_flows($workflow_id);
                $workflow->retrieve($con->aow_workflow_id);
                // $workflow->run_actions($workflow_id);
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


