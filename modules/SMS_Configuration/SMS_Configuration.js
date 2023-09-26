var smsData = '';
var app = '<div id="ASD" class="modal fade modal-search in" tabindex="-1" role="dialog" style="display: none; padding-left: 12px;">' +
        '<div class="modal-dialog modal-lg">' +
        '<div class="modal-content" style="border-color: #edd03d;border-width: medium;">' +
        '<div class="modal-header" style="background:linear-gradient(#333,#111); padding: 10px;">' +
        '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>' +
        '<h4 class="modal-title" style="color:#fff"><b>New SMS</b></h4>' +
        '</div>' +
        '<div class="modal-body" id="dashboardDialog">' +
        '</div>' +
 	'<div class="col-sm-6" style="width: 60%;">' +
	'</div>' +
        '<div class="modal-footer" style="background-color:#F5F5F5">' +
        '<button type="button" class="button" id="mod_can" data-dismiss="modal">Close</button> &nbsp;' +
        '<button id="submit" class="button">Send SMS</button>' +
        '</div></div></div>' +
        '</div>';

var bulksms = '<div id="BULK" class="modal fade modal-search in" tabindex="-1" role="dialog" style="display: none; padding-left: 12px;">' +
        '<div class="modal-dialog modal-lg">' +
        '<div class="modal-content" style="border-color: #f08377;border-width: medium;">' +
        '<div class="modal-header" style="background:#3C8DBC; padding: 10px;">' +
        '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>' +
        '<h4 class="modal-title" style="color:#fff"><b>Sending Bulk SMS</b></h4>' +
        '</div>' +
        '<div class="modal-body" id="bulk_dashboardDialog">' +
        '</div>' +
 	'<div class="col-sm-6" style="width: 60%;">' +
	'</div>' +
        '<div class="modal-footer" style="background-color:#F5F5F5">' +
        '<button type="button" class="button" id="mod_can" data-dismiss="modal">Close</button> &nbsp;' +
        '<button id="submit"type="submit" id="bulksubmit" class="button">Send</button>' +
        '</div></div></div>' +
        '</div>';

var testing_sms = '<div id="Testing_SMS" class="modal fade modal-search in" tabindex="-1" role="dialog" style="display: none; padding-left: 12px;">' +
        '<div class="modal-dialog modal-lg">' +
        '<div class="modal-content" style="border-color: #f08377;border-width: medium;">' +
        '<div class="modal-header" style="background:#3C8DBC; padding: 10px;">' +
        '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>' +
        '<h4 class="modal-title" style="color:#fff"><b>Testing SMS</b></h4>' +
        '</div>' +
        '<div class="modal-body" id="testing_dashboardDialog">' +
        '</div>' +
 	'<div class="col-sm-6" style="width: 60%;">' +
	'</div>' +
        '<div class="modal-footer" style="background-color:#F5F5F5">' +
        '<button type="button" class="button" id="mod_can" data-dismiss="modal">Close</button> &nbsp;' +
        '</div></div></div>' +
        '</div>';

$('body').append(app);
$('body').append(testing_sms);
$('body').append(bulksms);

function sendbulksms(module)
{
    sugarListView.get_checks();
    var sms_ids = document.MassUpdate.uid.value;

    $('#BULK').modal('toggle');
    $.ajax({
        url: 'index.php?entryPoint=SMS_Options',
        type: 'POST',
        data: {action: 'get_smsbulk_body', modulefrom: module, recid: sms_ids},
        success: function (get_body) {
            //document.getElementById("des").value = errorResponse;
            //alert(get_body);
            $("#bulk_dashboardDialog").empty();
            $("#bulk_dashboardDialog").append(get_body);
        }
    });

}

