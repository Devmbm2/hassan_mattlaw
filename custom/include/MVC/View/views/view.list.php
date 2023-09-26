<?php
require_once('include/MVC/View/views/view.list.php');

class CustomViewList extends ViewList{
	
    public function preDisplay()
    {
        parent::preDisplay();
        // require_once('custom/include/ListView/ListViewSmartyCustom.php');
        // $this->lv = new ListViewSmartyCustom();
        // $this->lv->buildExportLink();
    }
   
}
?>