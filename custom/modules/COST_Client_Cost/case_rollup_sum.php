<?php
   if (!defined('sugarEntry') || !sugarEntry) {die('Not A Valid Entry Point');}
   class rollup_sum {
     function save_record(&$bean, $event, $arguments) {
        //Get relate Case ID
        if ($bean->load_relationship('cost_client_cost_cases')) {
            $relatedBeans = $bean->cost_client_cost_cases->getBeans();
            if (is_array($relatedBeans) && !empty($relatedBeans)) {
                foreach ($relatedBeans as $relatedBean) {
                    $caseid = $relatedBean->id;
                }
            }
        }
        //Get all relate record of Cases
        if (!empty($caseid)){
        $bean = BeanFactory::getBean('Cases', $caseid);
        if ($bean->load_relationship('cost_client_cost_cases')) {
            $costs = $bean->cost_client_cost_cases->getBeans();
            if (is_array($costs) && !empty($costs)) {
                $sum = 0;
                foreach ($costs as $cost) {
                    $sum += $cost->total_amount;
                }
            }
        }
        $relatedBean->total_costs_c = $sum;
        $relatedBean->save();
        return true;
        }
    }
    function delete_record(&$bean, $event, $arguments) {
        $cost_amount = $bean->total_amount;
        if ($bean->load_relationship('cost_client_cost_cases')) {
            $relatedBeans = $bean->cost_client_cost_cases->getBeans();
            if (is_array($relatedBeans) && !empty($relatedBeans)) {
                foreach ($relatedBeans as $relatedBean) {
                    $caseid = $relatedBean->id;
                }
            }
        }
        if (!empty($caseid)) {
        //Get all relate record of Cases
        $bean = BeanFactory::getBean('Cases', $caseid);
        if ($bean->load_relationship('cost_client_cost_cases')) {
            $costs = $bean->cost_client_cost_cases->getBeans();
            if (is_array($costs) && !empty($costs)) {
                $sum = 0;
                foreach ($costs as $cost) {
                    $sum += $cost->total_amount;
                }
            }
        }
        $relatedBean->total_costs_c = $sum - $cost_amount;
        $relatedBean->save();
        return true;
        }
    }
}

?>
