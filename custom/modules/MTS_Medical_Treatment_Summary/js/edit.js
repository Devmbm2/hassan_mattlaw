 $(document).ready(function(){
	show_hide_fields();
	var summary_title_list = $('#summary_title_list').val();
	if(summary_title_list == 'OTHER'){
		$('#document_name').parent().parent().show();
	}else{
		$('#document_name').parent().parent().hide();
	}
});
function show_hide_fields(){
	$('#document_name').parent().parent().hide();
	$("#summary_title_list").change(function(){
		if(this.value == 'OTHER'){
			$('#document_name').parent().parent().show();
		}else{
			$('#document_name').parent().parent().hide();
		}
	});
}