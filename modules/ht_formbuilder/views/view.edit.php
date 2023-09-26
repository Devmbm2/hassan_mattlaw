<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class ht_formbuilderViewEdit extends ViewEdit
{
    public function display()
    {
		$this->ev->defs['templateMeta']['form']['buttons'][0] = array('customCode' => '<input title = "Save" accesskey="a" type="button" class="button primary savebtn" name="button" value="Save" id="SAVE">',);	
		$this->ev->defs['templateMeta']['form']['buttons'][] = array('customCode' => '<input  type="button" class="button primary clearbtn"  name="button" value="Clear" id="clearbtn">',);	
		$this->ev->defs['templateMeta']['form']['buttons'][] = array('customCode' => '<input  type="button" class="button primary showhtmlbtn"  name="button" value="Show HTML" id="showhtmlbtn">',);	
		$this->ev->defs['templateMeta']['form']['buttons'][] = array('customCode' => '<input  type="button" class="button primary downloadhtmlbtn"  name="button" value="Download Html" id="downloadhtmlbtn">',);	
		//parent::display();
		$this->ev->process();
			$required_fields = array();
			foreach($this->bean->field_name_map as $field_name => $field_data){
				if($field_name != 'id' && $field_name != 'bug_number' && $field_data['required'] ){
					$required_fields[$field_name] = $mod_strings[$field_data['vname']];				
				}
			}
			echo $this->ev->display($this->showTitle);
			$formName = $this->ev->formName;
			if(empty($formName)){
				$formName = 'EditView';
			}
    }
}