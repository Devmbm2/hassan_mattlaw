$(document).ready(function(){
  witness_type_change();
  // $("#qc_review_remarks_c").parent().parent().hide();
  let qr_review = $("#qc1_reviewed_c").text();
  // alert(qr_review);
    if(qr_review == '\nQC1 Fail\n'){
        $("#qc1_reason_for_fail_c").parent().parent().show();
        $("#assistant_reason_for_fail_c").parent().parent().parent().hide();
        $("#assistant_reviewed_c").parent().parent().parent().hide();
        $("#qc1_reviewed_c").parent().parent().show();
        // $("#qc_review_remarks_c").parent().parent().parent().hide();
      }
      else if(qr_review == '\nQC1 Fixed\n'){
        $("#qc1_reason_for_fail_c").parent().parent().parent().hide();
        $("#assistant_reason_for_fail_c").parent().parent().parent().hide();
        $("#assistant_reviewed_c").parent().parent().parent().hide();
        $("#qc1_reviewed_c").parent().parent().show();
        $("#qc_review_remarks_c").parent().parent().show();
      }
      else if(qr_review == '\nQC1 Pass\n'){
        $("#qc1_reason_for_fail_c").parent().parent().parent().hide();
        $("#assistant_reason_for_fail_c").parent().parent().parent().hide();
        // $("#qc_review_remarks_c").parent().parent().parent().hide();
        $("#assistant_reviewed_c").parent().parent().parent().hide();
        $("#qc1_reviewed_c").parent().parent().show();
      }
    let ar_review = $("#assistant_reviewed_c").text();
    if(ar_review == '\nAssistant Fail\n'){
        $("#assistant_reason_for_fail_c").parent().parent().show();
        $("#qc1_reason_for_fail_c").parent().parent().parent().hide();
        $("#assistant_reviewed_c").parent().parent().show();
        $("#qc1_reviewed_c").parent().parent().parent().hide();
        // $("#qc_review_remarks_c").parent().parent().parent().hide();
      }
      else if(ar_review == '\nAssistant Pass\n'){
        $("#assistant_reason_for_fail_c").parent().parent().parent().hide();
        $("#qc1_reason_for_fail_c").parent().parent().parent().hide();
        $("#assistant_reviewed_c").parent().parent().show();
        $("#qc1_reviewed_c").parent().parent().parent().hide();
        // $("#qc_review_remarks_c").parent().parent().parent().hide();
      }
      let subtype = $("#q_a").val();
      if(subtype == "Questions"){
        $("#response_date").parent().parent().show();
      }
      else{
        $("#response_date").parent().parent().hide();
      }
})
$(document).on('click', '#mark_done', function (e) {

  base_url = document.location.origin + window.location.pathname
  setTimeout(function () { location.href = base_url + "?module=DISC_Discovery&action=ListView"; }, 2500);
});
function witness_type_change(){
  var type = $("#type").val();
  if(type == 'Deposition' || type == '3rd_Non_Party_Requests' || type == 'CME'){
  $("#witness_type_c").parent().parent().show();
  var witness_type = $("#witness_type_c").val();
  if(witness_type == 'Accounts'){
    $("#customaccount_id_c").parent().parent().show();
    $("#customcontact_id_c").parent().parent().hide();
    $("#witness_nickname_c").parent().parent().show();
  }
  else if(witness_type == 'Contacts'){
    $("#customaccount_id_c").parent().parent().hide();
    $("#customcontact_id_c").parent().parent().show();
    $("#witness_nickname_c").parent().parent().show();
  }
  else{
  $("#customcontact_id_c").parent().parent().hide();
  $("#customaccount_id_c").parent().parent().hide();
  $("#witness_nickname_c").parent().parent().hide();
  }
  }
  else{
    $("#witness_type_c").parent().parent().hide();
  $("#customcontact_id_c").parent().parent().hide();
  $("#customaccount_id_c").parent().parent().hide();
  $("#witness_nickname_c").parent().parent().hide();
  }
}