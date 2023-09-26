$(document).ready(function(){
	$('#OneTwoFourthDropdownField').parent().parent().hide();
	$('#detailpanel_3').parent().hide();
	if($("#create_event").is(":checked")){
		$('#detailpanel_3').parent().show();
	}else{
		$('#detailpanel_3').parent().hide();
	}
	SUGAR.util.doWhen(
			"typeof(formName) != 'undefined'",
			create_event_apply
	);
	show_qc_failed_box();
	show_assistant_failed_box();
	days_counter();
	$("#qc_review_remarks_c").attr('readonly','readonly');
	// $("#qc_review_remarks_c").parent().parent().hide();
	let qr_review = $("input[name='qc1_reviewed_c']:checked").val();
		if(qr_review == 'qc1_fail'){
				$("#qc1_reason_for_fail_c").parent().parent().show();
				$("input[name='assistant_reviewed_c']:checked").attr('value','NULL');
				$("input[name='qc1_reviewed_c']:checked").attr('value','qc1_fail');
				$("#assistant_reason_for_fail_c").parent().parent().hide();
				// $("#qc_review_remarks_c").parent().parent().hide();
			}
			else if(qr_review == 'qc1_fixed'){
		        $("#qc1_reason_for_fail_c").parent().parent().hide();
		        $("#assistant_reason_for_fail_c").parent().parent().hide();
		        $("#qc_review_remarks_c").parent().parent().show();
		        $("input[name='assistant_reviewed_c']:checked").attr('value','NULL');
		        $("input[name='qc1_reviewed_c']:checked").attr('value','qc1_fixed');
		      }
		      else if(qr_review == 'qc1_pass'){
		        $("#qc1_reason_for_fail_c").parent().parent().hide();
		        $("#assistant_reason_for_fail_c").parent().parent().hide();
		        // $("#qc_review_remarks_c").parent().parent().hide();
		        $("input[name='assistant_reviewed_c']:checked").attr('value','NULL');
		        $("input[name='qc1_reviewed_c']:checked").attr('value','qc1_pass');
		      }
	let ar_review = $("input[name='assistant_reviewed_c']:checked").val();
		if(ar_review == 'assistant_fail'){
				$("#assistant_reason_for_fail_c").parent().parent().show();
				$("input[name='qc1_reviewed_c']:checked").attr('value','NULL');
				$("#qc1_reason_for_fail_c").parent().parent().hide();
				$("input[name='assistant_reviewed_c']:checked").attr('value','assistant_fail');
				// $("#qc_review_remarks_c").parent().parent().hide();
			}
			else if(ar_review == 'assistant_pass'){
				$("#assistant_reason_for_fail_c").parent().parent().hide();
				$("input[name='qc1_reviewed_c']:checked").attr('value','NULL');
				$("#qc1_reason_for_fail_c").parent().parent().hide();
				$("input[name='assistant_reviewed_c']:checked").attr('value','assistant_pass');
				// $("#qc_review_remarks_c").parent().parent().hide();
			}
});

function create_event_apply(){
	create_event();
	$('#' + formName +' #type').on('change', function() {
	 create_event();
	});
}
function create_event(){
	var type = $('#' + formName +' #type').val();
	console.log(type);
	if(type == 'Deposition') {
		required_fields['date_start_date'] = 'Start Date';
		required_fields['date_end_date'] = 'End Date';
		$('#detailpanel_3').parent().show();
	}else{
		if(typeof required_fields !== "undefined"){
			delete required_fields.date_start_date;
			delete required_fields.date_end_date;
		}
		$('#detailpanel_3').parent().hide();
	}
	var ComparedTypes = {
    Request_to_Produce: "Request_to_Produce",
    Request_for_Admissions: "Request_for_Admissions",
    Interrogatories: "Interrogatories"
  };
  if (ComparedTypes.hasOwnProperty(type) || type=='3rd_Non_Party_Requests') {
    // If the property exists, show the element
    $('#OneTwoFourthDropdownField').parent().parent().show();
     // addToValidate('EditView', 'OneTwoFourthDropdownField', 'enum', true, 'One To Four Field is required');
		required_fields['OneTwoFourthDropdownField'] = 'Discovery Type No.';  
  } else {
    // If the property doesn't exist, hide the element
    $('#OneTwoFourthDropdownField').parent().parent().hide();
    $('#OneTwoFourthDropdownField').val('');
    pleadName();
    if(typeof required_fields !== "undefined"){
			delete required_fields.OneTwoFourthDropdownField;
		}
  }
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
function days_counter(){
	$("#day_counter_c").attr('readOnly','readonly');
	$("#delivery_method_c").on('change', function(){
		let input = $(this).val();
		if(input == 'Email_or_snail_mail'){
			$("#day_counter_c").attr('value','35');
		}
		else if(input == 'Served_with_Complaint'){
			$("#day_counter_c").attr('value','60');
		}
		else if(input == 'FAX'){
			$("#day_counter_c").attr('value','29');
		}
		else{
			$("#day_counter_c").attr('value','');
		}
		var subtype = $('#q_a option:selected').text();
		if(subtype == 'Q'){
     	var response_date = $("#response_date").val();
     	$("#response_date").parent().parent().parent().show();
     	var date = $("#date_served").val();
     	var result = new Date(date);
     	// alert(result);
	    result.setDate(result.getDate() + parseInt($("#day_counter_c").val()));
	    formatted = padNumber(result.getUTCMonth() + 1) + '/' + padNumber(result.getUTCDate()) + '/' + result.getUTCFullYear();
	    $("#response_date").val(formatted);
     }
     else if(subtype != 'Q'){
     	$("#response_date").parent().parent().parent().hide();
     	$("#response_date").val("");
     }
	})
}
function padNumber(number) {
                var string  = '' + number;
                string      = string.length < 2 ? '0' + string : string;
                return string;
            }
function remove_attachment(id){
	if(id){
		$.ajax({
			type: 'POST',
			url: 'index.php?module=DISC_Discovery&action=removeAttachment&note_id='+ id,
			async: false,
			success: function(response){
				console.log("remove");
			}
		});
}
}