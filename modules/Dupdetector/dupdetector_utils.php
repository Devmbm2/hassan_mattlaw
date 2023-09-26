<?php

/*
  Created By : Urdhva Tech Pvt. Ltd.
  Created date : 09/29/2017
  Contact at : contact@urdhva-tech.com
  Web : www.urdhva-tech.com
  Skype : urdhvatech
  Module : Dupdetector 1.2
 */
/* * *
 * check for duplicate value
 */
/*
 * Fetch Fields from given module
 * @param   object
 * @param   module name
 * @return  array  fields
 */

function fetch_field_list(&$focus, $mod_name, $type = 'all') {

    $GLOBALS['log']->debug("Dupdetector :: fetch_field_list start for module {$mod_name}");

    $global_linked_modules_to_ignore = array("Teams", "Currencies");
    $global_fields_to_ignore = array('deleted', 'id', 'team_id', 'team_set_id', 'email1', 'email2', 'date_modified', 'date_entered', 'modified_user_id', 'assigned_user_id');
    $supported_type = array('varchar', 'name', 'phone');
    $linked_modules_to_ignore = array('EmailAddresses');
    $sources_to_ignore = array('non-db');


    global $current_language;
    $temp_module_strings = return_module_language($current_language, $mod_name);
    $fields = array();
    $required = array();
    foreach ($focus->field_defs as $field_def) {
        if (in_array($field_def['type'], $supported_type)) {
            // escape calculated fields - PRO+ versions
            if (isset($field_def['calculated']) && $field_def['calculated'] == true)
                continue;
            if (empty($field_def['source'])) //Undefined index
                $field_def['source'] = '';
            if (!in_array($field_def['source'], $sources_to_ignore)) {
                if (!in_array($field_def['name'], $global_fields_to_ignore)) {
                    //Don't show fields without a field label
                    if (isset($field_def['vname']) && isset($temp_module_strings[$field_def['vname']]) && !empty($temp_module_strings[$field_def['vname']])) {
                        //Strip colons
                        $lbl = translate($field_def['vname'], $mod_name);
                        $lbl = preg_replace("/:/", "", $lbl);
                        $fields[$field_def['name']] = $lbl;
                    }
                }
            }
        }
    }
    asort($fields);
    $GLOBALS['log']->debug("Dupdetector :: fetch_field_list end for module {$mod_name}");
    return $fields;
}

/*
 * Fetch module list to display
 * @param   void
 * @return  Array
 */

function dup_getModuleList() {
    $GLOBALS['log']->debug("Dupdetector :: dup_getModuleList Start");
    $aIgnoreModule = array('Activities', 'Dupdetector');
    global $app_list_strings;
    require_once 'modules/ModuleBuilder/parsers/relationships/DeployedRelationships.php';
    $relatableModules = DeployedRelationships::findRelatableModules(false);
    $ret = array();
    foreach ($relatableModules as $module => $other) {
        if (in_array($module, $aIgnoreModule))
            continue;
        if (!empty($app_list_strings['moduleList'][$module]))
            $ret[$module] = $app_list_strings['moduleList'][$module];
        else
            $ret[$module] = $module;
    }
    $GLOBALS['log']->debug("Dupdetector :: dup_getModuleList End");
    return $ret;
}

/* * *
 * add field to view
 * 
 * @param object $oModule
 * @param array $layoutFields
 * @param string $view
 * @param array $modifylayoutfields
 */

