var rel_module_old = ''; 
var formBuild = '';
var moduleFields;
let existingFormId = "";
$(window).load(function () {
	loadTreeData($("#related_module").val());
	rel_module_old = document.getElementById("related_module").value;
	if (rel_module_old) {
		$("#name").parent().parent().show();
	}
	else {
		$("#name").parent().parent().hide();
	}
	$("#save_and_continue").css("display", "none");
	if (rel_module_old == 'Cases' || rel_module_old == 'Leads') {
		$("#question_type").parent().parent().show();
		$("#case_type").parent().parent().show();
	}
	else {
		$("#question_type").parent().parent().hide();
		$("#case_type").parent().parent().hide();
	}
});
$(document).on('change', '#related_module', function () {
	var rel_module_new = $(this).val();
	$("#name").parent().parent().hide();
	if (rel_module_old == rel_module_new) {
		$(".form-builder").remove();
		loadTreeData($(this).val());
	}
	else {
		$(".form-builder").remove();
		loadTreeDataNew($("#related_module").val());
	}
	if (rel_module_new == 'Cases' || rel_module_new == 'Leads') {
		$("#question_type").parent().parent().show();
		$("#case_type").parent().parent().show();
		$("#name").parent().parent().hide();
	}
	else {
		$("#question_type").parent().parent().hide();
		$("#case_type").parent().parent().hide();
		$("#name").parent().parent().show();
	}
});
function loadTreeData(module, node){
	var _node = node;
	$.getJSON('index.php',
			{
				'module' : 'ht_formbuilder',
				'action' : 'getFieldData',
				'ht_module' : module,
				'view' : 'JSON'
			},
			function(relData){
				moduleFields = relData;
				var emptyData = "";
				moduleFields.enum[emptyData] = "--None--";
				moduleFields.varchar[emptyData] = "--None--";
				moduleFields.text[emptyData] = "--None--";
				moduleFields.datetime[emptyData] = "--None--";
				moduleFields.bool[emptyData] = "--None--";
				console.log(moduleFields);
				initFormBuilder();
			}
	);
}

function initFormBuilder(){
	
	$("div[data-label='LBL_DESCRIPTION']").html('');
	$("div[field='description']").attr("class", "col-xs-12 col-sm-12 edit-view-field ");
	const fbTemplate = document.getElementById('build-wrap');
	// New attribute for specified fields 'fields' below
	var textAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields.varchar,
			},
		};
	var selectAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields.enum,
			},
		};	
	var textareaAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields.text,
			},
		};	
	var dateAttributes = {
		shape: {
			label: 'Related Field',
			'class': 'select2',
			options: moduleFields.datetime,
		},
	};
	var boolAttributes = {
		shape: {
			label: 'Related Field',
			'class': 'select2',
			options: moduleFields.bool,
		},
	};
	var userAttrs = {};
	var fields = ["autocomplete", "checkbox-group", "date", "number", "radio-group", "select", "text", "textarea"];
		userAttrs["text"] = textAttributes;
		userAttrs["select"] = selectAttributes;
		userAttrs["textarea"] = textareaAttributes;
		userAttrs["date"] = dateAttributes;
		userAttrs["radio-group"] = boolAttributes;
	
	var options = {
		dataType: 'json',
		formData: $("#description").html(),
		typeUserAttrs: userAttrs,
		onOpenFieldEdit: function(editPanel) {
			$(".select2").select2();
		},
		
		disabledActionButtons: ['data','clear','save'],
	};
	formBuild =  $(fbTemplate).formBuilder(options);
	changeShape();
}

function loadTreeDataNew(module, node){
	var _node = node;
	$.getJSON('index.php',
			{
				'module' : 'ht_formbuilder',
				'action' : 'getFieldData',
				'ht_module' : module,
				'view' : 'JSON'
			},
			function(relData){
				moduleFields = relData;
				var emptyData = "";
				moduleFields.enum[emptyData] = "--None--";
				moduleFields.varchar[emptyData] = "--None--";
				moduleFields.text[emptyData] = "--None--";
				moduleFields.datetime[emptyData] = "--None--";
				moduleFields.bool[emptyData] = "--None--";
				console.log(moduleFields);
				initFormBuilderNew();
				
			}
	);
}

function initFormBuilderNew(){
	
	$("div[data-label='LBL_DESCRIPTION']").html('');
	$("div[field='description']").attr("class", "col-xs-12 col-sm-12 edit-view-field ");
	const fbTemplate = document.getElementById('build-wrap');
	// New attribute for specified fields 'fields' below
	var textAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields.varchar,
			},
		};
	var selectAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields.enum,
			},
		};	
	var textareaAttributes = {
		shape: {
			label: 'Related Field',
			'class': 'select2',
			options: moduleFields.text,
		},
	};	
	var dateAttributes = {
		shape: {
			label: 'Related Field',
			'class': 'select2',
			options: moduleFields.datetime,
		},
	};	
	var boolAttributes = {
		shape: {
			label: 'Related Field',
			'class': 'select2',
			options: moduleFields.bool,
		},
	};
	var userAttrs = {};
	var fields = ["autocomplete", "checkbox-group", "date", "number", "radio-group", "select", "text", "textarea"];
		userAttrs["text"] = textAttributes;
		userAttrs["select"] = selectAttributes;
		userAttrs["textarea"] = textareaAttributes;
		userAttrs["date"] = dateAttributes;
		userAttrs["radio-group"] = boolAttributes;
	
	var options = {
	  onAddField: function(fieldId) {
		<!-- updateFields(); -->
		
	  },
	  // onAddOption: (optionTemplate, optionIndex) => {
  // },
	  disabledActionButtons: ['data','clear','save'],
	  typeUserAttrs: userAttrs,
	  onOpenFieldEdit: function(editPanel) {
        $(".select2").select2();
      },
	};
  formBuild =  $(fbTemplate).formBuilder(options);
  changeShape();
}


