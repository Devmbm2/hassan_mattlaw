var ids = [];
$(document).ready(function() {
  $("input[value='Save']").attr("onclick",'showWorkflow(); return false;');
});
function showWorkflow(){
  var contact_id = $("input[name='record']").val();
  var contact_type = $("#type_c").val();
  $.ajax({
    url: 'index.php?module=Contacts&action=getContactWorkflow&contact_id='+ contact_id + '&type=' + contact_type,
    type: 'POST',
    contentType: 'application/x-www-form-urlencoded',
    dataType: 'text',
    data: 'sugar_body_only=true',
    async: true,
    success : function (result){
   var decode = JSON.parse(result);
   // console.log(decode);
   const tab = $(decode).find("#contact_table tr").length;
   console.log(tab);
   if(tab>1){
  YAHOO.SUGAR.MessageBox.show({  msg: decode,height:'700px', width:'200px',title:'WorkFlows to be Active'});
}
else{
  // var _form = document.getElementById('EditView'); _form.action.value='Save';if(custom_validation())if(check_form('EditView'))SUGAR.ajaxUI.submitForm(_form);return false;
}
}
});
  }
function selectWorkflow(){
  $("input[name='workflow_related']:checked").each(function() {
  ids.push(this.value);
  });
  $.ajax({
    url: 'index.php?module=Contacts&action=confirm_workflow',
    type: 'POST',
    contentType: 'application/x-www-form-urlencoded',
    dataType: 'text',
    data:{checkboxArray:ids,sugar_body_only:true},
    async: true,
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
    url: 'index.php?module=Contacts&action=updateContactWorkflow',
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


