<?php
require_once('include/MVC/View/views/view.detail.php');
class ht_vehiclesViewDetail extends ViewDetail {
	
	protected function _displaySubPanels()
    {
       
		$GLOBALS['focus'] = $this->bean;
		require_once ('modules/ht_vehicles/SubPanel/SubPanelTiles.php');
		$subpanel = new ht_VehiclesSubPanelTiles($this->bean, $this->module);

		unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['get_contact_insurance']);
		echo $subpanel->display();
    }
}
?>
