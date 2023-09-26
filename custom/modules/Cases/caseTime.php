<?php
$case_id = $_REQUEST['case_time'];
$attorney_hours = $_REQUEST['attorney_hours'];
$attorney_minutes = $_REQUEST['attorney_minutes'];
$paralegal_hours = $_REQUEST['paralegal_hours'];
$paralegal_minutes = $_REQUEST['paralegal_minutes'];
$legal_assistant_hours = $_REQUEST['legal_assistant_hours'];
$legal_assistant_minutes = $_REQUEST['legal_assistant_minutes'];
$document_hours = $_REQUEST['document_hours'];
$document_minutes = $_REQUEST['document_minutes'];
$case_bean = BeanFactory::getBean('Cases',$case_id);
$case_bean->attorney_duration_hours_c = $attorney_hours;
$case_bean->attorney_duration_minutes_c = $attorney_minutes;
$case_bean->paralegal_duration_hours_c = $paralegal_hours;
$case_bean->paralegal_duration_minutes_c = $paralegal_minutes;
$case_bean->legal_assistant_duration_hours_c = $legal_assistant_hours;
$case_bean->legal_assistant_duration_minutes_c = $legal_assistant_minutes;
$case_bean->document_duration_hours_c = $document_hours;
$case_bean->document_duration_minutes_c = $document_minutes;
$case_bean->save();
header("Location:index.php?module=Administration&action=CaseTime");
?>