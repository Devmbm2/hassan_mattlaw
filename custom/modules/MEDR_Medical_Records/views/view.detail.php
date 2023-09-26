<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once('include/MVC/View/views/view.detail.php');
class MEDR_Medical_RecordsViewDetail extends ViewDetail {
        function MEDR_Medical_RecordsViewDetail(){
        parent::ViewDetail();
}

function display() {

	echo "
        <script type='text/javascript' src='custom/include/javascript/visible/medr_datereq_detail.js'></script>";
        parent::display();
}
}
?>

