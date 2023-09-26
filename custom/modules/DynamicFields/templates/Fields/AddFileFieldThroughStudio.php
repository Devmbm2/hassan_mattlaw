<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
                            //
require_once('modules/DynamicFields/templates/Fields/TemplateField.php');
class AddFileFieldThroughStudio extends TemplateField{
    var $type='file';
                            //
    function get_field_def(){
        $def = parent::get_field_def();
        $def['dbType'] = 'file';
        return $def;
    }
}
