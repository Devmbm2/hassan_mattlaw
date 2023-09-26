<?php
	if(ACLController::checkAccess('Documents', 'import', true))$module_menu[] =Array("index.php?module=Import&action=Step1&import_module=Documents&return_module=Documents&return_action=index", $mod_strings['LNK_IMPORT_DOCUMENTS'],"Import", 'Documents');
    $module_menu[] = array(
        "index.php?module=Documents&action=index&return_module=Documents&return_action=DetailView&clear_query=true&filter_module=recently_saved",
        'Recently Saved',
        'List',
        'Documents'
     );


