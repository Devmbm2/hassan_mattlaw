$(document).ready(function(){
	SUGAR.util.doWhen(
			"typeof(display_hide_fields) != 'undefined'",
			show_hide_fields_ready
	);
});
function show_hide_fields_ready(){
	
	show_hide_fields();
	subcategory_id_show_hide_fields();
	pleadName();
	$('#category_id').attr('onchange','show_hide_fields();subcategory_id_show_hide_fields();showhideBaseNotTyp();pleadName();');
	$('#author_type').attr('onchange','pleadName();author_type_change();');
	$('#delivery_method_c').attr('onchange','pleadName();');
	$('#date_filed_c').attr('onchange','pleadName();');
	$('#pleading_sub_type_description').attr('focusout','pleadName();');
	$('#account_id_c').on('change',function(){pleadName();});
	$('#defendant_organization').on('blur',function(){pleadName();});
    	/* $('#btn_defendant_organization').on('blur',function(){pleadName();});
     	$('#defendant_organization').on('change',function(){pleadName();}); */
     	$('#parent_id').on('change',function(){pleadName();});
     	$('#parent_name').on('blur',function(){pleadName();});
     	$('#btn_parent_name').on('blur',function(){pleadName();});
}
function show_hide_fields(){
	$('#lastname_c').closest('.edit-view-row-item').hide();
        $('#nickname_c').closest('.edit-view-row-item').hide();
	var fields_to_hide = ['subcategory_id', 'complaint_answer_type', 'name_of_motion', 'notice_type'/* , 'filing_sub_type' */, 'hearing_type', /* 'sent_received','amount', */ 'orders_sub_type'];
	$.each(fields_to_hide, function( index, value ){
		$('#'+value).closest('.edit-view-row-item').hide();
		removeFromValidate('EditView',value);
	});
	if($('#category_id').val() == 'Pleading'){
		$('#subcategory_id').closest('.edit-view-row-item').show();
		addToValidate('EditView','subcategory_id','enum',true,'Pleading Sub Type');
		$('div[data-label="LBL_SF_SUBCATEGORY"]').html('Pleading Sub Type: <span class="required">*</span>');
		$('#subcategory_id').attr('onchange','subcategory_id_show_hide_fields();showhideBaseNotTyp();pleadName();');
		var fields_to_change = ['orders_sub_type','name_of_motion','complaint_answer_type','witness_list_type_c','exhibit_type_c','stipulation_type_c','sum_subp_type_c', 'filing_sub_type', 'filing_description', 'pleading_sub_type_description'];
     		$.each(fields_to_change, function( index, value ){
                $('#'+value).attr('onchange','pleadName();');
     		});
	}
}
function subcategory_id_show_hide_fields(){
	if($('#category_id').val() == 'Pleading'){
		var subcategory_id = $('#subcategory_id').val();
		if(typeof(display_hide_fields) !==  'undefined' && display_hide_fields != ''){
			
			$.each(display_hide_fields, function( index, value ){
				if(index != subcategory_id){
					$.each(value, function(i, field ){
						$('#'+field).closest('.edit-view-row-item').hide();
						removeFromValidate('EditView',field);
					});				
				}  
			});
		}
		
		if(typeof(subcategory_id) !==  'undefined' && subcategory_id !==  ''){
			if(typeof(display_hide_fields[subcategory_id]) !== 'undefined' && display_hide_fields[subcategory_id] != ''){
			var selected_subcategory_id_value = display_hide_fields[subcategory_id];
				if(typeof(selected_subcategory_id_value) !==  'undefined' && selected_subcategory_id_value != ''){
					$.each(selected_subcategory_id_value, function(i, value){
						$('#'+value).closest('.edit-view-row-item').show();
						addToValidate('EditView',value,'enum',true,value);
					});
				}
			}
			
		}
	}else{
		if(typeof(display_hide_fields) !==  'undefined' && display_hide_fields != ''){
			
			$.each(display_hide_fields, function( index, value ){
				if(index != subcategory_id){
					$.each(value, function(i, field ){
						$('#'+field).closest('.edit-view-row-item').hide();
					});				
				}  
			});
		}
	}
}

