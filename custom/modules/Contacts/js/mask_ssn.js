$(document).ready(function(){
    hideSSN();
    $('#ssn_c').on('keyup',function(){
	var val = $(this).val();

	//var ssn = $('#ssn_c').val();
	displayVal = val.substr(0, 11);
    
    // Inject dashes
        if (displayVal.length > 2) {
            displayVal = displayVal.slice(0, 3) + '-' + displayVal.slice(4);
        }
                       
        if (displayVal.length > 5) {
            displayVal = displayVal.slice(0, 6) + '-' + displayVal.slice(7);
        }

	//if (displayVal.length < 7) {
	//var displayVal = displayVal.replace(/[0-9]/g, '*');
	//}
        $(this).val(displayVal);

	//console.log(val);
    });
});

function hideSSN() {
    var mask = '';
    var ssn = $('#ssn_c').val();
    // Mask ssn value
    if (ssn){
    ssn.split('').forEach(function (letter, i){
	if (i < 7){
        var ssnmask = letter.replace(/^\d/g, '*');
	} else {
	    ssnmask = letter;
	}
        mask += ssnmask;
    });
    //console.log(mask);
    $('#ssn_c').val(mask);
    }
}
