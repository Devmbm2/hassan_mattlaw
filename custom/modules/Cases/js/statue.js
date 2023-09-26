
$(document).ready(function () {
    sol_years = SUGAR.language.languages.app_list_strings["sol_years"];
    sol_time = SUGAR.language.languages.app_list_strings["sol_time"];
    sol_months = SUGAR.language.languages.app_list_strings["sol_months"];
    sol_days = SUGAR.language.languages.app_list_strings["sol_days"];
    sol_category = SUGAR.language.languages.app_list_strings["sol_category"];
    sol_none = SUGAR.language.languages.app_list_strings["sol_none"];
    $('#tableid').hide();
    $('#savecaseFormupper').hide();
    $("#states_dom option:first-child").attr("disabled", "true");
    //------------------ Start on load make sol time empty and insert 'None' -------------------//
    var options = document.querySelectorAll('#sol_time option');

    options.forEach(alloptions => {
        alloptions.remove();
    });
    var appendingoption = document.querySelectorAll('#sol_time');
    Object.entries(appendingoption).forEach(([key, val]) => {
        val.append(new Option("None"))
    });
    //------------------ End on load make sol time empty and insert 'None' -------------------//

    //------------------ Start on Changing SOL Catogory empty sol_time option and insert option according to years,months,days and None -------------------//
    $(document).on('change', '#sol_category', function (e) {

        e.preventDefault();
        let item = $(this).find(":selected").text();
        let sol_choice = ($(this).closest("tr").find("select[name='sol_time[]']"));
        ($(this).closest("tr").find("select[name='sol_time[]']").removeAttr('disabled'));

        switch (item) {
            case 'Years': {
                sol_choice.empty();
                Object.entries(sol_years).forEach(([key, val]) => {
                    sol_choice.append(new Option(val));
                });
                break;
            }
            case 'Months': {
                sol_choice.empty();
                Object.entries(sol_months).forEach(([key, val]) => {
                    sol_choice.append(new Option(val));
                });
                break;
            }
            case 'Days': {
                sol_choice.empty();
                Object.entries(sol_days).forEach(([key, val]) => {
                    sol_choice.append(new Option(val));
                });
                break;
            }
            case 'None': {
                sol_choice.empty();
                Object.entries(sol_none).forEach(([key, val]) => {
                    sol_choice.empty().append(new Option(val));
                });
                break;
            }
        }
    })
    //------------------ End on Changing SOL Catogory empty sol_time option and insert option according to years,months,days and None -------------------//
                        
    document.getElementById("states_dom").addEventListener("change", () => {
        $('#tableid').show();
        $('#savecaseFormupper').show();

        $('#state_dom_heading').hide();

        state = document.getElementById("states_dom").value;
        sol_category = document.getElementById("sol_category").value;

        $.ajax({
            type: 'post',
            url: 'index.php?module=Cases&&action=getsol',
            data: { state: state },
            success: function (result) {
                if (result !== 'false') {
                    //------------------ Start State is already inserted in db then fetch and show -------------------//
                    result = JSON.parse(result);
                    statue_sol_category = SUGAR.language.languages.app_list_strings["sol_category"];
                    statue_sol_none = SUGAR.language.languages.app_list_strings["sol_none"];
                    statue_sol_years = SUGAR.language.languages.app_list_strings["sol_years"];
                    statue_sol_months = SUGAR.language.languages.app_list_strings["sol_months"];
                    statue_sol_days = SUGAR.language.languages.app_list_strings["sol_days"];
                    $("#statue_body").empty();
                    Object.entries(result).forEach(([key, v]) => {
                        sol_time_class = "sol_time" + v.id;
                        $("#statue_body").append('<tr class="trclass"><td><input name="case_type[]" value=' + v.case_type + ' readonly id="case_type" style="font-weight: bold; font-size:15px; width: 350px;"></td><td><select name = "sol_category[]" id="sol_category"><option value="' + v.sol_category + '" selected>' + v.sol_category + '</option></select></td><td><select class="' + sol_time_class + '" name = "sol_time[]" id="sol_time"><option value="' + v.sol + '" selected>' + v.sol + '</option></select></td></tr>');

                        if(v.sol_category == "Years"){
                            $.each(statue_sol_years, function (k1, val1) {
                                $("."+sol_time_class).append($('<option></option>').val(val1).html(val1));
                            })
                        }else if(v.sol_category == "Days"){
                            $.each(statue_sol_days, function (k2, val2) {
                                $("."+sol_time_class).append($('<option></option>').val(val2).html(val2));
                            })
                        }else if(v.sol_category == "Months"){
                            $.each(statue_sol_months, function (k3, val3) {
                                $("."+sol_time_class).append($('<option></option>').val(val3).html(val3));
                            })
                        }else if(v.sol_category == "None"){
                            $.each(statue_sol_none, function (k4, val4) {
                                $("."+sol_time_class).append($('<option></option>').val(val4).html(val4));
                            })
                        }
                    })

                    $.each(statue_sol_category, function (keys, values) {
                        $("select[name='sol_category[]']").append('<option value="'+ values +'">'+ values +'</option>');
                    })

                    //Removing Duplicates value is sol category
                    $("#sol_category option").each(function() {
                        $(this).siblings('[value="'+ this.value +'"]').remove();
                    });
                    //Removing Duplicates value is sol time
                    $("#sol_time option").each(function() {
                        $(this).siblings('[value="'+ this.value +'"]').remove();
                    });

                }
                    //------------------ End State is already inserted in db then fetch and show -------------------//

                //------------------ Start State is not inserted in db -------------------//
                else {
                    $('#sol_time').empty().append(new Option('None'));
                    sol_time = SUGAR.language.languages.app_list_strings["sol_time"];
                    complaint_type_list = SUGAR.language.languages.app_list_strings["complaint_type_list"];
                    sol_category = SUGAR.language.languages.app_list_strings["sol_category"];
                    $("#statue_body").empty();
                    $.each(complaint_type_list, function (k, v) {
                        $("#statue_body").append(`<tr  class="trclass"><td><input name="case_type[]" value='${k}' readonly id="case_type" style="font-weight: bold; font-size:15px; width: 350px;"></td><td><select name = "sol_category[]" id="sol_category">
                        ${Object.entries(sol_category).forEach((item2) => {
                                        if (item2['1'] === 'None') {
                                            return "<option >" + item2 + "</option>"
                                        }
                                        else {
                                            return '<option >' + item2 + '</option>'
                                        }
                                    })}
                        </select></td><td><select name = "sol_time[]" id="sol_time" >
      
          ${Object.entries(sol_time).forEach((item) => {
                            if (item['1'] === 'None') {
                                return "<option selected>" + item + "</option>"
                            }
                            else {
                                return '<option >' + item + '</option>'
                            }
                        })}
            </select></td></tr>`);
                    })
                    $.each(sol_time, function (k, v) {
                        $("select[name='sol_time[]']").append('<option selected>' + v + '</option>');
                    })
                    $.each(sol_category, function (key, val) {
                        $("select[name='sol_category[]']").append('<option >' + val + '</option>');
                    })

                    //------------------ Start on load make sol time empty and insert 'None' -------------------//
                    var options = document.querySelectorAll('#sol_time option');
                    options.forEach(alloptions => {
                        alloptions.remove();
                    });
                    var appendingoption = document.querySelectorAll('#sol_time');
                    Object.entries(appendingoption).forEach(([key, val]) => {
                        val.append(new Option("None"))
                    });
                    //------------------ End on load make sol time empty and insert 'None' -------------------//

                    //------------------ End State is not inserted in db -------------------//
                }
            }
        });
    })
});
//------------------ Start Checks on States dropdown-------------------//
function formSubmit(event) {
    event.preventDefault();
    let state = document.getElementById("states_dom").value;
     if (document.getElementById("states_dom").hasAttribute('required')) {
        console.log($("#states_dom").val())
        if ($("#states_dom").val() === null) {
            Swal.fire({
                title: 'State!',
                text: "Statue is not selected!",
                icon: 'error',
                confirmButtonColor: '#edd03d'
            })
        }
        else {
            Swal.fire({

                title: 'Success!',
                text: "Statue of limitation is inserted !",
                icon: 'success',
                confirmButtonColor: '#edd03d'
            })
            document.getElementById("statueoflimitform").submit();
        }
    }
    else if ($("#states_dom").val() !== "") {
        Swal.fire({

            title: 'Success!',
            text: "Statue of limitation is inserted !",
            icon: 'success',
            confirmButtonColor: '#edd03d'
        })
        document.getElementById("statueoflimitform").submit();
    }
    else {
        Swal.fire('You dont have permission to alter code!')

    }
}
var savebuttons = document.getElementsByClassName("savecaseForm");
Array.from(savebuttons).forEach(function(element) {
    element.addEventListener('click', formSubmit);
  });
// document.querySelectorAll(".savecaseForm").addEventListener('click', formSubmit);
//------------------ End Checks on States dropdown-------------------//
