<?php
require_once('include/MVC/View/views/view.detail.php');
class COST_Client_CostViewDetail extends ViewDetail {
        function COST_Client_CostViewDetail(){
        parent::ViewDetail();
}

function display() {

		echo "<script type='text/javascript'>var bean = ".json_encode($this->bean->toArray()).";
		if(bean['type']!='Videographer_Charges' && bean['type']!='Court_Reporting_for_Depo'){
					$(\"[field='deponent']\").parent().html('');
			}
			if(bean['status']!='Paid_by_Check'){
					$(\"[field='check_number']\").parent().hide();
			}
			if(bean['case_type_c'].includes('Companion') == false){
					$(\"[field='companion']\").parent().hide();
					$(\"[field='number_of_ways_to_split']\").parent().hide();
			}
		</script>";
		$formName = $this->ev->formName;
		if(empty($formName)){
		$formName = 'DetailView';
		}

        parent::display();
        $time = time();
		if($this->bean->recovery_of_costs != 'recovered_and_partially_paid'){
			echo"<script type='text/javascript'>
					$('#lost_unreimbursed_costs').parent().parent().hide();
				</script>";
		}
		echo "<script type='text/javascript'>

		var formName = '{$formName}';
		console.log('formName');
		console.log(formName);
		</script>";
		echo "<script type='text/javascript' src='custom/modules/COST_Client_Cost/js/detail.js?v={$time}'></script> ";
}
}
?>
