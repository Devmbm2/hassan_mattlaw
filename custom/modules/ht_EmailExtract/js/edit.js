$( document ).ready(function() {


  $("#add_field").click(function(e){
    $.ajax({
      type: 'POST',
      url:'index.php?module=ht_EmailExtract&action=GetAllModulesFromDatabase',
      data:{moduleName:$('#convert_to_module').val()},
      success: function(data) {
          $('#map_table > tbody').append(` <tr>`+
          `
          <td>  <input  type="button" class="button" id="remove_field"
          title="-" value="-"></td>
          <td>
            <select name="maping_fields[]" id="maping_fields" title="" style="width:200px">
              <option label="" value=""></option>
              `+data+`
              </select></td>
              <td>
              <select name="_emails_day[]" id="_emails_day" title="" style="width:200px">
                <option label="" value="subject">Subject</option>
                <option label="" value="sender_name">Sender Name</option>
                <option label="" value="sender_email">Sender Email</option>
                <option label="" value="body">Body</option>
                <option label="" value="date">Date</option>
                </select></td>
              `+`</tr>`);
          // $('[id=maping_fields]').html(data);

      }
  });
    // console.log(e);
        $("#map_table tbody").append();
    //   $("#map_table").append(` <tr>
    //   <td>  <input  type="button" class="button" id="remove_field"
    //    title="-" value="-"></td>
    //  <td> <select name="maping_fields[]" id="maping_fields" title="" style="width:200px">
    //  <option label="" value=""></option>
    //  `+getfields(this)+`
    //  </select> </td>
    //  <td><input type="text" name="sync_emails_day" id="sync_emails_day" size="30" value="" title="" tabindex="0"></td>
    //  </tr>`);

  });



  $("#map_table").on('click', '#remove_field', function(){
      $(this).parent().parent().remove();
  });

});

function ajaxGeneralFunction(Data,ID,URL){
  // console.log(ID+"  "+URL);
    $.ajax({
      type: 'POST',
      url:URL,
      data:Data,
      success: function(data) {

        // console.log(data);
          $(ID).html(data);
          let searchParams = new URLSearchParams(URL)
          var recordID=searchParams.get('onChangeModule');
          if(recordID=='true'){
            $('[id=maping_fields]').html(data);
          }

      }
  });
}

ajaxGeneralFunction({recordID:$('input[name="record"]').val()},'#convert_to_module','index.php?module=ht_EmailExtract&action=GetAllModulesFromDatabase&CodeType=module');
// $('#convert_to_module').on('change',function(){
//   $('#check_duplicate').css('width','250px');
//   ajaxGeneralFunction({moduleName:$('#convert_to_module').val()},'#check_duplicate','index.php?module=ht_EmailExtract&action=GetAllModulesFromDatabase');
// });

$( document ).ready(function() {
var recordID = $('input[name="record"]').val();
      $.ajax({
          type: 'POST',
          url:'index.php?module=ht_EmailExtract&action=OnEditloadMapingField',
          data:{record:recordID},
          success: function(data) {
            $('#map_table > tbody').append(` <tr>`+data+`</tr>`);
          }
      });

      // $('#is_active').hide();
      // $('#is_active').parent().parent().hide();
      // $('#CheckDuplicate_C').hide();
      // $('#CheckDuplicate_C').parent().parent().hide();
});
