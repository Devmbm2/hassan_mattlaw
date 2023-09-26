<?php
  
class OrgLocation {
   function orglocation_method(&$bean, $event, $arguments) {
      global $db, $sugar_config, $current_user;
      $duration = $bean->duration;
      $H = floor($duration / 3600);
      $i = ($duration / 60) % 60;
      $bean->duration_list = $H.'h '.$i.'m';
      if ($bean->parent_type == "Accounts") {
		$query = "SELECT billing_address_street FROM accounts WHERE id = '".$bean->parent_id."'"; 
		$result = $db->query($query,true);
		$row = $db->fetchByAssoc($result);
		$location = $row['billing_address_street'];
		$bean->location_address_c = $location;
      }
   }
}
?>
