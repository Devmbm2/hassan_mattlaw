$(document).ready(function(){
 $('#remove_button').attr('onclick', 'AjaxRequestForRemoveRecord(this)');
});
function AjaxRequestForRemoveRecord(e){
      $.ajax({
        type: "POST",
        url: "index.php?module=FP_events&action=deleteattachment22",
        data: {id:getParameterByName("id", $($(e).prev()[0]).attr("href"))},
        cache: false,
        success: function(data){
          if(data=='true'){
             $('#filename_old').hide();
             $('#filename_new').show();
          }
        }
      });
   }
