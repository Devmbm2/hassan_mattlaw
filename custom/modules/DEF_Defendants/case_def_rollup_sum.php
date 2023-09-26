<?php
   if (!defined('sugarEntry') || !sugarEntry) {die('Not A Valid Entry Point');}
   class def_rollup_sum {
	   
	   function create_def_save_record(&$bean, $event, $arguments) {
        //Get relate Case ID
        if (!empty($bean->acase_id)) {
            $caseid = $bean->acase_id;
               
        }
		
        //Get all relate record of Cases
        if (!empty($caseid)){
        $parent_bean = BeanFactory::getBean('Cases', $caseid);
        if ($parent_bean->load_relationship('def_defendants_cases')) {
            $policys = $parent_bean->def_defendants_cases->getBeans();
            if (is_array($policys) && !empty($policys)) {
                foreach ($policys as $policy) {
                    $sum += $policy->policy_limits;
					$sum_rec += $policy->amount_recovered_c;
                }
            }
        }
		/* echo  $sum;die; */
        $parent_bean->total_insurance_available_c = $sum;
	   $parent_bean->total_recovered_c = $sum_rec;
       $parent_bean->save();
        return true;
        }
    }
     function def_save_record(&$bean, $event, $arguments) {
        //Get relate Case ID
           if (!empty($bean->acase_id)) {
				$caseid = $bean->acase_id; 
			}
		//Get all relate record of Cases
        if (!empty($caseid)){
			$parent_bean = BeanFactory::getBean('Cases', $caseid);
			if ($parent_bean->load_relationship('def_defendants_cases')) {
				$policys = $parent_bean->def_defendants_cases->getBeans();
				if (is_array($policys) && !empty($policys)) {
					foreach ($policys as $policy) {
						$sum += $policy->policy_limits;
						$sum_rec += $policy->amount_recovered_c;
					}
				}
        }
			$parent_bean->total_insurance_available_c = $sum;
		   $parent_bean->total_recovered_c = $sum_rec;
		   $parent_bean->save();
			return true;
        }
    }
    function def_delete_record(&$bean, $event, $arguments) {
        $policy_lts = $bean->policy_limits;
		$amount_rec = $bean->amount_recovered_c;
       if (!empty($bean->acase_id)) {
			$caseid = $bean->acase_id; 
		}
        if (!empty($caseid)) {
        //Get all relate record of Cases
        $parent_bean = BeanFactory::getBean('Cases', $caseid);
        if ($parent_bean->load_relationship('def_defendants_cases')) {
            $policys = $parent_bean->def_defendants_cases->getBeans();
            if (is_array($policys) && !empty($policys)) {
                foreach ($policys as $policy) {
                    $sum += $policy->policy_limits;
					$sum_rec += $policy->amount_recovered_c;
                }
            }
        }
        $parent_bean->total_insurance_available_c = $sum - $policy_lts;
        $parent_bean->total_recovered_c = $sum - $amount_rec;
        $parent_bean->save();
        return true;
        }
    }
}

?>
