$(document).ready(function() {
	showhideNegFields();
	updateRelatedComplaintAssignedTo();
	YAHOO.util.Event.addListener(
	"neg_negotiations_complaintscomplaints_ida",
	"change",
	  function() {
		$("#btn_neg_negotiations_complaints_name").attr(
		  "onclick",
		  );
		   updateRelatedComplaintAssignedTo();
		   showhideNegFields();
	  }
	);
	$( "#btn_clr_neg_negotiations_complaints_name" ).click(function() {
	  updateRelatedComplaintAssignedToClear();
	});
});
function openComplaintPopup(){
    if ($("#neg_negotiations_complaintscomplaints_ida")) {
		open_popup(
			"Complaints", 
			600, 
			400, 
			"", 
			true, 
			false, 
			{"call_back_function":"set_return",
			"form_name":"EditView",
			"field_to_name_array":{"id":"neg_negotiations_complaintscomplaints_ida",
								   "name":"neg_negotiations_complaints_name"}}, 
			"single", 
			true
		);
		
    }
}
function showhideNegFields(){
	var  record_id = $("#neg_negotiations_complaintscomplaints_ida").val();
	if(record_id != ''){
		$.ajax({
		   type: "POST",
		   url: 'index.php?module=Complaints&action=get_related_complaint_type&record='+record_id,
		   async:true,
		   data: 'sugar_body_only=1',
		   success: function(response){
				 complainttype = response;
				if(complainttype.indexOf("Companion") != -1)
				{
				  $('div[field="companion"]').parent().show();
				}
				else {
				 $('div[field="companion"]').parent().hide();
				}
			}
		});
	}else{
		$('div[field="companion"]').parent().hide();
	}
	/* if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
		set_return(collection);
	}	 */

}

function updateRelatedComplaintAssignedToClear(){
	$('#user_id_c').val('');
	$('#complaint_assigned_to_c').val('');
	$('div[field="companion"]').parent().hide();
}
function updateRelatedComplaintAssignedTo(collection){
	var related_id = $("#neg_negotiations_complaintscomplaints_ida").val();
	if(related_id != ''){
		$.ajax({
			type: 'POST',
			url: 'index.php?module=NEG_Negotiations&action=getRelatedComplaintAssignedTo&related_id='+related_id,
			async: false,
			success: function(response){
				var obj = JSON.parse(response);
				$('#user_id_c').val(obj.assigned_user_id);
				$('#complaint_assigned_to_c').val(obj.assigned_user_name);
			}
		});
	}
	/* if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
		set_return(collection);
	} */
}