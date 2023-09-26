// ======Send Ajax Request to Fetch Data========

function ganrateReport(){
  var formData = $('#report_form_c').serializeArray();
  formData.push({ name: 'pdf_check', value: 'no' });
  var formData = $.param(formData);
  var params = new URLSearchParams(formData);
  var obj = {};
  for (const [key, value] of params.entries()) {
      if(key=="all_months[]"){

      }else{
          obj[key] = value;
      }

  }
  var lenghtVariable=$("select[name='all_months[]']").val();
  if ($("select[name='all_months[]']").is(":visible")) {
          var lenghtVariable=$("select[name='all_months[]']").val();
          obj['all_months']=lenghtVariable.length;
    } else if($("#all_month_d").is(":visible")) {
        var lenghtVariable=$("#all_month_d").val();
        obj['all_months']=lenghtVariable;
    }
  if ($.isEmptyObject(window.myFormData)) {
      window.myFormData = obj;
      sendAjaxForLoadRecordsForReport(formData);
    }else {
      var isChanged = false;
      for (var key in obj) {
        if (window.myFormData[key] !== obj[key]) {
          isChanged = true;
          break;
        }
      }

      if (isChanged) {
          window.myFormData = obj;
          sendAjaxForLoadRecordsForReport(formData);

      } else {

          $('.report_block').toggle();
      }
    }
}



function sendAjaxForLoadRecordsForReport(formData){
  var form = document.getElementById("report_form_c");
var Input = form.querySelector("input[name='pdf_check']");
if (Input) {
  $(form).removeAttr('target');
  $("#report_form_c").attr('action','javascript:void(0);');
  form.removeChild(Input);
}
  function GetResponseTable(response) {
    // console.log(response.responseText);
          $('#encoded_array').val($(response.responseText).find('textarea[id="encoded_array"]')[0].value);
          GenrateTableForJsonData();
        }
        http_fetch_async(
        'index.php?module=Cases&action=case_reports',
        GetResponseTable,
        'myRequest', formData);
}




