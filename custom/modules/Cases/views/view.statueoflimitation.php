<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
require_once 'modules/Cases/views/view.edit.php';
class CasesViewstatueoflimitation extends CasesViewEdit
{
	/* public function preDisplay(){
        $metadataFile = $this->getMetaDataFile();
		// print_r($metadataFile);
        $this->ev = new EditView2();
        $this->ev->ss =&  $this->ss;
        $this->ev->setup($this->module, $this->bean, $metadataFile,'custom/modules/Cases/tpls/store.tpl');
		// print_r($metadataFile);
        // if($this->bean->status!='active'){
			// SugarApplication::redirect("index.php?module=Cases&action=intakeForm");
        // }
    } */
    public function display()
    {
        
    
		global $app_list_strings;
       
		// parent::display();
		$smarty = new Sugar_Smarty();
     
        $complaint_type_list=($app_list_strings['complaint_type_list']);
 
   
        //$states_dom1=explode('\n',$states_dom);
     
        //$states_dom=str_split($states_dom,'\n');
       
		$smarty->assign('complaint_type_list',$complaint_type_list);
		$smarty->assign('sol_time', get_select_options($app_list_strings['sol_time'], ""));
		$smarty->assign('complaint_type_list_new', get_select_options($app_list_strings['complaint_type_list_new'], ""));
		$smarty->assign('states_dom', get_select_options($app_list_strings['states_dom'], ""));
		$smarty->assign('sol_category', get_select_options($app_list_strings['sol_category'], ""));

//         $smarty->assign('sols_radios', array(
//             1000 => 'Days',
//             1001 => 'Months',
//             1002 => 'Years'));
// $smarty->assign('sols_id', 1001);

        $statueoflimitationPage = $smarty->fetch('custom/modules/Cases/tpls/statueoflimitation.tpl');
        echo $statueoflimitationPage;
		// echo "casetypeview";
		// die();
    }
}