$( document ).ready(function() {
  $('#reasons_c').parent().parent().hide();
  $('#extend_date_c').parent().parent().hide();
  $('#reason_on_selected_other_option_c').parent().parent().hide();
  $("#btn_name_of_doctor_c").attr("onclick", "OpenPopupRelatedAssignedAttorney();");
  $('#status').change(function(){
    if(this.value=='extend'){
       $('#reasons_c').parent().parent().show();
       $('#extend_date_c').parent().parent().show();
       if(typeof required_fields !== "undefined"){
           required_fields['extend_date_c'] = 'Extend Date';
  }
     
    }else{
       $('#reasons_c').parent().parent().hide();
       $('#extend_date_c').parent().parent().hide();
       delete required_fields.extend_date_c;
    }
  });
  $('#reasons_c').change(function(){
    if(this.value=='other'){
      $('#reason_on_selected_other_option_c').parent().parent().show();
    }else if(this.value=='selectWorkflow'){
      var type = $('#status').val();
      $.LoadingOverlay("show", {zIndex: 999999 } );
      $.ajax({
        type: 'GET',
        url: 'index.php?module=Tasks&action=getAllRelatedWorkflows&event_type=' + type,
        contentType: 'application/x-www-form-urlencoded',
        dataType: 'text',
        data: 'sugar_body_only=true',           
        async: true,  
        success: function(data) {
          if(data){
            YAHOO.SUGAR.MessageBox.show({
          msg: data,
          height: '700px',
          width: '200px',
          position: 'centre',
          title: 'Workflows to be Active',


      });
            
          }
        $.LoadingOverlay("hide");
      }});
    }else{
      $('#reason_on_selected_other_option_c').parent().parent().hide();
    }
  });

});
function CheckedAllWorkflows(){
  var ids = [];
  $("input[name='workflow_related']:checked").each(function() {
  ids.push(this.value);
  });
  $.ajax({
    type: 'POST',
    url: 'index.php?module=Tasks&action=StatusActiveAndInactive',
    data:{checkboxArray:ids},
    success: function(data) {
              YAHOO.SUGAR.MessageBox.show({
                msg: 'Your Selected workflows has been activated',
                height: '70px',
                width: '100px',
                position: 'centre',
                title: 'Success',
            });
    }});
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
var toggleElements = function () {
    if($("#type_of_todo_c").val() == "Order_medical_record") {
        $("#detailpanel_0").parent().show();
        $('#beginning_date_range_of_reco_c').closest('.edit-view-row-item').hide();
        $('#end_date_of_med_rec_requeste_c').closest('.edit-view-row-item').hide();
     if($('#date_range_med_rec_requested_c').val() == 'Specific_Dates_Of_Medical_Records'){
        $('#beginning_date_range_of_reco_c').closest('.edit-view-row-item').show();
        $('#end_date_of_med_rec_requeste_c').closest('.edit-view-row-item').show();
        
        }
        $("div[data-label='LBL_CONTACT_NAME']").text('Client:');
        let client_name = $("#contact_name").val();
        let medical_facility = $("#name_of_doctor_c").val();
        let date_range_requested = $('#date_range_med_rec_requested_c option:selected').text();
        $("#name").val(client_name + '-' + medical_facility + '-' + date_range_requested);
    } 
    else{
      $("#detailpanel_0").parent().hide();
      $("div[data-label='LBL_CONTACT_NAME']").text('Contact Name:');
      $("#name").val('');
    }
};
function OpenPopupRelatedAssignedAttorney(){
      open_popup(
"MEDP_Medical_Providers", 
600, 
400, 
"&query=1&parent_id=" + $('#contact_id').val(), 
true, 
false, 
{"call_back_function":"set_return","form_name":"EditView","field_to_name_array":{"id":"medp_medical_providers_id_c","name":"name_of_doctor_c"}}, 
"single", 
true
);
  
}
$(document).on('change', "#type_of_todo_c", toggleElements);
$(document).on('change', "#date_range_med_rec_requested_c", toggleElements);
$(document).ready(toggleElements);