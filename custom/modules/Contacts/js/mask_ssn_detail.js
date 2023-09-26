$(document).ready(function(){
    detailhideSSN();
    $('#ssn_c').on('keyup',function(){
	var val = $(this).val();
	displayVal = val.substr(0, 11);
    
    // Inject dashes
        if (displayVal.length > 2) {
            displayVal = displayVal.slice(0, 3) + '-' + displayVal.slice(4);
        }
                       
        if (displayVal.length > 5) {
            displayVal = displayVal.slice(0, 6) + '-' + displayVal.slice(7);
        }
        $(this).val(displayVal);
    });
});

function detailhideSSN() {
    var mask = '';
    var ssn = $('#ssn_c').text();
    // Mask ssn value
    if (ssn){
    ssn.split('').forEach(function (letter, i){
	if (i < 7){
        var ssnmask = letter.replace(/[0-9]/g, '*');
	} else {
	    ssnmask = letter;
	}
        mask += ssnmask;
    });
    $('#ssn_c').text(mask);
    }
}
