<?php
if (!defined('sugarEntry') || !sugarEntry) die ('Not a valid entry point');
class AccountsHook{
    public function saveToContacts($bean, $event, $arguments){
        global $db;
          if(empty($bean->fetched_row['id'])){
            if($bean->save_contact == 1){
              $this->saveContactBean($bean);  
            }          
          }
          else if(!empty($bean->fetched_row['id']) && $bean->save_contact == 0)
          {
            if(!empty($bean->save_contact_id_c)){
            // $contactBean = BeanFactory::getBean('Contacts',$bean->save_contact_id_c);
            $update = "UPDATE contacts SET deleted = 1 WHERE id = '{$bean->save_contact_id_c}'";
              $GLOBALS['db']->query($update, true);
            }
          }
          else if(!empty($bean->fetched_row['id']) && $bean->save_contact == 1)
          {
            if(empty($bean->save_contact_id_c)){
              $this->saveContactBean($bean);  
            }
            else{
              $contactBean = BeanFactory::getBean('Contacts',$bean->save_contact_id_c);
             $update = "UPDATE contacts SET deleted = 0 WHERE id = '{$bean->save_contact_id_c}'";
              $GLOBALS['db']->query($update, true);
              $bean->load_relationship('contacts');
              $bean->contacts->add($contactBean);
            }
            
          }
    }
    public function saveContactBean($bean){
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

              $contacts_bean = BeanFactory::newBean('Contacts');
              $contacts_bean->date_entered = $date_entered;
              $contacts_bean->date_modified = $date_modified;
              $contacts_bean->modified_user_id = $modified_user_id;
              $contacts_bean->created_by = $created_by;
              $contacts_bean->deleted = $deleted;
              $contacts_bean->assigned_user_id = $assigned_user_id;
              $contacts_bean->campaign_id = $campaign_id;
              $contacts_bean->salutation = 'Honorable';
              $contacts_bean->first_name = $name;
              $contacts_bean->last_name = $name;
              $contacts_bean->dear_c = $name;
              $contacts_bean->phone_mobile = $phone_office;
              $contacts_bean->phone_work = $phone_office;
              $contacts_bean->phone_fax = $phone_fax;
              $contacts_bean->primary_address_street = $billing_address_street;
              $contacts_bean->primary_address_city = $billing_address_city;
              $contacts_bean->primary_address_state = $billing_address_state;
              $contacts_bean->primary_address_postalcode = $billing_address_postalcode;
              $contacts_bean->primary_address_country = $billing_address_country;
              $contacts_bean->description = $description;
              $contacts_bean->id_c = $id;
              $contacts_bean->type_c = $account_type;
              $contacts_bean->save();
              $update = "UPDATE accounts_cstm SET save_contact_id_c = '{$contacts_bean->id}' WHERE id_c = '{$bean->id}'";
              $GLOBALS['db']->query($update, true);
              $bean->load_relationship('contacts');
              $bean->contacts->add($contacts_bean);
    }
}