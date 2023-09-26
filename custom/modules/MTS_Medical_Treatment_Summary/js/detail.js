 $(document).ready(function(){
	show_hide_fields();
});
function show_hide_fields(){
	$('#document_name').parent().parent().hide();
	if($("#summary_title_list").val() == 'OTHER'){
		$('#document_name').parent().parent().show();
	}
}