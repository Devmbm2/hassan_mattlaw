<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
	// session_start();
	class create_export_event{
	   function show_export_event_data($bean, $event, $arguments){
	   	global $db;
	   	// $_SESSION['uid'] = $bean->id;
	   	// print_r('<pre>');print_r($bean);print_r('</pre>');die();
	   	$file_check = str_replace(',','',$bean->name);
	   	// echo $file_check;die();
	   	$filename = $file_check.'-'.$bean->id.'.doc';
	   	// $start_date = $_REQUEST['date_start'];
	   	// $end_date = $_REQUEST['date_end'];
        $start_hold_date = $_REQUEST['start_date'];
        $end_hold_date = $_REQUEST['end_date'];
	   	$sql = "SELECT * FROM fp_events WHERE related_event_id ='{$bean->id}' AND deleted = 0";
	   	$result = $db->query($sql);
        $count=0;
	   	// echo $start_date;echo $end_date;die();
		// header("Content-Type: application/force-download");
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
		foreach($start_hold_date as $no => $date){
         if(!empty($date[0]) && !empty($end_hold_date[$no][0])){
		 $content.='<tr>
		 <td>'.++$count.'
		 </td>
		 <td>'.$date[0].' '.$date[1].':'.$date[2].'
		 </td>
		 <td>'.$end_hold_date[$no][0].' '.$end_hold_date[$no][1].':'.$end_hold_date[$no][2].'
		 </td>
		 </tr>';
		}
		}	  
        $content.= '</table></body></html>';

        $myfile = fopen("uploads/".$filename, "w");
        fwrite($myfile, $content);
        fclose($myfile);
        // print_r('<pre>');print_r($bean);print_r('</pre>');die();
	   	

	   }


	}