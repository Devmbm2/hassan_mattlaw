<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
    global $db;
    $smarty = new Sugar_Smarty();
    $all_events = $_REQUEST['all_events'];
    $all_years = $_REQUEST['all_years'];
    $all_months = $_REQUEST['all_months'];
    // $all_years_text = $_REQUEST['year_text'];
    $year_text  = $_REQUEST['year_text'];
    if (!empty($all_events) && $all_events == 1) {
        $closed_cases = array();
        foreach ($all_months as $all_month) {
            $sql1 = "SELECT COUNT(id) as Count,cases.id,cases.name,cases.assigned_user_id, 
            DAY(date_entered) as 'Day', 
            DAYNAME(date_entered) as 'Day Name',
            MONTHNAME(date_entered) as 'Month Name',
            YEAR(date_entered) as 'Year Name' 
            FROM cases 
            WHERE MONTH(date_entered) = {$all_month}
            AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) AND deleted = 0 
            GROUP BY date_entered,id,cases.name,assigned_user_id";
            $result1 = $db->query($sql1, true);
            $i = 0;
            while ($row1 = $db->fetchByAssoc($result1)) {
                $Count = $row1['Count'];
                $i = $i + $Count;
                $user_id = $row1['assigned_user_id']; 
                $user_array = get_user_array($user_id);
                $user_name = $user_array[$user_id];
                $closed_cases[$all_month][] = array(
                    'id' => $row1['id'],
                    'name' => empty($row1['name']) ? "empty" : $row1['name'],
                    'assigned_by' => empty($user_name) ? "empty" : $user_name,
                );
            }
            $closed_cases[$all_month]['closed_cases']  = $i;
        }
    }
    elseif (!empty($all_events) && $all_events == 3) {
        $closed_cases = array();
        foreach ($all_months as $all_month) {
            $sql2 = "SELECT id FROM cases WHERE MONTH(date_entered) = {$all_month}
                    AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) AND deleted = 0";
            $result2 = $db->query($sql2, true);
            $case_sources = array();
            while ($row2 = $db->fetchByAssoc($result2)) {
                $id_c = $row2['id'];
                $sql3 = "SELECT source_c FROM cases_cstm WHERE id_c = '$id_c'";
                $result3 = $db->query($sql3, true);
                $row3 = $db->fetchByAssoc($result3);
                if($row3['source_c']!="")
                {
                $case_sources[] = $row3['source_c'];
               }
            }
            $values = array_count_values($case_sources);
            arsort($values);
            $source_advertisement = array_slice(array_keys($values), 0, 1, true);
            $source_advertisement = str_replace("_", " ",$source_advertisement);
            $closed_cases[$all_month]['closed_cases'] = $source_advertisement[0];
        }
    }
    elseif(!empty($all_events) && $all_events == 4) {
        $closed_cases = array();
        foreach ($all_months as $all_month) {
             $sql4 = "SELECT ROUND(SUM(total_amount),2) as total, COUNT(*) as count 
            FROM cost_client_cost 
            WHERE MONTH(date_entered) = {$all_month}
            AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) AND deleted = 0 
            -- GROUP BY total_amount ,DAY(date_entered)";
            $result4 = $db->query($sql4, true);
            $row4 = $db->fetchByAssoc($result4);
            // $i = 0;
            // while ($row4 = $db->fetchByAssoc($result4)) {
            //     $total_amount = $row4['total_amount'];
            //     $i = $i+$total_amount;
            // }
            if($row4['total'] == Null){
                $closed_cases[$all_month]['closed_cases'] = 0;
            }
            else{
                $closed_cases[$all_month]['closed_cases'] = $row4['total'];
            }
        }

    }
    elseif(!empty($all_events) && $all_events == 5) {
        $closed_cases = array();
        foreach ($all_months as $all_month) {
            $sql5 = "SELECT status_id,id,document_name,assigned_user_id, COUNT(*) as count
            FROM medr_medical_records
            WHERE MONTH(date_entered) = {$all_month}
            AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) AND deleted = 0
            GROUP BY status_id,id,document_name,assigned_user_id, DAY(date_entered)
            ";
            $result5 = $db->query($sql5, true);
            $i = 0;
            while ($row5 = $db->fetchByAssoc($result5)) {
                $status_id = $row5['status_id'];
                if($status_id == 'Received'){
                    $i++;
                    $user_id = $row5['assigned_user_id']; 
                    $user_array = get_user_array($user_id);
                    $user_name = $user_array[$user_id];
                     $closed_cases[$all_month][] = array(
                        'id' => $row5['id'],
                        'name' => empty($row5['document_name']) ? "empty" : $row5['document_name'],
                        'assigned_by' => empty($user_name) ? "empty" : $user_name,
                    );
                }
            }
            $closed_cases[$all_month]['closed_cases'] = $i;
        }
        
    }
    elseif(!empty($all_events) && $all_events == 6) {
        $closed_cases = array();
        foreach ($all_months as $all_month) {
            $sql6 = "SELECT status_id,id,document_name,assigned_user_id, COUNT(*) as count
            FROM medr_medical_records
            WHERE MONTH(date_entered) = {$all_month}
            AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) AND deleted = 0
            GROUP BY status_id, DAY(date_entered),id,document_name,assigned_user_id";
            $result5 = $db->query($sql5, true);
            $i = 0;
            while ($row5 = $db->fetchByAssoc($result5)) {
                $status_id = $row5['status_id'];
                if($status_id == 'Requested'){
                    $i++;
                    $user_id = $row6['assigned_user_id']; 
                    $user_array = get_user_array($user_id);
                    $user_name = $user_array[$user_id];
                    $closed_cases[$all_month][] = array(
                        'id' => $row6['id'],
                        'name' => empty($row6['document_name']) ? "empty" : $row6['document_name'],
                        'assigned_by' => empty($user_name) ? "empty" : $user_name,
                    );    
                }
            }
            $closed_cases[$all_month]['closed_cases'] = $i;
        }
    }
    elseif(!empty($all_events) && $all_events == 7) {
        $closed_cases = array();
        foreach ($all_months as $all_month) {
            $sql7 = "SELECT id , document_name  ,hard_or_soft_doc , assigned_user_id FROM documents WHERE MONTH(date_entered) = {$all_month} AND YEAR(date_entered) = {$year_text} AND deleted = 0";
            $result7 = $db->query($sql7, true);
            $i = 0;
            while ($row7 = $db->fetchByAssoc($result7)) {
                if($row7['hard_or_soft_doc'] == "Soft_Documents"){
                $id = $row7['id'];
                if(!empty($id)){
                    $i++;
                    $user_id = $row7['assigned_user_id']; 
                    $user_array = get_user_array($user_id);
                    $user_name = $user_array[$user_id];
                    $closed_cases[$all_month][] = array(
                        'id' => $row7['id'],
                        'name' => empty($row7['document_name']) ? "empty" : $row7['document_name'],
                        'assigned_by' => empty($user_name) ? "empty" : $user_name,
                    );
                }
            }
            }
            $closed_cases[$all_month]['closed_cases'] = $i;
        }

    }
    elseif(!empty($all_events) && $all_events == 2) {
        $closed_cases = array();
        foreach ($all_months as $all_month) {
            $sql2 = "SELECT  cases.state , COUNT(*) as count, cases.id, cases.name, cases.assigned_user_id
            FROM cases 
            WHERE MONTH(date_entered) = {$all_month}
            AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) AND deleted = 0 
            GROUP BY  date_entered,id,cases.name,assigned_user_id,cases.state;
            ";
            $result2 = $db->query($sql2, true);
            $i = 0;
            while ($row2 = $db->fetchByAssoc($result2)) {
                $state = $row2['state'];
                if(!empty($state) && $state != 'Open'){
                    $i++;
                    $user_id = $row2['assigned_user_id']; 
                    $user_array = get_user_array($user_id);
                    $user_name = $user_array[$user_id];
                    $closed_cases[$all_month][] = array(
                        'id' => $row2['id'],
                        'name' => empty($row2['name']) ? "empty" : $row2['name'],
                        'assigned_by' => empty($user_name) ? "empty" : $user_name,
                    ); 
                }
            }
            $closed_cases[$all_month]['closed_cases'] = $i;
        }

    }
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pdf_check']) && $_POST['pdf_check'] == 'no' ) {
    $encoded_array =  json_encode($closed_cases);
    $smarty->assign('encoded_array', $encoded_array);
    $smarty->assign('year_text', $year_text);
    $smarty->assign('all_months', $all_months);
    $smarty->assign('all_years', $all_years);
    $smarty->assign('all_events', $all_events);
    $smarty->display("custom/modules/Cases/tpls/case_reports.tpl");
}
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pdf_check']) && $_POST['pdf_check'] == 'yes' ) {
    // if (!empty($all_events) && $all_events !== 3)
    // { 
        $pdf = new mPDF('en', 'A4', '12', 'DejaVuSansCondensed', 10, 10, 10, 16, 9, 9);    
        $date =   date("Y/m/d");
        $html  = '<p>Date: '.$date.'</p>';
        $html .= '<br><br><div class="close_cases_information">
                <table border=1 style="width: 100%; border-collapse: collapse;"  id="close_cases_pdf" class="table table-bordered table-responsive">
                <thead>
                <tr style="font-weight:bold;font-size:15px;">
                <th  style="width:50%;" >Month</th>
                '; 
                if ($all_events == 1) {
                 $html .= '<th style="width:50%;"> Number of New Cases </th>';
                } elseif ($all_events == 2) {
                 $html .= '<th style="width:50%;"> Number of Closed Cases </th>';
                } elseif ($all_events == 3) {
                 $html .= '<th style="width:50%;"> Which Source Advertisement Works Best </th>';
                } elseif ($all_events == 4) {
                 $html .= '<th style="width:50%;"> Dollars Spent on Client Costs </th>';
                } elseif ($all_events == 5) {
                 $html .= '<th style="width:50%;"> Number of Medical Records Received </th>';
                } elseif ($all_events == 6) {
                 $html .= '<th style="width:50%;"> Number of Medical Records Requested </th>';
                } elseif ($all_events == 7) {
                 $html .= '<th style="width:50%;"> Number of Documents Generated (Soft) </th>';
                }


       $html .= '
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
              
                $pdf->SetHTMLHeader($header);
                $pdf->AddPage('P');
                $pdf->WriteHTML($html);
                ob_clean();
                $pdf->Output("custom_report_c.pdf", 'I');
   // }

} 
if($_SERVER['REQUEST_METHOD'] !== 'POST' ) {     
$smarty->display("custom/modules/Cases/tpls/case_reports.tpl");
}
