<?php
require_once('include/MVC/View/views/view.detail.php');
class TasksViewDetail extends ViewDetail {
        function TasksViewDetail(){
        parent::ViewDetail();
}

function display() {
        parent::display();
		echo '<div class="message_dialog_div" id="message_dialog_div" style="display:none;  background-color:white;">
			<div class="message_dialog" id="message_dialog" style="background-color:white;">
			</div>
		</div>';
		echo '<script type="text/javascript" src="custom/modules/Tasks/js/detailview.js"></script>';
}

}
?>