function getFields(){
	return moduleFields
};


jQuery($ => {

});
function updateFields(){
		
        $markup = $("<div/>");
        $markup.formRender({ dataType:'xml',
			formData: formBuild.actions.getData('xml') });

        <!-- $("#outDiv").show(); -->

        var opts = {};
        opts.indent_size = 4;
        opts.indent_char = " ";
        opts.eol = "\n";
        opts.indent_level = 0;
        opts.indent_with_tabs = false;
        opts.preserve_newlines = true;
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
				console.log('Test');
        $("#EditView #description").val(html_beautify($markup.formRender("html"), opts));
		return;
}

$(document).on("click",".savebtn",function(){
	var hiddenfieldhtml = `<input type="hidden" class="randomID" name="ruuid" id="ruuid" value=""/>`
	$("form#EditView").append(hiddenfieldhtml);
	// document.getElementById("ruuid").value = createGuidLocations();
	if (existingFormId.length > 0) {
		document.getElementById("ruuid").value = existingFormId;
	} else {
		document.getElementById("ruuid").value = createGuidLocations();
	}
	$("form#EditView #description").html(formBuild.formData);
	var _form = document.getElementById('EditView'); 
	_form.action.value='Save';
	if(check_form('EditView'))
	SUGAR.ajaxUI.submitForm(_form);
	return false;
  //});
});

//});
$(document).on("click",".clearbtn",function(){
	formBuild.actions.clearFields();
});
$(document).on("click",".showhtmlbtn",function(e){
	//formBuild.actions.showData();
	e.preventDefault();
		var modalhtml = `
<style>
.w3-container,.w3-panel{padding:0.01em 16px;background:black;}.w3-panel{margin-top:16px;margin-bottom:16px}
.w3-modal{z-index:3;display:none;padding-top:100px;position:fixed;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.4)}
.w3-modal-content{margin:auto;background-color:#fff;position:relative;padding:0;outline:0;width:600px}
.w3-btn,.w3-button{border:none;display:inline-block;padding:8px 16px;vertical-align:middle;overflow:hidden;text-decoration:none;color:#fff;background-color:inherit;text-align:center;cursor:pointer;white-space:nowrap}
.w3-display-topright{position:absolute;right:0;top:0}
.w3-button:hover{color:#000!important;background-color:#ccc!important}
</style>
<div class="w3-container">

  <div id="showhtml" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('showhtml').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <textarea style="height:500px;background:black;color:#fff;" class="form-control" id="htmlmodaldiv" name="htmlinnerdiv"></textarea>
      </div>
    </div>
  </div>
</div>`;
	$("body").append(modalhtml);
        var form_rendering_json = formBuild.actions.getData('json');
		var html = renderForm(form_rendering_json);
        $("#htmlmodaldiv").text(html);
		document.getElementById('showhtml').style.display='block'
		
});

$(document).on("click",".downloadhtmlbtn",function(){
	var testid = $("input[name='record']").val();
	var column_size = $("#column_size").val();
	// alert(column_size);
	var site_url = window.location.protocol+window.location.hostname+window.location.pathname;
	$markup = $("<div/>");
	$markup.formRender({formData: formBuild.actions.getData('json') });	
	let description_html_value = $markup.formRender("html");
  var filename = "code.html";
  let html = `<!DOCTYPE html>
<html>
    <head>
	 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <title>HTML</title>
		<style>
		input.formEntryPointButton
		{
			margin:auto;
			display:block;
		}
		</style>
    </head>
    <body>
	<form action="${site_url}?entryPoint=FormDataEntryPoint&id=${testid}" name="HtmlForm" id="htform" method="post">
	${description_html_value}
	<input type = "hidden" name="epformbuilder" id="epformbuilder" value="${testid}"/>
	<input class="formEntryPointButton" type = "submit" name ="htformsubmit" value="Submit"/>
	</form>
    </body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
 <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
  <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
	$(".rendered-form").addClass("container");
	if("${column_size}")
	{
		$(".form-group").addClass("${column_size}");
	}
	else
	{
	$(".form-group").addClass("col-lg-6");
	}
  </script>
  
   </html>`;
   
  download(filename, html);
});
function download(filename, text) {
	
    var element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);

    element.style.display = 'none';
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
}
function createGuidLocations(){  
   function S4() {  
	  return (((1+Math.random())*0x10000)|0).toString(16).substring(1);  
   }  
   return (S4() + S4() + "-" + S4() + "-4" + S4().substr(0,3) + "-" + S4() + "-" + S4() + S4() + S4()).toLowerCase();  
}
$(document).on('change', '#case_type', function () {
	$("#name").parent().parent().show();
	rel_module_old = document.getElementById("related_module").value;
	var case_type = $(this).val();
	// alert(case_type);
	if (case_type !== "") {
		$.ajax({
			url: "index.php?module=ht_formbuilder&action=getIntakeForum&sugar_body_only=true",
			type: "post",
			// dataType: 'json',
			data: { case_type: case_type, rel_module_old: rel_module_old },
			success: function (result) {

				var decode = JSON.parse(result);
				if (decode == false) {
					$("#name").val('');
					$(".form-builder").remove();
					loadTreeDataNew($("#related_module").val());
				}
				else {
					existingFormId = decode.id;
					$(".form-builder").remove();
					$("form#EditView #description").html(decode.description)
					$("#name").val(decode.name);
					$("#column_size").val(decode.column_size);
					loadTreeData(decode.related_module);
				}
			}
		});
	}
	else {
		$("#intakeformdiv").empty();
	}
});
	  


	  
