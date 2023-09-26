$( document ).ready(function() {
	//$('#subpanel_title_def_defendants_complaints').parent().hide(); // to hide the defandant subpanel title
	//$('#def_defendants_complaints_create_button').closest('tr').hide();
});

function execute_workflow(selected_record){
	var workflow_id = selected_record.name_to_value_array.subpanel_id;
	var complaint_id= document.getElementsByName("record")[0].value;
	SUGAR.ajaxUI.showLoadingPanel();
	$.ajax({
		url: 'index.php?module=AOW_WorkFlow&action=execute_workflow_manually&record_id='+complaint_id+'&record_module=Complaints&workflow_id='+workflow_id,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){
			SUGAR.ajaxUI.hideLoadingPanel();
			window.location.reload();	
			
		}
	});
}
   function show_complaint_related_events_report(id){
	window.open("index.php?action=complaints_related_events&module=Complaints&record="+id); 
  }	
