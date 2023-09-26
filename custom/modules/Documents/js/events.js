function DocumentCheckConflict(module){
	$.LoadingOverlay("show", {zIndex: 999999 } );
	var user_ids =  $('#multiple_assigned_users').val();
	var assigned_user_id =  $('#assigned_user_id').val();
	var date_start = $('#date_start').val();
	var date_end = $('#date_end').val();
	var case_id = '';
	if(module == 'DISC_Discovery'){
		case_id = $('#disc_discovery_casescases_ida').val();		
	}else if(module == 'PLEA_Pleadings'){
		case_id = $('#plea_pleadings_casescases_ida').val();			
	}else if(module == 'NEG_Negotiations'){
		case_id = $('#neg_negotiations_casescases_ida').val();			
	}
	var record_id= document.getElementsByName("record")[0].value;
	var move = false;
	$.ajax({
		type: "POST",
		async:false,
		contentType: "application/x-www-form-urlencoded",
		dataType: "text",
		url: "index.php?module=Documents&action=DocumentCheckConflictedEvents",
		data:"case_id="+ case_id + "&multiple_assigned_users="+ user_ids + "&date_start="+date_start + "&date_end="+date_end+ "&assigned_user_id="+assigned_user_id+ "&formName="+formName+ "&record_id="+record_id+ "&redirect="+redirect,
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
