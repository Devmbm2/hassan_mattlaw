$(document).ready(function () {
  $("input[value='Save']").attr( "onclick", "workflows_popup(); return false;" );
  // document.getElementById( "SAVE" ).setAttribute( "onclick", "javascript: workflows_popup(); return false;" );
  $("#workflow_not_done_c").parent().parent().hide();
  $("#workflow_end_reason_c").parent().parent().hide();
  $("#workflow_opt_out_reason_c").parent().parent().hide();
    document.querySelector('#workflow_end_status_c').addEventListener('change', function(){
  var workflow_end_status_c = $('#workflow_end_status_c').val();
      if(workflow_end_status_c == 'Not_Done'){
        $("#workflow_not_done_c").parent().parent().show();
        $("#workflow_opt_out_reason_c").val('');
        $("#workflow_opt_out_reason_c").parent().parent().hide();
        delete required_fields.workflow_opt_out_reason_c;
        required_fields["workflow_not_done_c"] = 'Workflow Not Done Reason';
      }
      else if(workflow_end_status_c == 'Opt_Out'){
        $("#workflow_opt_out_reason_c").parent().parent().show();
        $("#workflow_not_done_c").parent().parent().hide();
        $("#workflow_not_done_c").val('');
        $("#workflow_end_reason_c").parent().parent().hide();
        $("#workflow_end_reason_c").val('');
        delete required_fields.workflow_not_done_c;
        delete required_fields.workflow_end_reason_c;
        required_fields["workflow_opt_out_reason_c"] = 'Workflow Opt Out Reason';
      }
      else{
        $("#workflow_not_done_c").parent().parent().hide();
        $("#workflow_not_done_c").val('');
        $("#workflow_end_reason_c").parent().parent().hide();
        $("#workflow_end_reason_c").val('');
        $("#workflow_opt_out_reason_c").val('');
        $("#workflow_opt_out_reason_c").parent().parent().hide();
        delete required_fields.workflow_not_done_c;
        delete required_fields.workflow_end_reason_c;
        delete required_fields.workflow_opt_out_reason_c;
      }
    });
    document.querySelector('#workflow_not_done_c').addEventListener('change', function(){
  var workflow_not_done_c = $('#workflow_not_done_c').val();
      if(workflow_not_done_c == 'Other'){
        $("#workflow_end_reason_c").parent().parent().show();
        required_fields["workflow_end_reason_c"] = 'Explain Reason';
      }
      else{
        $("#workflow_end_reason_c").parent().parent().hide();
        delete required_fields.workflow_end_reason_c;
      }
    });
  const e = new Event("change");
  const element = document.querySelector('#workflow_end_status_c')
  element.dispatchEvent(e);
  const e2 = new Event("change");
  const element2 = document.querySelector('#workflow_not_done_c')
  element2.dispatchEvent(e2);
});