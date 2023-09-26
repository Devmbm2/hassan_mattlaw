<?php
require_once('include/MVC/View/views/view.edit.php');
require_once('include/SugarTinyMCE.php');

class CasesViewEdit extends ViewEdit {

    function __construct(){
        parent::__construct();
		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
    }

    /**
     * @deprecated deprecated since version 7.6, PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code, use __construct instead
     */
    function CasesViewEdit(){
        $deprecatedMessage = 'PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code';
        if(isset($GLOBALS['log'])) {
            $GLOBALS['log']->deprecated($deprecatedMessage);
        }
        else {
            trigger_error($deprecatedMessage, E_USER_DEPRECATED);
        }
        self::__construct();
    }

    function display(){

	global $app_list_strings, $sugar_config, $db, $mod_strings, $current_user;
	if($current_user->id=="b0f1271b-0a49-d33b-9d80-6012ec0f15a8" OR  $current_user->id=='e4cd5835-f692-69de-3b3a-591598674c54' OR $current_user->id=='54f0da65-ef55-f73f-88f7-595f9370744a'){
    }else{
        unset($app_list_strings['case_status_dom']['Closed']);
    }
	if(!$current_user->isAdmin()) {
		echo "
			<script type='text/javascript'>
                                $( document ).ready(function() {
				       $('#assigned_user_name').attr('disabled',true);
				       $('#btn_assigned_user_name').attr('disabled',true);
				       $('#btn_clr_assigned_user_name').attr('disabled',true);
				       $('#mdp_estimated_case_value_c').attr('disabled',true);
                                       });
                        </script>
		";
	}
	if($current_user->id != 'e4cd5835-f692-69de-3b3a-591598674c54') {
		echo "
			<script type='text/javascript'>
				$( document ).ready(function() {
					$('#resolution_strategy').attr('disabled',true);
				});
			</script>
		";
	}
	if(empty($this->bean->fetched_row['id'])) {
                   $this->bean->assigned_user_id = "e4cd5835-f692-69de-3b3a-591598674c54";
                   $this->bean->assigned_user_name = "Matthew D. Powell";
                }
		/* print"<pre>";print_r($this->bean->field_name_map); */
		parent::display();
		if($_REQUEST['return_module'] == 'Accounts' && !empty($_REQUEST['return_id'])){
			echo "
				  <script type='text/javascript'>
					$( document ).ready(function() {
					  $('#account_role').parent().parent().show();
					});
				  </script>";
		}else{
			echo "
				  <script type='text/javascript'>
					$( document ).ready(function() {
					  $('#account_role').parent().parent().hide();
					});
				  </script>";
		}
		
		if($_REQUEST['return_module'] == 'Contacts' && !empty($_REQUEST['return_id'])){
			echo "
				  <script type='text/javascript'>
					$( document ).ready(function() {
					  $('#contact_role').parent().parent().show();
					});
				  </script>";
		}else{
			echo "
				  <script type='text/javascript'>
					$( document ).ready(function() {
					  $('#contact_role').parent().parent().hide();
					});
				  </script>";
		}
		echo "<script type='text/javascript' src='include/javascript/sugarwidgets/SugarYUIWidgets.js'></script>";
		echo "<script type='text/javascript' src='custom/modules/Cases/js/edit.js'></script>";
	
    }
}
