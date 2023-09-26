
	<!--{assign var=idname value={{sugarvar key='name' string=true}}}
	{assign var=field_file value=$idname|cat:'_file'}

<div class="{$idname}_file">
	{if isset($bean->$field_file) && !empty($bean->$field_file)}
		<b>Attachments:</b><br/>
		<div style="margin-left:20px">
			{foreach from=$bean->$field_file key="val" item="file"}
				{$file}<br/>
			{/foreach}
		</div>
	{/if}
</div>
<link rel="stylesheet" type="text/css" href="custom/include/dropper/jquery.filer.css">
<link rel="stylesheet" type="text/css" href="custom/include/dropper/jquery.filer-dragdropbox-theme.css">
<link rel="stylesheet" type="text/css" href="custom/include/dropper/roboto.css">
<script type="text/javascript" src="custom/include/dropper/jquery.filer.js"></script>
<script type="text/javascript" src="custom/include/dropper/jquery.filer.min.js"></script>
<script type="text/javascript" src="custom/include/dropper/custom.js"></script>
<input type="file" name="files[]" id="filer_input2" multiple="multiple">-->
<div class="target" ></div>
<div style="margin-top:20px;">
	<table id="imagePreview">
	{$ELEMENTS_FILES}
	</table>
</div>
{literal}
	<script>
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
	
</script>
{/literal}