/* function getSMSStream()
{
	$("#errr_msg").css("display", "none");
    var record_id = $("#formDetailView [name='record']").val();
	var module = $("#formDetailView [name='module']").val();
	if(typeof(record_id) != 'undefined'){
		$.ajax({
			url: 'index.php?module=ht_sms&record_module='+module+'&action=get_sms_stream&sugar_body_only=true&record_id='+record_id,
			type: 'GET',
			async: true,
			success: function (get_body) {
				if(typeof(get_body) != 'undefined'){
					$("#sms_stream").html(get_body);		
				}
			}
		});
	}
} */
function getSMSStream()
{
	$("#errr_msg").css("display", "none");
    var record_id = $("#formDetailView [name='record']").val();
	var module = $("#formDetailView [name='module']").val();
	if(typeof(record_id) != 'undefined'){
		$.ajax({
			url: 'index.php?entryPoint=SMS_Options',
			data: {action: 'get_sms_data', record_module: module, record_id: record_id, module: 'ht_sms'},
			type: 'GET',
			async: false,
			success: function (sms_data) {
				if(typeof(sms_data) != 'undefined'){
					var sms_data_obj = JSON.parse(sms_data);
					smsData = sms_data_obj;
					displayMessages(sms_data_obj);
				}
			}
		});
	}
}

function displayMessages(sms_data_obj){
	var stream_html = '';
	$.each(sms_data_obj.data, function (i, record_data) {
		var heading = '';
		var css_class = '';
		
		if(record_data.sent_received == 'Outgoing'){
			css_class = 'right';
		}else{
			css_class = 'left';
		}
		stream_html += '<div class="comments '+css_class+'_comment" id="'+record_data.id+'_row">'
						  +'<h5>'+record_data.heading+'</h5>'
						  +record_data.description+''+record_data.display_image
						  +'</div>';
	});

	$("#sms_stream").html('');
	$("#sms_stream").html(stream_html);
}

function getSMSStreamData(record_ids)
{
	$("#errr_msg").css("display", "none");
    var record_id = $("#formDetailView [name='record']").val();
	var module = $("#formDetailView [name='module']").val();
	if(typeof(record_id) != 'undefined'){
		$.ajax({
			url: 'index.php?entryPoint=SMS_Options',
			data: {action: 'get_sms_data', record_module: module, record_id: record_id, module: 'ht_sms', record_ids: record_ids},
			type: 'GET',
			async: true,
			success: function (data) {
				if(typeof(data) != 'undefined'){
					//console.log('smsData');
					//console.log(smsData);
							
				}
			}
		});
	}
}

function scroll_down(){
	$('#sms_stream').on('scroll', function() {
		if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
			console.log('yes yes');
			//var record_ids = kanbanData.record_ids;
			getSMSStreamData();
		}
	});
}
function smstonumber(mobile, module, recid)
{
    $('#ASD').modal('toggle');
    $.ajax({
        url: 'index.php?entryPoint=SMS_Options',
        type: 'POST',
        data: {action: 'get_sms_body', mobile: mobile, modulefrom: module, recid: recid},
        success: function (get_body) {
			$("#dashboardDialog").empty();
            $("#dashboardDialog").append(get_body);
        }
    });

}

