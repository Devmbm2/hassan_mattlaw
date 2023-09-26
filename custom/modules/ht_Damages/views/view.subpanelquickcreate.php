<?php
require_once('include/EditView/SubpanelQuickCreate.php');

class ht_DamagesSubpanelQuickcreate extends SubpanelQuickCreate {



public function ht_DamagesSubpanelQuickcreate() {
    $currentmodule=$_REQUEST['return_module'];
    if($currentmodule=='Cases')
    {
        // $_REQUEST['parent_type']=$_REQUEST['return_module'];
        $_REQUEST['case_id']=$_REQUEST['return_id'];
        $_REQUEST['case_name'] = $_REQUEST['return_name'];
    
    }
    parent::SubpanelQuickCreate("ht_Damages");

}
}