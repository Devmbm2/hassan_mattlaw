$(document).ready(function (){
	setTimeout(function(){
		var form_data = new FormData();
		if (window.File && window.FileList && window.FileReader) {
			$("#file").on("change", function(e) {
				$("#file").hide();	
				var file = e.target.files,
				fileLength = file.length;
				var f = file[0];
				 var fileName = e.target.files[0].name;
				console.log('The file "' + fileName +  '" has been selected.');
				$("#file_name").val(fileName);
				var fileReader = new FileReader();
				fileReader.onload = (function(e) {
				  var file = e.target;
				  console.log('file');
				  console.log(file);
				  $("<span style = \"float:right;\" class=\"pip\">" +
					"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + fileName + "\"/>" +
					"<br/><span id=\"remove\" class=\"remove\">Remove image</span>" +
					"</span>").insertAfter("#file");
				  $(".remove").click(function(){
					$(this).parent(".pip").remove();
					$("#file").val('');
					$("#file_name").val('');
					$("#file").show();
					remove_file(fileName);
				  });
				  form_data.append("file[]", document.getElementById('file').files[0]);
					  $.ajax({
						url:"index.php?entryPoint=SMS_Options&action=upload",
						method:"POST",
						data: form_data,
						contentType: false,
						cache: false,
						async: true,
						processData: false,
						beforeSend:function(){
						 //$('#error_multiple_file').html('<br /><label class="text-primary">Uploading...</label>');
						},   
						success:function(data)
						{
						 //$('#error_multiple_file').html('<br /><label class="text-success">Uploaded</label>');
						
						}
					});
				});
				fileReader.readAsDataURL(f);
			});
		}else {
			alert("Your browser doesn't support to File API")
		}

	}, 100);
});

function remove_file(fileName){
	$.ajax({
		url:"index.php?entryPoint=SMS_Options&action=remove_upload&file_name="+fileName,
		method:"POST",
		contentType: false,
		cache: false,
		async: false,
		processData: false,
		beforeSend:function(){
		 //$('#error_multiple_file').html('<br /><label class="text-primary">Uploading...</label>');
		},   
		success:function(data)
		{
		 //$('#error_multiple_file').html('<br /><label class="text-success">Uploaded</label>');
		
		}
	});
}