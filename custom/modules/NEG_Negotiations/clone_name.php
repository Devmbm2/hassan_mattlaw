<?php
   if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
   class clone_name {
      function before_save($bean, $event, $arguments) {
	global $app_list_strings;
	$bean->document_name = $bean->initial_counter . ' '. $app_list_strings['neg_type_list'][$bean->type] . ' '. $app_list_strings['sent_received_list'][$bean->sent_rec] .' '. $bean->insurance_company .' $'.number_format($bean->amount,'2');
		/* echo $bean->name;die; */
      } 
	  
   }
?>      
