
function generate_records(related_module){
	var related_medical_providers = $('select#medical_providers').val();
	if(related_medical_providers != null){
		$.LoadingOverlay("show", {zIndex: 999999 } );
		$.ajax({
			url: 'index.php?module=AOR_Reports&action=generate_records&related_medical_providers='+related_medical_providers+'&related_module='+related_module,
			type: 'POST',
			contentType: 'application/x-www-form-urlencoded',
			dataType: 'text',
			data: 'sugar_body_only=true',						
			async: true,			
			success : function (result){
				$.LoadingOverlay("hide");
				if(result == 'done'){
					alert('The Records are Created in the System.');
				}
			}
		});
	}else{
		alert('Please Select medical Provider.');
	}

}

