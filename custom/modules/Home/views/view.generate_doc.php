<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

// require_once('include/MVC/View/views/view.edit.php');

class HomeViewgenerate_doc extends SugarView
{
 	public function display(){
		require_once('modules/DHA_PlantillasDocumentos/UI_Hooks.php');
		
		global $app_list_strings, $mod_strings;
		
		echo getClassicModuleTitle('Home', array('Generate Document'), false);
		
		$enabled_modules = MailMergeReports_after_ui_frame_hook_enabled_modules();
		$this->ss->assign('enabled_modules', $enabled_modules);
		echo $this->ss->fetch('custom/modules/Home/tpls/generate_doc.tpl');
	}
}