function ht_sendSMS(form_id){
	var phone_number = $(form_id+" #mobile_numbers").val();
	var selected_id = $(form_id+' #sms_description').val();
	var sl_mod = $(form_id+' #sl_mod').val();
	var sl_mod_id = $(form_id+' #sl_mod_id').val();

	$(form_id+" #errr_msg").css("display", "none");
	if (selected_id === "" &&  phone_number === ""){
		$(form_id+" #errr_msg").html("Phone Number OR Message Body can't be Empty to sending Message.");
		$(form_id+" #errr_msg").css("display", "block");
	}else if (phone_number === ""){
		$(form_id+" #errr_msg").html("Phone number Can't be Empty to send Message.");
		$(form_id+" #errr_msg").css("display", "block");
	}else if (selected_id === ""){
		$(form_id+" #errr_msg").html("Message Body Can't be Empty to send Message.");
		$(form_id+" #errr_msg").css("display", "block");
	}
	else{
		//Sending SMS
		$(form_id+" #loading_sms").css("display", "block");

		$.ajax({
			url: 'index.php?entryPoint=SMS_Options',
			type: 'POST',
			async: true,
			data: {action: 'send_sms', template_name: $(form_id+' #template_id option:selected').text(), mobile_numbers: $(form_id+" #mobile_numbers").val(), file_name: $(form_id+" #file_name").val(), file_data: $(form_id+" #file").val(), body: selected_id, sl_mod: sl_mod, sl_mod_id: sl_mod_id},
			success: function (response) {
				//document.getElementById("des").value = errorResponse;
				var result = JSON.parse(response)
				//exit;
				//  $(form_id+" #sms_description").empty();
				//  $(form_id+" #sms_description").append(get_body);
				if (result.success)
				{
					$(form_id+" #loading_sms").css("display", "none");
					$(form_id+" #errr_msg").text("Message Sent Successfully..");
					$(form_id+" #errr_msg").css("color", "blue");
					$(form_id+" #errr_msg").css("display", "block");
					$(form_id+" #sms_description").val("");
					$('.pip').remove();
					$("#file").val('');
					$("#file_name").val('');
					$("#file").show();
					remove_file($(form_id+" #file_name").val());
				} else{
					$(form_id+" #loading_sms").css("display", "none");
					$(form_id+" #errr_msg").text("Message Sending Failed. "+result.message);
					$(form_id+" #errr_msg").css("color", "red");
					$(form_id+" #errr_msg").css("display", "block");

				}
				
				// window.location.reload();
			}
		});
	}
}
function initSMSStream(){
	
	var record_id = $("#formDetailView [name='record']").val();
	var module = $("#formDetailView [name='module']").val();
	var phone = '';
	if(module == "Contacts" || module == "Leads"){
		phone = bean['phone_mobile'];
	}else if(module == "Accounts"){
		phone = bean['phone_office'];
	}else if(module == "ht_sms"){
		if(bean['sent_received'] == 'Outgoing'){
			phone = bean['to_number'];
		}else{
			phone = bean['from_number'];
		}
	}
	var SMS_body = '<div class="commentsection" id="sms_stream" style="padding: 25px 70px;max-height: 400px;overflow-y: scroll;"></div>';
	SMS_body += '<div id="stream_footer_content" style="padding: 0px 100px;">'
	+"<font color='red' style='text-align: center;'><span id='errr_msg' style='display:none;color:#F44336;'><b>Phone Number OR Message Body can't be Empty to sending Message.</b></span></font>"
	+"<div id='loading_sms' style='display:none'><div style='display: flex;justify-content: center;'><image src='modules/SMS_Configuration/images/sms_loading.gif'/></div></div>"
    + "Send to Numbers (format +1):"
    + "<input id='mobile_numbers' name='mobile_numbers' type='text' value='"+phone+"' style='width:inherit;'/>"
	+ " <input type='file' id='file' name='file' style = 'float:right;' /><input type='hidden' id='file_name' name='file_name' value = '' />"
    + "<input type='hidden' name='sl_mod' id='sl_mod' value='"+module+"'/>"
    + "<input type='hidden' name='sl_mod_id' id='sl_mod_id' value='"+record_id+"'/>"
				+'<textarea spellcheck="true" id="sms_description" name="sms_description" rows="4" cols="100" title="" tabindex="0" style=" width: 100%;margin-top:+20px;"></textarea>';
	SMS_body += '<input type="button" value="Send Message" onclick="ht_sendSMS(\'#stream_footer_content\');" style=" margin-left: 583px;margin-top: 10px;"></div>';
	if(module != 'Cases'){
		//$("#tab-content-5 .detail-view-row").html(SMS_body);
		$('div[field="sms_body"]').parent().html(SMS_body);		
	}
	//getSMSStreamData();
	//getSMSStream();
	//window.setInterval(function(){
	  //getSMSStreamData();
	  getSMSStream();
	//}, 50000);
}
$(document).ready(function (){   
	setTimeout(function() {   //calls click event after a certain time
	   scroll_down();
	   SUGAR.util.doWhen(
			"typeof(bean) != 'undefined'",
			initSMSStream
	);
	}, 5000);
	$('#mobile_numbers').mask('999-999-9999');
	//Create SMS screen
	// SUGAR.util.doWhen(
	// 		"typeof(bean) != 'undefined'",
	// 		initSMSStream
	// );
	$(document).off('click', '#bulksubmit');
	$(document).on('click', '#bulksubmit', function () {
		$("#bulksubmit").attr("disabled", true);
        var selected_id = $('#bulksms_description').val();
        var sl_mod = $('#bulk_sl_mod').val();
        var sl_mod_id = $('#bulk_sl_mod_id').val();

        $("#errr_msg").css("display", "none");
        if (selected_id === "")
        {
            $("#errr_msg").css("display", "block");
            //setTimeout(function(){ $("#mod_can").click(); }, 3000);
        } else
        {
            //Sending SMS
            $("#loading_sms").css("display", "block");

            $.ajax({
                url: 'index.php?entryPoint=SMS_Options',
                type: 'POST',
                async: true,
                data: {action: 'bulksend_sms',template_id:$('#bulktemplate_id').val() ,template_name: $('#bulktemplate_id option:selected').text(), mobile_numbers: $("#bulkmobile_numbers").val(), body: selected_id, sl_mod: sl_mod, sl_mod_id: sl_mod_id},
                success: function (get_body) {
                    //document.getElementById("des").value = errorResponse;
                    //alert(get_body);
                    //exit;
                    //  $("#sms_description").empty();
                    //  $("#sms_description").append(get_body);
                    if (get_body !== "")
                    {
                        $("#loading_sms").css("display", "none");
                        $("#errr_msg").text("Message Sent Successfully..");
                        $("#errr_msg").css("color", "blue");
                        $("#errr_msg").css("display", "block");
                    } else
                    {
                        $("#loading_sms").css("display", "none");
                        $("#errr_msg").text("Message Sending Failed..");
                        $("#errr_msg").css("color", "red");
                        $("#errr_msg").css("display", "block");

                    }
                    //$("#mod_can").click();
                    setTimeout(function () {
                        $("#mod_can").click();
                    }, 3000);
                    window.location.reload();
                }
            });


        }

    });
	$(document).off('click', '#submit');
    $(document).on('click', '#submit', function () {
		ht_sendSMS("#dashboardDialog");

    });
	$(document).off('change', '#template_id');
	$(document).on('change', '#template_id', function () {
        var selected_id = $('#template_id').val();
        var sl_mod = $('#sl_mod').val();
        var sl_mod_id = $('#sl_mod_id').val();
        //alert(selected_id);
        $("#errr_msg").css("display", "none");
        $.ajax({
            url: 'index.php?entryPoint=SMS_Options',
            type: 'POST',
            data: {action: 'sms_fetch', et_id: selected_id, sl_mod: sl_mod, sl_mod_id: sl_mod_id},
            success: function (get_body) {
                //document.getElementById("des").value = errorResponse;
                //alert(get_body);
                $("#sms_description").empty();
                $("#sms_description").append(get_body);
            }
        });


    });
	$(document).off('change', '#bulktemplate_id');
     $(document).on('change', '#bulktemplate_id', function () {

        var selected_id = $('#bulktemplate_id').val();
        //var sl_mod = $('#sl_mod').val();
        //var sl_mod_id = $('#sl_mod_id').val();
        //alert(selected_id);
        
        
        if(selected_id != "NS")
        {
          $('#bulksms_description').prop('readonly','readonly');
        }
        else
        {
          $('#bulksms_description').prop('readonly','');
        }
        
        $("#errr_msg").css("display", "none");
        $.ajax({
            url: 'index.php?entryPoint=SMS_Options',
            type: 'POST',
            data: {action: 'bulksms_fetch', et_id: selected_id},
            success: function (get_body) {
                //document.getElementById("des").value = errorResponse;
                //alert(get_body);
                $("#bulksms_description").empty();
                $("#bulksms_description").append(get_body);
            }
        });


    });
	///////
	// $(document).on("click", function()
	// {
	// 	alert("Please wait for SMS Screen load properly.");
	// 	$(this).css("position-events","none");
	// 	$(this).css("cursor","default");
	// })

});