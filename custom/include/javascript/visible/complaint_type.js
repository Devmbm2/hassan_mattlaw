$(document).ready(function() {
	if(document.getElementsByName('type').length > 0 ){
		initComplaintType();
		changeComplaintType(); //Call onchange function
	}
});

function initComplaintType(){
	//$('#detailpanel_1').parent().hide();
	value = document.getElementsByName('type')[0].value;
	if(value.includes("Multiple_Claims"))
	 {
                $('div[data-label="LBL_DATE_OF_2ND_INCIDENT"]').show();
                $('div[field="date_of_2nd_incident_c"]').show();
                $('div[data-label="LBL_COUNTY_OF_2ND_INCIDENT"]').show();
                $('div[field="county_of_2nd_incident_c"]').show();
                $('div[data-label="LBL_LOCATION_OF_2ND_INCIDENT"]').show();
                $('div[field="location_of_2nd_incident_c"]').show();
                $('div[data-label="LBL_STATUTE_OF_LIMITATIONS_2ND"]').show();
                $('div[field="statute_of_limitations_2nd_c"]').show();
				if(typeof required_fields !== "undefined"){
					required_fields['date_of_2nd_incident_c'] = 'Date of 2nd Incident';
					required_fields['county_of_2nd_incident_c'] = 'County of 2nd Incident';
					required_fields['location_of_2nd_incident_c'] = 'Location of 2nd Incident';
					required_fields['statute_of_limitations_2nd_c'] = 'SOL of 2nd Incident';
				}
        }
        else {
                $('div[data-label="LBL_DATE_OF_2ND_INCIDENT"]').hide();
                $('div[field="date_of_2nd_incident_c"]').hide();
                $('div[data-label="LBL_COUNTY_OF_2ND_INCIDENT"]').hide();
                $('div[field="county_of_2nd_incident_c"]').hide();
                $('div[data-label="LBL_LOCATION_OF_2ND_INCIDENT"]').hide();
                $('div[field="location_of_2nd_incident_c"]').hide();
                $('div[data-label="LBL_STATUTE_OF_LIMITATIONS_2ND"]').hide();
                $('div[field="statute_of_limitations_2nd_c"]').hide();
				if(typeof required_fields !== "undefined"){
					delete required_fields['date_of_2nd_incident_c'];
					delete required_fields['county_of_2nd_incident_c'];
					delete required_fields['location_of_2nd_incident_c'];
					delete required_fields['statute_of_limitations_2nd_c'];
				}
        }

	//{
	//	$('#detailpanel_1').parent().show();
	//}
	$('#number_potential_plaintif_c').closest('.edit-view-row-item').hide();
	if(typeof required_fields !== "undefined"){
		delete required_fields['number_potential_plaintif_c'];
	}
	if(value.includes("Auto") || value.includes("Trucking") || value.includes("Multiple_Claims") || value.includes("Bicycle") || value.includes("Motorcycle")) {
             $('#number_potential_plaintif_c').closest('.edit-view-row-item').show();
			 if(typeof required_fields !== "undefined"){
				required_fields['number_potential_plaintif_c'] = 'Number of Potential Plaintiffs';
			 }
	}	
}

function changeComplaintType(){
     document.getElementById("type").onchange = function() {
        initComplaintType(); //Call hide/show function
    }
}
