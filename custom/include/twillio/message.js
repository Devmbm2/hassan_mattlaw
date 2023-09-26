
function sendMessage(record_id,module, editview){
	$.LoadingOverlay("show", {zIndex: 999999 } );
		$.ajax({
		type: "POST",
		async:false,
		url: "index.php?entryPoint=MessageBox",
		data:"record_id="+record_id + "&module="+module,
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

		},
		error : function (error){
			alert(error);
		}
		});		
	} 
		function SendMessageApi(record_id,module, to_number){
			/* var to_number = $('#validator').val(); */
			var thisInstance = this;
			var d = new Date();
			var timestamp = ('0'+(d.getMonth() + 1)).slice(-2) + '/' + ('0'+(d.getDate())).slice(-2) + '/' +  d.getFullYear() + ' ' + ('0'+(d.getHours()%12)).slice(-2) +':'+('0'+d.getMinutes()).slice(-2)+':'+' '+((d.getHours()>12)? '':'');
			var sms_text = document.getElementById("new_activity_post").value;
			if(sms_text == ''){
				alert('Please enter some message before proceeding.');
				return false;
			}
			var comment = '<div class="comments left_comment" id="comment_'+length+'"><h5>'+to_number+' | '+timestamp+'</h5>'+sms_text+'</div>';
			$('#comment_section').prepend(comment);
			/* $.LoadingOverlay("show", {zIndex: 999999 } ); */
			$.ajax({
				url: "index.php?entryPoint=send_sms",
				type: "POST",
				contentType: "application/x-www-form-urlencoded",
				dataType: "text",
				async: true,
				data:"sugar_body_only=1&record_id="+record_id+"&to_number="+to_number+"&sms_text="+encodeURIComponent(sms_text)+"&module="+module,						
				success : function (sent){

					if(sent){
						 alert('Message Sent.');
						 document.getElementById("new_activity_post").value = '';
						/* $("#send_sms_response").html('Message has been sent to selected Slack User/Channel.'); */
						/* $(".container-close").trigger('click'); */
					}else{
						alert('Message Not Sent.Please check there is an issue while sending the message');
						/* $("#send_sms_response").html('Message did not send to selected Slack User/Channel.'); */
					}
					/* $.LoadingOverlay("hide"); */
				}
			});
		}
