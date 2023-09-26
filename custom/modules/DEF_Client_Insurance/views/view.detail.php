<?php
require_once('include/MVC/View/views/view.detail.php');
class DEF_Client_InsuranceViewDetail extends ViewDetail {
        function DEF_Client_InsuranceViewDetail(){
        parent::ViewDetail();
}

function display() {
	//echo "<script type='text/javascript'>var bean = ".json_encode($this->bean->toArray()).";
	// if(bean['type']!='PIP'){
        //        $(\"[field='pip_status']\").parent().html('');
        //}
        //if(bean['type']!='Med_Pay'){
        //        $(\"[field='med_pay_result']\").parent().html('');
       // }
        //if(bean['med_pay_result']!='Settled'){
        //        $(\"[field='amount_to_pay']\").parent().html('');
        //}
        //if(bean['claim_result']!='Filed_Suit' && bean['claim_result']!='Lit_Settlement'){
        //        $(\"[field='lit_spot']\").parent().html('');
       // }
        //if(bean['case_type_c']!='Multiple_Claims_in_One'){
        //        $(\"[field='date_of_incident']\").parent().html('');
        //}
        //if(bean['case_type_c'].includes('Companion') == false){
        //        $(\"[field='companion']\").parent().html('');
        //}
	//</script>";
	echo "
        <script type='text/javascript' src='custom/modules/DEF_Client_Insurance/js/hide_fields.js'></script>";
        parent::display();
}
}
?>

