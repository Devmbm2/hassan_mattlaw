<?php
class ht_sms_class{
	function sms_update_name($bean, $event, $arguments){
	  global $db, $app_list_strings;
	  if(isset($bean->sent_received) && !empty($bean->sent_received) && $bean->sent_received == 'Incoming'){

			$bean->name = "Inbound SMS From {$bean->parent_name} ({$bean->from_number})";
			
	  }else if(isset($bean->sent_received) && !empty($bean->sent_received) && $bean->sent_received == 'Outgoing'){
			$bean->name = "Outgoing SMS From {$bean->assigned_user_name} ({$bean->from_number})";
	  } 
	  
	}
}