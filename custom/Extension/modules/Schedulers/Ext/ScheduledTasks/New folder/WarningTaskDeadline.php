<?php
 /*
  * We add the method name to the $job_strings array.
  * This is the method that jobs for this scheduler will call.
  */
 $job_strings[] = 'warningTaskDeadline';

 /**
  * Example scheduled job to change any 'Planned' meetings older than a month
  * to 'Not Held'.
  * @return bool
  */
 function warningTaskDeadline(){
    global $sugar_config;
    $url = $sugar_config['site_url'];
    $sql = "select tasks.*,tasks_cstm.* from tasks inner join tasks_cstm on tasks.id=tasks_cstm.id_c where tasks_cstm.type_of_todo_c = 'Deadline_Court'";
        $result = $GLOBALS['db']->query($sql, true);
        while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
            $now = time();
            $your_date = strtotime($row['date_due']);
            $datediff = $now - $your_date;
            $date_check = $datediff;
            $findingNumberOfDays=round($date_check / (60 * 60 * 24));
            if($findingNumberOfDays==10 || $findingNumberOfDays==7 || $findingNumberOfDays==3){
                    $id=$row['id'];
                    $result2 = $GLOBALS['db']->query("SELECT * FROM alerts WHERE id = '$id'");
                    $count = $result2->num_rows; // edited here
                    if ($count > 0){
                        $description="Only ".$findingNumberOfDays." Days left for Court Deadline for Plantiff";
                        $sql2="UPDATE `alerts` SET `description`='$description',`is_read`='0' where id='$id'";
                        $GLOBALS['db']->query($sql2);
                    }else{
                        $name=$row['name'];
                        $description="Only ".$findingNumberOfDays." Days left for Court Deadline for Plantiff";
                        $sql2="INSERT INTO alerts(`id`, `name`,`description`,`assigned_user_id`,`is_read`,`url_redirect`) VALUES ('$id','$name','$description','1','0','{$url}/index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DTasks%26offset%3D2%26stamp%3D1660805517084980900%26return_module%3DTasks%26action%3DDetailView%26record%3D$id')";
                        if ($GLOBALS['db']->query($sql2) === TRUE) {
                            echo "New record created successfully";
                          } else {
                            echo "Error: Data can not be inserted due to some problem <br>" . $conn->error;
                          }
                    }

                }
        }

   
return true;

}