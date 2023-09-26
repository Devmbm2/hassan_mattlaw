<?php 		
	     $workflow_ids=array();
	     $workflow_ids= $_REQUEST['get_ids'];
	     if($workflow_ids!="")
	     {
	     $workflow_arr = explode (",", $workflow_ids);
	foreach ($workflow_arr as $id) {
	   $workflow_related = BeanFactory::getBean('AOW_WorkFlow', $id);
	   $workflow_related->status='Active';
   	   $workflow_related->save();
	
	      }
	      	
$stream_html .='<div><p style="padding:30px;">Selected Workflows are activated successfully</p></div>';

echo $stream_html;


      die;
      	}
      	else 
      	{

      	$stream_html .='<div><p style="padding:30px;">No Workflow is Selected </p></div>';
			echo $stream_html;
			 die;
      	}



