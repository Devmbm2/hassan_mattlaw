<?php
/*
   Created By : Urdhva Tech Pvt. Ltd.
 Created date : 09/29/2017
   Contact at : contact@urdhva-tech.com
          Web : www.urdhva-tech.com
        Skype : urdhvatech
       Module : Dupdetector 1.2
*/
class DupdetectorViewFieldConfig extends SugarView 
{
    public function __construct() {
        parent::__construct();
    }
    public function preDisplay()
    {
        require_once("modules/Dupdetector/dupdetector_utils.php");
        global $current_user, $app_strings,$mod_strings,$app_strings;
        if (!is_admin($current_user)) sugar_die($app_strings['ERR_NOT_ADMIN']);
        
        $smarty = new Sugar_Smarty();
        $smarty->assign("MOD",$mod_strings);
        $smarty->assign("app_strings",$app_strings);
        $admin=new Administration();
        $admin->retrieveSettings('checkdup',true);
        if(isset($admin->settings['checkdup_prevent_submit']) && $admin->settings['checkdup_prevent_submit'] == true)
            $smarty->assign("checkbox_value"," checked='checked' ");
        else
            $smarty->assign("checkbox_value","");
        $smarty->assign("MODULE_LIST_OPTION",get_select_options_with_id(dup_getModuleList(),""));
        $smarty->display("modules/Dupdetector/tpls/fieldconfig.tpl");
    }
}