<?php
   if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
   class clone_name {
      function before_save($bean, $event, $arguments) {
		$bean->document_name = $bean->type . ' _ '. $bean->q_a . ' _ '. $bean->sent_received .' _ '. $bean->to_from;
		/* echo $bean->name;die; */
      } 
	  
   }
?>      
