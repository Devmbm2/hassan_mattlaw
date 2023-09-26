<?php
if(ACLController::checkAccess('PLEA_Pleadings', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=PLEA_Pleadings&action=index&return_module=PLEA_Pleadings&return_action=DetailView&clear_query=true&filter_module=recently_saved",
        'Recently Saved',
        'List',
        'PLEA_Pleadings'
     );
}
?>

