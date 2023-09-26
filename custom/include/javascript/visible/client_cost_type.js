function initCostType(){
        //value = $('#'+formName+' #type').val();
        var value = $('#'+formName+' #type').val();
        if(value =="Videographer_Charges" || value =="Court_Reporting_for_Depo")
        {
                //$('#'+formName+' #contact_id1_c').parent().parent().show();
                $('#contact_id1_c').parent().parent().show();
        }
		else if(value == 'other'){
			$('#other_status_type_explain').parent().parent().show();
		}
        else {
                //$('#'+formName+' #contact_id1_c').parent().parent().hide();
                $('#contact_id1_c').parent().parent().hide();
                $('#other_status_type_explain').parent().parent().hide();
        }
 
}
function initCostTypeOnChange(){
		$('#'+formName+' #type').change(function() {
				initCostType();
			});
}
$(document).ready(function() {
		$('#other_status_type_explain').keypress(function(e) {
			var tval = $('#other_status_type_explain').val(),
				tlength = tval.length,
				set = 60,
				remain = parseInt(set - tlength);
			$('p').text(remain);
			if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
				$('#other_status_type_explain').val((tval).substring(0, tlength - 1));
				return false;
			}
		});	
		SUGAR.util.doWhen(
		"typeof(formName) != 'undefined' ",
			initCostType
			
		);
		SUGAR.util.doWhen(
		"typeof(formName) != 'undefined' ",
			initCostTypeOnChange  
			
		);
})
