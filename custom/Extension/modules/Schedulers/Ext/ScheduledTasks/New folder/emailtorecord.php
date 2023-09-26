<?php 
 //WARNING: The contents of this file are auto-generated

$job_strings[] = 'emailtorecord';
function emailtorecord()
{  
    global $db;
    $obj=new SugarBean();
     $query = "SELECT * FROM config WHERE category='email_config'";
        $result = $db->query($query);
        while($row = $db->fetchByAssoc($result)) 
            {
                $config_email = $row['name'];
                $config_password=$obj->decrypt_after_retrieve($row['value']);
            }
            if(!empty($config_email) && !empty($config_password)){
                $connection = imap_open('{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX', $config_email,  $config_password) or die('Cannot connect to Gmail: ' . imap_last_error());
            }
        if($connection){
                $emailData = imap_search($connection, 'SUBJECT "Captured Call: "');
    global $sugar_config, $audit_details, $db; 
       $get_mapping_q= "SELECT * FROM  ht_emailextract ";
          $result_map=$db->query($get_mapping_q);  
    while ($bean = mysqli_fetch_array($result_map))
    {
          if (! empty($emailData)) {
                foreach ($emailData as $emailIdent) {
                $headers = imap_header($connection, $emailIdent);
                // $body = imap_body($connection, $emailIdent);
                // print_r("<pre>");
                // print_r($body);
                $overview = imap_fetch_overview($connection, $emailIdent, 0);
                $message = imap_fetchbody($connection, $emailIdent, 1);
                // $messageExcerpt = substr($message, 0, 150);
                $messageExcerpt = $message;
                $partialMessage = trim(quoted_printable_decode($messageExcerpt)); 
                // $partialMessage = $messageExcerpt; 
                // print_r("<pre>");
                // print_r($messageExcerpt);
                $date = date("d F, Y", strtotime($overview[0]->date));
                $from_email = $bean['from_email'];
                $sync_email = $headers->from[0]->mailbox."@".$headers->from[0]->host;
                $active_status = $bean['is_active'];
                $duplicate_c_q="SELECT * FROM leads WHERE u_id = '{$emailIdent}' AND deleted = 0";
                $result_d=$db->query($duplicate_c_q);
                $row_d=mysqli_fetch_array($result_d);
                    if(!empty($row_d))
                    {
                        $check_duplication=1;
                    }else{
                        $check_duplication=0;
                    }
                if($from_email == $sync_email && $active_status == 1 && $check_duplication == 0){
                    $lead_bean = BeanFactory::newBean('Leads');
                    $lead_test = preg_replace( "/\n\s+/", "\n", rtrim(strip_tags($partialMessage)) );
                    preg_match('/Full Name(.*s?)\nDate & Time(.*s?)\nPhone(.*s?)\nLocation(.*s?)\nCaller ID(.*s?)\nCaseType(.*s?)\nCall Transfer Attempted(.*s?)/', $lead_test, $m);
                    if($m)
                        {
                            $name = $m[1].PHP_EOL;
                            $date = $m[2].PHP_EOL;
                            $phone = $m[3].PHP_EOL;
                            $location = $m[4].PHP_EOL;
                            $call_id = $m[5].PHP_EOL;
                            $case_type = $m[6].PHP_EOL;
                            $call_transfer = $m[7].PHP_EOL;
                            // $lead_bean->first_name = $name;
                            $lead_bean->last_name = $name;
                            $lead_bean->phone_mobile = $phone;
                            $lead_bean->primary_address_street = $location;
                            $lead_bean->case_description_c = $m[0];
                            $lead_bean->liability_description_c = $m[0];
                            $lead_bean->damages_description_c = $m[0];
                            $lead_bean->case_type_c= $case_type;
                        }
                    
                    $lead_bean->email1 = $sync_email;
                    $lead_bean->u_id = $emailIdent;
                    $lead_bean->leadrank_c = '5';
                    $lead_bean->description_html = $partialMessage;
                    $lead_bean->lead_source = 'Answering_Service';
                    // $lead_bean->assigned_user_id = '1';  
                    $lead_bean->assigned_user_id = 'e4cd5835-f692-69de-3b3a-591598674c54';  
                    $lead_bean->save();
                }
        } 
 }
}
 imap_close($connection);
    return true;
            }
    
}


?>