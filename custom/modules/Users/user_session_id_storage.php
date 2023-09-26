<?php
class user_session_id_storage{ 
   function addUserSessionID($bean, $event, $arguments){
      session_start();
      session_regenerate_id();
      $user_session_id = session_id();
      $user = BeanFactory::getBean('Users',$bean->id);
      $user->user_session_id = $user_session_id;
      $user->save();
      $_SESSION['user_id'] = $user->id;
      // echo $_SESSION['user_id'];die;
      $_SESSION['user_session_id'] = $user_session_id;
      // print_r($user_session_id);
      // die();
       }
}
?>

