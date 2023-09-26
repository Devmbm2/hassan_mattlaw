<?php
require_once('include/MVC/View/views/view.detail.php');

class ht_recycle_binViewDetail extends ViewDetail
{
	/*  public function __construct() {
        parent::SugarView();
        $this->options['show_footer'] = false;
        $this->options['show_header'] = false;
    } */

	public function preDisplay()
    {
		global $beanList;
		$this->module = $_SESSION['recycle_module'];
		$this->bean = new $beanList[$this->module];
		$this->bean->retrieve($_REQUEST['record'], true, false);
		parent::preDisplay();
    }
	
	protected function _displaySubPanels()
    {
		global $app_list_strings, $beanList;
		require_once ('include/SubPanel/SubPanelTiles.php');
		$this->module = $_SESSION['recycle_module'];
		$this->bean = new $beanList[$this->module];
        $subpanel = new SubPanelTiles($this->bean, $this->module);
		unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']);
        echo $subpanel->display();
        
    }

	public function display()
    {
		global $app_strings;
		$this->dv->formName = "recycleDetailView";
		unset($this->dv->defs['templateMeta']['form']['buttons']);
		$record_id = $_REQUEST['record'];
		$module = $_SESSION['recycle_module'];
		/* print"<pre>";print_r($this->dv); */
		$this->dv->defs['templateMeta']['includes'][]['file'] = 'modules/ht_recycle_bin/js/detail.js';
		$this->dv->defs['templateMeta']['form']['buttons'][0]['customCode'] = '<input title="Undelete" type="button" name="undelete" id="undelete" onclick="undelete(\'{$MODULE}\', \'{$RECORD_ID}\');" value="Undelete">';
		$this->dv->defs['templateMeta']['form']['buttons'][1]['customCode'] = '<input title="Permanent Delete" type="button" name="delete_permanent" id="delete_permanent" onclick="delete_permanent(\'{$MODULE}\', \'{$RECORD_ID}\');" value="Permanent Delete">';
		$this->dv->defs['templateMeta']['form']['hideAudit'] = true;		
        if(empty($this->bean->id)){
            sugar_die($GLOBALS['app_strings']['ERROR_NO_RECORD']);
        }
		$this->ss->assign('RECORD_ID', $record_id);
		$this->ss->assign('MODULE', $module);
		echo "
			<style>
			 .navbar{
				 display:none;
			 }
			</style>
		"; 
		/* 		echo "
			<script>
			$(document).ready(function(){
				$('#toolbar').parent().parent().remove();
			});
			</script>
		"; */
        $this->dv->process();
        echo $this->dv->display();

		
		
		
	 
	}	
}
