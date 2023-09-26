
$(document).ready(function () {
  sol_years = SUGAR.language.languages.app_list_strings["sol_years"];
  sol_time = SUGAR.language.languages.app_list_strings["sol_time"];
  sol_years = SUGAR.language.languages.app_list_strings["sol_years"];
  sol_months = SUGAR.language.languages.app_list_strings["sol_months"];
  sol_days = SUGAR.language.languages.app_list_strings["sol_days"];
  sol_category = SUGAR.language.languages.app_list_strings["sol_category"];

  //------------------ Start on load make sol time empty and insert 'None' -------------------// 
          var options = document.querySelectorAll('#sol_time option');
  console.log(options);

  options.forEach(alloptions => {
    alloptions.remove();
  });
  var appendingoption = document.querySelectorAll('#sol_time');
  Object.entries(appendingoption).forEach(([key, val]) => {
    val.append(new Option("None"))
  });
 //------------------ End on load make sol time empty and insert 'None' -------------------// 

  // $("#sol_time").each(function () {
  //  $(this).empty().append(new Option('None'));
  // })
 //------------------ Start on Changing SOL Catogory empty sol_time option and insert option according to years,months,days and None -------------------// 
  $(document).on('change', '#sol_category', function (e) {
    e.preventDefault();
    let item = $(this).find(":selected").text();
    let sol_choice = ($(this).closest("tr").find("select[name='sol_time[]']"));
    ($(this).closest("tr").find("select[name='sol_time[]']").removeAttr('disabled'));

    console.log(item)
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
        Object.entries(sol_days).forEach(([key, val]) => {
          sol_choice.append(new Option('None'));
        });
        break;
      }
    }
  })
   //------------------ End on Changing SOL Catogory empty sol_time option and insert option according to years,months,days and None -------------------// 

  let state = document.getElementById("states_dom").value;
  $.ajax({
    type: 'post',
    url: 'index.php?module=Cases&&action=getsol',
    data: $('form#logic-form'),
    success: function (result) {
      if (!result) {

        result = JSON.parse(result);

        result.forEach(element => {
          let options = document.querySelector(`[value="${element.case_type}"]`).parentElement.nextElementSibling.firstChild.children;
          console.log(options)
          Array.from(options).forEach(element1 => {
            if (element.sol == element1.value) {
              element1.setAttribute('selected', true)
            }
          })
        });
      }
    }
  });

  document.getElementById("states_dom").addEventListener("change", () => {

    state = document.getElementById("states_dom").value;
    sol_category = document.getElementById("sol_category").value;
    console.log(sol_category)
    $.ajax({
      type: 'post',
      url: 'index.php?module=Cases&&action=getsol',
      data: { state: state },
      success: function (result) {
        if (result !== 'false') {
          //------------------ Start State is already inserted in db then fetch and show -------------------// 
          result = JSON.parse(result);
          sol_time = SUGAR.language.languages.app_list_strings["sol_time"];
          sol_category = SUGAR.language.languages.app_list_strings["sol_category"];
          $("#statue_body").empty();
          Object.entries(result).forEach(([key, v]) => {
            $("#statue_body").append('<tr  class="trclass"><td><input name="case_type[]" value=' + v.case_type + ' readonly id="case_type" style="font-weight: bold; font-size:15px; width: 350px;"></td><td><select name = "sol_time[]" id="sol_time"><option>' + v.sol + '</option></select></td><td><select name = "sol_category[]" id="sol_category"><option>' + v.sol_category + '</option></select></td></tr>');
            // $("#statue_body tr:last").append('</tr>');
          })
          $.each(sol_category, function (keys, vals) {
            $("select[name='sol_category[]']").append(new Option(vals));
          })
          // $.each(sol_time, function (k, val4) {
          //   $("select[name='sol_time[]']").append(new Option(val4));
          // })
        }
        //------------------ End State is already inserted in db then fetch and show -------------------// 
        //------------------ Start State is not inserted in db -------------------// 
        else {
          $('#sol_time').empty().append(new Option('None'));
          console.log('else condition');
          sol_time = SUGAR.language.languages.app_list_strings["sol_time"];
          complaint_type_list = SUGAR.language.languages.app_list_strings["complaint_type_list"];
          sol_category = SUGAR.language.languages.app_list_strings["sol_category"];
          $("#statue_body").empty();
          $.each(complaint_type_list, function (k, v) {
            $("#statue_body").append(`<tr  class="trclass"><td><input name="case_type[]" value='${k}' readonly id="case_type" style="font-weight: bold; font-size:15px; width: 350px;"></td><td><select name = "sol_time[]" id="sol_time" >
      
          ${Object.entries(sol_time).forEach((item) => {
              if (item['1'] === 'None') {
                return "<option selected>" + item + "</option>"
              }
              else {
                return '<option >' + item + '</option>'
              }
            })}
            </select></td><td><select name = "sol_category[]" id="sol_category">
            ${Object.entries(sol_category).forEach((item2) => {
              if (item2['1'] === 'None') {
                return "<option >" + item2 + "</option>"
              }
              else {
                return '<option >' + item2 + '</option>'
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
          console.log(options);
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
    if ($("#states_dom").val() === "") {
      Swal.fire(
        'State?',
        'State is not selected?',
        'question'
      )
     // alert('State is not selected ')
    }
    else {
      console.log('submit')
      document.getElementById("statueoflimitform").submit();
    }
  }
  else if ($("#states_dom").val() !== "") {
    console.log('submit')
    document.getElementById("statueoflimitform").submit();
  }
  else {
    Swal.fire('You dont have permission to alter code!')
  
  }
}
document.getElementById("savecaseForm").addEventListener('click', formSubmit);
//------------------ End Checks on States dropdown-------------------//