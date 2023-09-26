$(document).ready(function() {
function initPip(){
    showhidePipFields();
    changePip(); //Call onchange function
}
function showhidePipFields(){
          $('#total_charges').closest('.edit-view-row-item').show();
	  $('#client_paid').closest('.edit-view-row-item').show();
          $('#write_offs_c').closest('.edit-view-row-item').show();
          $('#pip_paid').closest('.edit-view-row-item').show();
          $('#medicaid_paid').closest('.edit-view-row-item').show();
          $('#health_insurance_paid').closest('.edit-view-row-item').show();
          $('#reduction_amount').closest('.edit-view-row-item').show();
          $('#medicaid_date_c').closest('.edit-view-row-item').show();
          $('#medicare_date_c').closest('.edit-view-row-item').show();
          $('#medicare_type_c').closest('.edit-view-row-item').show();
          $('#medicaid_id_number_c').closest('.edit-view-row-item').show();
          $('#medicare_id_number_c').closest('.edit-view-row-item').show();
	//hide fields
        pip = $('#type_c').val();
        if(pip == 'PIP')  {
          $('#total_charges').closest('.edit-view-row-item').hide();
          $('#client_paid').closest('.edit-view-row-item').hide();
          $('#write_offs_c').closest('.edit-view-row-item').hide();
          $('#pip_paid').closest('.edit-view-row-item').hide();
          $('#medicaid_paid').closest('.edit-view-row-item').hide();
          $('#health_insurance_paid').closest('.edit-view-row-item').hide();
          $('#reduction_amount').closest('.edit-view-row-item').hide();
          $('#medicaid_date_c').closest('.edit-view-row-item').hide();
          $('#medicare_date_c').closest('.edit-view-row-item').hide();
          $('#medicare_type_c').closest('.edit-view-row-item').hide();
          $('#medicaid_id_number_c').closest('.edit-view-row-item').hide();
          $('#medicare_id_number_c').closest('.edit-view-row-item').hide();
        }
}

function changePip(){
     document.getElementById("type_c").onchange = function() {
        showhidePipFields(); //Call hide/show function
    }
}

initPip();
});
