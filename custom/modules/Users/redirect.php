<?php
class redirect{ 
   function go_url(&$bean, $event, $arguments){
       global $current_user;
       if($current_user->user_name == 'Laura'){
		SugarApplication::redirect("index.php?module=Leads&action=index");
       }
   }
}
?>

