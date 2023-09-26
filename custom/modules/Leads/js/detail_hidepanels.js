$(document).ready(function(){
    hidePanel();
    $('#case_type_c').attr('onchange','hidePanel();');
});
function hidePanel() {
    $('a#tab2').closest('li').hide();
    $('a#tab3').closest('li').hide();
    $('a#tab4').closest('li').hide();
    var case_type = $('#case_type_c').val();
    if(case_type.includes("Medical")){
	$('a#tab2').closest('li').show();
    }
    if(case_type.includes("Fall")){
	$('a#tab3').closest('li').show();
    }
    if(case_type.includes("Death")){
	$('a#tab4').closest('li').show();
    }
}
