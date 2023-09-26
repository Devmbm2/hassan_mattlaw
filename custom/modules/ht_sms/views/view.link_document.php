<?php
require_once('include/MVC/View/views/view.edit.php');

class ht_smsViewlink_document extends ViewEdit {
	protected function _getModuleTitleParams($browserTitle = false){
		$arr = parent::_getModuleTitleParams($browserTitle);
		
		$arr[] = $this->bean->name;
		$arr[] = "Link Document";
		
		return $arr;
	}
	
	public function preDisplay(){
		//load runtime non-db fields for viewdefs
		$this->bean->field_defs = $this->loadCustomVardef();
		$this->bean->field_name_map = $this->loadCustomVardef();
		
		$metadataFile = "custom/modules/ht_sms/metadata/link_documentviewdefs.php";
		
		$this->ev = $this->getEditView();
		$this->ev->ss =& $this->ss;
		
		$this->ev->setup($this->module, $this->bean, $metadataFile, 'include/EditView/EditView.tpl');
	}
	public function display(){
		/* print"<pre>";print_r($_REQUEST['record']); */
		$this->ev->record = $_REQUEST['record'];
		$this->ev->formName = "link_document";
		parent::display();
		$time = time();
		echo "<script type='text/javascript'>
				var record = '{$this->bean->id}';
				$( document ).ready(function() {
					$('#SAVE').attr('onclick', 'save_document();');				
				});
			</script>";
		//
		echo '<script type="text/javascript" src="custom/modules/ht_sms/js/save_document.js?v='.$time.'"></script>';
	}
	
	public function loadCustomVardef(){
		$custom_fields_array = array(
			'parent_name' => 
				array (
				'name' => 'parent_name',
				'parent_type' => 'record_type_display',
				'type_name' => 'parent_type',
				'id_name' => 'parent_id',
				'vname' => 'LBL_RELATED_TO',
				'type' => 'parent',
				'source' => 'non-db',
				'options' => 'document_relate_type_dom',
				),
			'parent_type' => 
				array (
				  'name' => 'parent_type',
				  'vname' => 'LBL_PARENT_TYPE',
				  'type' => 'parent_type',
				  'dbType' => 'varchar',
				  'group' => 'parent_name',
				  'options' => 'parent_type_display',
				  'len' => '255',
				  'comment' => 'Sugar module the Note is associated with',
				),
			'parent_id' => 
				array (
				  'name' => 'parent_id',
				  'vname' => 'LBL_PARENT_ID',
				  'type' => 'id',
				  'required' => false,
				  'reportable' => true,
				  'comment' => 'The ID of the Sugar item specified in parent_type',
				),
				'file_name' => 
				array (
				  'name' => 'file_name',
				  'vname' => 'LBL_FILE_NAME',
				  'type' => 'varchar',
				  'required' => true,
				),
		);
		
		return $custom_fields_array;
	}
}
?>