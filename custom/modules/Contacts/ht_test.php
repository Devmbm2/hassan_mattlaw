<?php
  //date in mm/dd/yyyy format; or it can be in other formats as well
/*   $birthDate = "12/17/1983";
  //explode the date to get month, day and year
  $birthDate = explode("/", $birthDate);
  //get age from date or birthdate
  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));
  echo "Age is:" . $age;
   */
  
 global $app_list_strings;
 
 /* print"<pre>";print_r($app_list_strings['confidential_info_score']);die; */
?>