// var witness_nick = "";
var old_type = $("#q_a").val();
$(document).ready(function(){
	discovery_description();
	change_fields_ready();
	author_type_change();
	witness_type_change();
	// document_processed_name_required();
	// $('#done').attr('onchange','document_processed_name_required();');
	$("#witness_type_c").parent().parent().hide();
	$("#witness_contact_c").parent().parent().hide();
	$("#witness_organization_c").parent().parent().hide();
	$("#witness_nickname_c").parent().parent().hide();
	typeDepo();
});
function discovery_description(){
	$('#discovery_description').keypress(function(e) {
		var tval = $(this).val(),
			tlength = tval.length,
			set = 100,
			remain = parseInt(set - tlength);
		$('p').text(remain);
		if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
			$(this).val((tval).substring(0, tlength - 1));
			return false;
		}
	});
}
function change_fields_ready(){
	
	change_fields();
	pleadName();
	$('select[name = "type"]').attr('onchange','change_fields();pleadName();typeDepo();');
	$('#author_type').attr('onchange','pleadName();author_type_change();');
}
function change_fields(){
	$('#discovery_description').attr('onchange','pleadName();');
	$('#q_a').attr('onchange','pleadName();');
	$('#delivery_method_c').attr('onchange','pleadName();');
	$('#date_served').attr('onchange','pleadName();');
	$('#discovery_description').attr('onKeyUp','pleadName();');
	$('#parent_id').on('change',function(){pleadName();});
	$('#parent_name').on('blur',function(){pleadName();});
	$('#parent_type').on('change',function(){pleadName();});
	$('#btn_parent_name').on('blur',function(){pleadName();});
	$('#parent_name').on('change',function(){pleadName();});
	$('#disc_discovery_casescases_ida').on('change',function(){caseLawyer();});
	$('#disc_discovery_cases_name').on('blur',function(){caseLawyer();});
	$('#btn_disc_discovery_cases_name').on('blur',function(){caseLawyer();});
	$('#disc_discovery_cases_name').on('change',function(){caseLawyer();});
	$('#customcontact_id_c').on('change',function(){witness_type_change();});
	$('#witness_contact_c').on('blur',function(){witness_type_change();});
	$('#witness_type_c').on('change',function(){witness_type_change();});
	$('#btn_witness_contact_c').on('blur',function(){witness_type_change();});
	$('#contact_id_c').on('change',function(){pleadName();});
	$('#companion').on('blur',function(){pleadName();});
	$('#btn_companion').on('blur',function(){pleadName();});
	$('#companion').on('change',function(){pleadName();});
	$('#witness_nickname_c').attr('onKeyUp','pleadName();');
	$('select[name="OneTwoFourthDropdownField"').on('change',function(){
    pleadName();
  });
	// $('#witness_contact_c').on('change',function(){witness_type_change();});
	/* var fields_to_change = ['orders_sub_type','name_of_motion','complaint_answer_type','witness_list_type_c','exhibit_type_c','stipulation_type_c','sum_subp_type_c', 'filing_sub_type', 'filing_description', 'discovery_sub_type_description'];
	$.each(fields_to_change, function( index, value ){
		$('#'+value).attr('onchange','pleadName();');
	}); */
}
function author_type_change(){
	var author_type = $('#author_type').val();
	if(author_type == 'Other'){
		$('#author_c').parent().parent().show();
	}else{
		$('#author_c').parent().parent().hide();
	}
}
// function document_processed_name_required(){
// 	var processed = $('input[name="done"]:checked').val();
// 	if(action_sugar_grp1 != 'DetailView'){
// 		if(processed == 1){
// 			$('#document_processed_description').parent().parent().show();
// 			 addToValidate('EditView','document_processed_description','varchar',true,'HD-Reviewed/Processed by'); 
// 		}else{
// 			/* removeFromValidate('EditView', 'document_processed_description'); */
// 			$('#document_processed_description').parent().parent().hide();
// 		}
// 	}
// }
function pleadName() {
     var author_type = $('#author_type').val();
     var type_discovery = $('select[name = "type"] option:selected').text();
     var discovery_subtype = $('#q_a').val();
     var discovery_delivery_method = $('#delivery_method_c option:selected').text();
     var date_served = $('#date_served').val();
     var discovery_description = $('#discovery_description').val();
     var subtype = $('#q_a option:selected').text();
     var witness_nick = $('#witness_nickname_c').val();
     var discovery_type_no = $('select[name="OneTwoFourthDropdownField"]').val();
     /* var defendant_name = $('#parent_name').val();
	 if(defendant_name != ''){
		var defendant_name = defendant_name.split(" ");
		var defendant_first_name = defendant_name[0];
		var defendant_last_name = defendant_name[1];
		if(defendant_first_name != ' ' && defendant_last_name != ' '){
			defendant_name = defendant_first_name.charAt(0) + defendant_last_name.charAt(0) + "'s"; 
		}
	 } */
     var map_field_sub_type = '';
     var discoveryName;
     var initial = '';
	 var author_type_name = '';
     if (author_type  == "Plaintiff"){
        initial = "P";
		var companion_name = $('#companion').val();

		if(companion_name != '' && companion_name){
			var companion_name = companion_name.split(" ");
			var companion_name_first_name = companion_name[0];
			var companion_name_last_name = companion_name[1];
			if(companion_name_first_name != ' ' && companion_name_last_name != ' '){
				companion_name = companion_name_first_name.charAt(0) + companion_name_last_name.charAt(0) + "'s"; 
				author_type_name = companion_name;
			}
		}
     }else if (author_type == "Defendant"){
        initial = "D";
		var defendant_name = $('#parent_name').val();
		 if(defendant_name != ''){
			var defendant_name = defendant_name.split(" ");
			var defendant_first_name = defendant_name[0];
			var defendant_last_name = defendant_name[1];
			if(defendant_first_name != ' ' && defendant_last_name != ' '){
				defendant_name = defendant_first_name.charAt(0) + defendant_last_name.charAt(0) + "'s";
				author_type_name = defendant_name;				
			}
		 }
     }else if (author_type == "Court"){
        initial = "C";
		var case_id = $('#disc_discovery_casescases_ida').val();
		$.ajax({
			type: 'POST',
			url: 'index.php?module=DISC_Discovery&action=get_related_case_fields&case_id='+case_id,
			async: false,
			success: function(response){
				 if(response != ''){
				var judge_name = response.split(" ");
				var judge_name_first_name = judge_name[0];
				var judge_name_last_name = judge_name[1];
				if(judge_name_first_name != ' ' && judge_name_last_name != ' '){
					judge_name = judge_name_first_name.charAt(0) + judge_name_last_name.charAt(0) + "'s";
					author_type_name = judge_name;		
				}
			 }

			}
		});
     }else if (author_type == "Other"){
        initial = "O";
		var defendant_name = $('#parent_name').val();
		 if(defendant_name != ''){
			var defendant_name = defendant_name.split(" ");
			var defendant_first_name = defendant_name[0];
			var defendant_last_name = defendant_name[1];
			if(defendant_first_name != ' ' && defendant_last_name != ' '){
				defendant_name = defendant_first_name.charAt(0) + defendant_last_name.charAt(0) + "'s";
				author_type_name = defendant_name;				
			}
		 }
     }
     if(subtype == 'Q'){
     	$("#response_date").parent().parent().parent().show();
     	var date = $("#date_served").val();
     	var result = new Date(date);
     	var day_counter = $("#day_counter_c").val();
     	if(day_counter){
     	result.setDate(result.getDate() + parseInt($("#day_counter_c").val()));
	    formatted = padNumber(result.getUTCMonth() + 1) + '/' + padNumber(result.getUTCDate()) + '/' + result.getUTCFullYear();
	    $("#response_date").val(formatted);
     	}
     	else{
     		$("#response_date").val("");
     	}
     	// alert(result);
	    
     }
     else if(subtype != 'Q'){
     	$("#response_date").parent().parent().parent().hide();
     	$("#response_date").val("");
     }
 
    /*     var map_fields_discovery_subtype = {Notice: "notice_type", Order: "orders_sub_type",Hearing_Notice: "notice_type",Motion: "name_of_motion",Complaint:"complaint_answer_type",Answer:"complaint_answer_type",Witness_List: "witness_list_type_c",Exhibits: "exhibit_type_c",Stipulation: "stipulation_type_c",Subpoenas_Service: "sum_subp_type_c",sum: "sum_subp_type_c"};
        var map_field_sub_type_type = {notice_type: "filing_sub_type"};
		var discovery_subtype_type = '';
		$.each(map_fields_discovery_subtype,function(i,v) {
          if(i = discovery_subtype){
			  if(map_fields_discovery_subtype[i] == 'name_of_motion'){
				map_field_sub_type = $('#name_of_motion').val();  
			  }else{
				map_field_sub_type = $('#' + map_fields_discovery_subtype[i] + ' option:selected').text();				  
			  }
              return false;
           } else {
              map_field_sub_type = '';
           }
        }); */
		/* $.each(map_field_sub_type_type,function(i,v) {
			if(discovery_subtype == 'Notice' && $('#notice_type').val() == 'Filing'){
				 discovery_subtype_type = $('#' + map_field_sub_type_type[i] + ' option:selected').text() + '' + $('#filing_description').val();				
			}
        }); */
       /*  var arr1 = ['Witness_List', 'Exhibits', 'sum', 'Subpoena'];
        var arr2 = ['Subpoenas_Service', 'Verdict'];
        discoveryName = '';
        if ($.inArray(discovery_subtype,arr1) != -1){
           discoveryName = initial;
		   if(defendant_name != ''){
			discoveryName += ' '+ defendant_name;
		   }
		   if(subtype != ''){
			   discoveryName += ' '+ subtype;			   
		   }
		   if(map_field_sub_type != ''){
			discoveryName += ' '+ map_field_sub_type;
		   }
		   if(discovery_subtype_type != ''){
			discoveryName += ' '+ discovery_subtype_type;
		   }
		   if($('#discovery_sub_type_description').val() != ''){
			discoveryName += ' '+ $('#discovery_sub_type_description').val();
		   }
        } else if ($.inArray(discovery_subtype,arr2) != -1){
           discoveryName = subtype;
        } else {
		   discoveryName = initial +' '+ defendant_name +' '+ subtype +' '+ map_field_sub_type + ' ' + discovery_subtype_type+ ' ' + $('#discovery_sub_type_description').val();;
			discoveryName = initial;
		   if(defendant_name != ''){
			discoveryName += ' '+ defendant_name;
		   }
		   if(subtype != ''){
			   discoveryName += ' '+ subtype;			   
		   }
		   if(map_field_sub_type != ''){
			discoveryName += ' '+ map_field_sub_type;
		   }
		   if(discovery_subtype_type != ''){
			discoveryName += ' '+ discovery_subtype_type;
		   }
		   if($('#discovery_sub_type_description').val() != ''){
			discoveryName += ' '+ $('#discovery_sub_type_description').val();
		   }
		} */
		discoveryName = initial;
	   if(author_type_name != ''){
		discoveryName += ' '+ author_type_name;
	   }
	   if(discovery_type_no != ''){
		   discoveryName += ' '+ discovery_type_no;			   
	   } 
	   if(type_discovery != ''){
		   discoveryName += ' '+ type_discovery;			   
	   }
	   if(subtype != ''){
		   discoveryName += ' '+ subtype;			   
	   }
	   if(witness_nick != ''){
		   discoveryName += ' '+ witness_nick;			   
	   }
	   if(discovery_delivery_method != ''){
		   discoveryName += ' '+ discovery_delivery_method;			   
	   }
	   if(date_served != ''){
		   discoveryName += ' '+ date_served;			   
	   }

	  /*  if(map_field_sub_type != ''){
		discoveryName += ' '+ map_field_sub_type;
	   }
	    */
		if(discovery_description != ''){
			discoveryName += ' '+ discovery_description;
		}
         $('#document_name').val(discoveryName);
}
function typeDepo(){
	var type_discovery = $('select[name = "type"] option:selected').text();
	if(type_discovery == 'DEPO' || type_discovery == '3RD' || type_discovery == 'CME')
     {
     	// console.log("here");
 //     	var depo_parent_id = $('#parent_id').val();
 //     	var depo_parent_type = $('#parent_type').val();
 //     	if(depo_parent_id){
	// 	$.ajax({
	// 		type: 'POST',
	// 		url: 'index.php?module=DISC_Discovery&action=get_nickname&depo_parent_id='+depo_parent_id+'&depo_parent_type='+depo_parent_type,
	// 		async: false,
	// 		success: function(response){
	// 			 if(response != ''){
	// 			$('#q_a').empty();
	// 			$('#q_a').append('<option label = "" value=""></option><option label = "'+response+'"value = "'+response+'">'+response+'</option>');
	// 		 	pleadName();
	// 		 }

	// 		}
	// 	});
	// }
	$("#witness_type_c").parent().parent().show();
	$("#witness_nickname_c").parent().parent().show();
	if(typeof required_fields !== "undefined"){
				required_fields['witness_type_c'] = 'Witness';
				$('div[data-label="LBL_WITNESS_TYPE"]').html('Witness:<font color="#edd03d">*</font>');
				required_fields['witness_nickname_c'] = 'Witness Nickname';
				$('div[data-label="LBL_WITNESS_NICKNAME"]').html('Witness Nickname:<font color="#edd03d">*</font>');
			 }
	witness_type_change();
	$("#witness_type_c").attr("onchange","witnessType();");
     }
     else
     {
  //    	if(old_type){
  //    		$("#q_a").val(old_type)
  //    	}
  //    	else{
  //    	$('#q_a').empty();
		// $('#q_a').append(`
		// <option label="" value=""></option>
		// <option label="Q" value="Questions">Q</option>
		// <option label="A" value="Answers">A</option>
		// <option label="NOT" value="Notice">NOT</option>
		// <option label="OBJ" value="Objection">OBJ</option>
		// `);
		// }
		$("#witness_type_c").parent().parent().hide();
		$("#witness_nickname_c").parent().parent().hide();
		$("#witness_type_c").val("");
		$("#witness_contact_c").parent().parent().hide();
		$("#witness_contact_c").val("");
		$("#customcontact_id_c").val("");
		$("#witness_organization_c").parent().parent().hide();
		$("#witness_nickname_c").parent().parent().hide();
		$("#witness_organization_c").val("");
		$("#customaccount_id_c").val("");	
		$("#witness_nickname_c").val("");
	if(typeof required_fields !== "undefined"){
				delete required_fields['witness_type_c'];
				$('div[data-label="LBL_WITNESS_TYPE"]').html('Witness:');
				delete required_fields['witness_contact_c'];
				$('div[data-label="LBL_WITNESS_CONTACT"]').html('Witness Contact:');
			 	delete required_fields['witness_organization_c'];
				$('div[data-label="LBL_WITNESS_ORGANIZATION"]').html('Witness Organization:');
				delete required_fields['witness_nickname_c'];
				$('div[data-label="LBL_WITNESS_NICKNAME"]').html('Witness Nickname:');
			 }
		pleadName();

     }
}
function padNumber(number) {
                var string  = '' + number;
                string      = string.length < 2 ? '0' + string : string;
                return string;
            }
