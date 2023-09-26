// ======Send Ajax Request to Fetch Data========
$(document).ready(function() {
    var encoded_array =$('#encoded_array').val();
 if(encoded_array!="") {
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
                    switch (index) {
                        case '1':
                            month_name  = "January";
                            break;
                        case '2':
                            month_name  = "February";
                            break;
                        case '3':
                            month_name  = "March";
                            break;
                        case '4':
                            month_name  = "April";
                            break;
                        case '5':
                            month_name  = "May";
                            break;
                        case '6':
                            month_name  = "June";
                            break;
                        case '7':
                            month_name  = "July";
                            break;
                        case '8':
                            month_name  = "August";
                            break;
                        case '9':
                            month_name  = "September";
                            break;
                        case '10':
                            month_name  = "October";
                            break;
                        case '11':
                            month_name  = "November";
                            break;
                        default:
                            month_name = "December";
                    }
                        $(".report_block").css("display", "block");
                    
                        $("#report_generate > tbody").append("<tr><td style='text-align: center;'>"+month_name+"</td><td style='text-align: center;'>"+obj.closed_cases+"</td></tr>");
                         if (!allCountsAreZero) {
                        $("#ViewReport").css("display", "block");
                    }

            });
          // }
        } 
        var chartmonths=[];
        $("#ViewGraph").click(function(){
          var jsonData = JSON.parse($('#encoded_array').val());
          var CountRecords=[];
          $.each(jsonData, function(index, value) {
            CountRecords.push(value.closed_cases);
            var month_name="";
            switch (index) {
              case '1':
                  month_name  = "January";
                  break;
              case '2':
                  month_name  = "February";
                  break;
              case '3':
                  month_name  = "March";
                  break;
              case '4':
                  month_name  = "April";
                  break;
              case '5':
                  month_name  = "May";
                  break;
              case '6':
                  month_name  = "June";
                  break;
              case '7':
                  month_name  = "July";
                  break;
              case '8':
                  month_name  = "August";
                  break;
              case '9':
                  month_name  = "September";
                  break;
              case '10':
                  month_name  = "October";
                  break;
              case '11':
                  month_name  = "November";
                  break;
              default:
                  month_name = "December";
          }
          chartmonths.push(month_name);
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
      });
                  var all_events=$('#all_event').val();
            $("#ViewReport").click(function() {
              var jsonData = JSON.parse($("#encoded_array").val());
              var table = "";
              $.each(jsonData, function(index, value) {
                 
                var month_name = "";
                switch (index) {
                  case "1":
                    month_name = "January";
                    break;
                  case "2":
                    month_name = "February";
                    break;
                  case "3":
                    month_name = "March";
                    break;
                  case "4":
                    month_name = "April";
                    break;
                  case "5":
                    month_name = "May";
                    break;
                  case "6":
                    month_name = "June";
                    break;
                  case "7":
                    month_name = "July";
                    break;
                  case "8":
                    month_name = "August";
                    break;
                  case "9":
                    month_name = "September";
                    break;
                  case "10":
                    month_name = "October";
                    break;
                  case "11":
                    month_name = "November";
                    break;
                  default:
                    month_name = "December";
                }
            if (all_events==1 || all_events==2) {
                if (value.closed_cases > 0 || value.closed_cases > 0 ) {
                    var h=0;
                    $.each(value, function(caseIndex, caseData) {
            if (caseData.name && caseData.assigned_by) {
                    if(h==0){
                  table += `<h3 style="font-size:20px;">${month_name}</h3><table style="width: 100%;" id="new_cases" class="table table-striped table-bordered">
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
                  table += `<h3 style="font-size:20px;">${month_name}</h3><table style="width: 100%;" id="new_cases" class="table table-striped table-bordered">
                            <thead>
                            <tr style="text-align:left;">
                            <th style="text-align:left; font-size:14px; "> Record Name</th>
                            <th style="text-align:left; font-size:14px; "> Assigned</th>
                            </tr>
                            </thead>
                            <tbody>`;
                        } h++;
                      table += `
                                <tr>
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
                  table += `<h3 style="font-size:20px;">${month_name}</h3><table style="width: 100%;" id="new_cases" class="table table-striped table-bordered">
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
});

