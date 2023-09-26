
function sendMessage(record_id,module, editview, form_name){
	$.LoadingOverlay("show", {zIndex: 999999 } );
		$.ajax({
		type: "POST",
		async:false,
		url: "index.php?entryPoint=MessageBox",
		data:"record_id="+record_id + "&module="+module + "&form_name="+form_name,
		success : function (result){
			$.LoadingOverlay("hide");
			document.getElementById("message_dialog").innerHTML =result;
			var quickEditDialog = new YAHOO.widget.SimpleDialog('message_dialog', {
				width: "650px",
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
			quickEditDialog.setHeader("Send Message")
			$(".container-close").click(function(){
				quickEditDialog.hide();	
			});
			quickEditDialog.show();
			$("#validator").select2({
				sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
			});
			if(editview){
				$('#send_message').val('Save & NOTIFY');
			}
		},
		error : function (error){
			alert(error);
		}
		});		
	} 
		function SendMessageToValidator(record_id,module, form_name){
			var e =  document.getElementById("validator");
			var strUser = $('#validator').val();
			// var res = strUser.split("");
			// var user_channel;
			// if(res[0]=='@'){
				// user_channel = 'user';
			// }else{
				// user_channel = 'channel';
			// }
			var thisInstance = this;
			var sms_text = document.getElementById("user_notes").value;
			var user_id = strUser;
			if(sms_text == ''){
				alert('Please enter some message before proceeding.');
				return false;
			}
			if(user_id == null || user_id == ''){
				alert('Please select Slack User/Channel before proceeding.');
				return false;
			}
			if(record_id != ''){
				$.LoadingOverlay("show", {zIndex: 999999 } );
				$.ajax({
					url: "index.php?entryPoint=SendMessage",
					type: "POST",
					contentType: "application/x-www-form-urlencoded",
					dataType: "text",
					data:"sugar_body_only=1&record_id="+record_id+"&user_id="+user_id+"&sms_text="+encodeURIComponent(sms_text)+"&module="+module,						
					success : function (response){
						console.log('response');
						console.log(response);
						if(response == 'sent'){
							if(typeof(form_name) != undefined && form_name != '' && form_name != 'undefined'){
								var _form = document.getElementById(form_name); 
								_form.action.value='Save';
								if(check_form(form_name))SUGAR.ajaxUI.submitForm(_form);return false;
							}
							$(".container-close").trigger('click');
						}else{
							var status_slack = JSON.parse(response);
							console.log('sent');
							console.log(status_slack);
							var html = '';
							$.each(status_slack, function( index, value ) {
							  html += index+':'+value+'<br>';
							});
							$("#send_sms_response").html('Slack notification did not send to selected Slack User/Channel.<br>'+html);
						}
						$.LoadingOverlay("hide");
					}
				});
			}else{
				var _form = document.getElementById(form_name); 
				_form.action.value='Save';
				_form.send_slack_notification.value='send';
				$('#'+ form_name +' #send_slack_notification').val('send');
				$('#'+ form_name +' #user_id').val(user_id);
				$('#'+ form_name +' #sms_text').val(sms_text);
				if(check_form(form_name))SUGAR.ajaxUI.submitForm(_form);return false;
			}
		
		}
