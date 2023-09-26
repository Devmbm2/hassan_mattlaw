<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
require_once 'modules/Leads/views/view.edit.php';
class LeadsViewIntakeform extends LeadsViewEdit
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
        // $smarty->assign('storeName', $store->storeName);
        // $smarty->assign('location', $store->location);
        // $smarty->assign('products', $store->products);
		$smarty->assign('case_type_list', get_select_options($app_list_strings['case_type_list'], ""));
        $intakeformPage = $smarty->fetch('custom/modules/Leads/tpls/intakeForm.tpl');
        echo $intakeformPage;
		// echo "casetypeview";
		// die();
    }
}