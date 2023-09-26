<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');


require_once('include/EditView/SubpanelQuickCreate.php');

class PLEA_PleadingsSubpanelQuickcreate extends SubpanelQuickcreate
{
    function PLEA_PleadingsSubpanelQuickcreate()
    {
        global$app_list_strings;
        if (isset($_REQUEST['parent_id']) && $_REQUEST['parent_id'] != '' && isset($_REQUEST['parent_type']) &&  $_REQUEST['parent_type'] == 'Cases'){
			 $case = new aCase();
			 $case->retrieve($_REQUEST['parent_id']);
			 $_REQUEST['case_type_c'] = $case->type;
			 //$_REQUEST['case_status_c'] = $case->status;
			 $_REQUEST['case_assigned_to_c'] = $case->assigned_user_name;
			 $_REQUEST['user_id_c'] = $case->assigned_user_id;
			 parent::SubpanelQuickCreate("PLEA_Pleadings");
         }
    }
}
?>
