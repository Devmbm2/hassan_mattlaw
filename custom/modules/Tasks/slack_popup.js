
function sendMessage(record_id){
		$.ajax({
		type: "POST",
		url: "index.php?module=Tasks&action=getsmshtml&sugar_body_only=true",
		data:"record_id="+record_id,
		success : function (result){
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
			quickEditDialog.setHeader("Send Messgage")
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
		function SendMessageToValidator(record_id){
			var e =  document.getElementById("validator");
			var strUser = e.options[e.selectedIndex].value;
			var res = strUser.split("");
			var user_channel;
			if(res[0]=='@'){
				user_channel = 'user';
			}else{
				user_channel = 'channel';
			}
			var thisInstance = this;
			var sms_text = document.getElementById("user_notes").value;
			var user_id = strUser;
			if(sms_text == ''){
				alert('Please enter some message before proceeding.');
				return false;
			}
			if(user_id == ''){
				alert('Please select Slack User/Channel before proceeding.');
				return false;
			}
			$.ajax({
				url: "index.php?module=Tasks&action=setsmshtml",
				type: "POST",
				contentType: "application/x-www-form-urlencoded",
				dataType: "text",
				data:"sugar_body_only=1&record_id="+record_id+"&user_id="+user_id+"&sms_text="+encodeURIComponent(sms_text)+"&user_channel="+user_channel,						
				success : function (sent){
					console.log(sent);
					if(sent){
						$("#send_sms_response").html('Slack notification has been sent to selected Slack User/Channel.');
					}else{
						$("#send_sms_response").html('Slack notification has not been sent to selected Slack User/Channel.');
					}
				}
			});
		}