function ViewGraph(){
  // get the elements
  if (!$("input[name='period_radio']:checked").val()) {
    // If not, display an error message
    alert("Please select a period to view the graph.");
    return false;
}
  const allEventsDropdown = document.getElementById("all_event");
  const allYearsDropdown = document.getElementById("all_years");
  const allMonthsDropdown = document.getElementById("all_month");
  if (!allEventsDropdown.value || !allYearsDropdown.value  ) {
          // show error message
          alert("Please select at least one option from the dropdown fields.");
      } else {
              function GetResponseTable(response) {

                  const encodedArrayTextarea = $(response.responseText).find('#encoded_array');

                  var chartmonths=[];
                  var jsonData = JSON.parse($(encodedArrayTextarea[0]).val());

                  var CountRecords=[];
                  var month_name="";
                  // console.log(jsonData);

                  $.each(jsonData, function(index, value) {
                      CountRecords.push(value.closed_cases);
                      if($("#all_month_d").is(":visible")) {
                        var year= $('#year_text').val();
                        var all_month_d = $('#all_month_d').val();
                        chartmonths.push(index+"/"+all_month_d+"/"+year);
                      }else{
                        const monthNames = [
                          "December", "January", "February", "March", "April",
                          "May", "June", "July", "August", "September", "October", "November"
                          ];
                           month_name = monthNames[index % 12];
                          chartmonths.push(month_name);
                      }


                  });

                  const ctx = document.getElementById('myChart');
                  new Chart(ctx, {
                      type: 'bar',
                      data: {
                      labels: chartmonths,
                      datasets: [{
                          label: '#'+$("select[name='all_events'] option:selected").text(),
                          data: CountRecords,
                          borderWidth: 1,
                          backgroundColor: 'rgba(237, 208, 61, 0.5)'
                      }]
                      },
                      options: {
                      scales: {
                          y: {
                          beginAtZero: true
                          }
                      },
                      plugins: {
                      tooltip: {
                          callbacks: {
                          label: function(context) {
                              // console.log(context);
                              return $("select[name='all_events'] option:selected").text()+":"+context.formattedValue; // Change this to set the tooltip text
                          }
                          }
                      }
                      }
                      },

                  });
              }
              var formData = $('#report_form_c').serializeArray();
              formData.push({ name: 'pdf_check', value: 'no' });
              var formData = $.param(formData);
              var params = new URLSearchParams(formData);
              var obj2 = {};
              for (const [key, value] of params.entries()) {
                  if(key=="all_months[]"){

                  }else{
                      obj2[key] = value;
                  }

              }
              if ($("select[name='all_months[]']").is(":visible")) {
                    var lenghtVariable=$("select[name='all_months[]']").val();
                    obj2['all_months']=lenghtVariable.length;
              } else if($("#all_month_d").is(":visible")) {
                var lenghtVariable=$("#all_month_d").val();
                obj2['all_months']=lenghtVariable;
              }
              if ($.isEmptyObject(window.myFormData2)) {
                  window.myFormData2 = obj2;
                  http_fetch_async(
                      'index.php?module=Cases&action=case_reports',
                      GetResponseTable,
                      'myRequest', formData);
              }else {
                  var isChanged = false;
                  for (var key in obj2) {
                      if (window.myFormData2[key] !== obj2[key]) {
                          isChanged = true;
                          break;
                      }
                  }
                  if (isChanged) {
                      window.myFormData2 = obj2;

                      http_fetch_async(
                      'index.php?module=Cases&action=case_reports',
                      GetResponseTable,
                      'myRequest', formData);
                      var chart = Chart.getChart('myChart');
                      chart.destroy();

                  } else {
                      $('#ChartDiv').toggle();
                  }

              }
      }

  }




  function GenrateTableForJsonData(){
        var encoded_array =$('#encoded_array').val();
        if(encoded_array!=""  &&  $('input[name="period_radio"]:checked').val() !='day') {
            $("#report_generate > tbody").children('tr').remove();
            let all_events = $('.all_events').val();
            let all_years  = $('.all_years').val();
            let all_years_text  = $('.all_years option:selected').text();
            let all_months = $('.all_months').val();
                    let return_result = JSON.parse(encoded_array);
                    $.each(return_result, function (index, obj) {
                      $(".all_months option[value='" + index + "']").prop('selected', true);

                    });
                    $('#all_month').multiselect('reload');
                    $('#ms-list-1').css("width","340px");
                    let allCountsAreZero = true;
                    // if(all_events == 1){
                    $.each(return_result, function (index, obj) {
                        if (obj.closed_cases !== 0) {
                        allCountsAreZero = false;
                        // break;
                      }
                        if(obj.closed_cases == null){
                            obj.closed_cases = '';
                        }
                        const monthNames = [
                          "December", "January", "February", "March", "April",
                          "May", "June", "July", "August", "September", "October", "November"
                        ];

                        const month_name = monthNames[parseInt(index) % 12];
                                $(".report_block").css("display", "block");

                                $("#report_generate > tbody").append("<tr><td style='text-align: center;'>"+month_name+"</td><td style='text-align: center;'>"+obj.closed_cases+"</td></tr>");
                                if (!allCountsAreZero) {
                                $("#ViewReport").css("display", "block");

                              }


                    });
                  // }
                }

        if(encoded_array!=""  && $('input[name="period_radio"]:checked').val() =='day') {
            $("#report_generate > tbody").children('tr').remove();
            let all_events = $('.all_events').val();
            let all_years  = $('.all_years').val();
            var year= $('#year_text').val();
            let all_years_text  = $('.all_years option:selected').text();
            let all_months = $('.all_months').val();
            var all_month_d = $('#all_month_d').val();
                    let return_result = JSON.parse(encoded_array);
                    $.each(return_result, function (index, obj) {
                       $(".all_day_d option[value='" + index + "']").prop('selected', true);
                    });

                    $('#all_month').multiselect('reload');
                    $('#ms-list-1').css("width","340px");
                    let allCountsAreZero = true;
                    // if(all_events == 1){
                    $.each(return_result, function (index, obj) {
                        if (obj.closed_cases !== 0) {
                        allCountsAreZero = false;
                        // break;
                      }
                        if(obj.closed_cases == null){
                            obj.closed_cases = '';
                        }
                                $(".report_block").css("display", "block");

                                $("#report_generate > tbody").append("<tr><td style='text-align: center;'>"+index+"/"+all_month_d+"/"+year+"</td><td style='text-align: center;'>"+obj.closed_cases+"</td></tr>");
                                 if (!allCountsAreZero) {
                                $("#ViewReport").css("display", "block");
                            }
                            if (all_events == 3  || all_events ==4) {
                              $("#ViewReport").css("display", "none");
                          }

                    });
                  // }
                }

           var all_events=$('#all_event').val();
           var check_t = $('input[name="period_radio"]:checked').val()
           $("#ViewReport").click(function() {
             var jsonData = JSON.parse($("#encoded_array").val());
             var table = "";
             $.each(jsonData, function(index, value) {

                   var month_name = "";
                  const monthNames = [
                    "December", "January", "February", "March", "April",
                    "May", "June", "July", "August", "September", "October", "November"
                    ];
                     month_name = monthNames[index % 12];
                   if (all_events==1 || all_events==2 || all_events==8) {
                       if (value.closed_cases > 0 || value.closed_cases > 0 ) {
                                 var h=0;
                                   $.each(value, function(caseIndex, caseData) {
                                       if (caseData.name && caseData.assigned_by) {
                                               if(h==0){
                                             table += `<h3 style="font-size:20px;">${(check_t =='day') ? index : month_name}</h3><table style="width: 100%;" id="new_cases" class="table table-striped table-bordered">
                                                       <thead>
                                                       <tr style="text-align:left;">
                                                       <th style="text-align:left; font-size:14px; "> Case</th>
                                                       <th style="text-align:left; font-size:14px; "> Assigned</th>
                                                       </tr>
                                                       </thead>
                                                       <tbody>`;
                                                   } h++;
                                                 table += `
                                                           <tr>
                                                             <td style="width:40%;"><a href="index.php?module=Cases&offset=3&stamp=1681712201036540300&return_module=Cases&action=DetailView&record=${caseData.id}"  target="_blank">${caseData.name}</a></td>
                                                             <td style="width:60%;">${caseData.assigned_by}</td>
                                                           </tr>`;
                                               }
                                 });
                         table += `</tbody>
                                   </table>`;
                       }
                   }

                     // for medical records
                     if (all_events==5 || all_events== 6) {
                         if ( value.closed_cases > 0 ) {
                             var h=0;
                                       $.each(value, function(caseIndex, caseData) {
                                                     if (caseData.name && caseData.assigned_by) {
                                                                           if(h==0){
                                                                                 table += `<h3 style="font-size:20px;">${(check_t =='day') ? index : month_name}</h3><table style="width: 100%;" id="new_cases" class="table table-striped table-bordered">
                                                                                           <thead>
                                                                                           <tr style="text-align:left;">
                                                                                           <th style="text-align:left; font-size:14px; "> Record Name</th>
                                                                                           <th style="text-align:left; font-size:14px; "> Assigned</th>
                                                                                           </tr>
                                                                                           </thead>
                                                                                           <tbody>`;
                                                                               }
                                                                               h++;
                                                                     table += `<tr>
                                                                                 <td style="width:40%;"><a href="index.php?module=MEDR_Medical_Records&offset=3&stamp=1681712201036540300&return_module=Cases&action=DetailView&record=${caseData.id}" target="_blank">${caseData.name}</a></td>
                                                                                 <td style="width:60%;">${caseData.assigned_by}</td>
                                                                               </tr>`;
                                                             }
                                     });
                           table += `</tbody>
                                     </table>`;
                         }
                     }
              // for documents records
              if (all_events== 7) {
               if ( value.closed_cases > 0 ) {
                   var h=0;
                   $.each(value, function(caseIndex, caseData) {
           if (caseData.name && caseData.assigned_by) {
                   if(h==0){
                 table += `<h3 style="font-size:20px;">${(check_t =='day') ? index : month_name}</h3><table style="width: 100%;" id="new_cases" class="table table-striped table-bordered">
                           <thead>
                           <tr style="text-align:left;">
                           <th style="text-align:left; font-size:14px; "> Document Name</th>
                           <th style="text-align:left; font-size:14px; "> Assigned</th>
                           </tr>
                           </thead>
                           <tbody>`;
                       } h++;
                     table += `
                               <tr>
                                 <td style="width:40%;"><a href="index.php?module=Documents&offset=3&stamp=1681712201036540300&return_module=Cases&action=DetailView&record=${caseData.id}" target="_blank">${caseData.name}</a></td>
                                 <td style="width:60%;">${caseData.assigned_by}</td>
                               </tr>`;
                   }
                 });
                 table += `</tbody>
                           </table>`;
               }
           }
             });
             $("#ViewReportTable").html(table).show();

           });
  }

  function ClearPage(){
    // location.reload();
    $("#report_form_c")[0].reset();
    $('#all_month').multiselect('reset');
  }




  function ganratePDF(){
    $('#pdf-modal').modal('show');
    const divElement = document.getElementById('ChartDiv');
    html2canvas(divElement).then(function(canvas) {
      canvas.toBlob(function(blob) {
        const formData = new FormData();
        formData.append('image', blob, 'image.png');
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?module=cases&action=save_image');
        xhr.onload = function() {
            if (xhr.status === 200) {
                  var newInput = $("<input>").attr({
                    type: "hidden",
                    name: "pdf_check",
                    value:'yes'
                  });
                  $('#report_form_c').append(newInput);
            } else {
                  console.log('Error saving image');
            }
        };
        xhr.send(formData);
      }, 'image/png');

      });
      setTimeout(function() {
        $('#pdf-modal').modal('hide');
        $("#report_form_c").attr('target','_blank');
                 $("#report_form_c").attr("action", "index.php?module=Cases&action=case_reports");
                 $("#report_form_c").submit();
      }, 5000);
}

















