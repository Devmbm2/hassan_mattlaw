$(document).ready(function(){
	hidePanel1();
	$( '#type' ).change(function() {
		hidePanel1();
	});
});

function hidePanel1(){
	$('#top-panel-0').parent().parent().hide();
	var type = $('#type').val();
	if (type.includes("Multiple_Claims")){
	    $('#top-panel-0').parent().parent().show();
	}	
}


