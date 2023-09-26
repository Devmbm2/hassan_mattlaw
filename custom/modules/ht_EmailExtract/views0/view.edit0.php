<?php
require_once('include/MVC/View/views/view.edit.php');
class ht_EmailExtractViewEdit extends ViewEdit {
    public function __construct() {
        parent::__construct();
    }
    public function preDisplay() {
        parent::preDisplay();
        // $metadataFile = $this->getMetaDataFile();
        // $this->ev = $this->getEditView();
        // $this->ev->ss =& $this->ss;
        // // echo "<pre>";
        // // print_r($this->ev->ss);
        // // echo "</pre>";
        // // die();
		// $this->ev->setup($this->module, $this->bean, $metadataFile, 'custom/modules/ht_EmailExtract/tpls/EditView.tpl');
    }

}