$('#view_btn_c , #pdf_btn_c').click(function() {
  if ($('#all_month').val() == null &&  $('input[name="period_radio"]:checked').val() !='day') {
    $('#error-msg').show();
    return false;
  }
  if ($('#all_day_d').val() == null &&  $('input[name="period_radio"]:checked').val() =='day') {
    $('#error-msg_d').show();
    return false;
  }
});


      $(' #report_form_c > div:nth-child(4)').hide();
      $('#report_form_c > div:nth-child(3) > div:nth-child(4)').hide();
      const select = document.querySelector('#all_month_d');
      const select_d = document.querySelector('#all_day_d');
      var selectedValue_r = $('input[name="period_radio"]:checked').val();

    $('input[name="period_radio"]').change(function() {
      $('#all_month_d').val('');
      var selectedValue_r = $(this).val();
      if (selectedValue_r=='day') {
          $('#report_form_c > div:nth-child(3) > div:nth-child(3)').hide();
          $('#report_form_c > div:nth-child(3) > div:nth-child(4)').show();
          select.setAttribute('required', '');
      }
      else
      {
          if(selectedValue_r=='year'){
                var dropdown = document.getElementById("#all_month");
                  for (var i = 0; i < 13; i++) {
              $(".all_months option[value='" + i + "']").prop('selected', true);
                  }
                  $('#all_month').multiselect('reload');
          }
          if(selectedValue_r=='month'){
            for (var i = 0; i < 13; i++) {
              $(".all_months option[value='" + i + "']").prop('selected', false);
                  }
                  $('#all_month').multiselect('reload');
          }
          $('#report_form_c > div:nth-child(3) > div:nth-child(3)').show();
          $('#all_month').multiselect('selectAll');
          $('#report_form_c > div:nth-child(3) > div:nth-child(4)').hide();
          select.removeAttribute('required');
          $(' #report_form_c > div:nth-child(4)').hide();
          select_d.removeAttribute('required');
           $('#all_day_d').multiselect('reload');
      }
  });

          var selectedValue_r = $('#all_month_d option:selected').val();
      if (selectedValue_r !='') {
              $(' #report_form_c > div:nth-child(4)').show();
              select_d.setAttribute('required', '');
              $('#all_day_d').empty();
              var selectElement= $('#all_day_d');
              var year= $('#year_text').val();
              var month= $('#all_month_d').val();
              const daysInMonth = getDaysInMonth(year, month);
              selectElement.innerHTML = ''; // clear existing options
              for (let i = 1; i <= daysInMonth; i++) {
              const option = document.createElement('option');
              option.value = i;
              option.textContent = i+'/'+month+'/'+year;
              selectElement.append(option);
              }
              $('#all_day_d').multiselect({
                  columns: 1,
                  search: true,
                  selectAll: true
              });
              $('#all_day_d').multiselect('reload');

          }else
          {
              $(' #report_form_c > div:nth-child(4)').hide();
              select_d.removeAttribute('required');
              $('#all_day_d').multiselect('reload');
          }

          $('#all_month_d').on('change', function() {
              var selectedValue_r = $(this).val();
              if (selectedValue_r !='') {
                      $(' #report_form_c > div:nth-child(4)').show();
                      select_d.setAttribute('required', '');
                      $('#all_day_d').empty();
                      var selectElement= $('#all_day_d');
                      var year= $('#year_text').val();
                      var month= $('#all_month_d').val();
                      const daysInMonth = getDaysInMonth(year, month);
                      selectElement.innerHTML = ''; // clear existing options
                      for (let i = 1; i <= daysInMonth; i++) {
                      const option = document.createElement('option');
                      option.value = i;
                      option.textContent = i+'/'+month+'/'+year;
                      selectElement.append(option);
                      }
                      $('#all_day_d').multiselect({
                          columns: 1,
                          search: true,
                          selectAll: true
                      });
                      $('#all_day_d').multiselect('reload');

                  }else{
                      $(' #report_form_c > div:nth-child(4)').hide();
                      select_d.removeAttribute('required');
                      $('#all_day_d').multiselect('reload');
                  }
              });

      function getDaysInMonth (year , month ) {
          return new Date(year, month, 0).getDate();
      }




