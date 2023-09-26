

function show_medical_summary_by_medical_provider(){

	var contact_id= document.getElementsByName("record")[0].value;
	$.LoadingOverlay("show", {zIndex: 999999 } );
	$.ajax({
		url: 'index.php?module=Contacts&action=medical_summary_providers&record='+contact_id,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){
				YAHOO.SUGAR.MessageBox.show({msg: result, height:'700px', width:'200px',title: 'List Of Medical Providers'});
				$.LoadingOverlay("hide");
				$( document ).ready(function() {
					$("#medical_providers").multiselect({
						columns: 1,
						placeholder: "Select Medical Providers",
						search: true,
						selectAll: true
					});
					$("#medical_provider_organizations").multiselect({
						columns: 1,
						placeholder: "Select Medical Providers Organization",
						search: true,
						selectAll: true
					});
					$(".ms-options-wrap").css("width", "60%");
					$(".ms-options").css("width", "60%");
				});
				
		}
	});
}

function show_related_running_bills_report(record_id){

	var contact_id= document.getElementsByName("record")[0].value;
	$.LoadingOverlay("show", {zIndex: 999999 } );
	$.ajax({
		url: 'index.php?module=Contacts&action=related_running_bills_list&record='+contact_id,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){
				YAHOO.SUGAR.MessageBox.show({msg: result, height:'600px', width:'150px',title: 'List Of Medical Providers'});
				$.LoadingOverlay("hide");
				$( document ).ready(function() {
					$("#medical_providers_bill").multiselect({
						columns: 1,
						placeholder: "Select Medical Providers",
						search: true,
						selectAll: true
					});
					$(".ms-options-wrap").css("width", "60%");
					$(".ms-options").css("width", "60%");
				});
				
		}
	});
}
function related_running_bills_list_for_medical_bill_summary_report(record_id){

	var contact_id= document.getElementsByName("record")[0].value;
	$.LoadingOverlay("show", {zIndex: 999999 } );
	$.ajax({
		url: 'index.php?module=Contacts&action=related_running_bills_list_for_medical_bill_summary_report&record='+contact_id,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){
				YAHOO.SUGAR.MessageBox.show({msg: result, height:'600px', width:'150px',title: 'List Of Medical Providers'});
				$.LoadingOverlay("hide");
				$( document ).ready(function() {
					$("#medical_providers_bill").multiselect({
						placeholder: "Select Medical Providers",
						search: true,
						selectAll: true
					});
					$(".ms-options-wrap").css("width", "60%");
					$(".ms-options").css("width", "60%");
				});
				
		}
	});
}

function SendMedicalProvidor(record_id){
	var medical_providers = $('select#medical_providers').val();
	var medical_provider_organizations = $('select#medical_provider_organizations').val();
	var start_date = $('#start_date').val();
	var end_date = $('#end_date').val();
	/* if(medical_providers == '' || medical_providers == null){
		alert('Please Select a Medical Providor.');
		return false;
	}
	 */
	if(start_date != '' && end_date == ''){
		alert('Please Select End Date.');
		return false;
	}else if(start_date == '' && end_date != ''){
		alert('Please Select Start Date.');
	}
	window.open('index.php?module=Contacts&action=medical_summary&record_id='+record_id+'&medical_providers='+medical_providers+'&medical_provider_organizations='+medical_provider_organizations+'&start_date='+start_date+'&end_date='+end_date);
}
function show_medical_bill_summary(record_id){
	var medical_providers_bill = $('select#medical_providers_bill').val();
	window.open('index.php?module=Contacts&action=medical_bill_summary_report&record_id='+record_id+'&medical_providers_bill='+medical_providers_bill);
}
function SendMedicalProvidor_related_bills_report(record_id){
	var medical_providers_bill = $('select#medical_providers_bill').val();
	window.open('index.php?module=Contacts&action=running_related_bills_report&medical_providers_bill='+medical_providers_bill+'&record_id='+record_id);
}


function show_related_module_files_zip_menu(){

	var contacts_id= document.getElementsByName("record")[0].value;
	$.LoadingOverlay("show", {zIndex: 999999 } );
	$.ajax({
		url: 'index.php?module=Contacts&action=show_related_module_files_zip_menu&record='+contacts_id,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){
				YAHOO.SUGAR.MessageBox.show({msg: result, height:'700px', width:'200px',title: 'List Of Related Module'});
				$.LoadingOverlay("hide");
				$( document ).ready(function() {
					$("#list_of_case_related_modules").multiselect({
						columns: 1,
						placeholder: "Select Related Modules",
						search: true,
						selectAll: true
					});
					$(".ms-options-wrap").css("width", "60%");
					$(".ms-options").css("width", "60%");
				});
				
		}
	});
}

function related_module_files_zip_download(record_id){
	var selected_modules = $('select#list_of_case_related_modules').val();
	if(selected_modules == '' || selected_modules == null){
		alert('Please Select a Module.');
		return false;
	}
	window.open('index.php?entryPoint=related_module_files_zip_download&record_id='+record_id+'&module=Contacts&selected_modules='+selected_modules);
}
// $(document).ready(function(){


// })