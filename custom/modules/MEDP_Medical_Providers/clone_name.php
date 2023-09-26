<?php
   if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
   class clone_name {
      function before_save($bean, $event, $arguments) {
		$bean->name = $bean->type . '-'. $bean->medical_facility .'_'. $bean->medical_doctor;
      }
   }
?>      
