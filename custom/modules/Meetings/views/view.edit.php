<?php
require_once('include/MVC/View/views/view.edit.php');
class MeetingsViewEdit extends ViewEdit {
        function MeetingsViewEdit(){
        parent::ViewEdit();
}

	function display() {

		parent::display();
		echo "<link href='custom/include/select2/css/select2.min.css' rel='stylesheet' type='text/css'/>";
		echo "<script type='text/javascript' src='custom/include/select2/js/select2.min.js'></script> ";
		echo "
			<script type='text/javascript'>
				$(document).ready(function(){
					$('#multiple_assigned_users').select2();
				});
			</script> 
		";
	}
}
?>
