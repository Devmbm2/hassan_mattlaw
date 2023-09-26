<?php
require_once('include/MVC/View/views/view.detail.php');
class FP_eventsViewDetail extends ViewDetail {
	function FP_eventsViewDetail(){
		parent::ViewDetail();
	}
	function display() {

		echo "<script type='text/javascript'>var bean = ".json_encode($this->bean->toArray()).";
		if(bean['type_c']!='Deposition'){
					$(\"[field='deponent_c']\").parent().html('');
			}
			if(bean['type_c']!='Deposition' && bean['type_c']!='Compulsory_Medical_Exam'){
					$(\"[field='videographer_c']\").parent().html('');
			}
			if(bean['type_c']!='Deposition' && bean['type_c']!='Trial' && bean['type_c']!='Hearing' && bean['type_c']!='Statement_Under_Oath'){
					$(\"[field='court_reporter_c']\").parent().html('');
			}
			if(bean['type_c']!='Deposition' && bean['type_c']!='Trial' && bean['type_c']!='Hearing' && bean['type_c']!='Mediation' && bean['type_c']!='Intake' && bean['type_c']!='Meeting'){
					$(\"[field='travel_start_c']\").parent().html('');
					$(\"[field='travel_end_c']\").parent().html('');
			}
		</script>";
			//<script type='text/javascript' src='custom/modules/FP_events/js/hide_fields.js'></script>";
			parent::display();
			if($_REQUEST['redirect'] == '1'){
				echo '
					<script type="text/javascript">
					$(document).ready(function(){
						$("#delete_button")[0].onclick = null;
						$("#delete_button").click(function() {
							var _form = document.getElementById("formDetailView"); 
							_form.return_module.value="Calendar";
							_form.return_action.value="index"; 
							_form.action.value="Delete"; 
							if(confirm("Are you sure you want to delete this record?")) 
							SUGAR.ajaxUI.submitForm(_form); 
							return false;
							
						});
						
					});	
					</script> 
				';
			}
	}
}
