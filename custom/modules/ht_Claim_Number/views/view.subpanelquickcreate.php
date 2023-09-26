<?php
require_once('include/EditView/SubpanelQuickCreate.php');

class ht_Claim_NumberSubpanelQuickcreate extends SubpanelQuickCreate {

public function ht_Claim_NumberSubpanelQuickcreate() {
    // pre($_REQUEST);
    $currentmodule=$_REQUEST['return_module'];
    if($currentmodule=='Accounts')
    {
        // $_REQUEST['parent_type']=$_REQUEST['return_module'];
        $_REQUEST['account_id']=$_REQUEST['return_id'];
        $_REQUEST['account_name'] = $_REQUEST['return_name'];

    }
    // pre($_REQUEST);
    parent::SubpanelQuickCreate("ht_Claim_Number");

}
}
