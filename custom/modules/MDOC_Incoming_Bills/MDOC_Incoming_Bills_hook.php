<?php

    if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    class MDOC_Incoming_Bills_hook
    {
        function related_running_bill_client($bean, $event, $arguments)
	{
            global $db;
	    $sql = "SELECT contacts.id, CONCAT_WS(' ', contacts.first_name, contacts.last_name) as name, document_name as medname, medb_medical_bills.id as medid
		    FROM medb_medical_bills_mdoc_incoming_bills_1_c 
		    LEFT JOIN medb_medical_bills ON (medb_medical_bills.id= medb_medical_bills_mdoc_incoming_bills_1_c.medb_medical_bills_mdoc_incoming_bills_1medb_medical_bills_ida)
		    LEFT JOIN medb_medical_bills_contacts_c ON (medb_medical_bills.id= medb_medical_bills_contacts_c.medb_medical_bills_contactsmedb_medical_bills_idb)
		    LEFT JOIN contacts ON (contacts.deleted = 0 AND contacts.id= medb_medical_bills_contacts_c.medb_medical_bills_contactscontacts_ida)
		    where medb_medical_bills_mdoc_incoming_bills_1_c.deleted = 0 AND medb_medical_bills_mdoc_incoming_bills_1_c.medb_medical_bills_mdoc_incoming_bills_1mdoc_incoming_bills_idb = '{$bean->id}'";
	    $result = $db->query($sql, true);
	    $row = $db->fetchByAssoc($result);
	    if(isset($row['medid']) && !empty($row['medid'])){
		$bean->medb_medical_bills_mdoc_incoming_bills_1_name = "<a href='index.php?module=MEDB_Medical_Bills&action=DetailView&record={$row['medid']}' target='_blank'>".$row['medname']."</a>";
	    }
	}
    }



?>
