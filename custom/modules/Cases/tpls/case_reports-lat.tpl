{literal}
<style>
    .view-case{
        width: fit-content;
        background-color: #edd03d;
        color: #fff;
        margin-bottom: 1px;
        height: 35px;
    }
    .all_years{
        width: 240px;
    }
    .all_months{
        width: 240px;
    }
    .all_events{
        width: 240px;
    }
    h1 {
        font-size: 30px;
        padding: 20px;
    }
    .button_info{
        text-align:center;
        position:absolute;
        right:505px;
        margin-top: 30px;
    }
    .label_for_dropdowns{
        font-size: 15px;
    }
    .first_table_head_class{
        font-weight:bold;
        font-size:15px;
        border-collapse:collapse;
        border-width:1px;
        border-style:solid;
    }
    .second_table_head_class{
        font-weight: bold;
        font-size:15px;
        bordered
    }
    .row
    {
    margin-left: 0px;
    }
    
</style>
<link href="custom/include/multiselect/multiselect.css" rel="stylesheet" />
<script type="text/javascript" src="custom/include/multiselect/multiselect.js"></script>
<!-- jspdf -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>

  <!-- html2canvas -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
{/literal}
<h2 class = "module-title-text" style="font-size: 24px;font-weight:unset;">Custom Reports</h2> <br/>
{*    {=======To show Dropdowns========}*}
    <form method="Post" action="index.php?module=Cases&action=case_reports" id="report_form_c" autocomplete="off">
            <div class="row">
            <div class="col-sm-12">
            <input type="radio" id="period_radio" name="period_radio" value="year" required {if $period_radio == "year"}checked{/if}  > 
            &nbsp;&nbsp;
            <label for="period_radio">Year / Quarter year / Half Year</label>
            &nbsp;&nbsp;
            <input type="radio" id="period_radio" name="period_radio" value="month" required {if $period_radio == "month"}checked{/if} >
            &nbsp;&nbsp;
            <label for="period_radio">Month</label>
            &nbsp;&nbsp;
            <input type="radio" id="period_radio" name="period_radio" value="day" required {if $period_radio == "day"}checked{/if} >
            &nbsp;&nbsp;
            <label for="period_radio">day / weeks</label>
            &nbsp;&nbsp;
            </div>
        </div>
      <br>
    <div class="row">
        <div class="col-sm-4">
        <label class="label_for_dropdowns">Select Event: </label><br>
        <select name="all_events" id="all_event" class="all_events" required>
        <option value="">Choose Event</option>
        <option value="1" {if $all_events == 1}selected{/if}>Number of New Cases</option>
        <option value="2" {if $all_events == 2}selected{/if}>Number of Closed Cases</option>
        <option value="3" {if $all_events == 3}selected{/if}>Which Source Advertisement Works Best</option>
        <option value="4" {if $all_events == 4}selected{/if}>Dollars Spent on Client Costs</option>
        <option value="5" {if $all_events == 5}selected{/if}>Number of Medical Records Received</option>
        <option value="6" {if $all_events == 6}selected{/if}>Number of Medical Records Requested</option>
        <option value="7" {if $all_events == 7}selected{/if}>Number of Documents Generated</option>
        <option value="8" {if $all_events == 8}selected{/if}>The Date a Case was converted to Open</option>
            </select>
        </div>

        <div class="col-sm-4">
        <label class="label_for_dropdowns">Select Year: </label><br>
        <select name="all_years" id="all_years" class="all_years" required>
            <option value="">Choose Year</option>
        </select>
        </div>

        <div class="col-sm-4">
        <label class="label_for_dropdowns">Select Month: </label>
        <select name="all_months[]" id="all_month" class="all_months" multiple  ">
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
        </select>
        <div id="error-msg" style="display:none">This field is required</div>
        </div>
        <div class="col-sm-4">
        <label class="label_for_dropdowns">Select Month: </label>
        <br>
        <select name="all_month_d" id="all_month_d" class="all_month_d"  >
                <option value="">Select options</option>
                <option value="1"  {if $all_month_d == 1}selected{/if}   >January</option>
                <option value="2"  {if $all_month_d == 2}selected{/if}  >February</option>
                <option value="3"  {if $all_month_d == 3}selected{/if}  >March</option>
                <option value="4"  {if $all_month_d == 4}selected{/if}  >April</option>
                <option value="5"  {if $all_month_d == 5}selected{/if}  >May</option>
                <option value="6"  {if $all_month_d == 6}selected{/if}  >June</option>
                <option value="7"  {if $all_month_d == 7}selected{/if}  >July</option>
                <option value="8"  {if $all_month_d == 8}selected{/if}  >August</option>
                <option value="9"  {if $all_month_d == 9}selected{/if}  >September</option>
                <option value="10" {if $all_month_d == 10}selected{/if}  >October</option>
                <option value="11" {if $all_month_d == 11}selected{/if}  >November</option>
                <option value="12" {if $all_month_d == 12}selected{/if}  >December</option>
        </select>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-4">
        <label class="label_for_dropdowns">Select Days: </label>
        <br>
        <select name="all_day_d[]" id="all_day_d" class="all_day_d" multiple >
                <option value=""></option>
        </select>
        <div id="error-msg_d" style="display:none">This field is required</div>
        </div>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-3" >
        </div>
        <div class="col-sm-2" >
        </div>
        <div class="col-sm-7" >
        <input   type="hidden" id="pdf_check" name="pdf_check" value="">
        <input  type="hidden"   id="year_text" name="year_text" value="{$year_text}">
        <textarea style="display:none;"   id="encoded_array">{$encoded_array}</textarea>
        <br><br>
       <button type="submit"  id="view_btn_c" name="button" class="button primary generate_report"  style="font-size: 10px; color:black;width:170px;">Generate Report</button>
       <button type="submit" id="pdf_btn_c" name="button" class="button primary generate_pdf" style="font-size: 10px; color:black;width:170px;">Generate Pdf</button>
       <button style="font-size: 10px; color:black;width:170px;" id="ViewGraph" onclick="return false;" class="button primary"  style="font-size: 10px;">View Graph</button>
       <button onclick="ClearPage();" name="Clear" class="button primary"  style="font-size: 10px; color:black;width:90px;" type = "button">Clear</button>
               </div>
          </div>
      
    

               {*    =======Buttons======*}
         
    </form>

