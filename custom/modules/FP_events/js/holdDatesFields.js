$(document).ready(function () {
	if (action_sugar_grp1 == 'DetailView') { 
		$('#btn_aggregatedFields').hide();
	}
    setTimeout(function () {
        load_fileds(fields_data);
    }, 1000);
     
    // $( "#datepicker0" ).datepicker("show");
});
var condln_agg = 0;
var condln_agg_count = 0;
var fields = '';
var functions = '';
var fields_data = '';
var script_run = true;

function load_fileds(fields_data) {
    if (fields_data !== null && fields_data !== '' && fields_data !== undefined) {
        var decode = atob(fields_data);
        var data = JSON.parse(decode);
        $.each(data, function (key, value) {
            insertDateField(value);
        });
    }
}

function insertaggConditionHeader() {
    tablehead = document.createElement("thead");
    tablehead.id = "holdDatesField_head";
    document.getElementById('holdDatesFields').appendChild(tablehead);

    var x = tablehead.insertRow(-1);
    x.id = 'holdDatesField_head';

    var a = x.insertCell(0);

    var b = x.insertCell(1);
    b.style.color = "rgb(0,0,0)";
    //b.innerHTML = SUGAR.language.get('FP_events', 'LBL_DATE');
    b.innerHTML = '<strong>Date</strong>';

    var c = x.insertCell(2);
    c.style.color = "rgb(0,0,0)";
    //c.innerHTML = SUGAR.language.get('FP_events', 'LBL_DATE_END');
    c.innerHTML = '<strong>End Date</strong>'; 
	
	var d = x.insertCell(3);
    d.style.color = "rgb(0,0,0)";
    //d.innerHTML = SUGAR.language.get('FP_events', 'LBL_DATE_END');
    d.innerHTML = '<strong>Status</strong>';

}

