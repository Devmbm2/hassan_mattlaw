<?php
require_once('modules/Leads/views/view.edit.php');

class CustomLeadsViewEdit extends LeadsViewEdit {
 	public function __construct(){
 		parent::__construct();
 	}
 	function display(){
		 global $app_list_strings, $sugar_config, $db, $mod_strings, $current_user;
        if(!$current_user->isAdmin()) {
                echo "
                        <script type='text/javascript'>
                                $( document ).ready(function() {
                                       $('#assigned_user_name').attr('disabled',true);
                                       $('#btn_assigned_user_name').attr('disabled',true);
                                       $('#btn_clr_assigned_user_name').attr('disabled',true);
                                       });
                        </script>
                ";
        }
		if(empty($this->bean->fetched_row['id'])) {
		   $this->bean->assigned_user_id = "e4cd5835-f692-69de-3b3a-591598674c54";
		   $this->bean->assigned_user_name = "Matthew D. Powell";
		}
	
		parent::display();
			echo "
		<script type='text/javascript'>
			function limitation_warning(){				
				var case_type = $('#case_type_c').val();
				var date_of_incident = new Date($('#date_of_incident_c').val());
				var today = new Date();
				if(case_type == 'Medical_Malpractice' || case_type == 'Wrongful_Death'  || case_type == 'Medical_Malpractice_Pre_Suit'){
					date_of_incident.setDate(date_of_incident.getDate() + 729);
					var diff = new Date(date_of_incident - today);
					var days = diff/1000/60/60/24;
					if(days <= 60 && days>0){
						alert('Warning! The date of incident is less than 60 days from the statute of limitations. Please consult with Matt.');
						return false;
					}
					else if(days < 0){
						alert('Warning! The statute of limitations may have passed. Please consult with Matt.');
						return false;						
					}

					return true;
				}
				else{
					date_of_incident.setDate(date_of_incident.getDate() + 1459);
					var diff = new Date(date_of_incident - today);
					var days = diff/1000/60/60/24;
					if(days <= 60 && days>0){
						alert('Warning! The date of incident is less than 60 days from the statute of limitations. Please consult with Matt.');
						return false;
					}
					else if(days < 0){
						alert('Warning! The statute of limitations may have passed. Please consult with Matt.');
						return false;						
					}

					return true;
				}
			}
		</script>
		<script src='custom/modules/Leads/js/hidepanel.js' type='text/javascript'></script>
		";	
 	}	
}
