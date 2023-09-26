$(document).ready(function() {

$( '#'+ formName +' #type_c' ).change(function() {
	    showhidemedFields(); //Call hide/show function
	});
	showhidemedFields();
});

function showhidemedFields(){
	//hide fields
//	console.log('formName123678');
//	console.log(formName);
        var type = $('#'+formName+ ' #type_c').val();
	if(type == 'Med_Pay')  {
           $('#'+formName +' #adjuster_name').parent().parent().parent().show();
           $('#'+formName +' #adjuster_phone').parent().parent().show();
           $('#'+formName +' #adjuster_fax').parent().parent().show();
           $('#'+formName +' #claim_number').parent().parent().show();
           $('#'+formName +' #limits').parent().parent().show();
        }else{
           $('#'+formName +' #adjuster_name').parent().parent().parent().hide();
           $( '#'+formName +' #adjuster_phone').parent().parent().hide();
           $( '#'+formName +' #adjuster_fax').parent().parent().hide();
           $( '#'+formName +' #claim_number').parent().parent().hide();
           $( '#'+formName +' #limits').parent().parent().hide();
                }

        if(type == 'Medicaid')  {
           $('#'+formName +' #medicaid_date_c').parent().parent().parent().show();
           $('#'+formName +' #medicaid_id_number_c').parent().parent().show();
        }else{
			 $('#'+formName +' #medicaid_date_c').parent().parent().parent().hide();
			 $( '#'+formName +' #medicaid_id_number_c').parent().parent().hide();
		} 
		if(type == 'Medicare')  {
          $('#'+formName+ ' #medicare_date_c').parent().parent().parent().show();
          $('#'+formName+ ' #medicare_id_number_c').parent().parent().show();
		  $('#'+formName+ ' #medicare_type_c').parent().parent().show();
        }else{
			 $('#'+formName+ ' #medicare_date_c').parent().parent().parent().hide();
             $('#'+formName+ ' #medicare_id_number_c').parent().parent().hide();
			 $('#'+formName+ ' #medicare_type_c').parent().parent().hide();
		}
		if(type == 'PIP'){
			 var pip_type_show1 = ['reduction_approved_by','pip_paid','total_charges','client_paid', 'write_offs_c', 'copy_charges', 'medicare_paid', 'medicaid_paid', 'adjustments', 'health_insurance_paid', 'interest_c', 'pip_exhausted_c', 'penalties_c', 'date_pip_exhausted_c', 'travel_c', 'wages_c', 'medicare_date_c', 'medicare_id_number_c', 'medicare_type_c'];
				$.each(pip_type_show1, function( index, value ) {
				  $('#'+formName+' #'+value).parent().parent().hide();
				});
				//$('div[data-label='LBL_DATE_PIP_EXHAUSTED']').hide();
			
		}else{
			 var pip_type_show = ['pip_paid','claim_number','client_paid', 'write_offs_c', 'copy_charges', 'medicare_paid', 'medicaid_paid', 'adjustments', 'health_insurance_paid', 'interest_c', 'pip_exhausted_c', 'penalties_c', 'date_pip_exhausted_c', 'travel_c', 'wages_c', 'medicare_date_c', 'medicare_id_number_c', 'medicare_type_c'];
				$.each(pip_type_show, function( index, value ) {
				  $('#'+formName+ ' #'+value).parent().parent().show();
				});
				//$('div[data-label=\'LBL_DATE_PIP_EXHAUSTED']').show();
		}
		 $('#'+formName +' #medicaid_date_c').parent().parent().parent().hide();
		 $( '#'+formName +' #medicaid_id_number_c').parent().parent().hide();
		 $('#'+formName+ ' #medicare_date_c').parent().parent().parent().hide();
		 $('#'+formName+ ' #medicare_id_number_c').parent().parent().hide();
		 $('#'+formName+ ' #medicare_type_c').parent().parent().hide();
		 $('#'+formName+ ' #claim_number').parent().parent().hide();
		 //$('#'+formName+ ' #adjuster_name').parent().parent().hide();
   
}	

