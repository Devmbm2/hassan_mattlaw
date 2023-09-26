<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*
   Created By : Urdhva Tech Pvt. Ltd.
 Created date : 09/29/2017
   Contact at : contact@urdhva-tech.com
          Web : www.urdhva-tech.com
        Skype : urdhvatech
       Module : Dupdetector 1.2
*/
require_once('modules/DynamicFields/templates/Fields/TemplateField.php');
class TemplateDupdetector extends TemplateField{
	var $type='dupdetector';
    function get_field_def() {
        $def = parent::get_field_def();

        //IF WE HAVE A DEFAULT VALUE SET IT
        $def['default'] = !empty($this->default) ? $this->default : $this->default_value;

        $def['dbType'] = 'text';
        return $def;
    }
}
?>
