$( document ).ready(function() {
    show_hide_type_of_corporation();
	$( "#type_of_corporation" ).change(function() {
		show_hide_type_of_corporation();
	});
});

function show_hide_type_of_corporation(){
	var type_of_corporation = $('#type_of_corporation').val();
	if(type_of_corporation == 'foriegn_for_profit'){
		$('#states').parent().parent().show();
	}else{
		$('#states').parent().parent().hide();
	}
}