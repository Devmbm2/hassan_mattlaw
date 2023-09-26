<?php
require_once('include/MVC/View/views/view.detail.php');
class NEG_NegotiationsViewDetail extends ViewDetail {
	function NEG_NegotiationsViewDetail(){
		parent::ViewDetail();
	}

	function display() {

        parent::display();
		echo "<script  src='custom/include/javascript/visible/neg_case_type.js'></script>";
	}
}
?>
