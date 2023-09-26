$(document).ready(function() {
    showhideDateRange();
    $('#range_of_records_requested_c').attr('onchange','showhideDateRange();'); //Call onchange function
});

function showhideDateRange(){
        $('#date_range_start').closest('.edit-view-row-item').hide();
        $('#date_range_end').closest('.edit-view-row-item').hide();
     if($('#range_of_records_requested_c').val() == 'Specific_Dates_Of_Medical_Records'){
        $('#date_range_start').closest('.edit-view-row-item').show();
        $('#date_range_end').closest('.edit-view-row-item').show();
        }
}

