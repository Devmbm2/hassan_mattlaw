<?php
global $db;
$workflow_ids= $_REQUEST['checkboxArray'];
foreach ($workflow_ids as $id) {
   $workflow_related = BeanFactory::getBean('AOW_WorkFlow', $id);
   $workflow_related->status='Active';
   $workflow_related->save();
      }
  	die;
?>