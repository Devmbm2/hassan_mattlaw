<?php		

	  	   $stream_html .='<head>
	<script type="text/javascript" src="custom/modules/Alerts/js/edit.js"></script>
	</script>
	<script type="text/javascript" src="cache/include/javascript/sugar_grp_yui_widgets.js"></script>
	</script>
</head> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	   <div class="container-fluid" style="padding-top:30px;">
	   <table class="table table-striped" style="width:700px;"  >
	   <tr style="background-color:#D3D3D3;">
		  <th style="width:50%">Workflows </th>
		  <th style="width:30%; style="text-align:center;">Action name </th>
		  <th style="width:5%">Description </th>
		  <th style="width:15%">Actions</th>
		  </tr>';

                 $workflow_ids=array();
		     $workflow_ids= $_REQUEST['get_ids'];
		     $workflow_arr = explode (",", $workflow_ids);
		 if($workflow_ids!=""){
		foreach ($workflow_arr as $id) {
	$workflow_related = BeanFactory::getBean('AOW_WorkFlow', $id);	
	   	$name_workflow=$workflow_related->name;
	   	$description_workflow=$workflow_related->description;
			$bean_AOW_Actions = BeanFactory::getBean('AOW_Actions');
			$query_2 = " aow_actions.aow_workflow_id = '$id'";
			$actions_workflow = $bean_AOW_Actions->get_full_list('',$query_2);	

foreach($actions_workflow as $actions )
		     {

$stream_html .='
		  
		 <tr>
		 <td>
		 <input type="checkbox" id="workflow_related" name="workflow_related" value="'.$id.'" style="padding-bottom:22px; display:none;"  checked>
			 <label for="workflow_related" style="font-size:14px; padding-left:5px;"> '.$name_workflow.'</label></td>';
			  
			 $stream_html .='<td>
			  <p  style="font-size:12px; padding-left:20px;"><b> '.$actions->name.'</b></td>
			  <td><div class="popup" onclick="ShowDescription();" id="show_descriptions" 
			  title="'.$description_workflow.'"><i  class="fa fa-info-circle" style="font-size:14px;" ></i>
</div> 
	</p>
			 ';
			
		 $stream_html .=' </td>
		 <td style="width:20%">
			 
			 <a href="index.php?module=AOW_WorkFlow&action=DetailView&record='.$id_workflow.'" target="_blank"><i  class="fa fa-eye" style="font-size:14px; " ></i></a>
			 				&nbsp; | &nbsp;
			 <a href="index.php?module=AOW_WorkFlow&action=EditView&record='.$id_workflow.'" target="_blank"><i  class="fa fa-edit" style="font-size:14px;" ></i></a>
			</td>
			</tr>';
		}
		
		 
}
$stream_html .='</table></div>';

echo $stream_html;

die;

}

 else{
 $stream_html .='</table></div><div><p style="padding:30px;">NO workflow selected</p></div>';	
 	echo $stream_html;
      die;
 }