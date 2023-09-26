<?php
   if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
   class DHA_AllDocumentTemplatesContactsHook_class {
      function after_ui_frame_method_all($event, $arguments) {
         require_once('modules/DHA_AllDocuments/UI_Hooks.php');
         MailMergeReports_after_ui_frame_hook ($event, $arguments);
      }
   }
?>      
