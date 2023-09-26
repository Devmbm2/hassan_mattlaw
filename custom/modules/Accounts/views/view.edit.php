<?php
require_once('include/MVC/View/views/view.edit.php');
class AccountsViewEdit extends ViewEdit {
	
	 function __construct(){
        parent::__construct();
		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
    }
	
	function AccountsViewEdit(){
		parent::ViewEdit();
	}

function display() {

    parent::display();
		if($_REQUEST['return_module'] == 'Cases' && !empty($_REQUEST['return_id'])){
			echo "
				  <script type='text/javascript'>
					$( document ).ready(function() {
					  $('#case_role').parent().parent().show();
					});
				  </script>";
		}else{
			echo "
				  <script type='text/javascript'>
					$( document ).ready(function() {
					  $('#case_role').parent().parent().hide();
					});
				  </script>";
		}
}

}
