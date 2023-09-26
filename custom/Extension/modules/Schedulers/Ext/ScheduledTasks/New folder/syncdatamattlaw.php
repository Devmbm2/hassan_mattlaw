<?php 
$job_strings[] = 'sync_mattlaw_data';

function sync_mattlaw_data(){
	global $db,$log,$sugar_config;
	
	$con = new mysqli("35.208.184.39","unjkl7qwgzo4q","xtu7r3fsinfd","mattlawf_prddb");
if ($con->connect_error) {
  echo "Failed to connect to MySQL: " . $con->connect_error;
  exit();
}
$sql = "SELECT * FROM ht_gravityform_fields where schedular_status = 0 AND email != 'ericjonesmyemail@gmail.com'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $leadBean = BeanFactory::newBean('Leads');
    $leadBean->first_name = $row['first_name'];
    $leadBean->middle_name_c = $row['middle_name'];
    $leadBean->last_name = $row['last_name'];
    $removeBrackets = str_replace(array( '(', ')'), '', $row['cell_no']);
    $leadBean->phone_mobile = str_replace(' ', '-', $removeBrackets);
    $leadBean->email1 = $row['email'];
    $leadBean->case_type_c = $row['case_type'];
    $leadBean->county_of_incident_c = $row['county'];
    $leadBean->date_of_incident_c = $row['incident_date'];
    $leadBean->case_description_c = $row['describe_cause'];
    $leadBean->liability_description_c = $row['describe_fault'];
    $leadBean->damages_description_c =  $row['describe_injury'];
    $leadBean->lead_source = 'Website_Form';
    $leadBean->save();
    $sql2 = "UPDATE ht_gravityform_fields SET schedular_status = 1";
    $result2 = $con->query($sql2);
    $site_url = $sugar_config['site_url'];
    require "include/phpmailer/class.phpmailer.php";
    require "include/phpmailer/class.smtp.php";
     $mail = new PHPMailer();
     $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );   
$mail->IsSMTP();                              // send via SMTP
$mail->Host = "smtp.gmail.com";
$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true;     
$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
$mail->Port = 587;                  // turn on SMTP authentication
$mail->Username = $sugar_config['email_address'];        // SMTP username
$mail->Password = $sugar_config['email_password'];               // SMTP password
// $webmaster_email = "ht.saeed5@gmail.com";       //Reply to this email ID
$email="Chance@MattLaw.com";
$email2="Beth@MattLaw.com";                // Recipients 
$name="Honey MattLaw";                              // Recipient's name
 // $mail->From = $webmaster_email;
$mail->FromName = "New Lead";
$mail->AddAddress($email);
$mail->AddAddress($email2);
// $mail->AddReplyTo($webmaster_email,"My Name");
$mail->WordWrap = 50;                         // set word wrap
$mail->IsHTML(true);                          // send as HTML
$mail->Subject = "New Lead Entry in Honey";
$mail->Body = "New Lead Entry in Honey with Name"." ".$leadBean->first_name." ".$leadBean->last_name;
$mail->Body .= "<br><a href = '{$site_url}/index.php?entryPoint=ViewLeadEntryPoint&id={$leadBean->id}'>Click to View Lead</a>"; 
if(!$mail->Send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
echo "Message has been sent";
}
  }
} else {
  echo "0 results";
}

$con->close();
	return true;
}
