<?php
require_once('custom/modules/Cases/views/view.detail.php');
class CustomCasesViewSubpanels extends ViewDetail {
        

function display() {
	global $current_user;
         
	$this->_displaySubPanels();
	// displayPopupHtml();
	
	
}
protected function _displaySubPanels()
        {
        if($_REQUEST["showpanels"] == 1)
         {
        if (isset($this->bean) && !empty($this->bean->id) && (file_exists('modules/' . $this->module . '/metadata/subpaneldefs.php') || file_exists('custom/modules/' . $this->module . '/metadata/subpaneldefs.php') || file_exists('custom/modules/' . $this->module . '/Ext/Layoutdefs/layoutdefs.ext.php'))) {
                $GLOBALS['focus'] = $this->bean;
    		// sleep(3);
  		require_once ('include/SubPanel/SubPanelTiles.php');
  		// $time_start = microtime(true);
                $subpanel = new SubPanelTiles($this->bean, $this->module);
                //Dependent logic
                if (strpos($this->bean->type, "Companion") == false)
                {
                        unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['comp_companions_cases']);
                }
				/* unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['activities']); */	
               //parent::_displaySubPanels();
	       echo $subpanel->display();
	 //        die();
  //               $time_end = microtime(true);
  //               $time = $time_end - $time_start;
  // 		$milliseconds = round($time * 1000);
  //   			// echo $milliseconds;	
		// echo "The speed of code = ".$milliseconds;
  //               echo "</script>";
           }
        }
}

}
?>
