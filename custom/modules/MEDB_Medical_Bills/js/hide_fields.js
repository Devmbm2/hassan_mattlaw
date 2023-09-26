$(document).ready(function(){
	if(bean['reduction_amount']<='0.00'){
		$("[field='reduction_approved_by']").parent().html('');
	}
});
