<?php
require_once('include/MVC/View/views/view.edit.php');
class ContactsViewEdit extends ViewEdit {
   /*  function ContactsViewEdit(){
		parent::ViewEdit();
	} */
	function __construct(){
        parent::__construct();
    }
	function display(){
		global $mod_strings, $current_user;
		$required_fields = array();
		foreach($this->bean->field_name_map as $field_name => $field_data){
			if($field_name != 'id' && $field_name != 'bug_number' && $field_data['required']){
				$required_fields[$field_name] = $mod_strings[$field_data['vname']];				
			}
		}
		/* if (!$current_user->is_admin){
			echo "<script type='text/javascript' src='custom/modules/Contacts/js/mask_ssn.js'></script>";
        }	 */	
  //       $this->ev->defs['templateMeta']['form']['buttons'][0] = array('customCode' => '<input title = "Save" accesskey="a" type="button" class="button primary savebtn" name="button" value="Save" id="SAVE" onClick="return showWorkflow();">',);

		
		// $this->ev->process();
		parent::display();
		// $required_fields = array();
		// 	foreach($this->bean->field_name_map as $field_name => $field_data){
		// 		if($field_name != 'id' && $field_name != 'bug_number' && $field_data['required'] ){
		// 			$required_fields[$field_name] = $mod_strings[$field_data['vname']];				
		// 		}
		// 	}
		// echo $this->ev->display($this->showTitle);
		// $formName = $this->ev->formName;
		// 	if(empty($formName)){
		// 		$formName = 'EditView';
		// 	}
    }
}

