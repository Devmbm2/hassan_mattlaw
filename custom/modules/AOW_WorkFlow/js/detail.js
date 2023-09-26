$(document).ready(function(){
	var assigned_team_id = $("#assigned_team_id").val();
	if(assigned_team_id){
		$('#assigned_team').val(assigned_team_id);
	}
})