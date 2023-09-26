
function renderForm(jsonData)
{
	
	// alert(testid);
	$markup = $("<div/>");
        $markup.formRender({ formData: jsonData });

         // $("#htmlModal").modal("show");

        var opts = {};
        opts.indent_size = 4;
        opts.indent_char = " ";
        opts.eol = "\n";
        opts.indent_level = 0;
        opts.indent_with_tabs = false;
        opts.preserve_newlines = true;9
        opts.max_preserve_newlines = 5;
        opts.jslint_happy = false;
        opts.space_after_anon_function = false;
        opts.brace_style = "collapse";
        opts.keep_array_indentation = false;
        opts.keep_function_indentation = false;
        opts.space_before_conditional = true;
        opts.break_chained_methods = false;
        opts.eval_code = false;
        opts.unescape_strings = false;
        opts.wrap_line_length = 0;
        opts.wrap_attributes = "auto";
        opts.wrap_attributes_indent_size = 4;
        opts.end_with_newline = false;
		var htmlcode = $markup.formRender("html"), opts
		let html = `<!DOCTYPE html>
		<html>
			<head>
			 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
				<title>HTML</title>
			</head>
			<body>
			${htmlcode}
			<input type = "hidden" name="epformbuilder" id="epformbuilder" value=""/>
			</body>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		 <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
		  <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
		  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		  
		   </html>`;
		   return html;
}
function changeShape()
{
	$(document).on('change','.select2',function(){
	var type = $(this).closest("li").attr("type");
	var options_container = $(this);
	var option_value = $(this).val();
	var module = $("#related_module").val();
	if(type === 'select')
	{
		$.ajax({
            url:"index.php?module=ht_formbuilder&action=getRelatedOptions&sugar_body_only=true",   
            type: "post",
            // dataType: 'json',
            data: {module_name: module, option_value: option_value},
            success:function(result){
				var decode = JSON.parse(result);
				console.log(decode);
				if(decode!==null)
				{
					$(options_container).parent().parent().parent().find("ol").empty();
					 // var decode = JSON.parse(result);
					$.each(decode, function(k,v) {
						if(v !== "")
						{
							$(options_container).parent().parent().parent().find("ol").append('<li class="ui-sortable-handle"><input value="true" type="radio" checked="true" data-attr="selected" class="option-selected option-attr"><input value='+v+' type="text" placeholder="" data-attr="label" class="option-label option-attr"><input value='+k+' type="text" placeholder="" data-attr="value" class="option-value option-attr"><a class="remove btn formbuilder-icon-cancel" title="Remove Element"></a></li>')
						}
						else
						{
							$(options_container).parent().parent().parent().find("ol").append('<li class="ui-sortable-handle"><input value="true" type="radio" checked="true" data-attr="selected" class="option-selected option-attr"><input value="" type="text" placeholder="" data-attr="label" class="option-label option-attr"><input value="" type="text" placeholder="" data-attr="value" class="option-value option-attr"><a class="remove btn formbuilder-icon-cancel" title="Remove Element"></a></li>')
						}
					});
				}
				else
				{
					$(options_container).parent().parent().parent().find("ol").empty();
					$(options_container).parent().parent().parent().find("ol").append('<li class="ui-sortable-handle"><input value="true" type="radio" checked="true" data-attr="selected" class="option-selected option-attr"><input value="Option 1" type="text" placeholder="" data-attr="label" class="option-label option-attr"><input value="option-1" type="text" placeholder="" data-attr="value" class="option-value option-attr"><a class="remove btn formbuilder-icon-cancel" title="Remove Element"></a></li><li class="ui-sortable-handle"><input value="false" type="radio" data-attr="selected" class="option-selected option-attr"><input value="Option 2" type="text" placeholder="" data-attr="label" class="option-label option-attr"><input value="option-2" type="text" placeholder="" data-attr="value" class="option-value option-attr"><a class="remove btn formbuilder-icon-cancel" title="Remove Element"></a></li><li class="ui-sortable-handle"><input value="false" type="radio" data-attr="selected" class="option-selected option-attr"><input value="Option 3" type="text" placeholder="" data-attr="label" class="option-label option-attr"><input value="option-3" type="text" placeholder="" data-attr="value" class="option-value option-attr"><a class="remove btn formbuilder-icon-cancel" title="Remove Element"></a></li>');
				}
			}
        });
	}
});
}