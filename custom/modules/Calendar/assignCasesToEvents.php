<?php
// Combine the arrays into an associative array
$combined = array_combine($_REQUEST['NameOfEvents'], $_REQUEST['SelectedCases']);

foreach ($combined as $eventid => $caseId) {
    // Output the event name and case ID
    if($caseId==""){
        continue;
    }
    $bean=BeanFactory::getBean('FP_events',$eventid);
    $bean->cases_fp_events_1cases_ida=$caseId;
    $bean->cases_fp_events_1fp_events_idb=$eventid;
    $bean->save();
}
header('Location: index.php?module=Calendar&action=index');
exit;
// print_r($_REQUEST);
// pre($combined);
// $str = html_entity_decode($_REQUEST['AssignedCasesToEvents']); // decode HTML entities
// $arr = json_decode($str, true); // convert to PHP array
// foreach ($arr as $item) {
//     $bean=BeanFactory::getBean('FP_events',$item['eventID']);
//     $bean->cases_fp_events_1cases_ida=$item['caseID'];
//     $bean->cases_fp_events_1fp_events_idb=$item['eventID'];
//     $bean->save();
//     // $query="INSERT IsNTO `cases_fp_events_1_c`(`id`, `deleted`, `cases_fp_events_1cases_ida`, `cases_fp_events_1fp_events_idb`) VALUES ('".create_guid()."','0','".$item['caseID']."','".$item['eventID']."')";
//     // print_r($query);

// }

?>
