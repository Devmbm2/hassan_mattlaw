<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class date_range{
	
	function specific_date_range($bean, $event, $arguments){
		/* print"<pre>";print_r($bean);die; */
		global $app_list_strings;
		$bean->date_range_requested_c = $app_list_strings['date_range_med_rec_requested_list'][$bean->range_of_records_requested_c]." ".$bean->date_range_start ." - ".$bean->date_range_end;
	}
}
