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
    $all_month_d = $_REQUEST['all_month_d'];
    $all_day_d  = $_REQUEST['all_day_d'];
    $period_radio =$_REQUEST['period_radio'];
        if( $_REQUEST['period_radio'] != 'day')
    {
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
                AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) AND deleted = 0 ";
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
        if(!empty($all_events) && $all_events == 8){
            $closed_cases = array();
            foreach ($all_months as $all_month){
                $sql1 = "SELECT COUNT(id) as Count, cases.id, cases.name, cases.assigned_user_id , cases.date_entered  ,
                DAY(date_entered) as 'Day',
                DAYNAME(date_entered) as 'Day Name',
                MONTHNAME(date_entered) as 'Month Name',
                YEAR(date_entered) as 'Year Name'
                FROM cases
                WHERE deleted=0 AND  MONTH(date_entered) = {$all_month}
                AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR)
                GROUP BY date_entered , id , cases.name , assigned_user_id";
                $result1 = $db->query($sql1, true);
                $i = 0;
                while($row1 = $db->fetchByAssoc($result1)){
                    $Count = $row1['Count'];
                    $i = $i+$Count;
                    $id=$row1['id'];
                    $user_id = $row1['assigned_user_id'];
                    $user_array = get_user_array($user_id);
                    $user_name = $user_array[$user_id];
                    $dateString=$row1['date_entered'];
                    $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
                    $date_entered = $date->format('Y-m-d');
                    $converted="";
                    $sub_sql="SELECT contact_id1_c FROM `cases_cstm` WHERE id_c='".$id."'";
                    $result22 = $db->query($sub_sql, true);
                    while($row22 = $db->fetchByAssoc($result22)){
                        $contact_id=$row22["contact_id1_c"];
                    $sub_sql2="SELECT converted FROM `leads` WHERE contact_id='".$contact_id."'";
                    $result23 = $db->query($sub_sql2, true);
                    while($row23 = $db->fetchByAssoc($result23)){
                        $converted=$row23["converted"];
                        if ($converted==1){
                            $closed_cases[$all_month][] = array(
                                'id' => $row1['id'],
                                'name' => empty($row1['name']) ? "empty" : $row1['name'],
                                'assigned_by' => empty($user_name) ? "empty" : $user_name,
                                'converted' => empty($converted) ? "0" : $converted,
                                'data_entered' => empty($date_entered) ? "empty" : $date_entered,
                            );
                        }
                    }
                    }

                }
                if ($converted==1){
                $closed_cases[$all_month]['closed_cases'] = $i;
                  }else {
                $closed_cases[$all_month]['closed_cases'] = 0 ;
                  }
            }
            $encoded_array =  json_encode($all_newly_cases);
            $smarty->assign('encoded_array', $encoded_array);
        }
    }


    if(!empty($all_day_d) && $_REQUEST['period_radio'] == 'day')
    {
        if(!empty($all_events)){
                if($all_events == 1){
                        $closed_cases = array();
                    foreach ($all_day_d as $all_day){
                        $result1=getQueryResult($all_events,$all_events,$all_day,$all_month_d,$all_years);
                        $i = 0;
                        while($row1 = $db->fetchByAssoc($result1)){
                            $Count = $row1['Count'];
                            $i = $i+$Count;
                            $user_id = $row1['assigned_user_id'];
                            $user_array = get_user_array($user_id);
                            $user_name = $user_array[$user_id];
                            $closed_cases[$all_day][] = array(
                                'id' => $row1['id'],
                                'name' => empty($row1['name']) ? "empty" : $row1['name'],
                                'assigned_by' => empty($user_name) ? "empty" : $user_name,
                            );

                        }
                        $closed_cases[$all_day]['closed_cases'] = $i;
                    }
                    $encoded_array =  json_encode($closed_cases);
                    $smarty->assign('encoded_array', $encoded_array);
                }
                elseif($all_events == 2) {
                    $closed_cases = array();
                    foreach ($all_day_d as $all_day) {
                        $result2=getQueryResult($all_events,$all_events,$all_day,$all_month_d,$all_years);
                        $i = 0;
                        while ($row2 = $db->fetchByAssoc($result2)) {
                            $state = $row2['state'];
                            if(!empty($state) && $state != 'Open'){
                                $i++;
                                $user_id = $row2['assigned_user_id'];
                                $user_array = get_user_array($user_id);
                                $user_name = $user_array[$user_id];
                                $closed_cases[$all_day][] = array(
                                    'id' => $row2['id'],
                                    'name' => empty($row2['name']) ? "empty" : $row2['name'],
                                    'assigned_by' => empty($user_name) ? "empty" : $user_name,
                                );
                            }
                        }
                        $closed_cases[$all_day]['closed_cases'] = $i;
                    }

                }
                elseif ($all_events == 3) {
                    $closed_cases = array();
                    foreach ($all_day_d as $all_day) {
                        $result2=getQueryResult($all_events,$all_events,$all_day,$all_month_d,$all_years);
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
                        $closed_cases[$all_day]['closed_cases'] = $source_advertisement[0];
                    }
                }
                elseif($all_events == 4) {
                    $closed_cases = array();
                    foreach ($all_day_d as $all_day) {
                        $result4=getQueryResult($all_events,$all_events,$all_day,$all_month_d,$all_years);
                        $row4 = $db->fetchByAssoc($result4);
                        if($row4['total'] == Null){
                            $closed_cases[$all_day]['closed_cases'] = 0;
                        }
                        else{
                            $closed_cases[$all_day]['closed_cases'] = $row4['total'];
                        }
                    }

                }
                elseif($all_events == 5) {
                    $closed_cases = array();
                    foreach ($all_day_d as $all_day) {
                        $result5=getQueryResult($all_events,$all_events,$all_day,$all_month_d,$all_years);
                        $i = 0;
                        while ($row5 = $db->fetchByAssoc($result5)) {
                            $status_id = $row5['status_id'];
                            if($status_id == 'Received'){
                                $i++;
                                $user_id = $row5['assigned_user_id'];
                                $user_array = get_user_array($user_id);
                                $user_name = $user_array[$user_id];
                                $closed_cases[$all_day][] = array(
                                    'id' => $row5['id'],
                                    'name' => empty($row5['document_name']) ? "empty" : $row5['document_name'],
                                    'assigned_by' => empty($user_name) ? "empty" : $user_name,
                                );
                            }
                        }
                        $closed_cases[$all_day]['closed_cases'] = $i;
                    }

                }
                elseif($all_events == 6) {
                    $closed_cases = array();
                    foreach ($all_day_d as $all_day) {
                        $result5=getQueryResult($all_events,$all_events,$all_day,$all_month_d,$all_years);
                        $i = 0;
                        while ($row5 = $db->fetchByAssoc($result5)) {
                            $status_id = $row5['status_id'];
                            if($status_id == 'Requested'){
                                $i++;
                                $user_id = $row6['assigned_user_id'];
                                $user_array = get_user_array($user_id);
                                $user_name = $user_array[$user_id];
                                $closed_cases[$all_day][] = array(
                                    'id' => $row6['id'],
                                    'name' => empty($row6['document_name']) ? "empty" : $row6['document_name'],
                                    'assigned_by' => empty($user_name) ? "empty" : $user_name,
                                );
                            }
                        }
                        $closed_cases[$all_day]['closed_cases'] = $i;
                    }
                }
                elseif($all_events == 7) {
                    $closed_cases = array();
                    foreach ($all_day_d as $all_day) {
                        $result7=getQueryResult($all_events,$all_events,$all_day,$all_month_d,$all_years);
                        $i = 0;
                        while ($row7 = $db->fetchByAssoc($result7)) {
                            if($row7['hard_or_soft_doc'] == "Soft_Documents"){
                            $id = $row7['id'];
                            if(!empty($id)){
                                $i++;
                                $user_id = $row7['assigned_user_id'];
                                $user_array = get_user_array($user_id);
                                $user_name = $user_array[$user_id];
                                $closed_cases[$all_day][] = array(
                                    'id' => $row7['id'],
                                    'name' => empty($row7['document_name']) ? "empty" : $row7['document_name'],
                                    'assigned_by' => empty($user_name) ? "empty" : $user_name,
                                );
                            }
                        }
                        }
                        $closed_cases[$all_day]['closed_cases'] = $i;
                    }

                }
                if($all_events == 8){
                    $closed_cases = array();
                    foreach ($all_day_d as $all_day ){
                        $result1=getQueryResult($all_events,$all_events,$all_day,$all_month_d,$all_years);
                        $i = 0;
                        while($row1 = $db->fetchByAssoc($result1)){
                            $Count = $row1['Count'];
                            $i = $i+$Count;
                            $id=$row1['id'];
                            $user_id = $row1['assigned_user_id'];
                            $user_array = get_user_array($user_id);
                            $user_name = $user_array[$user_id];
                            $dateString=$row1['date_entered'];
                            $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
                            $date_entered = $date->format('d/m/Y');
                            $converted="";
                            $sub_sql="SELECT contact_id1_c FROM `cases_cstm` WHERE id_c='".$id."'";
                        //   echo $sub_sql; die;
                            $result22 = $db->query($sub_sql, true);
                            while($row22 = $db->fetchByAssoc($result22)){
                                $contact_id=$row22["contact_id1_c"];
                            $sub_sql2="SELECT converted FROM `leads` WHERE contact_id='".$contact_id."'";
                            $result23 = $db->query($sub_sql2, true);
                            while($row23 = $db->fetchByAssoc($result23)){
                                $converted=$row23["converted"];
                            }
                            }
                            if ($converted==1){
                                $closed_cases[$all_day][] = array(
                                    'id' => $row1['id'],
                                    'name' => empty($row1['name']) ? "empty" : $row1['name'],
                                    'assigned_by' => empty($user_name) ? "empty" : $user_name,
                                    'converted' => empty($converted) ? "0" : $converted,
                                    'data_entered' => empty($date_entered) ? "empty" : $date_entered,
                                );
                            }

                        }
                        if ($converted==1){
                        $closed_cases[$all_day]['closed_cases'] = $i;
                        }else {
                        $closed_cases[$all_day]['closed_cases'] = 0 ;
                        }
                    }
                    $encoded_array =  json_encode($closed_cases);
                }
        }

    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pdf_check']) && $_POST['pdf_check'] == 'no' ) {
    $encoded_array =  json_encode($closed_cases);
    $smarty->assign('all_day_d', $all_day_d);
    $smarty->assign('all_month_d', $all_month_d);
    $smarty->assign('period_radio', $period_radio);
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
        if ( $all_events == 1 || $all_events == 2 || $all_events == 5 || $all_events == 6 || $all_events == 7
        || $all_events == 8)
        {
            $pdf = new mPDF('en', 'A4', '12', 'DejaVuSansCondensed', 10, 10, 30, 16, 9, 9);
            $date =   date("Y/m/d");
            $html  = '<p>Date: '.$date.'</p>';
            $html .= '<div class="close_cases_information">
                    <table border=1 style="width: 100%; border-collapse: collapse;"  id="close_cases_pdf" class="table table-bordered table-responsive">
                    <thead>
                    <tr style="font-weight:bold;font-size:15px;">
                    <th  style="width:50%;" >Month</th>
                    ';
                    if ($all_events == 1) {
                     $html .= '<th style="width:50%;"> Number of New Cases </th>';
                    } elseif ($all_events == 2) {
                     $html .= '<th style="width:50%;"> Number of Closed Cases </th>';
                    }  elseif ($all_events == 4) {
                     $html .= '<th style="width:50%;"> Dollars Spent on Client Costs </th>';
                    } elseif ($all_events == 5) {
                     $html .= '<th style="width:50%;"> Number of Medical Records Received </th>';
                    } elseif ($all_events == 6) {
                     $html .= '<th style="width:50%;"> Number of Medical Records Requested </th>';
                    } elseif ($all_events == 7) {
                     $html .= '<th style="width:50%;">  Soft Documents </th>';
                    } elseif ($all_events == 8) {
                     $html .= '<th style="width:50%;">  Case Converted </th>';
                    }


           $html .= '
                    </tr>
                    </thead>
                    <tbody>';
            foreach ($closed_cases as $key => $value) {
                $soft_documents = $value['soft_documents'];
                $closed_cases_val = $value['closed_cases'];
                $month_name=MonthFunction($key);
         $key_u = $key.'/'.$all_month_d.'/'.$year_text;
            $html .= '<tr>
                <td style="text-align: center;">' . (($period_radio == "day") ? $key_u : $month_name )  . '</td>
                <td style="text-align: center;">' . $closed_cases_val . '</td>
                </tr>';

            }
            $html .= '</tbody>
                    </table>
                    </div>';

                        foreach ($closed_cases as  $key => $Data) {
                            $month_name=MonthFunction($key);
                                  $h = 0;
                         foreach ($Data as  $caseData) {
                            if ($caseData['name'] && $caseData['assigned_by']) {
                                if ($h == 0) {
                                    $key_u = $key.'/'.$all_month_d.'/'.$year_text;
                                    $html .= '<h3 style="font-size:20px;">' . (($period_radio == "day") ? $key_u : $month_name ) . '</h3>
                                    <div class="close_cases_information">
                                 <table border=1 style="width: 100%; border-collapse: collapse;"  id="close_cases_pdf" class="table table-bordered table-responsive">
                                                <thead>
                                                <tr style="text-align:left;">';
                                    if($all_events==1 || $all_events==2 || $all_events==8) {
                                      $html .= '<th style="text-align:left; font-size:14px; "> Case</th>';
                                      if($all_events==8){
                                      $html .= '<th style="text-align:left; font-size:14px; "> Converted date </th>';
                                        }
                                    }else{
                                        $html .= '<th style="text-align:left; font-size:14px; "> Record Name</th>';
                                    }
                                      $html .= '<th style="text-align:left; font-size:14px; "> Assigned</th>
                                                </tr>
                                                </thead>
                                                <tbody>';
                                }
                                $h++;
                                $html .= '
                                    <tr>
                                        <td style="width:40%;"><a href="index.php?module=Cases&offset=3&stamp=1681712201036540300&return_module=Cases&action=DetailView&record=' . $caseData['id'] . '"  target="_blank">' . $caseData['name'] . '</a></td>';
                                        if($all_events==8){
                                        $html .= '<td style="width:20%;">' . $caseData['data_entered'] . '</td>';
                                            }
                                        $html .= '<td style="width:40%;">' . $caseData['assigned_by'] . '</td>
                                    </tr>';
                            }
                        }

                        $html .= '</tbody>
                                </table>

                                </div>';
                            }
$html.='
<br><br>
<div style="text-align:center;">
<img src="upload/Graph/image.png">
</div>
';
                    if ($all_events == 1) {
                        $header="<h4 style='text-align:center;'>  Number of New Cases </h4>";
                    } elseif ($all_events == 2) {
                        $header="<h4 style='text-align:center;'>  Number of Closed Cases </h4>";
                    }  elseif ($all_events == 4) {
                        $header="<h4 style='text-align:center;'>  Dollars Spent on Client Costs </h4>";
                    } elseif ($all_events == 5) {
                        $header="<h4 style='text-align:center;'>  Number of Medical Records Received </h4>";
                    } elseif ($all_events == 6) {
                        $header="<h4 style='text-align:center;'>  Number of Medical Records Requested </h4>";
                    } elseif ($all_events == 7) {
                        $header="<h4 style='text-align:center;'>  Number of Documents Generated </h4>";
                    }elseif ($all_events == 8) {
                        $header="<h4 style='text-align:center;'>  The Date a Case was converted to Open </h4>";
                    }
                    $pdf->SetHTMLHeader($header);
                    $pdf->AddPage('P');
                    $pdf->WriteHTML($html);
                    ob_clean();
                    $pdf->Output("custom_report_c.pdf", 'I');
       } else{

        $pdf = new mPDF('en', 'A4', '12', 'DejaVuSansCondensed', 10, 10, 10, 16, 9, 9);
        $date =   date("Y/m/d");
        $html  = '<p>Date: '.$date.'</p>';
        $html .= '<br><br><div class="close_cases_information">
                <table border=1 style="width: 100%; border-collapse: collapse;"  id="close_cases_pdf" class="table table-bordered table-responsive">
                <thead>
                <tr style="font-weight:bold;font-size:15px;">
                <th  style="width:50%;" >'. (($period_radio == "day") ? "Day" : "Month" ). '</th>
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
                }elseif ($all_events == 8) {
                    $html .= '<th style="width:50%;"> Number Converted Cases </th>';
                   }


       $html .= '
                </tr>
                </thead>
                <tbody>';
        foreach ($closed_cases as $key => $value) {
            $closed_cases_val = $value['closed_cases'];
            $month_name=MonthFunction($key);
            $key_u = $key.'-'.$all_month_d.'-'.$year_text;
            $html .= '<tr>
                <td style="text-align: center;">' . (($period_radio == "day") ? $key_u : $month_name )  . '</td>
                <td style="text-align: center;">' . $closed_cases_val . '</td>
                </tr>';
        }
        $html .= '</tbody>
                </table>
                <img src="upload/Graph/image.png">
                </div>';

                $pdf->SetHTMLHeader($header);
                $pdf->AddPage('P');
                $pdf->WriteHTML($html);
                ob_clean();
                $pdf->Output("custom_report_c.pdf", 'I');
            }
                // }

}
if($_SERVER['REQUEST_METHOD'] !== 'POST' ) {
$smarty->display("custom/modules/Cases/tpls/case_reports.tpl");
}


