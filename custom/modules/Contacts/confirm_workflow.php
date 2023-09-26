<?php
global $db;
$workflow_ids= $_REQUEST['checkboxArray'];
$form = '';
$form .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <div class="container-fluid" style="">
 <table class="table table-striped" style="width:700px;"  >
      <thead>
      <tr>
            <th style = "text-align:left;">Workflows</th>
            <th style = "text-align:left;">Action Name</th>
            <th style = "text-align:left;">Description</th>
            <th style = "text-align:left;">Actions</th>
              </tr>
            </thead>
            <tbody>';
   foreach ($workflow_ids as $id) {
      $workflow_bean = BeanFactory::getBean('AOW_WorkFlow',$id);
   $action_bean = BeanFactory::getBean('AOW_Actions');
   $query = "aow_actions.aow_workflow_id='$id'";
   $all_actions_related_to_workflow = $action_bean->get_full_list('',$query);
   foreach($all_actions_related_to_workflow as $action){ 
     $form.='
      <tr>
        <td style="" >
          <label for="workflow_related" style="font-size:14px; padding-left:5px;"> '.$workflow_bean->name.'</label>
        </td>
        <td>'.$action->action.'</td>
       <td><a href="#" style="color:#edd03d;" onclick="ShowDescription(\''.$workflow_bean->description.'\')"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
        <td style="width:20px; margin-left:70px;">
          <a href="index.php?module=AOW_WorkFlow&action=DetailView&record='.$workflow_bean->id.'" target="_blank"><i class="fa fa-eye" style="font-size:14px;color:#edd03d;"></i></a>
          |&nbsp;<a href="index.php?module=AOW_WorkFlow&action=EditView&record='.$workflow_bean->id.'" target="_blank"><i class="fa fa-edit" style="font-size:14px;color:#edd03d;"></i></a>
         </td>
      </tr>';
 }
}
// }
 $form .='</tbody></table><span>Do You Want to proceed these workflows?</span><input title="No"  class="button primary" onclick="no_workflow();" type="button" name="No_workflow" value="No" id="No" style="float:right; border-radius:20px; ""><input title="Yes"  class="button primary" onclick="yes_workflow();" type="button" name="select_workflow" value="Yes" id="Yes" style="float:right; border-radius:20px; ""></div>';
   echo json_encode($form);
 die;
?>