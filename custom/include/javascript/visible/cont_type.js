	$(document).ready(function() {
		showhideDocType();
		changeContType(); //Call onchange function
		changeFelony();
		$('input[name=felony_convictions_c]').click(function(){changeFelony()});
		$('#salutation').attr('onchange','showhideDocType();');
		$('#suffix').attr('onchange','showhideDocType();');
	});
	function showhideDocType(){
		console.log('asdht');
		var hideFields = ['doctor_type_c'/* , 'felony_convictions_c' */, 'pre_existing_conditions_c', 'assistant', 'assistant_phone', 'judge_web_page_c', 'federal_tax_id_c', 'expert_type_c'];
			$.each(hideFields, function( index, value ){
				$('#'+value).parent().parent().hide();
			});

		$('a#tab4').closest('li').hide();
		var conttype = $('#type_c').val();
		var salutation = $('#salutation').val();
		var suffix = $('#suffix').val();
		var suffix_array = ['Esq.','MD','DC','DO','PhD'];	
		if(conttype == "Doctor"){
			$('#doctor_type_c').parent().parent().show();
			$('a#tab2').closest('li').hide();
			$('a#tab3').closest('li').hide();
		}else{
			$('#doctor_type_c').parent().parent().hide();
			$('a#tab2').closest('li').show();
			$('a#tab3').closest('li').show();
		}
		if(conttype == "Judge" || salutation == "Honorable" || salutation == "Dr." || salutation == "Prof." || suffix_array.includes(suffix)){
			$('#assistant').parent().parent().show();
			$('#assistant_phone').parent().parent().show();
		}else{
			$('#assistant').parent().parent().hide();
			$('#assistant_phone').parent().parent().hide();
		}
		if(conttype=="Claims_Adjuster"){
		   $('a#tab2').closest('li').hide();
		   $('a#tab3').closest('li').hide();
		}else{
		   $('a#tab2').closest('li').show();
		   $('a#tab3').closest('li').show();
		}
		if(conttype == "Client"){
			$('#work_injury_c').parent().parent().hide();
			$('#children_c').parent().parent().hide();
			$('#work_injury_status_c').parent().parent().hide();
			$('#work_injury_details_c').parent().parent().hide();
			$('#arrest_details_c').parent().parent().hide();
			//$('div[field="felony_convictions_c"]').parent().hide();
			$('#pre_existing_conditions_c').parent().parent().show();
			$('#account_name').parent().parent().show();
		}else{
			$('#work_injury_c').parent().parent().show();
			$('#children_c').parent().parent().show();
			$('#work_injury_status_c').parent().parent().show();
			$('#work_injury_details_c').parent().parent().show();
			$('#arrest_details_c').parent().parent().show();
			//$('div[field="felony_convictions_c"]').parent().show();
			$('#pre_existing_conditions_c').parent().parent().hide();
			$('#account_name').parent().parent().hide();
		}
		if(conttype == "Judge"){
			$('#account_name').parent().parent().hide(); 
		}else{
			$('#account_name').parent().parent().show();
		}
		if(conttype=="Defendant"){
			$('#email1_span').parent().parent().hide();
			$('#birthday_card_c').parent().parent().hide();
			$('#newsletter_c').parent().parent().hide();
			$('#marital_status_c').parent().parent().hide();
			$('#observations_about_client_c').parent().parent().hide();
		}else{
			$('#email1_span').parent().parent().show();
			$('#birthday_card_c').parent().parent().show();
			$('#newsletter_c').parent().parent().show();
			$('#marital_status_c').parent().parent().show();
			$('#observations_about_client_c').parent().parent().show();
		}
		if(conttype == "Expert_Witness")
		{
			$('#federal_tax_id_c').parent().parent().show();
			$('#expert_type_c').parent().parent().show();
			$('a#tab2').closest('li').hide();
			$('a#tab3').closest('li').hide();
			$('a#tab4').closest('li').show();
		}else{
			$('#federal_tax_id_c').parent().parent().hide();
			$('#expert_type_c').parent().parent().hide();
			$('a#tab2').closest('li').show();
			$('a#tab3').closest('li').show();
			$('a#tab4').closest('li').hide();
		}
		if(conttype == "Insured" || conttype == "Investigator" || conttype == "Judge" || conttype == "Lawyer" || conttype == "Lien_Holder" || conttype == "Police" || conttype == "Vendor" || conttype == "Witness_BandA" || conttype == "Witness_Fact"){
			$('a#tab1').closest('li').hide();
			$('a#tab2').closest('li').hide();
			$('a#tab3').closest('li').hide();
		}else{
			$('a#tab1').closest('li').show();
			$('a#tab2').closest('li').show();
			$('a#tab3').closest('li').show();
		}
		if(conttype == "Investigator"){
			$('#federal_tax_id_c').parent().parent().show();
		}else{
			$('#federal_tax_id_c').parent().parent().hide();
		}
		if(conttype == "Judge"){
			$('#occupation_c').parent().parent().hide();
			$('#birthday_card_c').parent().parent().hide();
			$('#newsletter_c').parent().parent().hide();
		}else{
			$('#occupation_c').parent().parent().show();
			$('#birthday_card_c').parent().parent().show();
			$('#newsletter_c').parent().parent().show();
		}
		/* if(conttype == "Police"){
			$('#suffix').parent().parent().show();
		}else{
			$('#suffix').parent().parent().hide();
		} */
	}
	function changeFelony(){
		$('#county_of_convictions_c').parent().parent().hide();
		$('#years_of_convictions_c').parent().parent().hide();
		var fc = $('input[name=felony_convictions_c]:checked').val();
		if (fc == "Yes"){
		   $('#county_of_convictions_c').parent().parent().show();
		   $('#years_of_convictions_c').parent().parent().show();
		}
	}

	function changeContType(){
		 document.getElementById("type_c").onchange = function() {
			showhideDocType(); //Call hide/show function
		}
	}


