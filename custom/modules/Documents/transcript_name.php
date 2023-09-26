<?php
   if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
   class transcript_name {
      function concat_name($bean, $event, $arguments) {
        global $app_list_strings;
	if ($bean->subcategory_id == "Transcripts_Statements") {
	   //$contact_id = $bean->contacts_documents_1contacts_ida;
	   if ($bean->load_relationship('contacts_documents_1')) {
               $contactBeans = $bean->contacts_documents_1->getBeans();
	       if (!empty($contactBeans)) {
                foreach ($contactBeans as $deponent) {
                    $lastname = $deponent->last_name;
                    $firstname = $deponent->first_name;
                }
           }


  	   //$deponent = new Contact();
	   //$deponent->retrieve($contact_id);
	   //$GLOBALS['log']->fatal($contact_id);
	   //$deponent = BeanFactory::getBean('Contacts', $contact_id);
           //$bean->document_name = $deponent->last_name . ' '. $deponent->first_name . ' '.$bean->date_of_document_c.' '. $app_list_strings['format_list'][$bean->format_c];
           $bean->document_name = $lastname . ', '. $firstname . ' '.$bean->date_of_document_c.' '. $app_list_strings['format_list'][$bean->format_c];
	   }
	}
      }

   }
?>