function pleadName() {
     var author_type = $('#author_type').val();
     var type_pleading = $('#category_id').val();
     var pleading_subtype = $('#subcategory_id').val();
     var subtype = $('#subcategory_id option:selected').text();
     var delivery_method = $('#delivery_method_c option:selected').text();
     var description = $('#pleading_sub_type_description').val();
     var date_served = $('#date_filed_c').val();
    /*  var defendant_name = $('#human_defendant').val();
	 if(defendant_name != ''){
		var defendant_name = defendant_name.split(" ");
		var defendant_first_name = defendant_name[0];
		var defendant_last_name = defendant_name[1];
		if(defendant_first_name != ' ' && defendant_last_name != ' '){
			defendant_name = defendant_first_name.charAt(0) + defendant_last_name.charAt(0) + "'s"; 
		}
	 } */
     var map_field_sub_type = '';
     var pleadingName;
	 var author_type_name = '';
     var initial = '';
     if (author_type  == "Plaintiff"){
        initial = "P's";
		var Plaintiff = $('#parent_name').val();
		if(Plaintiff != ''){
			var Plaintiff_name = Plaintiff.split(" ");
			var Plaintiff_first_name = Plaintiff[0];
			var Plaintiff_last_name = Plaintiff[1];
			if(Plaintiff_first_name != ' ' && Plaintiff_last_name != ' '){
				Plaintiff_name = Plaintiff_first_name.charAt(0) + Plaintiff_last_name.charAt(0) + "'s"; 
				author_type_name = Plaintiff_name;
			}
		}
     }else if (author_type == "Defendant"){
        initial = "D's";
		var Plaintiff = $('#parent_name').val();
		if(Plaintiff != ''){
			var Plaintiff_name = Plaintiff.split(" ");
			var Plaintiff_first_name = Plaintiff[0];
			var Plaintiff_last_name = Plaintiff[1];
			if(Plaintiff_first_name != ' ' && Plaintiff_last_name != ' '){
				Plaintiff_name = Plaintiff_first_name.charAt(0) + Plaintiff_last_name.charAt(0) + "'s"; 
				author_type_name = Plaintiff_name;
			}
		}
     }else if (author_type == "Court"){
        initial = "Ct's";
		var case_id = $('#plea_pleadings_casescases_ida').val();
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
        initial = "O's";
		var Plaintiff = $('#parent_name').val();
		if(Plaintiff != ''){
			var Plaintiff_name = Plaintiff.split(" ");
			var Plaintiff_first_name = Plaintiff[0];
			var Plaintiff_last_name = Plaintiff[1];
			if(Plaintiff_first_name != ' ' && Plaintiff_last_name != ' '){
				Plaintiff_name = Plaintiff_first_name.charAt(0) + Plaintiff_last_name.charAt(0) + "'s"; 
				author_type_name = Plaintiff_name;
			}
		}
     }
     if (type_pleading == "Pleading"){
        var map_fields_pleading_subtype = {Notice: "notice_type", Order: "orders_sub_type",Hearing_Notice: "notice_type",Motion: "name_of_motion",Complaint:"complaint_answer_type",Answer:"complaint_answer_type",Witness_List: "witness_list_type_c",Exhibits: "exhibit_type_c",Stipulation: "stipulation_type_c",Subpoenas_Service: "sum_subp_type_c",sum: "sum_subp_type_c"};
        var map_field_sub_type_type = {notice_type: "filing_sub_type"};
		var pleading_subtype_type = '';
		$.each(map_fields_pleading_subtype,function(i,v) {
          if(i = pleading_subtype){
			  if(map_fields_pleading_subtype[i] == 'name_of_motion'){
				map_field_sub_type = $('#name_of_motion').val();  
			  }else{
				map_field_sub_type = $('#' + map_fields_pleading_subtype[i] + ' option:selected').text();				  
			  }
              return false;
           } else {
              map_field_sub_type = '';
           }
        });
		$.each(map_field_sub_type_type,function(i,v) {
			if(pleading_subtype == 'Notice' && $('#notice_type').val() == 'Filing'){
				 pleading_subtype_type = $('#' + map_field_sub_type_type[i] + ' option:selected').text() + '' + $('#filing_description').val();				
			}
        });
        var arr1 = ['Witness_List', 'Exhibits', 'sum', 'Subpoena'];
        var arr2 = ['Subpoenas_Service', 'Verdict'];
        pleadingName = '';
        if ($.inArray(pleading_subtype,arr1) != -1){
           pleadingName = initial;
		   if(author_type_name != ''){
			pleadingName += ' '+ author_type_name;
		   }
		   if(subtype != ''){
			   pleadingName += ' '+ subtype;			   
		   }
		   if(map_field_sub_type != ''){
			pleadingName += ' '+ map_field_sub_type;
		   }
		   if(pleading_subtype_type != ''){
			pleadingName += ' '+ pleading_subtype_type;
		   }
		   if($('#pleading_sub_type_description').val() != ''){
			pleadingName += ' '+ $('#pleading_sub_type_description').val();
		   }
        } else if ($.inArray(pleading_subtype,arr2) != -1){
           pleadingName = subtype;
        } else {
		   //pleadingName = initial +' '+ author_type_name +' '+ subtype +' '+ map_field_sub_type + ' ' + pleading_subtype_type+ ' ' + $('#pleading_sub_type_description').val();;
			pleadingName = initial;
		   if(author_type_name != ''){
			pleadingName += ' '+ author_type_name;
		   }
		   if(subtype != ''){
			   pleadingName += ' '+ subtype;			   
		   }
		   if(delivery_method != ''){
			   pleadingName += ' '+ delivery_method;			   
		   }
		   if(date_served != ''){
			   pleadingName += ' '+ date_served;			   
		   }
		   if(map_field_sub_type != ''){
			pleadingName += ' '+ map_field_sub_type;
		   }
		   if(pleading_subtype_type != ''){
			pleadingName += ' '+ pleading_subtype_type;
		   }
		   if($('#pleading_sub_type_description').val() != ''){
			pleadingName += ' '+ $('#pleading_sub_type_description').val();
		   }
		}
     }
     //    $('#EditView'+ ' #document_name').val(pleadingName);
         $('#document_name').val(pleadingName);
}
