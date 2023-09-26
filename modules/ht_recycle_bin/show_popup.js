function show_reocrd_detail(module, record){

	$.ajax({
		url: 'index.php?module=ht_recycle_bin&action=DetailView&record='+record,
		type: 'POST',				
		async: true,			
		success : function (result){
			/* YAHOO.SUGAR.MessageBox.show({msg: result, width:'700px',title: 'Recycle Bin'}); */
			document.getElementById("message_dialog").innerHTML =result;
			var quickEditDialog = new YAHOO.widget.SimpleDialog('message_dialog', {
				width: "800px",
				height: "1000px",
				effect:{
					effect: YAHOO.widget.ContainerEffect.FADE,
					duration: 0.25
				},
				fixedcenter: true,
				modal: true,
				visible: false,
				close : true,
				draggable : true,
				zIndex:100
				 
			});
			
			quickEditDialog.render(document.body);	
			quickEditDialog.setHeader("Recycle Bin")
			$(".container-close").click(function(){
				quickEditDialog.hide();	
			});
			quickEditDialog.show();
		}
	});
}