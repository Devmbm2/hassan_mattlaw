$(document).ready(function(){
	$('#detailpanel_3').parent().hide();
	$('#outgoing_document').attr('onchange','document_processed_name_required();');
	author_type_change();
	document_processed_name_required();
	create_event();
	show_qc_failed_box();
	show_assistant_failed_box();
	$('#plea_pleadings_casescases_ida').on('change',function(){caseLawyer();});
	$('#plea_pleadings_cases_name').on('blur',function(){caseLawyer();});
	$('#btn_plea_pleadings_cases_name').on('blur',function(){caseLawyer();});
	$('#plea_pleadings_cases_name').on('change',function(){caseLawyer();});
	$("#qc_review_remarks_c").attr('readonly','readonly');
});

function author_type_change(){
	var author_type = $('#author_type').val();
	if(author_type == 'Other'){
		$('#author_c').parent().parent().show();
		addToValidate('EditView','author_c','text',true,'Author');
	}else{
		$('#author_c').parent().parent().hide();
		removeFromValidate('EditView', 'author_c');
	}
}
function document_processed_name_required(){
	var processed = $('input[name="outgoing_document"]:checked').val();
	if(action_sugar_grp1 != 'DetailView'){
		if(processed == 1){
			$('#document_processed_description').parent().parent().show();
			/* addToValidate('EditView','document_processed_description','text',true,'Document Processed'); */
		}else{
			/* removeFromValidate('EditView', 'document_processed_description'); */
			$('#document_processed_description').parent().parent().hide();
		}
	}
}
function create_event(){
	$("#create_event").change(function() {
		if(this.checked) {
			$('#detailpanel_3').parent().show();
		}else{
			$('#detailpanel_3').parent().hide();
		}
	});
}
function show_qc_failed_box(){
	$("#qc1_reason_for_fail_c").parent().parent().hide();
	$("input[name='qc1_reviewed_c']").on('change', function(){
		let input = $(this).val();
		if(input == 'qc1_fail'){
			$("#qc1_reason_for_fail_c").parent().parent().show();
			$("input[name='assistant_reviewed_c']:checked").attr('value','NULL');
			$("input[name='qc1_reviewed_c']:checked").attr('value','qc1_fail');
			$("#assistant_reason_for_fail_c").parent().parent().hide();
			// $("#qc_review_remarks_c").parent().parent().hide();
		}
		else if(input == 'qc1_fixed'){
		        $("#qc1_reason_for_fail_c").parent().parent().hide();
		        $("#assistant_reason_for_fail_c").parent().parent().hide();
		        $("#qc_review_remarks_c").parent().parent().show();
		        $("input[name='assistant_reviewed_c']:checked").attr('value','NULL');
		        $("input[name='qc1_reviewed_c']:checked").attr('value','qc1_fixed');
		      }
		      else if(input == 'qc1_pass'){
		        $("#qc1_reason_for_fail_c").parent().parent().hide();
		        $("#assistant_reason_for_fail_c").parent().parent().hide();
		        // $("#qc_review_remarks_c").parent().parent().hide();
		        $("input[name='assistant_reviewed_c']:checked").attr('value','NULL');
		        $("input[name='qc1_reviewed_c']:checked").attr('value','qc1_pass');
		      }
	})
}
function show_assistant_failed_box(){
	$("#assistant_reason_for_fail_c").parent().parent().hide();
	$("input[name='assistant_reviewed_c']").on('change', function(){
		let input = $(this).val();
		if(input == 'assistant_fail'){
				$("#assistant_reason_for_fail_c").parent().parent().show();
				$("input[name='qc1_reviewed_c']:checked").attr('value','NULL');
				$("#qc1_reason_for_fail_c").parent().parent().hide();
				$("input[name='assistant_reviewed_c']:checked").attr('value','assistant_fail');
				// $("#qc_review_remarks_c").parent().parent().hide();
			}
			else if(input == 'assistant_pass'){
				$("#assistant_reason_for_fail_c").parent().parent().hide();
				$("input[name='qc1_reviewed_c']:checked").attr('value','NULL');
				$("#qc1_reason_for_fail_c").parent().parent().hide();
				$("input[name='assistant_reviewed_c']:checked").attr('value','assistant_pass');
				// $("#qc_review_remarks_c").parent().parent().hide();
			}
	})
}
function caseLawyer(){
	// alert("1");
	var case_id = $('#plea_pleadings_casescases_ida').val();
	// console.log(case_id);
		$.ajax({
			type: 'POST',
			url: 'index.php?module=PLEA_Pleadings&action=get_related_case_lawyer&case_id='+case_id,
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
function remove_attachment(id){
	if(id){
		$.ajax({
			type: 'POST',
			url: 'index.php?module=PLEA_Pleadings&action=removeAttachment&note_id='+ id,
			async: false,
			success: function(response){
				console.log("remove");
			}
		});
}
}