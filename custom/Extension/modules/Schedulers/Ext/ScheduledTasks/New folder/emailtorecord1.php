<?php 
 //WARNING: The contents of this file are auto-generated

$job_strings[] = 'emailtorecord';
function emailtorecord()
{  
    global $sugar_config, $audit_details, $db; 
       $get_mapping_q= "SELECT * FROM  ht_emailextract ";
          $result_map=$db->query($get_mapping_q);  
    while ($bean = mysqli_fetch_array($result_map))
    {
            $user_email=$bean['from_email'];
        if($bean['NoOfDaysForEmailExtraction']!='AllTheTime'){
          $get_date = date ( 'Y-m-d', strToTime ( "-".$bean['NoOfDaysForEmailExtraction']." days" ) );
                $dateCondition="emails.date_entered > '".$get_date."' AND";
            }else{
                $dateCondition="";
            }
             $only_sync_status=$bean['only_sync_status'];
            if($only_sync_status!=''){
                $statusCondition=" emails.status = '".$only_sync_status."' AND ";
            }else{
                $statusCondition="";
            }
      $query_11= "SELECT * FROM `emails` WHERE ".$dateCondition."  ".$dateCondition." emails.deleted=0 ";

          $result_1=$db->query($query_11);

    while ($row1 = mysqli_fetch_array($result_1))
    {

                 $get_uid=$row1['uid'];
           $email_id=$row1['id'];
        $query_2="SELECT * FROM `emails_text` WHERE emails_text.email_id='".$email_id."' " ;
        $result_2=$db->query($query_2);

                while ($row2 = mysqli_fetch_array($result_2))
                {       

                    $allrecords=new Email();
                    $email_from_addr=$allrecords->retrieve($email_id)->from_addr;
                    if($email_from_addr!=""  && $email_from_addr==$user_email)
                     {      
                        $module_name=$bean['convert_to_module'];
                        $sender_name=$row2['from_addr'];
                        $sender_email=$email_from_addr;
                        $body=$row2['description'];
                        $subject=$row1['name'];
                        $date=$row1['date_entered'];
                     /// convert body to plain text////   
                            $str = str_replace('&nbsp;', ' ', $body);
                            $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
                            $str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
                            $str = html_entity_decode($str);
                            $str = htmlspecialchars_decode($str);
                            $str = strip_tags($str , " ");
                            $body=$str;
                        $create_bean = BeanFactory::newBean($module_name);
                        $get_table_name= strtolower($module_name);
                        $decodedText = html_entity_decode($bean['fieldForJsonData']);

                        $Object = json_decode($decodedText);
                        // print_r($Object);
                        foreach ($Object as $fields=>$value)
                        {
                            //dubliation check


                            $duplicate_c_q="SELECT * FROM ".$get_table_name."  WHERE
                            u_id =".$get_uid." ";

                                $result_d=$db->query($duplicate_c_q);
                                $row_d=mysqli_fetch_array($result_d);

                                        if(!empty($row_d))
                                        {
                                            $check_duplication=1;
                                        }else{
                                            $check_duplication=0;
                                        }



                                        //// map fields with  values ////
                                        $create_bean->u_id= $get_uid;
                                        if($value=='subject')
                                        {
                                        $create_bean->$fields= $subject;
                                        }
                                        else if($value=='sender_name')
                                        {
                                        $create_bean->$fields= $sender_name;
                                        }
                                        else if($value=='date')
                                        {
                                        $create_bean->$fields= $date;
                                        }
                                        else if($value=='sender_email')
                                        {
                                        $create_bean->$fields= $sender_email;
                                        }
                                        else if($value=='body')
                                        {

                                            $create_bean->$fields=$body;
                                        }

                                        if($fields=='email_address')
                                        {
                                            $email_field_check=1;
                                        }

                        }
                

           if($check_duplication==0)
           {
              $create_bean->save();

                if ($email_field_check==1) 
                {
                        $created_bean_id=$create_bean->id; 
                        $email_record_q="SELECT id FROM email_addresses WHERE email_address='".$sender_email."' ";
                        $result_email=$db->query($email_record_q);
                        $row_email=mysqli_fetch_array($result_email);
                        $email_addr_id=$row_email['id'];
                        $newID = create_guid();
                        $insert_email_q="INSERT INTO email_addr_bean_rel(id, email_address_id, bean_id, bean_module) VALUES ('".$newID."','".$email_addr_id."','".$created_bean_id."','".$module_name."')";
                     $db->query($insert_email_q); 
                  } 
              

           }
        }
    
        
    }
}


 }
    return true;
}


?>