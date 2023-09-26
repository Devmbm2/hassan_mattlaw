// ======Append Years in Dropdown========
$("select.all_events").change(function(){
    $('.all_years').empty();
    $(".all_years").append(new Option('Choose Year', '-2'));
    $(".all_years").append(new Option('2022', '0'));
    $(".all_years").append(new Option('2021', '1'));
    $(".all_years").append(new Option('2020', '2'));
    $(".all_years").append(new Option('2019', '3'));
    $(".all_years").append(new Option('2018', '4'));
    $(".all_years").append(new Option('2017', '5'));
    $(".all_years").append(new Option('2016', '6'));
    $(".all_years").append(new Option('2015', '7'));
    $(".all_years").append(new Option('2014', '8'));
    $(".all_years").append(new Option('2013', '9'));
    $(".all_years").append(new Option('2012', '10'));
});

// ======Append Months in Dropdown========
$("select.all_years").change(function(){
    $('.all_months').empty();
    $(".all_months").append(new Option('Choose Month', '-3'));
    $(".all_months").append(new Option('January', '1'));
    $(".all_months").append(new Option('February', '2'));
    $(".all_months").append(new Option('March', '3'));
    $(".all_months").append(new Option('April', '4'));
    $(".all_months").append(new Option('May', '5'));
    $(".all_months").append(new Option('June', '6'));
    $(".all_months").append(new Option('July', '7'));
    $(".all_months").append(new Option('August', '8'));
    $(".all_months").append(new Option('September', '9'));
    $(".all_months").append(new Option('October', '10'));
    $(".all_months").append(new Option('November', '11'));
    $(".all_months").append(new Option('December', '12'));
});

