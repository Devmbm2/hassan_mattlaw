<?php

if(ACLController::checkAccess('DISC_Discovery', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=DISC_Discovery&action=index&return_module=DISC_Discovery&return_action=DetailView&clear_query=true&filter_module=qc1_inbox",
        'QC1 Inbox',
        'List',
        'DISC_Discovery'
     );

 }

if(ACLController::checkAccess('DISC_Discovery', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=DISC_Discovery&action=index&return_module=DISC_Discovery&return_action=DetailView&clear_query=true&filter_module=qc1_failed",
        'QC1 Failed',
        'List',
        'DISC_Discovery'
     );

 }

 if(ACLController::checkAccess('DISC_Discovery', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=DISC_Discovery&action=index&return_module=DISC_Discovery&return_action=DetailView&clear_query=true&filter_module=qc1_fixed",
        'QC1 Fixed',
        'Add',
        'DISC_Discovery'
     );

 }


 if(ACLController::checkAccess('DISC_Discovery', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=DISC_Discovery&action=index&return_module=DISC_Discovery&return_action=DetailView&clear_query=true&filter_module=qc2_inbox",
        'QC2 Inbox',
        'Import',
        'DISC_Discovery'
     );

 }

 if(ACLController::checkAccess('DISC_Discovery', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=DISC_Discovery&action=index&return_module=DISC_Discovery&return_action=DetailView&clear_query=true&filter_module=qc2_failed",
        'QC2 Failed',
        'List',
        'DISC_Discovery'
     );

 }

 if(ACLController::checkAccess('DISC_Discovery', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=DISC_Discovery&action=index&return_module=DISC_Discovery&return_action=DetailView&clear_query=true&filter_module=assistant_pass",
        'QC2 Pass',
        'List',
        'DISC_Discovery'
     );

 }
 if(ACLController::checkAccess('DISC_Discovery', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=DISC_Discovery&action=index&return_module=DISC_Discovery&return_action=DetailView&clear_query=true&filter_module=discovery_matrix",
        'D Matrix Not Done',
        'List',
        'DISC_Discovery'
     );

 }



 $module_menu[] = array(
    "index.php?module=DISC_Discovery&action=index&return_module=DISC_Discovery&return_action=DetailView&clear_query=true&filter_module=recently_saved",
    'Recently Saved',
    'List',
    'DISC_Discovery'
 );
?>

