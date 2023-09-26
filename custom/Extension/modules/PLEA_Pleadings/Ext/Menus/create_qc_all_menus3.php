<?php

if(ACLController::checkAccess('PLEA_Pleadings', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=PLEA_Pleadings&action=index&return_module=PLEA_Pleadings&return_action=DetailView&clear_query=true&filter_module=qc1_inbox",
        'QC1 Inbox',
        'List',
        'PLEA_Pleadings'
     );

 }

if(ACLController::checkAccess('PLEA_Pleadings', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=PLEA_Pleadings&action=index&return_module=PLEA_Pleadings&return_action=DetailView&clear_query=true&filter_module=qc1_failed",
        'QC1 Failed',
        'List',
        'PLEA_Pleadings'
     );

 }

 if(ACLController::checkAccess('PLEA_Pleadings', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=PLEA_Pleadings&action=index&return_module=PLEA_Pleadings&return_action=DetailView&clear_query=true&filter_module=qc1_fixed",
        'QC1 Fixed',
        'Add',
        'PLEA_Pleadings'
     );

 }


 if(ACLController::checkAccess('PLEA_Pleadings', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=PLEA_Pleadings&action=index&return_module=PLEA_Pleadings&return_action=DetailView&clear_query=true&filter_module=qc2_inbox",
        'QC2 Inbox',
        'Import',
        'PLEA_Pleadings'
     );

 }

 if(ACLController::checkAccess('PLEA_Pleadings', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=PLEA_Pleadings&action=index&return_module=PLEA_Pleadings&return_action=DetailView&clear_query=true&filter_module=qc2_failed",
        'QC2 Failed',
        'List',
        'PLEA_Pleadings'
     );

 }

 if(ACLController::checkAccess('PLEA_Pleadings', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=PLEA_Pleadings&action=index&return_module=PLEA_Pleadings&return_action=DetailView&clear_query=true&filter_module=assistant_pass",
        'QC2 Pass',
        'List',
        'PLEA_Pleadings'
     );

 }
 if(ACLController::checkAccess('PLEA_Pleadings', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=PLEA_Pleadings&action=index&return_module=PLEA_Pleadings&return_action=DetailView&clear_query=true&filter_module=recently_saved",
        'Recently Saved',
        'List',
        'PLEA_Pleadings'
     );
}
?>

