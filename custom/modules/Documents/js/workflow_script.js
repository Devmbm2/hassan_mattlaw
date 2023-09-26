var ids = [];
var RecordID=[];
function get_all_workflows_related_todocuments(){

  function myCallback(response) {
    console.log(response.responseText);
        YAHOO.SUGAR.MessageBox.show({
          msg: response.responseText,
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
http_fetch_async('index.php?module=Documents&action=getAllRelatedWorkflows',myCallback,'myRequest', 'sugar_body_only=true');
}



function ShowDescription(description){
 $('#sugarMsgWindow_c').append(`
 <div  id="sugarMsgWindow "  class="yui-module yui-overlay yui-panel " style="visibility: inherit; position: absolute; top:10%; margin:20px 15%;">
    <a class="container-close" href="#" onclick="ClosePopup(this)" >Close</a>
    <div class="hd" id="sugarMsgWindow_h" style="cursor: move;">Description</div>
    <div class="bd">
      <div class="container " style="width: 400px; font-size:15px; background-color:white; ">
          <div style="padding:5%;">
            `+description+`
          </div>
      </div>
    </div>
  </div>
`);
}


function CheckedAllWorkflows(){

  $("input[name='workflow_related']:checked").each(function() {
        var id = this.value;
        if (!ids.includes(id)) {
          ids.push(id);
          RecordID.push($("input[name='record']").val());
        }
  });
  var case_id= document.getElementsByName("record")[0].value;
  $.ajax({
    type: 'POST',
    url: 'index.php?module=Documents&action=confirm_workflow',
    data:{checkboxArray:ids,record_id:RecordID,sugar_body_only:true},
    success: function(data) {
      // console.log(data);
      var decode = JSON.parse(data);
              YAHOO.SUGAR.MessageBox.show({
                msg: decode,
                height: '700px',
                width: '200px',
                // position: 'centre',
                title: 'Confirm Workflows',
            });

    }
  });
}

function yes_workflow(){
  $.ajax({
    url: 'index.php?module=Cases&action=StatusActiveAndInactive',
    type: 'POST',
    data:{checkboxArray:ids},
    success: function(data) {
      // console.log(data);
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
  var _form = document.getElementById('EditView');
  _form.action.value='Save';
  if(custom_validation())if(check_form('EditView'))SUGAR.ajaxUI.submitForm(_form);return false;
}
function ClosePopup(e){
$(e).parent().hide();
}
