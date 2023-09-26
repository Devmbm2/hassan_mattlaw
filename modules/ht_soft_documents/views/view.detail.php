<?php
require_once('include/MVC/View/views/view.detail.php');
class DocumentsViewDetail extends ViewDetail {
	function DocumentsViewDetail(){
		parent::ViewDetail();
	}

function display() {

	echo "<script type='text/javascript'>var bean = ".json_encode($this->bean->toArray()).";</script>
        <script type='text/javascript' src='custom/modules/Documents/js/hide_fields.js'></script>";
		if($_REQUEST['doc_url']){
		echo "<script type='text/javascript'>
		\$( document ).ready(function() {
			var win = window.open('{$_REQUEST['doc_url']}', '_blank');
			if (win == null || typeof(win)=='undefined') {  
				alert('Please disable your pop-up blocker and refresh this page'); 
			}else {  
				win.focus();
			}
		});
		</script>";
	}
        parent::display();
		echo "<script type='text/javascript' src='custom/modules/Documents/js/detail.js'></script>";
		
}

}
?>
