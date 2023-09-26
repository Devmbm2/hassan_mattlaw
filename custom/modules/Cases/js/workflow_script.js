var ids = [];
$(document).ready(function () {
  $("input[value='Save']").attr( "onclick", "workflows_popup(); return false;" );
  // document.getElementById( "SAVE" ).setAttribute( "onclick", "javascript: workflows_popup(); return false;" );
  $("#workflow_not_done_c").parent().parent().hide();
  $("#workflow_end_reason_c").parent().parent().hide();
  $("#workflow_opt_out_reason_c").parent().parent().hide();
    $("select#status").change(function () {
      ids = [];
      var type = $(this).val();
      var caseID = $("input[name='record']").val();
      // alert(type);
      $.ajax({
        type: 'GET',
        url: 'index.php?module=Cases&action=getAllRelatedWorkflows&event_type='+ type + '&case_id=' + caseID,
        contentType: 'application/x-www-form-urlencoded',
        dataType: 'text',
        data: 'sugar_body_only=true',
        async: true,
        success: function(data) {
          // console.log(document.querySelectorAll("#case_table tr").length);
          const isEmpty = $(data).find("#case_table tr").length;
          // console.log(data);
          if(isEmpty > 1){
          if(data){
            // console.log(data);
            YAHOO.SUGAR.MessageBox.show({
            msg: data,
            height: '700px',
            width: '200px',
            position: 'centre',
            title: 'Workflows to be Active',
        });
        $(".bd").append(`
<style>

.tooltip2 {
  position: relative;
  display: inline-block;
  //border-bottom: 1px dotted black;
}

.tooltip2 .tooltiptext {
  visibility: hidden;
  width: 300px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip2:hover .tooltiptext {
  visibility: visible;
}

</style>

        `);
          }
        }
        },
      });
$("#workflow_not_done_c").val('');
$("#workflow_end_reason_c").val('');
$("#workflow_end_status_c").val('Open');
$("#workflow_opt_out_reason_c").val('');
$("#workflow_not_done_c").parent().parent().hide();
$("#workflow_end_reason_c").parent().parent().hide();
$("#workflow_opt_out_reason_c").parent().parent().hide();
delete required_fields.workflow_not_done_c;
delete required_fields.workflow_end_reason_c;
delete required_fields.workflow_opt_out_reason_c;
    });
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
function CheckedAllWorkflows(){
  $("input[name='workflow_related']:checked").each(function() {
  ids.push(this.value);
  });
  var case_id= document.getElementsByName("record")[0].value;
  $.ajax({
    type: 'POST',
    url: 'index.php?module=Cases&action=confirm_workflow',
    data:{checkboxArray:ids,record_id:case_id,sugar_body_only:true},
    success: function(data) {
      var decode = JSON.parse(data);
      console.log(decode);
              YAHOO.SUGAR.MessageBox.show({
                msg: decode,
                height: '700px',
                width: '200px',
                // position: 'centre',
                title: 'Confirm Workflows',
            });
              // var _form = document.getElementById('EditView'); _form.action.value='Save';if(custom_validation())if(check_form('EditView'))SUGAR.ajaxUI.submitForm(_form);return false;
    }
  });
}
function yes_workflow(){
  $.ajax({
    url: 'index.php?module=Cases&action=StatusActiveAndInactive',
    type: 'POST',
    data:{checkboxArray:ids},
    success: function(data) {
      console.log(data);
              YAHOO.SUGAR.MessageBox.show({
                msg: "Your selected workflows is activated now.",
                height: '70px',
                width: '200px',
                // position: 'centre',
                title: 'Success',
            });
              var _form = document.getElementById('EditView'); _form.action.value='Save';if(custom_validation())if(check_form('EditView'))SUGAR.ajaxUI.submitForm(_form);return false;
    }
  });
}
function no_workflow(){
              YAHOO.SUGAR.MessageBox.show({
                msg: "Your record is saved without activation of any workflow.",
                height: '70px',
                width: '200px',
                // position: 'centre',
                title: 'Declined',
            });
              var _form = document.getElementById('EditView'); _form.action.value='Save';if(custom_validation())if(check_form('EditView'))SUGAR.ajaxUI.submitForm(_form);return false;
}
function cancelWorkflow(){
  var _form = document.getElementById('EditView'); _form.action.value='Save';if(custom_validation())if(check_form('EditView'))SUGAR.ajaxUI.submitForm(_form);return false;
}
function ShowDescription(description){
 $('#sugarMsgWindow_c').append(`
 <div  id="sugarMsgWindow "  class="yui-module yui-overlay yui-panel " style="visibility: inherit; position: absolute; top:10%; margin:20px 15%;">
 <a class="container-close" href="#" onclick="ClosePopup(this)" >Close</a>
 <div class="hd" id="sugarMsgWindow_h" style="cursor: move;">Description</div>
 <div class="bd">
 <div class="container " style="width: 400px; font-size:15px; background-color:white; ">
<div style="padding:5%;">`+description+`</div></div></div> </div>`);
}

function ClosePopup(e){
 $($(e).parent()[0]).remove();
}

function workflows_popup(){
  var conditions_check={};
  var caseID = $("input[name='record']").val();
   var type= $( "#type option:selected" ).val();
  if(type=="Car_Accident"){
      conditions_check={type:"type",}
  }
  var insurance_or_collectability_c= $( "#insurance_or_collectability_c option:selected" ).val();
  if(insurance_or_collectability_c=="Low_Insurance" || insurance_or_collectability_c=="Medium_Insurance" ||
  insurance_or_collectability_c=="High_Insurance" ){
      conditions_check.insurance_or_collectability_c="insurance_or_collectability_c";
     }
 var damages_c= $( "#damages_c option:selected" ).val();
  if(damages_c=="Low_Damages" || damages_c=="Medium_Damages" ||
  damages_c=="High_Damages" ){
      conditions_check.damages_c="damages_c";
  }
var liability_c= $( "#liability_c option:selected" ).val();
  if(liability_c=="Low_Liability" || liability_c=="Medium_Liability" ||
  liability_c=="High_Liability" ){
        conditions_check.liability_c="liability_c";
    }
 var number_potential_plaintif_c= $( "#number_potential_plaintif_c option:selected" ).val();
  if(number_potential_plaintif_c !=""){
      conditions_check.number_potential_plaintif_c="number_potential_plaintif_c";
     }
    if(conditions_check.type=="type" &&
   conditions_check.insurance_or_collectability_c=="insurance_or_collectability_c" &&
     conditions_check.damages_c=="damages_c" &&
      conditions_check.liability_c=="liability_c" &&
       conditions_check.number_potential_plaintif_c=="number_potential_plaintif_c" )
    {
   var contact_id = $("[name='contact_id2_c']").val();
  $.LoadingOverlay("show", {zIndex: 999999 } );
  $.ajax({
    url: 'index.php?module=Cases&action=show_related_workflows&contact_id='+contact_id+ '&case_id='+caseID,
    type: 'POST',
    contentType: 'application/x-www-form-urlencoded',
    dataType: 'text',
    data: 'sugar_body_only=true',
    async: true,
    success : function (result){
      console.log(result);
      const isEmpty = $(result).find("#case_table tr").length;
          console.log(isEmpty);
          if(isEmpty > 1){
    if(result!='false')
    {
  YAHOO.SUGAR.MessageBox.show({msg: result, height:'700px', width:'200px',title: 'WorkFlows to be Active',position:'center'});
    $.LoadingOverlay("hide");
    }
  }
    else{
      $.LoadingOverlay("hide");
      save_form();
    }
    }
  });
}
else
{
  save_form();
}
}
function save_form(){
      var _form =
document.getElementById('EditView');
        _form.action.value='Save';
if(check_form('EditView')){
SUGAR.ajaxUI.submitForm(_form);
return false;
}
}
