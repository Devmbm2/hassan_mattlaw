<?php
require_once "modules/AOW_WorkFlow/AOW_WorkFlow.php";
class AOW_WorkFlow_Advance extends AOW_WorkFlow {
    public function getWorkflowsWithConditionsForCasesModule()
    {
        // Query to retrieve workflows and their associated conditions
        $query = "
            SELECT w.*, c.*
            FROM aow_workflow w
            LEFT JOIN aow_conditions c ON w.id = c.aow_workflow_id
            WHERE w.module = 'Cases'
            ORDER BY w.id, c.condition_order";

        $result = $this->db->query($query);

        $workflows = array();
        $currentWorkflow = null;

        // Loop through the result rows and organize into workflows with conditions
        while ($row = $this->db->fetchByAssoc($result)) {
            if (!$currentWorkflow || $currentWorkflow->id !== $row['id']) {
                // Create a new workflow instance
                $currentWorkflow = new AOW_Workflow();
                $currentWorkflow->populateFromRow($row); // Populate workflow properties

                // Add to the workflows array
                $workflows[] = $currentWorkflow;
            }

            if ($row['id'] && $row['aow_workflow_id']) {
                // Create a new condition instance
                $condition = new AOW_Condition();
                $condition->populateFromRow($row); // Populate condition properties

                // Add the condition to the current workflow
                $currentWorkflow->addCondition($condition);
            }
        }

        return $workflows;
    }
}
?>
