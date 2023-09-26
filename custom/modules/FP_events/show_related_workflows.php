<?php

//Open pop-up Window
//$case_bean = BeanFactory::getBean('Cases', $_REQUEST['event_type']);
   $bean = BeanFactory::getBean('AOW_Conditions');
   $type_name= $_REQUEST['event_type'];
   $record= $_REQUEST['record_id'];
   $query = "value = '$type_name' ";
   $conditions_workflows = $bean->get_full_list('',$query);	
	   $stream_html .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	   <div class="container-fluid" style="padding-top:30px;">
	   <table class="table table-striped" style="width:700px;"  >
	   <thead>
	   <tr>
            <th style = "text-align:left;">Workflows</th>
            <th style = "text-align:left;">Action Name</th>
            <th style = "text-align:left;">Description</th>
            <th style = "text-align:left;">Actions</th>
       </tr>
            </thead>';
	   if (!empty($conditions_workflows))
	   {
    foreach($conditions_workflows as $row)
    {
    	  if (!empty($row->aow_workflow_id)) 
   {	
      $get_id=$row->aow_workflow_id;
   $workflow_related = BeanFactory::getBean('AOW_WorkFlow', $get_id);
   $workflow_related->status='Inactive';
   $workflow_related->save();
  $action_bean = BeanFactory::getBean('AOW_Actions');
   $query = "aow_actions.aow_workflow_id='$workflow_related->id'";
   $all_actions_related_to_workflow = $action_bean->get_full_list('',$query);
   foreach($all_actions_related_to_workflow as $action){
$stream_html .='
		 <tr>
		 <td>
		 <input type="checkbox" id="workflow_related" name="workflow_related" value="'.$workflow_related->id.'" style="padding-bottom:22px;">
			 <label for="workflow_related" style="font-size:14px; padding-left:5px;"> '.$workflow_related->name.'</label>
		 </td>
		 <td>'.$action->action.'</td>
		 <td><a href="#" style="color:#edd03d;" onclick="ShowDescription(\''.$workflow_related->description.'\')"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
		 <td>
			 <a href="index.php?module=AOW_WorkFlow&action=DetailView&record='.$workflow_related->id.'" target="_blank"><i  class="fa fa-eye" style="font-size:14px;color:#edd03d;" ></i></a>
			 				&nbsp; | &nbsp;
			 <a href="index.php?module=AOW_WorkFlow&action=EditView&record='.$workflow_related->id.'" target="_blank"><i  class="fa fa-edit" style="font-size:14px;color:#edd03d;" ></i></a>
			</td>
			</tr>';
   }
}
    }

$stream_html .='</table><input title="Activate" accesskey="a" class="button primary" onclick="confirm_activate_workflows();" type="submit" name="button" value="Activate" id="SAVE" style="float:right; border-radius:20px; "><input title="Cancel"  class="button primary" onclick="cancelWorkflow();" type="button" name="cancel_workflow" value="Cancel" id="Cancel" style="float:right; border-radius:20px; margin-top:0px;""></div>';

echo $stream_html;
die;

}
