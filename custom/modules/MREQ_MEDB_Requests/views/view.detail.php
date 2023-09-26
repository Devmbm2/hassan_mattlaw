<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once('include/MVC/View/views/view.detail.php');
class MREQ_MEDB_RequestsViewDetail extends ViewDetail {
        function MREQ_MEDB_RequestsViewDetail(){
        parent::ViewDetail();
}

function display() {
$time = time();
	echo "
        <script type='text/javascript' src='custom/include/javascript/visible/mreq_date_range.js'></script>";
        echo "<script type='text/javascript' src='custom/modules/MREQ_MEDB_Requests/js/workflow.js?v={$time}'></script> ";
        parent::display();
}
}
?>