function insertDateField(value = '') {
    if (document.getElementById('holdDatesField_head') == null) {
        insertaggConditionHeader();
    } else {
        document.getElementById('holdDatesField_head').style.display = '';
    }


    tablebody = document.createElement("tbody");
    tablebody.id = "holdDates_fields_body" + condln_agg;
    document.getElementById('holdDatesFields').appendChild(tablebody);


    var x = tablebody.insertRow(-1);
    x.id = 'product_line' + condln_agg;

    var a = x.insertCell(0);
    if (action_sugar_grp1 == 'EditView' || action_sugar_grp1 == 'index') {
        a.innerHTML = "<button type='button' id='holdDates_fields_delete_line" + condln_agg + "' class='button' value='-' tabindex='116' onclick='markAggregatedFieldDeletedupdated(" + condln_agg + ");markAggregatedFieldDeleted(" + condln_agg + ");'><span class='glyphicon glyphicon-minus'></span></button><br>";
        a.innerHTML += "<input type='hidden' name='holdDates_fields_deleted[" + condln_agg + "]' id='holdDates_fields_deleted" + condln_agg + "' value='0'><input type='hidden' name='event_id[" + condln_agg + "]' id='event_id" + condln_agg + "' value=''>";
    } else {
        //a.innerHTML = condln_agg + 1;
    }

    var b = x.insertCell(1);
    var viewStyle = '';
    if (action_sugar_grp1 == 'DetailView') { viewStyle = 'display:none'; }
    b.innerHTML = "<input  class = 'required_check' type='text' name='start_date[" + condln_agg + "][]' id='start_date" + condln_agg + "' autocomplete='off' style = 'max-width: 40%;min-width: 40%;' required>"
                +"<select  name='start_date[" + condln_agg + "][]' class='datetimecombo_time required_check' size='1' id='date_start_hours" + condln_agg + "' tabindex='0' required><option></option><option value='00'>00</option><option value='01'>01</option><option value='02'>02</option><option value='03'>03</option><option value='04'>04</option><option value='05'>05</option><option value='06'>06</option><option value='07'>07</option><option value='08'>08</option><option value='09'>09</option><option value='10'>10</option><option value='11' selected>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option><option value='21'>21</option><option value='22'>22</option><option value='23'>23</option>"
				+"</select>&nbsp;:"
				+"&nbsp;<select  name='start_date[" + condln_agg + "][]' class='datetimecombo_time required_check' size='1' id='date_start_minutes" + condln_agg + "' tabindex='0' required>"
				+"<option></option>"
				+"<option value='00' selected>00</option>"
				+"<option value='05'>05</option>"
				+"<option value='15'>15</option>"
				+"<option value='30'>30</option>"
				+"<option value='45'>45</option>"
				+"</select>";

    var c = x.insertCell(2);
    var viewStyle = '';
    var additionalDiv = '<div style="padding: 5px;border: 1px solid skyblue;border-radius: 5px;margin-top: 5px;width: 95%;background: #a9a9a97d;">ID</div>';
     if (action_sugar_grp1 == 'DetailView') { viewStyle = 'display:none'; }
    
    c.innerHTML = "<input  class = 'required_check' type='text' name='end_date[" + condln_agg + "][]' id='end_date" + condln_agg + "' autocomplete='off' style = 'max-width: 40%;min-width: 40%;' required>"
				+"<select  name='end_date[" + condln_agg + "][]' class='datetimecombo_time required_check' size='1' id='end_date_hours" + condln_agg + "' tabindex='0' required><option></option><option value='00'>00</option><option value='01'>01</option><option value='02'>02</option><option value='03'>03</option><option value='04'>04</option><option value='05'>05</option><option value='06'>06</option><option value='07'>07</option><option value='08'>08</option><option value='09'>09</option><option value='10'>10</option><option value='11' selected>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option><option value='21'>21</option><option value='22'>22</option><option value='23'>23</option>"
				+"</select>&nbsp;:"
				+"&nbsp;<select  name='end_date[" + condln_agg + "][]' class='datetimecombo_time required_check' size='1' id='end_date_minutes" + condln_agg + "' tabindex='0' required>"
				+"<option></option>"
				+"<option value='00' selected>00</option>"
				+"<option value='05'>05</option>"
				+"<option value='15'>15</option>"
				+"<option value='30'>30</option>"
				+"<option value='45'>45</option>"
				+"</select>";
				
	var d = x.insertCell(3);
    var viewStyle = '';
    var additionalDiv = '<div style="padding: 5px;border: 1px solid skyblue;border-radius: 5px;margin-top: 5px;width: 95%;background: #a9a9a97d;">ID</div>';
     if (action_sugar_grp1 == 'DetailView') { viewStyle = 'disabled:true'; }
    
    d.innerHTML = "<select  name='h_c[" + condln_agg + "]' id='h_c" + condln_agg + "' class='required_check' size='1'  tabindex='0' required>"
				+"<option value='hold'>H</option>"
				+"<option value='Confirmed'>C</option>"
				+"</select>";
	
    $("#start_date" + condln_agg).datepicker({
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImageOnly: true,
            buttonImage: "themes/Honey/images/jscalendar.gif?v=V6Jf_6LIk4nKTRgtYTnxCA",
            dateFormat: "mm/dd/yy"
        }); 
    $( "#end_date"+ condln_agg).datepicker({
            changeMonth: true,
            changeYear: true,
            showOn: "button",
            buttonImageOnly: true,
            buttonImage: "themes/Honey/images/jscalendar.gif?v=V6Jf_6LIk4nKTRgtYTnxCA",
            dateFormat: "mm/dd/yy"
        });

	$('#h_c' + condln_agg).on('change', function () {
		console.log('this.value');
		console.log(this.value);
		if(this.value == 'Confirmed'){
			alert("This Event is marked as Confirmed. All other Events will be deleted.");
			$('select[name^="h_c"]').each(function(){
				if($(this).val() != 'Confirmed'){
					$(this).prop( "disabled", true );
				}
			});
			$('#btn_aggregatedFields').prop( "disabled", true );
		}else{
			$('select[name^="h_c"]').each(function(){
				$(this).prop( "disabled", false );
				$('#btn_aggregatedFields').prop( "disabled", false );
			});
		}
    });
	
    if (value) {
        $('#start_date' + condln_agg).val(value.date_start);
        $('#date_start_hours' + condln_agg).val(value.date_start_hours);
        $('#date_start_minutes' + condln_agg).val(value.date_start_minutes);
        $('#end_date' + condln_agg).val(value.date_end);
        $('#end_date_hours' + condln_agg).val(value.date_end_hours);
        $('#end_date_minutes' + condln_agg).val(value.date_end_minutes);
        $('#h_c' + condln_agg).val(value.h_c);
        $('#event_id' + condln_agg).val(value.event_id);
    }
	if (action_sugar_grp1 == 'DetailView') {
		$('input[name^="start_date"]').prop( "disabled", true );
		$('input[name^="end_date"]').prop( "disabled", true );
		$('select[name^="h_c"]').prop( "disabled", true );
		$('select[name^="start_date"]').prop( "disabled", true );
		$('select[name^="end_date"]').prop( "disabled", true );
	}
    condln_agg++;
    condln_agg_count++;

    return condln_agg - 1;
}

function markAggregatedFieldDeleted(ln) {
    /* document.getElementById('holdDates_fields_body' + ln).style.display = 'none'; */
    document.getElementById('holdDates_fields_deleted' + ln).value = '1';
    document.getElementById('holdDates_fields_delete_line' + ln).onclick = '';
    condln_agg_count--;
    if (condln_agg_count == 0) {
        document.getElementById('holdDatesField_head').style.display = "none";
    }
}
function markAggregatedFieldDeletedupdated(ln) {
    $('#holdDates_fields_body' + ln).remove();
    condln_agg_count--;
	console.log('condln_agg_count : '+ condln_agg_count);
	console.log('condln_agg_count : '+ condln_agg);
    if (condln_agg_count == 0) {
        $('#holdDatesField_head').remove();
		$('#btn_aggregatedFields').prop( "disabled", false );
    }
}

function isEmpty(obj) {
    if (obj == null) return true;
    if (obj.length > 0) return false;
    if (obj.length === 0) return true;
    if (typeof obj !== "object") return true;
    for (var key in obj) {
        if (hasOwnProperty.call(obj, key)) return false;
    }
    return true;
}
