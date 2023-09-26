$( document ).ready(function() {
    add_dates();
});
function eventHolds(){
	//$.LoadingOverlay("show", {zIndex: 999999 } );
	$.ajax({
		type: "POST",
		async:false,
		//contentType: "application/x-www-form-urlencoded",
		dataType: "text",
		url: "index.php?module=FP_events&action=EventsHold",
		success : function (result){
			//$.LoadingOverlay("hide");
			document.getElementById("message_dialog_Events").innerHTML =result;				
			var quickEditDialog = new YAHOO.widget.SimpleDialog('message_dialog_Events', {
				width: "860px",
				effect:{
					effect: YAHOO.widget.ContainerEffect.FADE,
					duration: 0.25
				},
				fixedcenter: true,
				modal: true,
				visible: false,
				close : true,
				draggable : true,
				zIndex:15000
			});
			quickEditDialog.render(document.body);	
			quickEditDialog.setHeader("Hold Events")
			$(".container-close").click(function(){
				quickEditDialog.hide();	
			});
			quickEditDialog.show();
			
		},
		error : function (error){
			alert(error);
		}
	});	
	return false;
}
function add_dates(){
	$(document).on('click', '#save_dates', function () {
		if(!check_required_inputs()){
			alert('Please fill all the fields');
			return false;
		};
		var form = $('#test');
		var url = form.attr('action');

		$.ajax({
		   type: 'POST',
		   url: url,
		   data: form.serialize(), // serializes the form's elements.
		   success: function(data)
		   {
			   $('#hold_data').val('');
			   $('#hold_data').val(data);
			   $('.container-close').click();
		   }
		 });
	});
	// add row
	var counter = 1;
	$(document).on('click', '#addRow', function () {
		var html = '<div class="row">'+
				'<div class="col-lg-6">'+
					'<div id="inputFormRow">'+
						'<div class="input-group mb-3">'+
							'Start Date: '+
							'<input class = "required_check" type="date" name="start_date['+ counter +'][]"  placeholder="Enter title" autocomplete="off" style = "max-width: 40%;min-width: 40%;">'+
							'<select name="start_date['+ counter +'][]" class="datetimecombo_time required_check" size="1" id="date_start_hours" tabindex="0" ><option></option><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option>'+
							'</select>&nbsp;:'+
							'&nbsp;<select name="start_date['+ counter +'][]" class="datetimecombo_time required_check" size="1" id="date_start_minutes" tabindex="0" >'+
							'<option></option>'+
							'<option value="00">00</option>'+
							'<option value="05">05</option>'+
							'<option value="15">15</option>'+
							'<option value="30">30</option>'+
							'<option value="45">45</option>'+
							'</select>'+
						'</div>'+
					'</div>'+
				'</div>  '+
				'<div class="col-lg-6">'+
					'<div id="inputFormRow">'+
						'<div class="input-group mb-3">'+
							'End Date: '+
							'<input class = "required_check" type="date" name="end_date['+ counter +'][]" class="" placeholder="Enter title" autocomplete="off" style = "max-width: 40%;min-width: 40%;">'+
							'<select name="end_date['+ counter +'][]" class="datetimecombo_time required_check" size="1" id="date_start_hours" tabindex="0" ><option></option><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option>'+
							'</select>&nbsp;:'+
							'&nbsp;<select name="end_date['+ counter +'][]" class="datetimecombo_time required_check" size="1" id="date_start_minutes" tabindex="0" >'+
							'<option></option>'+
							'<option value="00">00</option>'+
							'<option value="05">05</option>'+
							'<option value="15">15</option>'+
							'<option value="30">30</option>'+
							'<option value="45">45</option>'+
							'</select>'+
						'</div>'+
					'</div>'+
				'</div>'+
				'<div class="input-group-append">'+
					'<button id="removeRow" type="button" class="btn btn-danger">Remove</button>'+
				'</div>'+
			'</div>';

		$('.container_box').append(html);
		counter++;
	});

	// remove row
	$(document).on('click', '#removeRow', function () {
		$(this).closest('.row').remove();
	});
}

function check_required_inputs() {
	var move = true;
    $('.required_check').each(function(){
        if( $(this).val() == "" ){
		  move = false;
        }
    });
    return move;
}

