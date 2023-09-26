<?php
/*
   Created By : Urdhva Tech Pvt. Ltd.
 Created date : 09/29/2017
   Contact at : contact@urdhva-tech.com
          Web : www.urdhva-tech.com
        Skype : urdhvatech
       Module : Dupdetector 1.2
*/
require_once('include/SugarFields/Fields/Base/SugarFieldBase.php');
class SugarFieldDupdetector extends SugarFieldBase {
    function getEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {
        global $current_language, $sugar_flavor,$theme;
        $this->setup($parentFieldArray, $vardef, $displayParams, $tabindex);
        $module_language= return_module_language($current_language,'Dupdetector');
        $this->ss->assign('mdoule_language', $module_language);
        if($sugar_flavor != 'CE')
            $this->ss->assign('info_inline', "themes/Sugar/images/helpInline.png");
        else
            $this->ss->assign('info_inline', "themes/{$theme}/images/helpInline.gif");
        return parent::getEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex);
    }
}