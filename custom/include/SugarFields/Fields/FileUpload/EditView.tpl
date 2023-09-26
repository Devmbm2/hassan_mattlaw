<link rel="stylesheet" type="text/css" href="custom/include/dropper/jquery.filer.css">
<link rel="stylesheet" type="text/css" href="custom/include/dropper/jquery.filer-dragdropbox-theme.css">
<link rel="stylesheet" type="text/css" href="custom/include/dropper/roboto.css">
<script type="text/javascript" src="custom/include/dropper/jquery.filer.js"></script>
<script type="text/javascript" src="custom/include/dropper/jquery.filer.min.js"></script>
<script type="text/javascript" src="custom/include/dropper/custom.js"></script>
<input type="file" name="files[]" id="filer_input2" multiple="multiple">
<div class="target" ></div>
<div style="margin-top:20px;">
	<table id="imagePreview">
	{$ELEMENTS_FILES}
	</table>
</div>
{literal}
<!-- <script type="text/javascript">
	$(document).ready(function(){
		var module=document.EditView.elements['module'].value;
		var module_id=document.EditView.elements['record'].value;
		$(".target").dropper({
			action: "index.php?entryPoint=AjaxFileUpload&module="+module+"&record="+module_id,	
		}).on("fileStart.dropper", onFileStart).on("fileComplete.dropper", onFileUpload);		
	});
	function onFileStart(){
		SUGAR.ajaxUI.showLoadingPanel();
	}
	function onFileUpload(file, response, path){
		var obj = jQuery.parseJSON(path);
		documents_id.push(obj.file_id);
		documents_names.push(obj.file_name);
		documents_types.push(obj.file_type);
		$("input[name='case_attachments_file_id[]']").val(documents_id);
		$("input[name='case_attachments_file_name[]']").val(documents_names);
		$("input[name='case_attachments_file_types[]']").val(documents_types);
		SUGAR.ajaxUI.hideLoadingPanel();
		var module_id=document.EditView.elements['record'].value;
		$("#note_attachment_preview").append('<tr><td id="'+obj.file_id+'" style="padding-top: 20px;padding-right: 15px;">'+response.name+'</a><img src="themes/Suite7/images/2ndaryclose.png" style="width:12px; cursor:pointer; margin-left: 5px;" onclick="delete_attachment(\''+path+'\');"/></td></tr>');
	}
	function makeJsonObject(documents) {
	var case_attachments;
	  var json = {
		 case_attachments : documents
	  }
	  
	  return json;
	}
	function delete_attachment(path){
		var module_id=document.EditView.elements['record'].value;
		$.post('index.php?entryPoint=DeleteUploadedFile', {file: path , record : module_id});
		var x = document.getElementById(path);
		x.remove(x);
		console.log(case_attachments_file_id['value']);
		var str = case_attachments_file_id['value'];
		var res = str.split(",");
		var index = res.indexOf(path);
		if (index >= 0) {
		  res.splice( index, 1 );
		}
		case_attachments_file_id['value'] = " ";
		console.log(case_attachments_file_id['value']);
		
		case_attachments_file_id['value'] = res.toString();
		console.log(case_attachments_file_id['value']);
		console.log(res);
	}	
	
</script> -->
{/literal}
