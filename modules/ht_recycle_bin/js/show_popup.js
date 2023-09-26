function show_reocrd_detail(module, record){ 
console.log('record');
console.log(record);
$.LoadingOverlay("show");
	var quickEditDialog = new YAHOO.widget.SimpleDialog('message_dialog', {
		width: "900px",
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
	$("#popup_frame").attr("src", "index.php?module=ht_recycle_bin&action=Detailview&record="+record);
	$(function(){
    $('#popup_frame').load(function(){
		$.LoadingOverlay("hide");
    });
  
});

}

		