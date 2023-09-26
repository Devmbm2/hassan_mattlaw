function checkConflict(){
	$.LoadingOverlay("show", {zIndex: 999999 } );
	var user_ids =  $('#multiple_assigned_users').val();
	var assigned_user_id =  $('#assigned_user_id').val();
	var date_start = $('#date_start').val();
	var date_end = $('#date_end').val();
	var cancelled_reset_c = $('#cancelled_reset_c').val();
	var record_id= document.getElementsByName("record")[0].value;
	var move = false;
	if(cancelled_reset_c == 'Cancelled' || cancelled_reset_c == 'Reset'){
		return false;
	}
	$.ajax({
		type: "POST",
		async:false,
		contentType: "application/x-www-form-urlencoded",
		dataType: "text",
		url: "index.php?module=Calendar&action=checkConflictedEvents",
		data:"multiple_assigned_users="+ user_ids + "&date_start="+date_start + "&date_end="+date_end+ "&assigned_user_id="+assigned_user_id+ "&formName="+formName+ "&record_id="+record_id+ "&redirect="+redirect,
		success : function (result){
			$.LoadingOverlay("hide");
			if(result !== 'false'){
				move = true;
				document.getElementById("message_dialog_Events").innerHTML =result;				
				var quickEditDialog = new YAHOO.widget.SimpleDialog('message_dialog_Events', {
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
				quickEditDialog.setHeader("Conflict Notice")
				$(".container-close").click(function(){
					quickEditDialog.hide();	
				});
				quickEditDialog.show();
			}
		},
		error : function (error){
			alert(error);
		}
		});	
	return move;
}
