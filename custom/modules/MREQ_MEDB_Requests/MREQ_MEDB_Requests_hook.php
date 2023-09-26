<?php

    if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

    class MREQ_MEDB_Requests_hook
    {
        function related_running_bill_client($bean, $event, $arguments)
        {
            global $db;
			$sql = "SELECT contacts.id, CONCAT_WS(' ', contacts.first_name, contacts.last_name) as name
					FROM mreq_medb_requests_medb_medical_bills_c 
					LEFT JOIN medb_medical_bills ON (medb_medical_bills.id= mreq_medb_requests_medb_medical_bills_c.mreq_medb_requests_medb_medical_billsmedb_medical_bills_ida)
					LEFT JOIN medb_medical_bills_contacts_c ON (medb_medical_bills.id= medb_medical_bills_contacts_c.medb_medical_bills_contactsmedb_medical_bills_idb)
					LEFT JOIN contacts ON (contacts.deleted = 0 AND contacts.id= medb_medical_bills_contacts_c.medb_medical_bills_contactscontacts_ida)
					where mreq_medb_requests_medb_medical_bills_c.deleted = 0 AND mreq_medb_requests_medb_medical_bills_c.mreq_medb_requests_medb_medical_billsmreq_medb_requests_idb= '{$bean->id}'";
			$result = $db->query($sql, true);
			$row = $db->fetchByAssoc($result);
			$client = $row['name'];
			if(isset($row['id']) && !empty($row['id'])){
				if($event == 'before_save'){
					$bean->related_running_bill_client = $client;
				}
				if($event == 'process_record'){
					$bean->related_running_bill_client = "<a style = 'color: black;font-weight: bold;font-size: 13px;'  href='index.php?module=Contacts&action=DetailView&record={$row['id']}' target='_blank'>".$row['name']."</a>";
				}
			}
        }
    }



?>