// ======Send Ajax Request to Fetch Data========
$('.generate_report').on('click',function () {
    $("#new_cases > tbody").children('tr').remove();
    $("#new_source_advertisement > tbody").children('tr').remove();
    $("#new_cost > tbody").children('tr').remove();
    $("#new_records_received > tbody").children('tr').remove();
    $("#new_records_requested > tbody").children('tr').remove();
    $("#documents_info > tbody").children('tr').remove();
    $("#cases_closed_info > tbody").children('tr').remove();
    let all_events = $('.all_events').val();
    let all_years  = $('.all_years').val();
    let all_years_text  = $('.all_years option:selected').text();
    let all_months = $('.all_months').val();
    $.ajax({
        url: "index.php?entryPoint=CaseReportEntryPoint",
        type: "POST",
        data: {
            all_events: all_events,
            all_years: all_years,
            all_years_text: all_years_text,
            all_months:all_months,
            'action': 'fetch_cases',
        },
        success: function (response) {
            let return_result = JSON.parse(response);
            if(all_events == 1){
            $.each(return_result, function (index, obj) {
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
                        $(".cost_info_block").css("display", "none");
                        $(".source_advertisement_block").css("display", "none");
                        $(".cases_closed").css("display", "none");
                        $(".documents_generated").css("display", "none");
                        $(".medical_records_requested").css("display", "none");
                        $(".medical_records_received").css("display", "none");
                        $(".new_cases_block").css("display", "block");
                        $("#new_cases > tbody").append("<tr><td style='text-align: center;'>"+month_name+"</td><td style='text-align: center;'>"+obj.count+"</td></tr>");
            });
          }else if(all_events == 3){
                $.each(return_result, function (index, obj) {
                    let case_source = obj.source;
                    if (case_source.length === 0) {
                        case_source = '';
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
                    $(".cost_info_block").css("display", "none");
                    $(".cases_closed").css("display", "none");
                    $(".documents_generated").css("display", "none");
                    $(".medical_records_requested").css("display", "none");
                    $(".medical_records_received").css("display", "none");
                    $(".new_cases_block").css("display", "none");
                    $(".source_advertisement_block").css("display", "block");
                    $("#new_source_advertisement > tbody").append("<tr><td style='text-align: center;'>"+month_name+"</td><td style='text-align: center;'>"+case_source+"</td></tr>");
                });
            }else if(all_events == 4){
                $.each(return_result, function (index, obj) {
                        let cost_info = obj.count;
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

                    $(".cases_closed").css("display", "none");
                    $(".documents_generated").css("display", "none");
                    $(".medical_records_requested").css("display", "none");
                    $(".medical_records_received").css("display", "none");
                    $(".new_cases_block").css("display", "none");
                    $(".source_advertisement_block").css("display", "none");
                    $(".cost_info_block").css("display", "block");
                    $("#new_cost > tbody").append("<tr><td style='text-align: center;'>"+month_name+"</td><td style='text-align: center;'>"+cost_info+"</td></tr>");
                });
            }else if(all_events == 5){
                $.each(return_result, function (index, obj) {
                    let status_info = obj.status;
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
                    $(".cases_closed").css("display", "none");
                    $(".documents_generated").css("display", "none");
                    $(".medical_records_requested").css("display", "none");
                    $(".new_cases_block").css("display", "none");
                    $(".source_advertisement_block").css("display", "none");
                    $(".cost_info_block").css("display", "none");
                    $(".medical_records_received").css("display", "block");
                    $("#new_records_received > tbody").append("<tr><td style='text-align: center;'>"+month_name+"</td><td style='text-align: center;'>"+status_info+"</td></tr>");
                });
            }else if(all_events == 6){
                $.each(return_result, function (index, obj) {
                    let medical_status_info = obj.medical_status;
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
                    $(".cases_closed").css("display", "none");
                    $(".documents_generated").css("display", "none");
                    $(".new_cases_block").css("display", "none");
                    $(".source_advertisement_block").css("display", "none");
                    $(".cost_info_block").css("display", "none");
                    $(".medical_records_received").css("display", "none");
                    $(".medical_records_requested").css("display", "block");
                    $("#new_records_requested > tbody").append("<tr><td style='text-align: center;'>"+month_name+"</td><td style='text-align: center;'>"+medical_status_info+"</td></tr>");
                });
            }else if(all_events == 7){
                $.each(return_result, function (index, obj) {
                    let documents_generated = obj.soft_documents;
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
                    $(".cases_closed").css("display", "none");
                    $(".new_cases_block").css("display", "none");
                    $(".source_advertisement_block").css("display", "none");
                    $(".cost_info_block").css("display", "none");
                    $(".medical_records_received").css("display", "none");
                    $(".medical_records_requested").css("display", "none");
                    $(".documents_generated").css("display", "block");
                    $("#documents_info > tbody").append("<tr><td style='text-align: center;'>"+month_name+"</td><td style='text-align: center;'>"+documents_generated+"</td></tr>");
                });
            }else if(all_events == 2){
                $.each(return_result, function (index, obj) {
                    let closed_cases_info = obj.closed_cases;
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
                    $(".new_cases_block").css("display", "none");
                    $(".source_advertisement_block").css("display", "none");
                    $(".cost_info_block").css("display", "none");
                    $(".medical_records_received").css("display", "none");
                    $(".medical_records_requested").css("display", "none");
                    $(".documents_generated").css("display", "none");
                    $(".cases_closed").css("display", "block");
                    $("#cases_closed_info > tbody").append("<tr><td style='text-align: center;'>"+month_name+"</td><td style='text-align: center;'>"+closed_cases_info+"</td></tr>");
                });
            }
        }
    });
});

// ======Send Ajax Request to Generate PDF========
$('.generate_pdf').on('click',function () {
    let all_events = $('.all_events').val();
    let all_years  = $('.all_years').val();
    let all_months = $('.all_months').val();
    let all_years_text  = $('.all_years option:selected').text();
    $.ajax({
        url: "index.php?entryPoint=CaseReportEntryPoint",
        type: "POST",
        data: {
            all_events: all_events,
            all_years: all_years,
            all_months:all_months,
            all_years_text:all_years_text,
            'action': 'generate_pdf',
        },
        success: function (response) {
            console.log(response);
            window.location.href = 'index.php?entryPoint=CaseReportEntryPoint';
            // let return_result = JSON.parse(response);
            // $('.view_cases_pdf').attr('href',return_result);
        }
    });
});
//==========Change Color Of text for View Pdf Report Link=============
$('.view_cases_pdf').on('hover',function(){
    $(this).css("color", "#111111");
});