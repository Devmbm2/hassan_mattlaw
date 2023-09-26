function initCostStatus(){
   var  value = $('#'+formName+' #status').val();
	if(value =="Paid_by_Credit_Card" || value =="Paid_by_Check" || value =="Voided"){
		$('#'+formName+' #check_number').parent().parent().show();
	}
	else {
		/* $('div[data-label="LBL_CHECK_NUMBER"]').hide(); */
		$('#'+formName+' #check_number').parent().parent().hide();
	}
	if(value.includes("Paid")){
		var d = new Date();
		var curr_date = d.getDate();
		var curr_month = d.getMonth();
		curr_month++;   // need to add 1 – as it’s zero based !
		var curr_year = d.getFullYear();
		var formattedDate = curr_month + "/" + curr_date  + "/" + curr_year;
		if ($('#'+formName+' #paid_date').val() === ""){
		   $('#'+formName+' #paid_date').val(formattedDate);
		}
	}
	if(value == 'Voided'){
		$('#'+formName+' #total_amount').val('0.00');
	}
		
}

function initCostStatusOnChange(){
	$('#'+formName+' #status').change(function() {
		initCostStatus();
	});
}
$(document).ready(function() {
	

SUGAR.util.doWhen(
		"typeof(formName) != 'undefined' ",
		initCostStatus
);
SUGAR.util.doWhen(
		"typeof(formName) != 'undefined' ",
		initCostStatusOnChange
); 

})