function ut_addField2View($oModule, $layoutFields, $view, $modifylayoutfields = array()) {

    $GLOBALS['log']->debug("Dupdetector :: ut_addField2View Start for module {$oModule->module_dir}");
    $parser = ParserFactory::getParser($view, $oModule->module_dir);
    foreach ($parser->_viewdefs['panels'] as $panelName => $panel) {
        foreach ($panel as $rowIndex => $panelRow) {
            foreach ($panelRow as $columnIndex => $panelColumn) {
                if (is_array($panelColumn) && isset($panelColumn['name'])) {
                    $fieldName = $panelColumn['name'];
                } else {
                    $fieldName = $panelColumn;
                }
                if (array_key_exists($fieldName, $layoutFields)) {
                    $parser->_viewdefs['panels'][$panelName][$rowIndex][$columnIndex] = $layoutFields[$fieldName];
                    unset($layoutFields[$fieldName]);
                }
            }
        }
    }
    if ($view == 'quickcreate') {
        $deffile = 'quickcreatedefs';
        $defview = 'QuickCreate';
    } else {
        $deffile = 'editviewdefs';
        $defview = 'EditView';
    }
    //Need to remove
    $path = "modules/{$oModule->module_dir}/metadata/{$deffile}.php";
    if (sugar_is_file("custom/{$path}")) {
        include("custom/{$path}");
    } else {
        include("{$path}");
    }
    $fieldindefs = array();
    if (isset($viewdefs [$oModule->module_dir][$defview]['panels'])) {
        $module_view = $viewdefs [$oModule->module_dir][$defview]['panels'];
        foreach ($module_view as $panelName => $panel) {
            foreach ($panel as $rowIndex => $panelRow) {
                foreach ($panelRow as $columnIndex => $panelColumn) {
                    if (is_array($panelColumn) && isset($panelColumn['name']) && isset($panelColumn['type']) && $panelColumn['type'] == 'dupdetector') {
                        if (isset($modifylayoutfields[$panelColumn['name']])) {
                            $parser->_viewdefs['panels'][$panelName][$rowIndex][$columnIndex] = $modifylayoutfields[$panelColumn['name']];
                        }
                    }
                }
            }
        }
    }
    $parser->handleSave(false);
    $GLOBALS['log']->debug("Dupdetector :: ut_addField2View Start for module {$oModule->module_dir}");
}

/* * *
 * get result based on search criteria
 * @param    object  module_object
 * @param    array   fields_array
 * @param    bool   encode
 * @param    bool    deleted
 */

function get_duplicate_string($module_object, $fields_array, $encode = true, $deleted = true) {
    global $db;
    $where_clause = "";
    $return_array = array();
    foreach ($fields_array as $name => $value) {
        if (!empty($where_clause)) {
            $where_clause .= " AND ";
        }
        $name = $db->getValidDBName($name);
        switch ($module_object->field_name_map[$name]['type']) {
            case 'phone':
                $value = $db->quoted($value, false);
                $where_clause .= get_replace_string_phone($name) . " = " . get_replace_string_phone($value);
                break;
            default :
                $value = $db->quoted($value, false);
                $where_clause .= get_replace_string($name) . " = " . get_replace_string($value);
                break;
        }
    }
    if (!empty($where_clause)) {
        $where_clause = "WHERE $where_clause AND deleted=0";
    }
    if (function_exists('getCustomJoin')) {
        $custom_join = $module_object->getCustomJoin();
    } else {
        $custom_join = $module_object->custom_fields->getJOIN();
    }
    $query = "SELECT $module_object->table_name.*" . $custom_join['select'] . " FROM $module_object->table_name " . $custom_join['join'];
    $query .= " $where_clause";
    $result = $db->query($query, true);
    if (empty($result)) {
        return null;
    } else {
        while ($row = $db->fetchByAssoc($result, $encode)) {
            $return_array[] = $module_object->convertRow($row);
        }
    }
    return $return_array;
}

/**
 * create a where clause for string to strip special punctuation marks for phone no
 * @str  string 
 * @return replace string 
 */
function get_replace_string_phone($str) {
    $aPattern = array(' ', '(', ')', '-', '+', '[', ']');
    $replace = '';
    foreach ($aPattern as $char) {
        if (empty($replace)) {
            $replace .= "REPLACE({$str}, ' ', '')";
        } else {
            $replace = "REPLACE(" . $replace . ",'{$char}','')";
        }
    }
    return $replace;
}

/**
 * create a where clause for string to strip special punctuation marks
 * @str  string 
 * @return replace string 
 */
function get_replace_string($str) {
    $aPattern = array(' ', '.', ')', '(', '-', '+', ',', '/');
    $replace = '';
    foreach ($aPattern as $char) {
        if (empty($replace)) {
            $replace .= "REPLACE({$str}, ' ', '')";
        } else {
            $replace = "REPLACE(" . $replace . ",'{$char}','')";
        }
    }
    return $replace;
}