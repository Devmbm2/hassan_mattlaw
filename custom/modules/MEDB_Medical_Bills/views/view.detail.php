<?php
require_once('include/MVC/View/views/view.detail.php');
class MEDB_Medical_BillsViewDetail extends ViewDetail {
        function MEDB_Medical_BillsViewDetail(){
        parent::ViewDetail();
}

function display() {


        parent::display();
			echo "<script type='text/javascript'>var bean = ".json_encode($this->bean->toArray()).";
	$(document).ready(function(){
	if(bean['reduction_amount']<='0.00'){
               $(\"[field='reduction_approved_by']\").parent().html('');
        }
		showhidemedFields();
	});
	function showhidemedFields(){

        var type = $(' #type_c').val();
        if(type == 'Medicaid')  {
           $('#medicaid_date_c').parent().parent().parent().show();
           $('#medicaid_id_number_c').parent().parent().show();
		   $('#claim_number').parent().parent().hide();
			$('#adjuster_id').parent().parent().parent().hide();
        }else{
			 $('#medicaid_date_c').parent().parent().parent().hide();
			 $( '#medicaid_id_number_c').parent().parent().hide();
			  $('#medicaid_date_c').parent().parent().parent().hide();
			 $('#medicare_date_c').parent().parent().parent().hide();
			 $('#medicare_id_number_c').parent().parent().hide();
			 
		} 
		if(type == 'Medicare')  {
          $('#medicare_date_c').parent().parent().parent().show();
          $('#medicare_id_number_c').parent().parent().show();
		  $('#medicare_type_c').parent().parent().show();
		   $('#claim_number').parent().parent().hide();
			$('#adjuster_id').parent().parent().parent().hide();
        }else{
			 $('#medicare_date_c').parent().parent().parent().hide();
             $('#medicare_id_number_c').parent().parent().hide();
			 $('#medicare_type_c').parent().parent().hide();
			 
		}
		
		if(type == 'PIP'){
			 var pip_type_show = ['reduction_approved_by', 'client_paid', 'write_offs_c', 'copy_charges', 'medicare_paid', 'medicaid_paid', 'adjustments', 'health_insurance_paid', 'interest_c', 'pip_exhausted_c', 'penalties_c', 'date_pip_exhausted_c', 'travel_c', 'wages_c', 'medicare_date_c', 'medicare_id_number_c', 'medicare_type_c'];
				$.each(pip_type_show, function( index, value ) {
				  $('#'+value).parent().parent().hide();
				});
				$('div[data-label=\'LBL_DATE_PIP_EXHAUSTED\']').hide();
				$('#claim_number').parent().parent().parent().show();
				$('#adjuster_id').parent().parent().parent().show();
				$('#adjuster_phone').parent().parent().parent().show();
				$('#adjuster_fax').parent().parent().parent().show();
				$('#total_charges').parent().parent().parent().show();
			
		}else{
			 var pip_type_show = ['pip_paid','client_paid', 'write_offs_c', 'copy_charges', 'medicare_paid', 'medicaid_paid', 'adjustments', 'health_insurance_paid', 'interest_c', 'pip_exhausted_c', 'penalties_c', 'date_pip_exhausted_c', 'travel_c', 'wages_c', 'medicare_date_c', 'medicare_id_number_c', 'medicare_type_c'];
				$.each(pip_type_show, function( index, value ) {
				  $('#'+value).parent().parent().show();
				});
				$('div[data-label=\'LBL_DATE_PIP_EXHAUSTED\']').show();
				$('#claim_number').parent().parent().parent().hide();
				$('#adjuster_id').parent().parent().parent().hide();
				$('#adjuster_phone').parent().parent().parent().hide();
				$('#adjuster_fax').parent().parent().parent().hide();
				$('#total_charges').parent().parent().parent().show();

				
		}
		$(' #medicare_id_number_c').parent().parent().hide();
		$(' #medicare_type_c').parent().parent().hide();
}
	</script>";
}
}
?>

