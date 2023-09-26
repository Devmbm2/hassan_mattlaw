$(document).ready(function() {
	show_hide_fields();
	$('#insured_person_corp').attr('onchange','show_hide_fields();');
});

function show_hide_fields(){
        $('#insured_person').closest('.edit-view-row-item').hide();
        $('#insured_corporate').closest('.edit-view-row-item').hide();
        if($('#insured_person_corp').val() == 'Person'){
              $('#insured_person').closest('.edit-view-row-item').show();
        }
	if($('#insured_person_corp').val() == 'Corporate'){
              $('#insured_corporate').closest('.edit-view-row-item').show();
        }
}

