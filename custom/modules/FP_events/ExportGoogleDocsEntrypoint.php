<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
session_start();
$url_array = explode('&', 'http://'.$_SERVER ['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$url = $url_array[0];
// echo $url_array;
// echo $url;
// die();
$uid= $_REQUEST['uid'];
  // print_r('<pre>');print_r($uid); die();
 // die($_SESSION['uid']);
require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';
$client = new Google_Client();
$client->setClientId('958782610471-jt0qlt3s263ljl3os8khmvpfi2gceuj0.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri($url);
$client->setState($uid);
$client->setScopes(array('https://www.googleapis.com/auth/drive'));
// $auth_url = "https://accounts.google.com/AccountChooser?service=lso&continue=";
// $auth_url .= urlencode("https://accounts.google.com/o/oauth2/auth/?response_type=code&scope=https://www.googleapis.com/auth/analytics.readonly&access_type=offline&redirect_uri=$redirect_uri&approval_prompt=force&state=$uid&client_id=$client_id");


if (isset($_GET['code'])) {
    $_SESSION['accessToken'] = $client->authenticate($_GET['code']);
    $_SESSION['uid'] = $_GET['state'];
    // echo $_GET['state'];
    // die();
    header('location:'.$url);exit;
} elseif (!isset($_SESSION['accessToken'])) {
    $client->authenticate();
}
        global $db;
        $bean = BeanFactory::getBean('FP_events',$uid);
        $file_check = str_replace(',','',$bean->name);
        $filename = $file_check.'-'.$bean->id.'.doc';
        $sql = "SELECT * FROM fp_events WHERE related_event_id ='{$bean->id}' AND deleted = 0";
        $result = $db->query($sql);
        $count=0;
        header( "Content-Disposition: inline; filename=".basename($filename));
        header( "Content-Description: File Transfer");
        @readfile($filename);

$content = '<html xmlns:v="urn:schemas-microsoft-com:vml" '
        .'xmlns:o="urn:schemas-microsoft-com:office:office" '
        .'xmlns:w="urn:schemas-microsoft-com:office:word" '
        .'xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"= '
        .'xmlns="http://www.w3.org/TR/REC-html40">'
        .'<head><meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">'
        .'<title></title>'
        .'<!--[if gte mso 9]>'
        .'<xml>'
        .'<w:WordDocument>'
        .'<w:View>Print'
        .'<w:Zoom>100'
        .'<w:DoNotOptimizeForBrowser/>'
        .'</w:WordDocument>'
        .'</xml>'
        .'<![endif]-->'
        .'<style>
        @page
        {
            font-family: Arial;
            size:215.9mm 279.4mm;  /* A4 */
            margin:14.2mm 17.5mm 14.2mm 16mm; /* Margins: 2.5 cm on each side */
        }
        h2 { font-family: Arial; font-size: 18px; text-align:center; }
        p.para {font-family: Arial; font-size: 13.5px; text-align: justify;}
        </style>'
        .'</head>'
        .'<body>'
        .'<p class="para">'
        .'This is a sample output or report that would be great to use when we want to propose multiple dates and times for some event.  What is nice about this format, is we can cut and paste the information easily into a document.<br>'

        .'Here are the proposed dates for (name of event).  Please select one of these dates and times on or before (deadline date), or else we will schedule the (name of event) on the first date listed below.'
        .'</p>' ;
        
        $content .= '<table id = "event-details" style="" border=1 width=100%>
              <tr>
              <td style = "">Choices</td>         
              <td style = "">Date Time Start</td>
             <td style = "">Date Time End</td>
        </tr>';
        $content.='<tr>
         <td>'.++$count.'
         </td>
         <td>'.$bean->date_start.'
         </td>
         <td>'.$bean->date_end.'
         </td>
         </tr>';
        
        while ($row = $db->fetchByAssoc($result)){
    $FP_events = BeanFactory::getBean('FP_events', $row['id']);
         $content.='<tr>
         <td>'.++$count.'
         </td>
         <td>'.$FP_events->date_start.'
         </td>
         <td>'.$FP_events->date_end.'
         </td>
         </tr>';
        
        }     
        $content.= '</table></body></html>';

        $myfile = fopen("uploads/".$filename, "w");
        fwrite($myfile, $content);
        fclose($myfile);
        

$files= array();
$dir = dir('uploads');
while ($file = $dir->read()) {
    if ($file != '.' && $file != '..') {
        $files[] = $file;
    }
}
$dir->close();
// echo $_GET['state'];
// die();
if (!empty($uid)) {
 // die($_SESSION['uid']);
    $client->setAccessToken($_SESSION['accessToken']);
    $client->setState($_SESSION['accessToken']);
    $fileuid = $_SESSION['uid'];
    // die($fileuid);
    $service = new Google_DriveService($client);
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file = new Google_DriveFile();
    foreach ($files as $file_name) {
    	if(strpos($file_name, $uid) !== false)
    	{
        $file_path = 'uploads/'.$file_name;
        $mime_type = finfo_file($finfo, $file_path);
        $file->setTitle($file_name);
        $file->setDescription('This is a '.$mime_type.' document');
        $file->setMimeType('application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        $createdFile = $service->files->insert(
            $file,
            array(
                'data' => file_get_contents($file_path),
                'mimeType' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            )
        );
        // die($createdFile);
        finfo_close($finfo);
        unlink('uploads/'.$file_name);
		header('Location: https://docs.google.com/document/d/'.$createdFile['id'].'/edit?usp=drivesdk');
    } 
    }
}
if (empty($uid)) {
 // die($_SESSION['uid']);
    $client->setAccessToken($_SESSION['accessToken']);
    $client->setState($_SESSION['accessToken']);
    $fileuid = $_SESSION['uid'];
    // die($fileuid);
    $service = new Google_DriveService($client);
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file = new Google_DriveFile();
    foreach ($files as $file_name) {
        if(strpos($file_name, $fileuid) !== false)
        {
        $file_path = 'uploads/'.$file_name;
        // echo $file_path;die();
        $mime_type = finfo_file($finfo, $file_path);
        $file->setTitle($file_name);
        $file->setDescription('This is a '.$mime_type.' document');
        $file->setMimeType('application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        $createdFile = $service->files->insert(
            $file,
            array(
                'data' => file_get_contents($file_path),
                'mimeType' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            )
        );
        // die($createdFile);

        
        finfo_close($finfo);
                unlink('uploads/'.$file_name);
        header('Location: https://docs.google.com/document/d/'.$createdFile['id'].'/edit?usp=drivesdk');
    } 
    }
    
}
// header('Location: https://docs.google.com/document/d/edit?usp=drivesdk');
// include 'index.phtml';
// die("1");