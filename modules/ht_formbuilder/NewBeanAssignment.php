<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
class NewBeanAssignment
     {
         function assignBeanID($bean, $event, $arguments)
         {
			 if ($bean->fetched_row['id']==NULL)
			 { 
				 $bean->id =  $_POST["ruuid"];
				 $bean->save();
				header("Location:index.php?module=ht_formbuilder&action=DetailView&record={$bean->id}&offset=1");
			 }	 
		 }	 
	 }