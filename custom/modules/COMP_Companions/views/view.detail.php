<?php
require_once('include/MVC/View/views/view.detail.php');
class COMP_CompanionsViewDetail extends ViewDetail {
        function COMP_CompanionsViewDetail(){
        parent::ViewDetail();
}

function display() {

	echo "<script type='text/javascript'>var bean = ".json_encode($this->bean->toArray()).";
/* 	if(bean['case_type_c'].includes('Companion') == false){
                $(\"[field='companion']\").parent().html('');
        } */
	</script>";
        //<script type='text/javascript' src='custom/modules/COMP_Companions/js/hide_fields.js'></script>";
        parent::display();
		echo "<link href='custom/include/select2/css/select2.min.css' rel='stylesheet' type='text/css'/>";
			echo "<script type='text/javascript' src='custom/include/select2/js/select2.min.js'></script> ";
}
}
?>