function caseLawyer(){
	var case_id = $('#disc_discovery_casescases_ida').val();
		$.ajax({
			type: 'POST',
			url: 'index.php?module=DISC_Discovery&action=get_related_case_lawyer&case_id='+case_id,
			async: false,
			success: function(response){
				 if(response != ''){
				var decode = JSON.parse(response);
				$.each(decode,function(k,v){
					$('#assigned_lawyer_1_c').val(v.assigned_user_name);
					$('#customuser_id_c').val(v.assigned_user_id);
					$('#disc_case_assistant_c').val(v.default_assistant_lawyer_name);
					$('#customuser_id2_c').val(v.default_assistant_lawyer_id);
				})
			 }

			}
		});
}
function witnessType(){
	var witness_type = $("#witness_type_c").val();
	if(witness_type == 'Accounts'){
		$("#witness_organization_c").parent().parent().show();
		$("#witness_contact_c").parent().parent().hide();
		$("#witness_contact_c").val("");
		$("#customcontact_id_c").val("");
		if(typeof required_fields !== "undefined"){
				required_fields['witness_organization_c'] = 'Witness Organization';
				$('div[data-label="LBL_WITNESS_ORGANIZATION"]').html('Witness Organization:<font color="#edd03d">*</font>');
				delete required_fields['witness_contact_c'];
				$('div[data-label="LBL_WITNESS_CONTACT"]').html('Witness Contact:');
			 }
	}
	else if(witness_type == 'Contacts'){
		$("#witness_organization_c").parent().parent().hide();
		$("#witness_contact_c").parent().parent().show();
		$("#witness_organization_c").val("");
		$("#customaccount_id_c").val("");	
		if(typeof required_fields !== "undefined"){
				required_fields['witness_contact_c'] = 'Witness Contact';
				$('div[data-label="LBL_WITNESS_CONTACT"]').html('Witness Contact:<font color="#edd03d">*</font>');
				delete required_fields['witness_organization_c'];
				$('div[data-label="LBL_WITNESS_ORGANIZATION"]').html('Witness Organization:');
			 }
	}
	else{
	$("#witness_contact_c").parent().parent().hide();
	$("#witness_contact_c").val("");
	$("#customcontact_id_c").val("");
	$("#witness_organization_c").parent().parent().hide();
	$("#witness_organization_c").val("");
	$("#witness_nickname_c").val("");
	$("#customaccount_id_c").val("");
	if(typeof required_fields !== "undefined"){
				delete required_fields['witness_contact_c'];
				delete required_fields['witness_organization_c'];
				$('div[data-label="LBL_WITNESS_ORGANIZATION"]').html('Witness Organization:');
				$('div[data-label="LBL_WITNESS_CONTACT"]').html('Witness Contact:');
			 }
	}
}
function witness_type_change(){
	// addToValidate('EditView', 'witness_type_c', 'enum', true, SUGAR.language.languages.DISC_Discovery.LBL_WITNESS_TYPE);
	var witness_type = $("#witness_type_c").val();
	if(witness_type == 'Accounts'){
		$("#witness_organization_c").parent().parent().show();
		$("#witness_contact_c").parent().parent().hide();
		if(typeof required_fields !== "undefined"){
				required_fields['witness_organization_c'] = 'Witness Organization';
				$('div[data-label="LBL_WITNESS_ORGANIZATION"]').html('Witness Organization:<font color="#edd03d">*</font>');
				delete required_fields['witness_contact_c'];
				$('div[data-label="LBL_WITNESS_CONTACT"]').html('Witness Contact:');
			 }
			 var witness_account_id = $('#customaccount_id_c').val();
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'index.php?module=DISC_Discovery&action=get_witness_nickname&witness_parent_id='+witness_account_id+'&witness_parent_type=Accounts',
		// 	async: false,
		// 	success: function(response){
		// 		 if(response != ''){
		// 		witness_nick = response;
		// 	 	pleadName();
		// 	 }
		// 	 else{
		// 	 	witness_nick = "";
		// 	 	pleadName();
		// 	 }

		// 	}
		// });	 
	}
	else if(witness_type == 'Contacts'){
		$("#witness_organization_c").parent().parent().hide();
		$("#witness_contact_c").parent().parent().show();
		if(typeof required_fields !== "undefined"){
				required_fields['witness_contact_c'] = 'Witness Contact';
				$('div[data-label="LBL_WITNESS_CONTACT"]').html('Witness Contact:<font color="#edd03d">*</font>');
				delete required_fields['witness_organization_c'];
				$('div[data-label="LBL_WITNESS_ORGANIZATION"]').html('Witness Organization:');
			 }
		 var witness_contact_id = $('#customcontact_id_c').val();
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'index.php?module=DISC_Discovery&action=get_witness_nickname&witness_parent_id='+witness_contact_id+'&witness_parent_type=Contacts',
		// 	async: false,
		// 	success: function(response){
		// 		 if(response != ''){
		// 		witness_nick = response;
		// 	 	pleadName();
		// 	 }
		// 	 else{
		// 	 	witness_nick = "";
		// 	 	pleadName();
		// 	 }

		// 	}
		// });	 
	}
	else{
	$("#witness_contact_c").parent().parent().hide();
	$("#witness_organization_c").parent().parent().hide();
	if(typeof required_fields !== "undefined"){
				delete required_fields['witness_contact_c'];
				delete required_fields['witness_organization_c'];
				$('div[data-label="LBL_WITNESS_ORGANIZATION"]').html('Witness Organization:');
				$('div[data-label="LBL_WITNESS_CONTACT"]').html('Witness Contact:');
			 }
	}
}