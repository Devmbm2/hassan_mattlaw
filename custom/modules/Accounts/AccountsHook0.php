<?php
if (!defined('sugarEntry') || !sugarEntry) die ('Not a valid entry point');
class AccountsHook{
    public function saveToContacts($bean, $event, $arguments){
        
         if(!empty($bean->save_contact) && $bean->save_contact == 1){
            // echo $bean->fetched_row["save_contact"];
            // die();
             if($bean->fetched_row["save_contact"] == 0) {
                // echo "here";
                // die();
                 global $db;
                 $id = $bean->id;
                 $accounts_contacts_id = uniqid();
                 $email1 = $bean->email1;
                 $email2 = strtoupper("$email1");
                 $name = $bean->name;
                 $account_type = $bean->account_type;
                 $billing_address_street = $bean->billing_address_street;
                 $billing_address_city = $bean->billing_address_city;
                 $billing_address_state = $bean->billing_address_state;
                 $billing_address_country = $bean->billing_address_country;
                 $billing_address_postalcode = $bean->billing_address_postalcode;
                 $description = $bean->description;
                 $phone_fax = $bean->phone_fax;
                 $phone_office = $bean->phone_office;
                 $date_entered = $bean->date_entered;
                 $date_modified = $bean->date_modified;
                 $modified_user_id = $bean->modified_user_id;
                 $created_by = $bean->created_by;
                 $deleted = $bean->deleted;
                 $assigned_user_id = $bean->assigned_user_id;
                 $campaign_id = $bean->campaign_id;

                 $sql = "INSERT INTO contacts (id, date_entered, date_modified, modified_user_id, created_by, deleted, assigned_user_id, campaign_id, salutation, first_name, last_name, dear_c, phone_mobile, phone_work, phone_fax,primary_address_street,primary_address_city,primary_address_state,primary_address_postalcode,primary_address_country,description)
                    VALUES ('$id', '$date_entered', '$date_modified', '$modified_user_id', '$created_by', '$deleted', '$assigned_user_id', '$campaign_id', 'Honorable', '$name', '$name', '$name', '$phone_office', '$phone_office', '$phone_fax','$billing_address_street','$billing_address_city','$billing_address_state','$billing_address_postalcode','$billing_address_country','$description')";
                 if ($db->query($sql, true)) {
                     $sql1 = "INSERT INTO contacts_cstm (id_c, type_c) VALUES ('$id','$account_type')";
                     $db->query($sql1, true);
                     $sql4 = "INSERT INTO accounts_contacts (id, contact_id, account_id) VALUES ('$accounts_contacts_id','$id','$id')";
                     $db->query($sql4, true);
                 }
                 if (!empty($email1)) {
                     $sql2 = "INSERT INTO email_addr_bean_rel (id, email_address_id,bean_id,bean_module,primary_address,reply_to_address) VALUES ('$id','$id','$id','Contacts',1,0)";
                     if ($db->query($sql2, true)) {
                         $sql3 = "INSERT INTO email_addresses (id,email_address, email_address_caps) VALUES ('$id','$email1','$email2')";
                         $db->query($sql3, true);
                     }
                 }
             }
         }
    }
}