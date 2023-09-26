<?php
global $db;
$contact_id = $_REQUEST['contact_id'];
$contact_type = $_REQUEST['type'];
$contact_array = array();
$form = '';
 $bean = BeanFactory::getBean('AOW_WorkFlow');
 $query = "aow_workflow.flow_module= 'Contacts'";
 $Contacts = $bean->get_full_list('',$query);
 $form .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <div class="container-fluid" style="">
 <table class="table table-striped contact_table" id="contact_table" style="width:700px;"  >
	   <thead>
	   <tr>
            <th style = "text-align:left;">Workflows</th>
            <th style = "text-align:left;">Action Name</th>
            <th style = "text-align:left;">Description</th>
            <th style = "text-align:left;">Actions</th>
              </tr>
            </thead>
            <tbody>';
 foreach ($Contacts as $contact) {
 	$sql = "SELECT * FROM aow_processed where aow_processed.status='Complete' AND aow_processed.aow_workflow_id = '{$contact->id}' AND aow_processed.parent_id = '{$contact_id}'";
 	$result = $db->query($sql);
 	$row = $db->fetchByAssoc($result);  
 	if (!empty($contact->id) && empty($row['id'])) 
   {	
      $get_id=$contact->id;
   $workflow_related = BeanFactory::getBean('AOW_WorkFlow', $get_id);
   $workflow_related->status='Inactive';
   $workflow_related->save();
   $action_bean = BeanFactory::getBean('AOW_Actions');
   $query = "aow_actions.aow_workflow_id='$workflow_related->id'";
   $all_actions_related_to_workflow = $action_bean->get_full_list('',$query);
   foreach($all_actions_related_to_workflow as $action){	
     $form.='
		<tr>
		  <td style="" >
		    <input type="checkbox" id="workflow_related" name="workflow_related" value="'.$contact->id.'" style="padding-bottom:20px;">
		    <label for="workflow_related" style="font-size:14px; padding-left:5px;"> '.$contact->name.'</label>
		  </td>
		  <td>'.$action->action.'</td>
		 <td><a href="#" style="color:#edd03d;" onclick="ShowDescription(\''.$workflow_related->description.'\')"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
		  <td style="width:20px; margin-left:70px;">
			 <a href="index.php?module=AOW_WorkFlow&action=DetailView&record='.$contact->id.'" target="_blank"><i class="fa fa-eye" style="font-size:14px;color:#edd03d;"></i></a>
			 |&nbsp;<a href="index.php?module=AOW_WorkFlow&action=EditView&record='.$contact->id.'" target="_blank"><i class="fa fa-edit" style="font-size:14px;color:#edd03d;"></i></a>
	      </td>
		</tr>';
 }
}
}
// }
 $form .='</tbody></table><input title="Activate"  class="button primary" onclick="selectWorkflow();" type="button" name="select_workflow" value="Activate" id="Activate" style="float:right; border-radius:20px; ""><input title="Cancel"  class="button primary" onclick="cancelWorkflow();" type="button" name="cancel_workflow" value="Cancel" id="Cancel" style="float:right; border-radius:20px; ""></div>';
// }
   echo json_encode($form);
 die;

?>
