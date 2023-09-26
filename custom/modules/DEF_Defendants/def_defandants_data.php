<?php

global $db;
$bean = BeanFactory::getBean('DEF_Defendants', 'c33c81c6-a009-f178-470d-5d134a6884ab');
        if (!empty($bean->acase_id)) {
				$caseid = $bean->acase_id; 
			}
			echo $caseid;echo '<hr>';
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
			echo $sum;echo '<hr>';
			echo $parent_bean->id;die;
			$parent_bean->total_insurance_available_c = $sum;
		   $parent_bean->total_recovered_c = $sum_rec;
		   $parent_bean->save();
			return true;
        }