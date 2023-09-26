<?php
   if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
   class countrycode_concatenation {
      function countrycode_phone($bean, $event, $arguments){
		  global $db;

		  $bean->country_code_phone=($bean->countrycode_ht).($bean->phone_mobile);
		  $GLOBALS['log']->fatal("country_code_phone");

      }

   }
   
