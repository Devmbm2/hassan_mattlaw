<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

//require_once('include/MVC/View/SugarView.php');
require_once('include/MVC/View/views/view.detail.php');
require_once('include/TemplateHandler/TemplateHandler.php');
ini_set('display_errors',0);
class DHA_PlantillasDocumentosViewCustomselection extends ViewDetail{
	
	public function DHA_PlantillasDocumentosViewCustomselection() {
		parent::SugarView();
		$this->th = new TemplateHandler();
		$this->th->ss =& $this->ss;
	}

	public function display() {
		//$GLOBALS['view'] = '';
		global $app_list_string,$mod_strings;
		$selection_array  = json_decode($_REQUEST['SELECTION_ARRAY'],true);
		$this->ss->assign('LABEL_CHECKBOX', $GLOBALS['app_strings']['LBL_ADJUNTAR_DOCUMENTO_GENERADO_A_CASE']);
		$this->ss->assign('SELECTION_ARRAY', $selection_array);
		echo $this->th->displayTemplate("DHA_PlantillasDocumentos", "viewjobsqueue", "modules/DHA_PlantillasDocumentos/tpls/HTSelectionListViewGeneric.tpl");
		//print"<pre>";print_r($selection_array);die;
		   
		die();
	}
}

?>