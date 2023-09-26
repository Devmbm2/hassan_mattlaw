<?php

class NameConcat {
    function concatName($bean, $event, $arguments){
		global $timedate;
		if (!empty($bean->date_requested)) {
			$date_requested = $timedate->to_display_date($bean->date_requested, false);
		}elseif (empty($bean->fetched_row)){
			$date_requested = $timedate->nowDate();
		}else{
			$date_requested = $timedate->to_display_date($bean->fetched_row['date_entered'], false);
		}
		//Load Medical Bill
		if ($bean->load_relationship('mreq_medb_requests_medb_medical_bills')) {
			$medbBeans = $bean->mreq_medb_requests_medb_medical_bills->getBeans();
			if (!empty($medbBeans)) {
				foreach ($medbBeans as $medbBean) {
					$medical_provider = $medbBean->medical_provider;
				}
				$name = $date_requested." - ".$medical_provider;
			}
		}
		$bean->document_name = $name;
	}
}

