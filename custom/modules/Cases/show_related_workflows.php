<?php
global $db;
//Open pop-up Window
//$case_bean = BeanFactory::getBean('Cases', $_REQUEST['event_type']);
 // require_once('custom/modules/Cases/js/edit.js');
//get and check age of injured person
	// $stream_html = "";
  $contact_id= $_REQUEST['contact_id'];
  $case_id= $_REQUEST['case_id'];
  // echo $contact_id;die;
  $get_contact = BeanFactory::getBean('Contacts', $contact_id);
  $get_dob= $get_contact->birthdate;
	$dob = new DateTime($get_dob);
	$now = new DateTime();      
	$difference = $now->diff($dob); 
	$age = $difference;
	$age=$age->format('%y.%m');
      if($age>=17.5 && $age<=70.0) { 
				 $bean = BeanFactory::getBean('AOW_Conditions');
				 $query = " aow_conditions.field = 'type' AND  aow_conditions.value='Car_Accident' ";
				 $conditions_workflows = $bean->get_full_list('',$query);	
				 // print_r($conditions_workflows) ;die;
				   $stream_html .='<head>
	   <style>
/* Popup container - can be anything you want */
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* The actual popup */
.popup .popuptext {
  visibility: hidden;
  width: 160px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
</style>
	<script type="text/javascript" src="custom/modules/Cases/js/edit.js">
	</script>
</head> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	   <div class="container-fluid" style="padding-top:30px;height:400px;overflow-y:scroll;">
	   <table class="table table-striped" id = "case_table" style="width:780px;"  >
	   <tr style="background-color:#D3D3D3;">
		  <th style="width:50%">Workflows </th>
		  <th style="width:30%; style="text-align:center;">Actions </th>
		  <th style="width:5%">Description </th>
		  <th style="width:15%"> </th>
		  </tr>';
	   if (!empty($conditions_workflows))
	   {
	   	 $arr = array();
	       foreach ($conditions_workflows as $rows) 
	       {
         //    $arr[] = $rows->aow_workflow_id;
         //  }	
         //    $get_ids = array_unique($arr);   
         //   foreach($get_ids as $get_id)
		     // {
		     	$sql = "SELECT * FROM aow_processed where aow_processed.status='Complete' AND aow_processed.aow_workflow_id = '{$rows->aow_workflow_id}' AND aow_processed.parent_id = '{$case_id}'";
				 	$result = $db->query($sql);
				 	$row2 = $db->fetchByAssoc($result);
		    	  if (!empty($rows->aow_workflow_id) && empty($row2['id'])) 
		         {	
		         	$get_id=$rows->aow_workflow_id;
		         	// echo $get_id;die;
                 $workflow_related = BeanFactory::getBean('AOW_WorkFlow', $get_id);
                 if($workflow_related->flow_module='Cases')
  	             {
							   $workflow_related->status='Inactive';
							   $workflow_related->save();

							   $id_workflow=$workflow_related->id;
							   	$name_workflow=$workflow_related->name;
							   	$description_workflow=$workflow_related->description;
						 $bean = BeanFactory::getBean('AOW_Actions');
					   $query_2 = " aow_actions.aow_workflow_id = '$get_id'";
					   $actions_workflow = $bean->get_full_list('',$query_2);	
					   // echo $actions_workflow;die;
	 // foreach($actions_workflow as $actions )
	// 	     {
  
$stream_html .='
		  
		 <tr>
		 <td>
		 <input name="age_check" id="age_check" type="hidden" value="ok">
		 <input type="checkbox" id="workflow_related" name="workflow_related" value="'.$id_workflow.'" style="padding-bottom:22px;">
			 <label for="workflow_related" style="font-size:14px; padding-left:5px;"> '.$name_workflow.'</label></td><td style="text-align:center;width:330px;"><ol>';
			 foreach($actions_workflow as $actions )
		     {
			 $stream_html .='
			  <li style="font-size:12px; padding-left:20px;"><b> '.$actions->name.'</li>';
			}

			  $stream_html .='</ol></td><td><div class="popup" onclick="ShowDescription(\''.$description_workflow.'\')" style="color:#edd03d;"><i  class="fa fa-info-circle" style="font-size:14px;" ></i>
</div> 
	</p>
			 ';
			
		 $stream_html .=' </td>
		 <td style="width:20%">
			 
			 <a href="index.php?module=AOW_WorkFlow&action=DetailView&record='.$id_workflow.'" target="_blank" style="color:#edd03d;"><i  class="fa fa-eye" style="font-size:14px; " ></i></a>
			 				&nbsp; | &nbsp;
			 <a href="index.php?module=AOW_WorkFlow&action=EditView&record='.$id_workflow.'" target="_blank" style="color:#edd03d;"><i  class="fa fa-edit" style="font-size:14px;" ></i></a>
			</td>
			</tr>';
		          // }
		          }
            }
    }

$stream_html .='</table><input title="Activate" accesskey="a" class="button primary" onclick="CheckedAllWorkflows();" type="submit" name="button" value="Activate" id="SAVE" style="float:right; border-radius:20px; "><input title="Cancel"  class="button primary" onclick="save_form();" type="button" name="cancel_workflow" value="Cancel" id="Cancel" style="float:right; border-radius:20px; margin-top:0px;""></div>
';

echo $stream_html;
// echo "true";

die;

}
else {

	echo 'false';
 die;
}
}