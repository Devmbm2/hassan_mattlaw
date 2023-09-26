<?php
   if (!defined('sugarEntry') || !sugarEntry) {die('Not A Valid Entry Point');}
   class balance_rollup_sum {
     function balance_save_record(&$bean, $event, $arguments) {
	$bean->balance = $bean->total_charges - $bean->write_offs_c - $bean->pip_paid - $bean->medicare_paid - $bean->medicaid_paid - $bean->health_insurance_paid - $bean->copy_charges - $bean->adjustments - $bean->client_paid -$bean->reduction_amount - $bean->workers_comp_paid + $bean->interest_c;
        //Get relate Contact ID
        if ($bean->load_relationship('medb_medical_bills_contacts')) {
            $relatedContacts = $bean->medb_medical_bills_contacts->getBeans();
            if (is_array($relatedContacts) && !empty($relatedContacts)) {
                foreach ($relatedContacts as $relatedContact) {
                    $contactid = $relatedContact->id;
                }
            }
        }
        //Get all relate record of Contacts
        if (!empty($contactid)){
        $bean = BeanFactory::getBean('Contacts', $contactid);
        if ($bean->load_relationship('medb_medical_bills_contacts')) {
            $balances = $bean->medb_medical_bills_contacts->getBeans();
            if (is_array($balances) && !empty($balances)) {
                foreach ($balances as $balance) {
                    $sum_balance += $balance->balance;
                }
            }
        }
        $relatedContact->total_medical_bills_c = $sum_balance;
        $relatedContact->save();
        return true;
        }
    }
    function balance_delete_record(&$bean, $event, $arguments) {
        $balance = $bean->balance;
        if ($bean->load_relationship('medb_medical_bills_contacts')) {
            $relatedContacts = $bean->medb_medical_bills_contacts->getBeans();
            if (is_array($relatedContacts) && !empty($relatedContacts)) {
                foreach ($relatedContacts as $relatedContact) {
                    $contactid = $relatedContact->id;
                }
            }
        }
        if (!empty($contactid)) {
        //Get all relate record of Cases
        $bean = BeanFactory::getBean('Contacts', $contactid);
        if ($bean->load_relationship('medb_medical_bills_contacts')) {
            $balances = $bean->medb_medical_bills_contacts->getBeans();
            if (is_array($balances) && !empty($balances)) {
                foreach ($balances as $balance) {
                    $sum_balance += $balance->balance;
                }
            }
        }
        $relatedContact->total_medical_bills_c = $sum_balance - $balance;
        $relatedContact->save();
        return true;
        }
    }
}

?>
