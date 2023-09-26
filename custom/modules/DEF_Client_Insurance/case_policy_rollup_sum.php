<?php
   if (!defined('sugarEntry') || !sugarEntry) {die('Not A Valid Entry Point');}
   class cliins_policy_rollup_sum {
     function create_cliins_policy_save_record(&$bean, $event, $arguments) {
        //Get relate Case ID
		/* echo $bean->def_client_insurance_cases_1cases_ida;die; */
		 if (!empty($bean->def_client_insurance_cases_1cases_ida)) {
            $caseid = $bean->def_client_insurance_cases_1cases_ida;
               
        }
        //Get all relate record of Cases
        if (!empty($caseid)){
        $parent_bean = BeanFactory::getBean('Cases', $caseid);
        if ($parent_bean->load_relationship('def_client_insurance_cases_1')) {
            $pol_lmts = $parent_bean->def_client_insurance_cases_1->getBeans();
            if (is_array($pol_lmts) && !empty($pol_lmts)) {
                foreach ($pol_lmts as $pol_lmt) {
		    /* if ($pol_lmt->type !== "PIP" && $pol_lmt->type !== "Med_Pay") { */
                    $sum_pol += $pol_lmt->policy_limits;
		    /* } */
                }
            }
        }
        $parent_bean->total_um_available_c = $sum_pol;
        $parent_bean->save();
        return true;
		}
	}

	function cliins_policy_save_record(&$bean, $event, $arguments) {
        //Get relate Case ID
        if ($bean->load_relationship('def_client_insurance_cases_1')) {
            $clientcases = $bean->def_client_insurance_cases_1->getBeans();
            if (is_array($clientcases) && !empty($clientcases)) {
                foreach ($clientcases as $clientcase) {
                    $caseid = $clientcase->id;
                }
            }
        }
        //Get all relate record of Cases
        if (!empty($caseid)){
        $bean = BeanFactory::getBean('Cases', $caseid);
        if ($bean->load_relationship('def_client_insurance_cases_1')) {
            $pol_lmts = $bean->def_client_insurance_cases_1->getBeans();
            if (is_array($pol_lmts) && !empty($pol_lmts)) {
                foreach ($pol_lmts as $pol_lmt) {
		    if ($pol_lmt->type !== "PIP" && $pol_lmt->type !== "Med_Pay") {
                    $sum_pol += $pol_lmt->policy_limits;
		    }
                }
            }
        }
        $clientcase->total_um_available_c = $sum_pol;
        $clientcase->save();
        return true;
        }
    }
    function cliins_policy_delete_record(&$bean, $event, $arguments) {
        $ins_policy_limits = $bean->policy_limits;
        if ($bean->load_relationship('def_client_insurance_cases_1')) {
            $caseBeans = $bean->def_client_insurance_cases_1->getBeans();
            if (is_array($caseBeans) && !empty($caseBeans)) {
                foreach ($caseBeans as $caseBean) {
                    $caseid = $caseBean->id;
                }
            }
        }
        if (!empty($caseid)) {
        //Get all relate record of Cases
        $bean = BeanFactory::getBean('Cases', $caseid);
        if ($bean->load_relationship('def_client_insurance_cases_1')) {
            $policys = $bean->def_client_insurance_cases_1->getBeans();
            if (is_array($policys) && !empty($policys)) {
                foreach ($policys as $policy) {
		    if ($policy->type !== "PIP" && $policy->type !== "Med_Pay") {
                    $sum_lmt += $policy->policy_limits;
		    }
                }
            }
        }
        $caseBean->total_um_available_c = $sum_lmt - $ins_policy_limits;
        $caseBean->save();
        return true;
        }
    }
}

?>
