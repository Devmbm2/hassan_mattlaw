<?php
namespace Dompdf;
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
require_once 'custom/include/dompdf/autoload.inc.php';
global $db;

//============Generate Report=============
if(isset($_POST['action']) && $_POST['action']=='fetch_cases') {
    $all_events = $_REQUEST['all_events'];
    $all_years  = $_REQUEST['all_years'];
    $all_months = $_REQUEST['all_months'];
    $year_text  = $_REQUEST['all_years_text'];
    if(!empty($all_events) && $all_events == 1){
        $all_newly_cases = array();
        foreach ($all_months as $all_month){
            $sql1 = "SELECT COUNT(id) as Count, DAY(date_entered) as 'Day', DAYNAME(date_entered) as 'Day Name',
                 MONTHNAME(date_entered) as 'Month Name',YEAR(date_entered) as 'Year Name' FROM cases
                 WHERE MONTH(date_entered) = MONTH(CURDATE() - INTERVAL {$all_month} MONTH)
                 AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) GROUP BY DAY(date_entered)";
            $result1 = $db->query($sql1, true);
            $i = 0;
            while($row1 = $db->fetchByAssoc($result1)){
                $Count = $row1['Count'];
                $i = $i+$Count;
            }
            $all_newly_cases[$all_month]['count'] = $i;
        }
        $encoded_array =  json_encode($all_newly_cases);
        echo $encoded_array;
        die();
    }elseif(!empty($all_events) && $all_events == 3){
        $source_advertisement_array = array();
        foreach ($all_months as $all_month) {
            $sql2 = "SELECT id FROM cases WHERE MONTH(date_entered) = MONTH(CURDATE() - INTERVAL {$all_month} MONTH)
                 AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) GROUP BY DAY(date_entered)";
            $result2 = $db->query($sql2, true);
            $case_sources = array();
            while ($row2 = $db->fetchByAssoc($result2)) {
                $id_c = $row2['id'];
                $sql3 = "SELECT source_c FROM cases_cstm WHERE id_c = '$id_c'";
                $result3 = $db->query($sql3, true);
                $row3 = $db->fetchByAssoc($result3);
                $case_sources[] = $row3['source_c'];
            }
            $values = array_count_values($case_sources);
            arsort($values);
            $source_advertisement = array_slice(array_keys($values), 0, 1, true);
            $source_advertisement_array[$all_month]['source'] = $source_advertisement;
        }
        $encoded_source_array =  json_encode($source_advertisement_array);
        echo $encoded_source_array;
        die();

    }elseif(!empty($all_events) && $all_events == 4){
        $cost_info = array();
        foreach ($all_months as $all_month) {
            $sql4 = "SELECT total_amount FROM cost_client_cost WHERE MONTH(date_entered) = MONTH(CURDATE() - INTERVAL {$all_month} MONTH)
                     AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) GROUP BY DAY(date_entered)";
            $result4 = $db->query($sql4, true);
            $i = 0;
            while ($row4 = $db->fetchByAssoc($result4)) {
                $total_amount = $row4['total_amount'];
                $i = $i+$total_amount;
            }
            $cost_info[$all_month]['count'] = $i;
        }
        $encoded_cost_info =  json_encode($cost_info);
        echo $encoded_cost_info;
        die();
    }elseif(!empty($all_events) && $all_events == 5){
        $medical_records_received = array();
        foreach ($all_months as $all_month) {
            $sql5 = "SELECT status_id FROM medr_medical_records WHERE MONTH(date_entered) = MONTH(CURDATE() - INTERVAL {$all_month} MONTH)
                     AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) GROUP BY DAY(date_entered)";
            $result5 = $db->query($sql5, true);
            $i = 0;
            while ($row5 = $db->fetchByAssoc($result5)) {
                $status_id = $row5['status_id'];
                if($status_id == 'Received'){
                    $i++;
                }
            }
            $medical_records_received[$all_month]['status'] = $i;
        }
        $encoded_medical_records =  json_encode($medical_records_received);
        echo $encoded_medical_records;
        die();
    }elseif(!empty($all_events) && $all_events == 6){
        $medical_records_requested = array();
        foreach ($all_months as $all_month) {
            $sql6 = "SELECT status_id FROM medr_medical_records WHERE MONTH(date_entered) = MONTH(CURDATE() - INTERVAL {$all_month} MONTH)
                     AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) GROUP BY DAY(date_entered)";
            $result6 = $db->query($sql6, true);
            $i = 0;
            while ($row6 = $db->fetchByAssoc($result6)) {
                $status_id = $row6['status_id'];
                if($status_id == 'Requested'){
                    $i++;
                }
            }
            $medical_records_requested[$all_month]['medical_status'] = $i;
        }
        $encoded_medical_records =  json_encode($medical_records_requested);
        echo $encoded_medical_records;
        die();
    }elseif(!empty($all_events) && $all_events == 7){
        $documents_generated = array();
        foreach ($all_months as $all_month) {
            $sql7 = "SELECT id FROM ht_soft_documents WHERE MONTH(date_entered) = {$all_month} AND YEAR(date_entered) = {$year_text}";
            $result7 = $db->query($sql7, true);
            $i = 0;
            while ($row7 = $db->fetchByAssoc($result7)) {
                $id = $row7['id'];
                if(!empty($id)){
                    $i++;
                }
            }
            $documents_generated[$all_month]['soft_documents'] = $i;
        }
        $encoded_documents_record =  json_encode($documents_generated);
        echo $encoded_documents_record;
        die();
    }elseif(!empty($all_events) && $all_events == 2){
        $closed_cases = array();
        foreach ($all_months as $all_month) {
            $sql2 = "SELECT state FROM cases WHERE MONTH(date_entered) = {$all_month} AND YEAR(date_entered) = {$year_text}";
            $result2 = $db->query($sql2, true);
            $i = 0;
            while ($row2 = $db->fetchByAssoc($result2)) {
                $state = $row2['state'];
                if(!empty($state) && $state != 'Open'){
                    $i++;
                }
            }
            $closed_cases[$all_month]['closed_cases'] = $i;
        }
        $encoded_closed_cases =  json_encode($closed_cases);
        echo $encoded_closed_cases;
        die();
    }
}

