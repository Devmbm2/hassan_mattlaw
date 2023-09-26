<?php

$case_id = $_REQUEST['case_id'];
$case_bean = BeanFactory::getBean('Cases', $case_id);
$caseTime = array();
$caseTime[]=['attorney_time_hour' => $case_bean->attorney_duration_hours_c,'attorney_time_minute'=>$case_bean->attorney_duration_minutes_c,'paralegal_time_hour' => $case_bean->paralegal_duration_hours_c, 'paralegal_time_minute' => $case_bean->paralegal_duration_minutes_c,'legal_time_hour' => $case_bean->legal_assistant_duration_hours_c,'legal_time_minute' => $case_bean->legal_assistant_duration_minutes_c,'document_time_hour' => $case_bean->document_duration_hours_c,'document_time_minute' => $case_bean->document_duration_minutes_c];
echo json_encode($caseTime);
die();
