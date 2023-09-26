<?php
  
class duplicate {
   function after_save($bean, $event, $arguments) {
	    /* print"<pre>";print_r($bean->fetched_row);die; */
	    if (!empty($bean->fetched_row['id'])) {
		    if($bean->cancelled_reset_c == "Reset") {
				$GLOBALS['db']->query("UPDATE fp_events_cstm SET cancelled_reset_c = 'Cancelled' WHERE id_c = '{$bean->id}'");
				$id = create_guid();
				$new_event = BeanFactory::getBean('FP_events', $bean->id);
				$new_event->id = $id;
				$new_event->processed = true;
				$new_event->new_with_id = true;
				$new_event->cancelled_reset_c = ' ';
				$new_event->save();
				$queryParams = array(
					'module' => 'FP_events',
					'action' => 'EditView',
					'record' => $id,
					'redirect' => $_REQUEST['redirect'],
				);
				echo "string";
				die();
				SugarApplication::redirect('index.php?' . http_build_query($queryParams));
			}
	   }
   }
}

