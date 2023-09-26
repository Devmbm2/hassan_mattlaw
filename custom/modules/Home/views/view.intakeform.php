<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class HomeViewIntakeform extends SugarView
{
    public function display()
    {

		global $app_list_strings;
		$smarty = new Sugar_Smarty();
		$smarty->assign('intakeform_type_list', get_select_options($app_list_strings['intakeform_case_type_list'], ""));
		$smarty->assign('states_list', get_select_options($app_list_strings['states_dom'], ""));
		$smarty->assign('search_module', $_REQUEST['search_module'], "");
        $intakeformPage = $smarty->fetch('custom/modules/Home/tpls/intakeForm.tpl');
        echo $intakeformPage;
		// echo "casetypeview";
		// die();
    }
}