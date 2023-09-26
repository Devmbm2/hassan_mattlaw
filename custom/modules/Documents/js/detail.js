function mark_done(record_id, module){
	console.log('ht test 456');
	$.ajax({
		type: "POST",
		url: 'index.php?module='+module+'&action=mark_done&record_id='+record_id,
		async:true,
		success: function(response){
			$("#outgoing_document").prop("checked", true);
			$("#done").prop("checked", true);
			var next_btn = $("button.btn-pagination[title=Next]");
			if(typeof next_btn.attr('onclick') == 'undefined' ){
				window.location.reload();
			}else{
				next_btn.trigger('click');
			}

		}
	});
}

function mark_done_notify(record_id, module){
	console.log('ht test 456');
	$.ajax({
		type: "POST",
		url: 'index.php?module='+module+'&action=mark_done&record_id='+record_id,
		async:true,
		success: function(response){
			$("#outgoing_document").prop("checked", true);
			$("#done").prop("checked", true);
			sendMessage(record_id , module);
			

		}
	});
}