function MonthFunction($key){
    $month_name = "";
    $monthNames = [
              "December", "January", "February", "March", "April",
              "May", "June", "July", "August", "September", "October", "November"
              ];
    $month_name = $monthNames[$key % 12];

    return $month_name;
}
function getQueryResult($all_events,$all_day="",$all_month_d="",$all_years="")
{
    if($all_events==1){
        $sql = "SELECT COUNT(id) as Count, cases.id, cases.name, cases.assigned_user_id ,
        DAY(date_entered) as 'Day',
        DAYNAME(date_entered) as 'Day Name',
        MONTHNAME(date_entered) as 'Month Name',
        YEAR(date_entered) as 'Year Name'
        FROM cases
        WHERE deleted=0 AND  DAY(date_entered) = {$all_day} AND  MONTH(date_entered) = {$all_month_d}
        AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR)
        GROUP BY date_entered , id , cases.name , assigned_user_id";

    }else if($all_events==2){
        $sql = "SELECT  cases.state , COUNT(*) as count, cases.id, cases.name, cases.assigned_user_id
                        FROM cases
                        WHERE MONTH(date_entered) = {$all_month_d} AND  DAY(date_entered) = {$all_day}
                        AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) AND deleted = 0
                        GROUP BY  date_entered,id,cases.name,assigned_user_id,cases.state;
                        ";
    }else if($all_events==3){
        $sql = "SELECT id FROM cases WHERE MONTH(date_entered) = {$all_month_d} AND  DAY(date_entered) = {$all_day}
        AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) AND deleted = 0";
    }else if($all_events==4){
        $sql = "SELECT ROUND(SUM(total_amount),2) as total, COUNT(*) as count
        FROM cost_client_cost
        WHERE MONTH(date_entered) = {$all_month_d} AND  DAY(date_entered) = {$all_day}
        AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) AND deleted = 0 ";
    }else if($all_events==5){
        $sql = "SELECT status_id,id,document_name,assigned_user_id, COUNT(*) as count
                        FROM medr_medical_records
                        WHERE MONTH(date_entered) = {$all_month_d} AND  DAY(date_entered) = {$all_day}
                        AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) AND deleted = 0
                        GROUP BY status_id,id,document_name,assigned_user_id, DAY(date_entered)
                        ";
    }else if($all_events==6){
        $sql = "SELECT status_id,id,document_name,assigned_user_id, COUNT(*) as count
                        FROM medr_medical_records
                        WHERE MONTH(date_entered) = {$all_month_d} AND  DAY(date_entered) = {$all_day}
                        AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR) AND deleted = 0
                        GROUP BY status_id, DAY(date_entered),id,document_name,assigned_user_id";
    }else if($all_events==7){
        $sql = "SELECT id , document_name  ,hard_or_soft_doc , assigned_user_id FROM documents WHERE MONTH(date_entered) = {$all_month_d}  AND  DAY(date_entered) = {$all_day}
                        AND YEAR(date_entered) = {$year_text} AND deleted = 0";
    }else if($all_events==8){
        $sql = "SELECT COUNT(id) as Count, cases.id, cases.name, cases.assigned_user_id , cases.date_entered  ,
        DAY(date_entered) as 'Day',
        DAYNAME(date_entered) as 'Day Name',
        MONTHNAME(date_entered) as 'Month Name',
        YEAR(date_entered) as 'Year Name'
        FROM cases
        WHERE deleted=0 AND  MONTH(date_entered) = {$all_month_d}
        AND  DAY(date_entered) = {$all_day}
        AND YEAR(date_entered) = YEAR(CURDATE() - INTERVAL {$all_years} YEAR)
        GROUP BY date_entered , id , cases.name , assigned_user_id";
    }
    $result = $db->query($sql, true);
    return $result;

}
