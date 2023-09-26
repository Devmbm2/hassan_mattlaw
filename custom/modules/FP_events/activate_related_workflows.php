<?php 		
	     $workflow_ids=array();
	     $workflow_ids= $_REQUEST['get_ids'];
	     $workflow_arr = explode (",", $workflow_ids);
	 if($workflow_ids!=""){
	foreach ($workflow_arr as $id) {
	   $workflow_related = BeanFactory::getBean('AOW_WorkFlow', $id);
	   $workflow_related->status='Active';
   	   $workflow_related->save();
	
	      }
$stream_html .='<div><p style="padding:30px;">Selected Workflows is activated successfully</p></div>';
 }
 else{
 $stream_html .='<div><p style="padding:30px;">Please select a Workflow for activation</p></div>';	
 }
echo $stream_html;
      die;



