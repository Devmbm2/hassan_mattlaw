<?php
require_once('include/MVC/View/views/view.detail.php');
class LIEN_Liens_LOPsViewDetail extends ViewDetail {
        function LIEN_Liens_LOPsViewDetail(){
        parent::ViewDetail();
}

function display() {

	echo "<script type='text/javascript'>var bean = ".json_encode($this->bean->toArray()).";
	if(bean['type']!='Medicaid'){
                $(\"[field='medicaid_date']\").parent().html('');
                $(\"[field='medicaid_id_number']\").parent().html('');
        }
        if(bean['type']!='Medicare'){
                $(\"[field='medicare_date']\").parent().html('');
                $(\"[field='medicare_id_number']\").parent().html('');
                $(\"[field='medicare_type']\").parent().html('');
        }
	</script>";
        //<script type='text/javascript' src='custom/modules/LIEN_Liens_LOPs/js/hide_fields.js'></script>";
        parent::display();
}
}
?>
