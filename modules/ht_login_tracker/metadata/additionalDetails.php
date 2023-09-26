<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

function additionalDetailsht_login_tracker($fields){
    static $mod_strings;
    global $app_strings;
    if (empty($mod_strings)){
        global $current_language;
        $mod_strings = return_module_language($current_language, 'ht_login_tracker');
    }
    $overlib_string = '';

    if (!empty($fields['DESCRIPTION'])){
        $overlib_string .= $fields['DESCRIPTION'] . '<br>';
    }

    return array(
        'fieldToAddTo' => 'NAME',
        'string' => $overlib_string,
        'editLink' => "index.php?action=EditView&module=ht_login_tracker&return_module=ht_login_tracker&record={$fields['ID']}",
        'viewLink' => "index.php?action=DetailView&module=ht_login_tracker&return_module=ht_login_tracker&record={$fields['ID']}"
    ); 
}
