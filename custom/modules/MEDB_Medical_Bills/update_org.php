<?php

class UpdateOrgContact {
	function copyContactOrg($bean, $event, $arguments)
	{
	$org_name = $bean->medical_provider;
	$org_id = $bean->account_id_c;
	if ($bean->load_relationship('medb_medical_bills_contacts')) {
            $relatedContacts = $bean->medb_medical_bills_contacts->getBeans();
            if (is_array($relatedContacts) && !empty($relatedContacts)) {
                foreach ($relatedContacts as $relatedContact) {
                    $contactid = $relatedContact->id;
                }
            }
        }
 
		// $name = $bean->medical_provider ." - ". $bean->medb_medical_bills_contacts_name;
		// $bean->document_name = $name;
	}
}

