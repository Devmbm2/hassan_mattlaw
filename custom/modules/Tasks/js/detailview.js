var toggleElements = function () {
    if($("#type_of_todo_c").val() == "Order_medical_record") {
        $("#top-panel-0").parent().show();
        $("div[data-label='LBL_CONTACT_NAME']").text('Client:');
        $('#beginning_date_range_of_reco_c').parent().parent().hide();
        $('#end_date_of_med_rec_requeste_c').parent().parent().hide();
        if($('#date_range_med_rec_requested_c').val() == 'Specific_Dates_Of_Medical_Records'){
        $('#beginning_date_range_of_reco_c').parent().parent().show();
        $('#end_date_of_med_rec_requeste_c').parent().parent().show();
        }
        $("div[data-label='LBL_CONTACT_NAME']").text('Client:');
    } 
    else{
      $("#top-panel-0").parent().hide();
      $("div[data-label='LBL_CONTACT_NAME']").text('Contact Name:');
      $("#name").val('');
    }
};
$(document).on('change', "#type_of_todo_c", toggleElements);
$(document).ready(toggleElements);