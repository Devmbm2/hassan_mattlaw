$(document).ready(function(){
	if(bean['claim_result']!='Filed_Suit'){
		$("[field='lit_spot']").parent().html('');
	}
	if(bean['claim_result']!='PreSuit_Settlement' && bean['claim_result']!='Lit_Settlement' && bean['claim_result']!='Verdict'){
		$("[field='amount_recovered_c']").parent().html('');
		$('#firm_fee').parent().parent().html('');
	}
	if(bean['case_type_c']!='Multiple_Claims_in_One'){
		$("[field='date_of_incident']").parent().html('');
	}
});
