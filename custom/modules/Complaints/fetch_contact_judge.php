<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');  

class fetch_contact_field_value
{

 function get_data_from_contacts($bean, $event, $arguments)
 {

  // Fetch the related Contact object
  $contact_object_id = $bean->contact_id_c;
  $contact_object = new Contact();
  $contact_object->retrieve($contact_object_id);

  // Bring the Contacts Fields into Complaints
  $bean->judge_asst_phone_c = $contact_object->assistant_phone;
  $bean->judge_assistant_c = $contact_object->assistant;
  //$bean->judge_web_page_c = $contact_object->judge_web_page_c;
  $bean->judge_asst_email_c = $contact_object->email1;
 }

}

?>
