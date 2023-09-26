<?php
require_once('include/EditView/SubpanelQuickCreate.php');

class NotesSubpanelQuickcreate extends SubpanelQuickCreate {



public function NotesSubpanelQuickcreate() {
    $currentmodule=$_REQUEST['return_module'];
    if($currentmodule=='Contacts')
    {
        $_REQUEST['parent_type']=$_REQUEST['return_module'];
        $_REQUEST['parent_id']=$_REQUEST['return_id'];
        $_REQUEST['parent_name'] = $_REQUEST['customcontact_name'];
    
    }
    parent::SubpanelQuickCreate("Notes");

}
}