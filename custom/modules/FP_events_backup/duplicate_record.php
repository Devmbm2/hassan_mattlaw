<?php
  
class duplicate {
   function after_save($bean, $event, $arguments) {
      if ($bean->cancelled_reset_c == "Reset") {
        // SugarApplication::appendErrorMessage('End Date must be after Start Date');
        $queryParams = array(
                'module' => 'FP_events',
                'action' => 'EditView',
                'record' => $bean->id,
            );
            SugarApplication::redirect('index.php?' . http_build_query($queryParams));
      }
   }
}

