<?php
require_once('include/MVC/View/views/view.detail.php');
class AccountsViewDetail extends ViewDetail {
        function AccountsViewDetail(){
        parent::ViewDetail();
}

function display() {

	echo "<script type='text/javascript'>var bean = ".json_encode($this->bean->toArray()).";
	if(bean['account_type']!='Medical_Provider' && bean['expert_type_c']!='Medical'){
                $(\"[field='medicine_type_c']\").parent().html('');
        }
        if(bean['account_type']!='Expert_Witness'){
                $(\"[field='expert_type_c']\").parent().html('');
        }
	</script>";
        parent::display();
        echo '<link href="custom/include/multiselect/multiselect.css" rel="stylesheet" />';
	echo '<script type="text/javascript" src="custom/include/multiselect/multiselect.js"></script>';
	echo "<script type='text/javascript' src='custom/include/javascript/visible/org_type.js'></script>";
}
protected function _displaySubPanels()
    {
        if (isset($this->bean) && !empty($this->bean->id) && (file_exists('modules/' . $this->module . '/metadata/subpaneldefs.php') || file_exists('custom/modules/' . $this->module . '/metadata/subpaneldefs.php') || file_exists('custom/modules/' . $this->module . '/Ext/Layoutdefs/layoutdefs.ext.php'))) {
             $GLOBALS['focus'] = $this->bean;
             require_once ('include/SubPanel/SubPanelTiles.php');
             $subpanel = new SubPanelTiles($this->bean, $this->module);
	     if ($this->bean->account_type == "Court_Clerk")
                {
		    unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts']);
		    unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['leads']);
		    unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['accounts']);
		    unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['account_ht_address_book']);
		}
                //Dependent logic
                if (strpos($this->bean->type, "Companion") == false)
                {
                        unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['comp_companions_cases']);
                }

                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['activities']['order'] = 1;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['bugs']['order'] = 2;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['campaigns']['order'] = 3;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['cases']['order'] = 4;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['account_aos_contracts']['order'] = 5;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['documents']['order'] = 6;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['history']['order'] = 7;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['aos_invoices']['order'] = 8;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['accounts_ht_claim_number']['order'] = 9;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['opportunities']['order'] = 10;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['project']['order'] = 11;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['aos_quotes']['order'] = 12;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['medical_provider_account']['order'] = 13;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['securitygroups']['order'] = 14;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['soft_documents']['order'] = 15;                
                echo $subpanel->display();
        }
    }
}
?>
