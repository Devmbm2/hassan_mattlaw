<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');  

class fill_contact_age_value
{

 function get_contact_age($bean, $event, $arguments)
 {

  // Fetch the related Contact object
  $contact_object_id = $bean->contact_id2_c;
  $contact_object = new Contact();
  $contact_object->retrieve($contact_object_id);

  // Bring the Contacts Fields into Complaints
  $bean->injured_person_age_c = $contact_object->age_c;
  //$GLOBALS['log']->fatal($contact_object->age_c);
 }

}

?>