//============Generate Report in Pdf==============
if(isset($_POST['action']) && $_POST['action']=='generate_pdf') {
    $all_events = $_REQUEST['all_events'];
    $all_years = $_REQUEST['all_years'];
    $all_months = $_REQUEST['all_months'];
    $all_years_text = $_REQUEST['all_years_text'];
    if (!empty($all_events) && $all_events == 1) {
        $all_newly_cases = array();
        foreach ($all_months as $all_month) {
            $sql1 = "SELECT COUNT(id) as Count, DAY(date_entered) as 'Day', DAYNAME(date_entered) as 'Day Name',
                 MONTHNAME(date_entered) as 'Month Name',YEAR(date_entered) as 'Year Name' FROM cases
                 WHERE MONTH(date_entered) = MONTH(CURDATE() - INTERVAL {$all_month} MONTH)
                 AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) GROUP BY DAY(date_entered)";
            $result1 = $db->query($sql1, true);
            $i = 0;
            while ($row1 = $db->fetchByAssoc($result1)) {
                $Count = $row1['Count'];
                $i = $i + $Count;
            }
            $all_newly_cases[$all_month]['count'] = $i;
        }
        $dompdf = new Dompdf();
        $date = date("Y/m/d");
            $html  = '<p>Date: '.$date.'</p>';
            $html .= '<div class="new_cases_pdf">
                <table border=1 style="width: 100%;" id="new_cases_pdf" class="table table-bordered table-responsive">
                <thead>
                <tr style="font-weight:bold;font-size:15px;border-collapse:collapse;border-width:1px;border-style:solid;">
                <th>Month</th>
                <th>Count(Cases)</th>
                </tr>
                </thead>
                <tbody>';
        foreach ($all_newly_cases as $key => $value) {
            switch ($key) {
                case "1":
                    $month_name = 'January';
                    break;
                case "2":
                    $month_name = 'February';
                    break;
                case "3":
                    $month_name = 'March';
                    break;
                case "4":
                    $month_name = 'April';
                    break;
                case "5":
                    $month_name = 'May';
                    break;
                case "6":
                    $month_name = 'June';
                    break;
                case "7":
                    $month_name = 'July';
                    break;
                case "8":
                    $month_name = 'August';
                    break;
                case "9":
                    $month_name = 'September';
                    break;
                case "10":
                    $month_name = 'October';
                    break;
                case "11":
                    $month_name = 'November';
                    break;
                default:
                    $month_name = 'December';
            }

            $html .= '<tr>
                <td style="text-align: center;">' . $month_name . '</td>
                <td style="text-align: center;">' . $value['count'] . '</td>
                </tr>';
        }
            $html .= '</tbody>
                </table>
                </div>';
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        // $pdf = $dompdf->output();
        // $file_name = 'custom/modules/Cases/public/'.uniqid().'.pdf';
        // file_put_contents($file_name, $pdf);
        // echo json_encode($file_name);
        $dompdf->stream("codexworld", array("Attachment" => 0));
        // file_put_contents("newfile.pdf", $pdf);
    }
    elseif (!empty($all_events) && $all_events == 3) {
        $source_advertisement_array = array();
        foreach ($all_months as $all_month) {
            $sql2 = "SELECT id FROM cases WHERE MONTH(date_entered) = MONTH(CURDATE() - INTERVAL {$all_month} MONTH)
                 AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) GROUP BY DAY(date_entered)";
            $result2 = $db->query($sql2, true);
            $case_sources = array();
            while ($row2 = $db->fetchByAssoc($result2)) {
                $id_c = $row2['id'];
                $sql3 = "SELECT source_c FROM cases_cstm WHERE id_c = '$id_c'";
                $result3 = $db->query($sql3, true);
                $row3 = $db->fetchByAssoc($result3);
                $case_sources[] = $row3['source_c'];
            }
            $values = array_count_values($case_sources);
            arsort($values);
            $source_advertisement = array_slice(array_keys($values), 0, 1, true);
            $source_advertisement_array[$all_month]['source'] = $source_advertisement;
        }
        $dompdf = new Dompdf();
        $date = date("Y/m/d");
        $html  = '<p>Date: '.$date.'</p>';
        $html .= '<div class="source_advertisement">
                <table border=1 style="width: 100%;" id="new_sources_pdf" class="table table-bordered table-responsive">
                <thead>
                <tr style="font-weight:bold;font-size:15px;border-collapse:collapse;border-width:1px;border-style:solid;">
                <th>Month</th>
                <th>Source</th>
                </tr>
                </thead>
                <tbody>';
        foreach ($source_advertisement_array as $key => $value) {
            switch ($key) {
                case "1":
                    $month_name = 'January';
                    break;
                case "2":
                    $month_name = 'February';
                    break;
                case "3":
                    $month_name = 'March';
                    break;
                case "4":
                    $month_name = 'April';
                    break;
                case "5":
                    $month_name = 'May';
                    break;
                case "6":
                    $month_name = 'June';
                    break;
                case "7":
                    $month_name = 'July';
                    break;
                case "8":
                    $month_name = 'August';
                    break;
                case "9":
                    $month_name = 'September';
                    break;
                case "10":
                    $month_name = 'October';
                    break;
                case "11":
                    $month_name = 'November';
                    break;
                default:
                    $month_name = 'December';
            }
            if(empty($value['source'])){
                $source = '';
            }elseif(empty($value['source'][0])){
                $source = '';
            }else{
                $source = $value['source'][0];
            }
            $html .= '<tr>
                <td style="text-align: center;">' . $month_name . '</td>
                <td style="text-align: center;">' . $source . '</td>
                </tr>';
        }
        $html .= '</tbody>
                </table>
                </div>';
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        // $pdf = $dompdf->output();
        // $file_name = 'custom/modules/Cases/public/'.uniqid().'.pdf';
        // file_put_contents($file_name, $pdf);
        // echo json_encode($file_name);
        $dompdf->stream("codexworld", array("Attachment" => 0));
    }
    elseif(!empty($all_events) && $all_events == 4) {
        $cost_info = array();
        foreach ($all_months as $all_month) {
            $sql4 = "SELECT total_amount FROM cost_client_cost WHERE MONTH(date_entered) = MONTH(CURDATE() - INTERVAL {$all_month} MONTH)
                     AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) GROUP BY DAY(date_entered)";
            $result4 = $db->query($sql4, true);
            $i = 0;
            while ($row4 = $db->fetchByAssoc($result4)) {
                $total_amount = $row4['total_amount'];
                $i = $i+$total_amount;
            }
            $cost_info[$all_month]['count'] = $i;
        }

        $dompdf = new Dompdf();
        $date = date("Y/m/d");
        $html  = '<p>Date: '.$date.'</p>';
        $html .= '<div class="cost_info">
                <table border=1 style="width: 100%;" id="cost_info_pdf" class="table table-bordered table-responsive">
                <thead>
                <tr style="font-weight:bold;font-size:15px;border-collapse:collapse;border-width:1px;border-style:solid;">
                <th>Month</th>
                <th>Client Cost</th>
                </tr>
                </thead>
                <tbody>';
        foreach ($cost_info as $key => $value) {
            $client_cost = $value['count'];
            switch ($key) {
                case "1":
                    $month_name = 'January';
                    break;
                case "2":
                    $month_name = 'February';
                    break;
                case "3":
                    $month_name = 'March';
                    break;
                case "4":
                    $month_name = 'April';
                    break;
                case "5":
                    $month_name = 'May';
                    break;
                case "6":
                    $month_name = 'June';
                    break;
                case "7":
                    $month_name = 'July';
                    break;
                case "8":
                    $month_name = 'August';
                    break;
                case "9":
                    $month_name = 'September';
                    break;
                case "10":
                    $month_name = 'October';
                    break;
                case "11":
                    $month_name = 'November';
                    break;
                default:
                    $month_name = 'December';
            }

            $html .= '<tr>
                <td style="text-align: center;">' . $month_name . '</td>
                <td style="text-align: center;">' . $client_cost . '</td>
                </tr>';
        }
        $html .= '</tbody>
                </table>
                </div>';
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        // $pdf = $dompdf->output();
        // $file_name = 'custom/modules/Cases/public/'.uniqid().'.pdf';
        // file_put_contents($file_name, $pdf);
        // echo json_encode($file_name);
        $dompdf->stream("codexworld", array("Attachment" => 0));
    }
    elseif(!empty($all_events) && $all_events == 5) {
        $medical_records_received = array();
        foreach ($all_months as $all_month) {
            $sql5 = "SELECT status_id FROM medr_medical_records WHERE MONTH(date_entered) = MONTH(CURDATE() - INTERVAL {$all_month} MONTH)
                     AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) GROUP BY DAY(date_entered)";
            $result5 = $db->query($sql5, true);
            $i = 0;
            while ($row5 = $db->fetchByAssoc($result5)) {
                $status_id = $row5['status_id'];
                if($status_id == 'Received'){
                    $i++;
                }
            }
            $medical_records_received[$all_month]['status'] = $i;
        }

        $dompdf = new Dompdf();
        $date = date("Y/m/d");
        $html  = '<p>Date: '.$date.'</p>';
        $html .= '<div class="medical_received_info">
                <table border=1 style="width: 100%;" id="medical_received_pdf" class="table table-bordered table-responsive">
                <thead>
                <tr style="font-weight:bold;font-size:15px;border-collapse:collapse;border-width:1px;border-style:solid;">
                <th>Month</th>
                <th>Medical Records Received</th>
                </tr>
                </thead>
                <tbody>';
        foreach ($medical_records_received as $key => $value) {
            $medical_status = $value['status'];
            switch ($key) {
                case "1":
                    $month_name = 'January';
                    break;
                case "2":
                    $month_name = 'February';
                    break;
                case "3":
                    $month_name = 'March';
                    break;
                case "4":
                    $month_name = 'April';
                    break;
                case "5":
                    $month_name = 'May';
                    break;
                case "6":
                    $month_name = 'June';
                    break;
                case "7":
                    $month_name = 'July';
                    break;
                case "8":
                    $month_name = 'August';
                    break;
                case "9":
                    $month_name = 'September';
                    break;
                case "10":
                    $month_name = 'October';
                    break;
                case "11":
                    $month_name = 'November';
                    break;
                default:
                    $month_name = 'December';
            }

            $html .= '<tr>
                <td style="text-align: center;">' . $month_name . '</td>
                <td style="text-align: center;">' . $medical_status . '</td>
                </tr>';
        }
        $html .= '</tbody>
                </table>
                </div>';
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("codexworld", array("Attachment" => 0));
        // $pdf = $dompdf->output();
        // $file_name = 'custom/modules/Cases/public/'.uniqid().'.pdf';
        // file_put_contents($file_name, $pdf);
        // echo json_encode($file_name);
    }
    elseif(!empty($all_events) && $all_events == 6) {
        $medical_records_requested = array();
        foreach ($all_months as $all_month) {
            $sql5 = "SELECT status_id FROM medr_medical_records WHERE MONTH(date_entered) = MONTH(CURDATE() - INTERVAL {$all_month} MONTH)
                     AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) GROUP BY DAY(date_entered)";
            $result5 = $db->query($sql5, true);
            $i = 0;
            while ($row5 = $db->fetchByAssoc($result5)) {
                $status_id = $row5['status_id'];
                if($status_id == 'Requested'){
                    $i++;
                }
            }
            $medical_records_requested[$all_month]['medical_status'] = $i;
        }

        $dompdf = new Dompdf();
        $date = date("Y/m/d");
        $html  = '<p>Date: '.$date.'</p>';
        $html .= '<div class="medical_received_info">
                <table border=1 style="width: 100%;" id="medical_received_pdf" class="table table-bordered table-responsive">
                <thead>
                <tr style="font-weight:bold;font-size:15px;border-collapse:collapse;border-width:1px;border-style:solid;">
                <th>Month</th>
                <th>Medical Records Received</th>
                </tr>
                </thead>
                <tbody>';
        foreach ($medical_records_requested as $key => $value) {
            $medical_status = $value['medical_status'];
            switch ($key) {
                case "1":
                    $month_name = 'January';
                    break;
                case "2":
                    $month_name = 'February';
                    break;
                case "3":
                    $month_name = 'March';
                    break;
                case "4":
                    $month_name = 'April';
                    break;
                case "5":
                    $month_name = 'May';
                    break;
                case "6":
                    $month_name = 'June';
                    break;
                case "7":
                    $month_name = 'July';
                    break;
                case "8":
                    $month_name = 'August';
                    break;
                case "9":
                    $month_name = 'September';
                    break;
                case "10":
                    $month_name = 'October';
                    break;
                case "11":
                    $month_name = 'November';
                    break;
                default:
                    $month_name = 'December';
            }

            $html .= '<tr>
                <td style="text-align: center;">' . $month_name . '</td>
                <td style="text-align: center;">' . $medical_status . '</td>
                </tr>';
        }
        $html .= '</tbody>
                </table>
                </div>';
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("codexworld", array("Attachment" => 0));
        // $pdf = $dompdf->output();
        // $file_name = 'custom/modules/Cases/public/'.uniqid().'.pdf';
        // file_put_contents($file_name, $pdf);
        // echo json_encode($file_name);
    }
    elseif(!empty($all_events) && $all_events == 7) {
        $documents_generated = array();
        foreach ($all_months as $all_month) {
            $sql7 = "SELECT id FROM ht_soft_documents WHERE MONTH(date_entered) = {$all_month} AND YEAR(date_entered) = {$all_years_text}";
            $result7 = $db->query($sql7, true);
            $i = 0;
            while ($row7 = $db->fetchByAssoc($result7)) {
                $id = $row7['id'];
                if(!empty($id)){
                    $i++;
                }
            }
            $documents_generated[$all_month]['soft_documents'] = $i;
        }

        $dompdf = new Dompdf();
        $date = date("Y/m/d");
        $html  = '<p>Date: '.$date.'</p>';
        $html .= '<div class="doc_generated_info">
                <table border=1 style="width: 100%;" id="doc_generated_pdf" class="table table-bordered table-responsive">
                <thead>
                <tr style="font-weight:bold;font-size:15px;border-collapse:collapse;border-width:1px;border-style:solid;">
                <th>Month</th>
                <th>Documents Generated</th>
                </tr>
                </thead>
                <tbody>';
        foreach ($documents_generated as $key => $value) {
            $documents_status = $value['soft_documents'];
            switch ($key) {
                case "1":
                    $month_name = 'January';
                    break;
                case "2":
                    $month_name = 'February';
                    break;
                case "3":
                    $month_name = 'March';
                    break;
                case "4":
                    $month_name = 'April';
                    break;
                case "5":
                    $month_name = 'May';
                    break;
                case "6":
                    $month_name = 'June';
                    break;
                case "7":
                    $month_name = 'July';
                    break;
                case "8":
                    $month_name = 'August';
                    break;
                case "9":
                    $month_name = 'September';
                    break;
                case "10":
                    $month_name = 'October';
                    break;
                case "11":
                    $month_name = 'November';
                    break;
                default:
                    $month_name = 'December';
            }

            $html .= '<tr>
                <td style="text-align: center;">' . $month_name . '</td>
                <td style="text-align: center;">' . $documents_status . '</td>
                </tr>';
        }
        $html .= '</tbody>
                </table>
                </div>';
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("codexworld", array("Attachment" => 0));
        // $pdf = $dompdf->output();
        // $file_name = 'custom/modules/Cases/public/'.uniqid().'.pdf';
        // file_put_contents($file_name, $pdf);
        // echo json_encode($file_name);
    }
    elseif(!empty($all_events) && $all_events == 2) {
        $closed_cases = array();
        foreach ($all_months as $all_month) {
            $sql2 = "SELECT state FROM cases WHERE MONTH(date_entered) = {$all_month} AND YEAR(date_entered) = {$all_years_text}";
            $result2 = $db->query($sql2, true);
            $i = 0;
            while ($row2 = $db->fetchByAssoc($result2)) {
                $state = $row2['state'];
                if(!empty($state) && $state != 'Open'){
                    $i++;
                }
            }
            $closed_cases[$all_month]['closed_cases'] = $i;
        }

        $dompdf = new Dompdf();
        $date =   date("Y/m/d");
        $html  = '<p>Date: '.$date.'</p>';
        $html .= '<div class="close_cases_information">
                 <table border=1 style="width: 100%;" id="close_cases_pdf" class="table table-bordered table-responsive">
                 <thead>
                 <tr style="font-weight:bold;font-size:15px;border-collapse:collapse;border-width:1px;border-style:solid;">
                 <th>Month</th>
                 <th>Closed Cases</th>
                 </tr>
                 </thead>
                 <tbody>';
        foreach ($closed_cases as $key => $value) {
            $closed_cases_val = $value['closed_cases'];
            switch ($key) {
                case "1":
                    $month_name = 'January';
                    break;
                case "2":
                    $month_name = 'February';
                    break;
                case "3":
                    $month_name = 'March';
                    break;
                case "4":
                    $month_name = 'April';
                    break;
                case "5":
                    $month_name = 'May';
                    break;
                case "6":
                    $month_name = 'June';
                    break;
                case "7":
                    $month_name = 'July';
                    break;
                case "8":
                    $month_name = 'August';
                    break;
                case "9":
                    $month_name = 'September';
                    break;
                case "10":
                    $month_name = 'October';
                    break;
                case "11":
                    $month_name = 'November';
                    break;
                default:
                    $month_name = 'December';
            }

            $html .= '<tr>
                <td style="text-align: center;">' . $month_name . '</td>
                <td style="text-align: center;">' . $closed_cases_val . '</td>
                </tr>';
        }
        $html .= '</tbody>
                </table>
                </div>';
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("codexworld", array("Attachment" => 0));
        // $pdf = $dompdf->output();
        // $file_name = 'custom/modules/Cases/public/'.uniqid().'.pdf';
        // file_put_contents($file_name, $pdf);
        // echo json_encode($file_name);
    }
}
