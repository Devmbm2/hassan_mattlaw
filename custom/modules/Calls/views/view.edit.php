<?php
require_once('include/MVC/View/views/view.edit.php');
class CallsViewEdit extends ViewEdit {
	public function __construct()
 	{
 		parent::__construct();
 		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
 	}
 /*        function CallsViewEdit(){
        parent::ViewEdit();
		
} */

	function display() {
		global $current_user;
		if(empty($this->bean->id)){
			$this->bean->multiple_assigned_users = $current_user->id;
		}
		$formName = $this->ev->formName;
		if(empty($formName)){
			$formName = 'EditView';
		}
		parent::display();
		$time = time();
			echo "
				<script type='text/javascript'>
					$(document).ready(function(){
						var formName = '{$formName}';
						console.log(formName);
					});	
					

				</script> 
			";
		echo "<script type='text/javascript' src='custom/modules/Calls/js/edit.js?v={$time}'></script> ";
		echo "<link href='custom/include/select2/css/select2.min.css' rel='stylesheet' type='text/css'/>";
		echo "<script type='text/javascript' src='custom/include/select2/js/select2.min.js'></script> ";
		echo '<link href="custom/include/multiselect/multiselect.css" rel="stylesheet" />';
		echo '<script type="text/javascript" src="custom/include/multiselect/multiselect.js"></script>';
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
				</script> ";
		if(empty($this->bean->id)){
			echo "
				<script type='text/javascript'>
					$(document).ready(function(){
						var current_user = '{$current_user->id}';
						$('#multiple_assigned_users').val(current_user).trigger('change.select2');
					});
				</script> 
			";
		}
	}
}
?>
