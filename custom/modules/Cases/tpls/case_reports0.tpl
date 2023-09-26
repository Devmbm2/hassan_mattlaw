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
</style>
{/literal}
<h1>Custom Reports</h1>
{*    {=======To show Dropdowns========}*}
    <div class="row">
        <div class="col-sm-4">
        <label class="label_for_dropdowns">Select Event: </label>
        <select name="all_events" id="all_event" class="all_events">
            <option value="-1">Choose Event</option>
            <option value="1">Number of New Cases</option>
            <option value="2">Number of Closed Cases</option>
            <option value="3">Which Source Advertisement Works Best</option>
            <option value="4">Dollars Spent on Client Costs</option>
            <option value="5">Number of Medical Records Received</option>
            <option value="6">Number of Medical Records Requested</option>
            <option value="7">Number of Documents Generated</option>
        </select>
        </div>

        <div class="col-sm-4">
        <label class="label_for_dropdowns">Select Year: </label>
        <select name="all_years" id="all_year" class="all_years">
            <option value="-2">Choose Year</option>
        </select>
        </div>

        <div class="col-sm-4">
        <label class="label_for_dropdowns">Select Month: </label>
        <select name="all_months" id="all_month" class="all_months" multiple>
            <option value="-3">Choose Month</option>
        </select>
        </div>
    </div>

               {*    =======Buttons======*}
    <div class="row button_info">
    <button type="button" name="button" class="button primary generate_report">Generate Report</button>
    <button type="button" name="button" class="button primary generate_pdf">Generate Pdf</button>
    <a href="" class="btn view-case view_cases_pdf" target="_blank">View File</a>
    </div>

</br></br></br></br></br></br></br></br>
<div style="display: none;" class="new_cases_block">
    <table style="width: 100%;" id="new_cases" class="table table-bordered table-responsive">
        <thead>
        <tr class="first_table_head_class">
        <th>Month</th>
        <th>Count(Cases)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        {*======Rows will be placed using jQuery======*}
        </tr>
        </tbody>
    </table>
</div>
<div style="display: none;" class="source_advertisement_block">
    <table style="width: 100%;" id="new_source_advertisement" class="table table-bordered table-responsive">
        <thead>
        <tr class="second_table_head_class">
            <th>Month</th>
            <th>Source</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            {*======Rows will be placed using jQuery======*}
        </tr>
        </tbody>
    </table>
</div>
<div style="display: none;" class="cost_info_block">
    <table style="width: 100%;" id="new_cost" class="table table-bordered table-responsive">
        <thead>
        <tr class="third_table_head_class">
            <th>Month</th>
            <th>Client Cost</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            {*======Rows will be placed using jQuery======*}
        </tr>
        </tbody>
    </table>
</div>
<div style="display: none;" class="medical_records_received">
    <table style="width: 100%;" id="new_records_received" class="table table-bordered table-responsive">
        <thead>
        <tr class="fourth_table_head_class">
            <th>Month</th>
            <th>Medical Records Received</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            {*======Rows will be placed using jQuery======*}
        </tr>
        </tbody>
    </table>
</div>
<div style="display: none;" class="medical_records_requested">
    <table style="width: 100%;" id="new_records_requested" class="table table-bordered table-responsive">
        <thead>
        <tr class="fifth_table_head_class">
            <th>Month</th>
            <th>Medical Records Requested</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            {*======Rows will be placed using jQuery======*}
        </tr>
        </tbody>
    </table>
</div>
<div style="display: none;" class="documents_generated">
    <table style="width: 100%;" id="documents_info" class="table table-bordered table-responsive">
        <thead>
        <tr class="sixth_table_head_class">
            <th>Month</th>
            <th>Documents Generated</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            {*======Rows will be placed using jQuery======*}
        </tr>
        </tbody>
    </table>
</div>
<div style="display: none;" class="cases_closed">
    <table style="width: 100%;" id="cases_closed_info" class="table table-bordered table-responsive">
        <thead>
        <tr class="seventh_table_head_class">
            <th>Month</th>
            <th>Closed Cases</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            {*======Rows will be placed using jQuery======*}
        </tr>
        </tbody>
    </table>
</div>

{literal}
    <script src='custom/modules/Cases/js/report_script.js'></script>
{/literal}