</br></br>
<div style="display: none;" class="report_block">
    <table style="width: 100%;" id="report_generate" class="table table-bordered table-responsive table-striped">
        <thead>
        <tr class="first_table_head_class">
        {if $period_radio !="day"} <th>Month</th>  {else}
            <th>Day</th>
              {/if}
       
        {if $all_events == 1}
                 <th style="width:50%;"> Number of New Cases </th>
                 {/if}
                 {if $all_events == 2} 
                 <th style="width:50%;"> Number of Closed Cases </th>
                 {/if}
                 {if $all_events == 3} 
                 <th style="width:50%;"> Which Source Advertisement Works Best </th>
                 {/if}
                 {if $all_events == 4} 
                 <th style="width:50%;"> Dollars Spent on Client Costs </th>
                 {/if}
                 {if $all_events == 5} 
                 <th style="width:50%;"> Number of Medical Records Received </th>
                 {/if}
                 {if $all_events == 6}
                 <th style="width:50%;"> Number of Medical Records Requested </th>
                 {/if}
                 {if $all_events == 7} 
                 <th style="width:50%;"> Number of Documents Generated (Soft) </th>
                 {/if}
                 {if $all_events == 8} 
                    <th style="width:50%;"> Converted Cases </th>
                    {/if}
        </tr>
        </thead>
        <tbody>
        <tr>
        {*======Rows will be placed using jQuery======*}
        </tr>
        </tbody>
    </table>
    
</div>
<button id="ViewReport" name="button" class="button primary" style="display: none;font-size: 10px; color:black;">View Details</button>
<div id="ViewReportTable"></div>
<div style="width:600px;">
  <canvas id="myChart"></canvas>
</div>
{literal}
    <script src='custom/modules/Cases/js/report_script.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

    // Get the current year
    var currentYear = new Date().getFullYear();
    // Create options for the last 10 years
    for (let i = 0; i < 10; i++) {
      var year = currentYear - i;
      var option = document.createElement("option");
      option.text = year.toString();
      option.value = i;
      var com_year = $('#year_text').val();
      if (year == com_year) { 
      option.selected = true;
    }
      document.getElementById("all_years").appendChild(option);
    }
    $('#all_years').on('change', function() {
  var selectedOption = $(this).find('option:selected');
  var selectedOptionText = selectedOption.text();
   $('#year_text').val(selectedOptionText);
    });


    var generatePdfBtn = document.getElementById('pdf_btn_c');
    generatePdfBtn.addEventListener('click', function() {
      var pdfCheckInput = document.getElementById('pdf_check');
      pdfCheckInput.value = 'yes';
      var reportForm = document.getElementById('report_form_c');
      reportForm.setAttribute('target', '_blank');
    });
  
    var viewReportBtn = document.getElementById('view_btn_c');
    viewReportBtn.addEventListener('click', function() {
      var pdfCheckInput = document.getElementById('pdf_check');
      pdfCheckInput.value = 'no';
      var reportForm = document.getElementById('report_form_c');
      reportForm.setAttribute('target', '_self');
    });
        
    $('#all_month').multiselect({
        columns: 1,
        search: true,
        selectAll: true
    });
    $('#ms-list-1').css("width","340px");
    $('#all_month_d').css("width","340px");
    $('#all_day_d').css("width","250px");



  </script>
  <style>
  .ms-options-wrap
{
    width:340px;
}
.ms-options-wrap > .ms-options
{
    width:340px !important;
    left: unset !important;
    color: #534d64;
}
.ms-options-wrap > button:focus, .ms-options-wrap > button
{
    border-radius: 4px;
    padding: 5px 20px 7px 5px !important;
    margin-top:0px !important;
    border: 1px solid #edd03e !important;
    color: #534d64;
    width:340px !important;
}
.ms-options-wrap > button:after{
    background: url(themes/Honey/images/forms/select.ico) no-repeat right #fff;
    background-size: 42px 42px;
    top:11%;
    right:0;
    padding: 21px 14px 7px 10px;
    border: unset !important;
}
.select2-container{ width: 340px !important; 
}
 th {
        text-align: center;
    }
    #ms-list-1 > div {
        max-width: 340px;
    }
#all_day_d .ms-options-wrap > button:focus, .ms-options-wrap > button
{
    width:340px !important;
}
  </style>

{/literal}
