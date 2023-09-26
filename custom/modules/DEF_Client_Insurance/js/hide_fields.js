$(document).ready(function(){
	show_hide_fields();
});
function show_hide_fields() {
	var claim = $('#claim_result').val();
	if (claim.includes("Settlement") == false) {
	   $('#amount_recovered').closest('.detail-view-row-item').hide();
	   $('#firm_fee').closest('.detail-view-row-item').hide();
	}
	console.log("Test");
	//$('#contact_id3').closest('.detail-view-row-item').hide();
	//$('#insured_corporate').closest('.detail-view-row-item').hide();

	if ($('#insured_person_corp').val() != 'Person'){
	   $('#contact_id3').closest('.detail-view-row-item').hide();
	}
	if ($('#insured_person_corp').val() != 'Corporate'){
	   $('#account_id1_c').closest('.detail-view-row-item').hide();
	}
}
