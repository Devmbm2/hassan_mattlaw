<?php
require_once('include/MVC/View/views/view.edit.php');
class FP_eventsViewEdit extends ViewEdit {
   public function __construct(){
 		parent::__construct();
 		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
 	}
	function display() {
		global $current_user;
		if(empty($this->bean->id)){
			/* $this->bean->multiple_assigned_users = $current_user->id;	 */
			$this->bean->assigned_user_id = $current_user->id;	
		}
		$formName = $this->ev->formName;
		if(empty($formName)){
			$formName = 'EditView';
		}
		if($_REQUEST['isDuplicate'] == 'true'){
			$this->bean->name  = str_replace('Cancelled', ' ', $this->bean->name);
		}
		parent::display();
		if($_REQUEST['isDuplicate'] == 'true'){	
			echo "
				<script type='text/javascript'>
					$(document).ready(function(){
						console.log('htht2');
						$('#cancelled_reset_c').val('');
					});	
				</script> 
			";
		}
		/* print"<pre>";print_r($_REQUEST); */
		
		echo "
				<script type='text/javascript'>
				var redirect = '';
					redirect = '{$_REQUEST['redirect']}';
						console.log('redirect');
						console.log(redirect);
					$(document).ready(function(){
						var formName = '{$formName}';
						
					});	
					

				</script> 
			";
		if($_REQUEST['redirect'] == '1'){
			echo '
				<script type="text/javascript">
					$(document).ready(function(){
						$("#CANCEL")[0].onclick = null;
						$("#CANCEL").click(function() { SUGAR.ajaxUI.loadContent("index.php?module=Calendar&action=index");});
						$("#SAVE")[0].onclick = null;
						$("#SAVE").click(function() {
							var _form = document.getElementById(formName); _form.action.value=\'Save\';_form.return_module.value=\'Calendar\';_form.return_action.value=\'index\';if(custom_validation())if(check_cancel_reset())if(check_form(formName))SUGAR.ajaxUI.submitForm(_form);return false;
							
						});
						
					});	
				</script> 
			';
		}
		echo "<script type='text/javascript' src='cache/include/javascript/sugar_grp_yui_widgets.js'></script>";
		 echo '<link href="custom/include/multiselect/multiselect.css" rel="stylesheet" />';

			    echo '<script type="text/javascript" src="custom/include/multiselect/multiselect.js"></script>';
			 	echo "
				<script type='text/javascript'>
					$(document).ready(function(){
						
						$('#'+ formName +' #assigned_user_name').parent().parent().hide();
						
						$('#'+ formName +' #multiple_assigned_users').multiselect({
							columns: 1,
							placeholder: 'Select Multiple Assigned Users',
							search: true,
							selectAll: true
						});
						
					});
					$('#primary_address_street').css('width','45%');
					$('#primary_address_street').css('height','30px');
				</script> 
			";
			if(empty($this->bean->id) && isset($_REQUEST['cases_fp_events_1cases_ida']) && !empty($_REQUEST['cases_fp_events_1cases_ida'])){
				$case = BeanFactory::getBean('Cases', $_REQUEST['cases_fp_events_1cases_ida']);
				/* echo $case->assigned_user_id; */
				$this->bean->multiple_assigned_users = $case->assigned_user_id;	
				/* print"<pre>";print_r($_REQUEST['cases_fp_events_1cases_ida']); */
				echo "
				<script type='text/javascript'>
					$(document).ready(function(){
						var related_case_assigned_user_id = '{$case->assigned_user_id}';
						$('#'+ formName + ' #multiple_assigned_users option[value='+ related_case_assigned_user_id+']').attr('selected', 'selected');
						$('#'+ formName + ' #multiple_assigned_users').multiselect( 'reset' );
					});
				</script> 
				";
			}
		/*  if(empty($this->bean->id)){
			echo "
				<script type='text/javascript'>
					$(document).ready(function(){
						var current_user = '{$current_user->id}';
						$('#'+ formName +' #multiple_assigned_users').val(current_user).trigger('change.select2');
					});
				</script> 
			";
		} */
	
	}
}
?>
