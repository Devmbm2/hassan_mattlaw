<?php
   if (!defined('sugarEntry') || !sugarEntry) {die('Not A Valid Entry Point');}
   class owed_rollup_sum {
     function owed_save_record(&$bean, $event, $arguments) {
        //Get relate Contact ID
        if ($bean->load_relationship('lien_liens_lops_contacts')) {
            $relContacts = $bean->lien_liens_lops_contacts->getBeans();
            if (is_array($relContacts) && !empty($relContacts)) {
                foreach ($relContacts as $relContact) {
                    $contactid = $relContact->id;
                }
            }
        }
        //Get all relate record of Contacts
        if (!empty($contactid)){
        $bean = BeanFactory::getBean('Contacts', $contactid);
        if ($bean->load_relationship('lien_liens_lops_contacts')) {
            $oweds = $bean->lien_liens_lops_contacts->getBeans();
            if (is_array($oweds) && !empty($oweds)) {
                foreach ($oweds as $owed) {
                    $sum_owed += $owed->total_owed;
                }
            }
        }
        $relContact->total_lops_liens_c = $sum_owed;
        $relContact->save();
        return true;
        }
    }
    function owed_delete_record(&$bean, $event, $arguments) {
        $owed = $bean->total_owed;
        if ($bean->load_relationship('lien_liens_lops_contacts')) {
            $relContacts = $bean->lien_liens_lops_contacts->getBeans();
            if (is_array($relContacts) && !empty($relContacts)) {
                foreach ($relContacts as $relContact) {
                    $contactid = $relContact->id;
                }
            }
        }
        if (!empty($contactid)) {
        //Get all relate record of Cases
        $bean = BeanFactory::getBean('Contacts', $contactid);
        if ($bean->load_relationship('lien_liens_lops_contacts')) {
            $oweds = $bean->lien_liens_lops_contacts->getBeans();
            if (is_array($oweds) && !empty($oweds)) {
                foreach ($oweds as $owed) {
                    $sum_owed += $owed->total_owed;
                }
            }
        }
        $relContact->total_lops_liens_c = $sum_owed - $owed;
        $relContact->save();
        return true;
        }
    }
}

?>
