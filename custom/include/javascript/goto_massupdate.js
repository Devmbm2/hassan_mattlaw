$(document).ready(function(){
    $( "#massupdate_listview_top" ).click(function() {
		gotoMassUpdate();
	});
});


function gotoMassUpdate(){
    $('html,body').animate({
        scrollTop: $("#mass_update_div").offset().top},
        'slow');
}
