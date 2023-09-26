$(document).ready(function(){
	$("#assigned_user_name").parent().parent().hide();
	$("#assigned_team").parent().parent().hide();
	var assigned_team_id = $("#assigned_team_id").val();
	if(assigned_team_id){
		$('#assigned_team').val(assigned_team_id);
	}
	document.querySelector('#assigned_type').addEventListener('change', function(){
	var assigned_type = $('#assigned_type').val();
			if(assigned_type == 'Individual'){
				$("#assigned_user_name").parent().parent().show();
				$("#assigned_team").parent().parent().hide();
				$("#assigned_team").val("");
				removeFromValidate('EditView', 'assigned_team');
			}
			else if(assigned_type == 'Team'){
				$("#assigned_team").parent().parent().show();
				$("#assigned_user_name").parent().parent().hide();
				$("#assigned_user_name").val("");
				$("#assigned_user_id").val("");
				addToValidate('EditView', 'assigned_team', 'enum', true, SUGAR.language.languages.AOW_WORKFLOW.LBL_ASSIGNED_TEAM);
			}
			else{
				$("#assigned_user_name").parent().parent().hide();
				$("#assigned_team").parent().parent().hide();
			}
		});
	const e = new Event("change");
	const element = document.querySelector('#assigned_type')
	element.dispatchEvent(e);
})