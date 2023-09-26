<?php
require_once('include/MVC/View/views/view.edit.php');
class TasksViewEdit extends ViewEdit {
public function __construct()
 	{
 		parent::__construct();
		$this->useForSubpanel = true;
		$this->useModuleQuickCreateTemplate = true;
 	}

function display() {
        parent::display();
		echo "<link href='custom/include/select2/css/select2.min.css' rel='stylesheet' type='text/css'/>";
		echo "<script type='text/javascript' src='custom/include/select2/js/select2.min.js'></script> ";
		echo '<link href="custom/include/multiselect/multiselect.css" rel="stylesheet" />';
		echo '<script type="text/javascript" src="custom/include/multiselect/multiselect.js"></script>';
		echo '<script type="text/javascript" src="custom/modules/Tasks/js/editview.js"></script>';
		echo '<script type="text/javascript" src="cache/include/javascript/sugar_grp_yui_widgets.js"></script>';
		echo "
			<script type='text/javascript'>
				$(document).ready(function(){
					$('#multiple_assigned_users').multiselect({
							columns: 1,
							placeholder: 'Select Multiple Assigned Users',
							search: true,
							selectAll: true
						});
				});
			</script> 
		";
}

}
?>
