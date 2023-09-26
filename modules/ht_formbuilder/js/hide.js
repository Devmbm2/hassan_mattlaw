
$(window).load(function() {
loadTreeData($("#related_module").val());
rel_module_old = document.getElementById("related_module").value;
if(rel_module_old == 'Cases')
	{
		$("#case_type").parent().parent().show();
	}
	else
	{
		$("#case_type").parent().parent().hide();
	}
});
function loadTreeData(module, node){
	var _node = node;
	$.getJSON('index.php',
			{
				'module' : 'AOR_Reports',
				'action' : 'getModuleFields',
				'aor_module' : module,
				'view' : 'JSON'
			},
			function(relData){
				moduleFields = relData;
				initFormBuilder();
			}
	);
}

function initFormBuilder(){
	
	$("div[data-label='LBL_DESCRIPTION']").html('');
	$("div[field='description']").attr("class", "col-xs-12 col-sm-12 edit-view-field ");
	const fbTemplate = document.getElementById('build-wrap');
	// New attribute for specified fields 'fields' below
	var newAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields,
			},
		};
	/* var userAttrs = {};
	var fields = ["autocomplete", "checkbox-group", "date", "number", "radio-group", "select", "text", "textarea"];
	fields.forEach(function (item, index) {
		userAttrs[item] = newAttributes;
	}); */
	var options = {
		dataType: 'json',
      formData: $("#description").html(),
	  disabledActionButtons: ['data','clear','save'],
	   disableFields: ["autocomplete", "checkbox-group", "date", "number", "radio-group", "select", "text", "textarea", "button","file","header","hidden","paragraph"],
	    disabledFieldButtons: {
	    text: ['remove','edit','copy'], 
	    select: ['remove','edit','copy'],
	    textarea: ['remove','edit','copy'],
	    autocomplete: ['remove','edit','copy'], 
	    'checkbox-group': ['remove','edit','copy'],
	    date: ['remove','edit','copy'],
	    number: ['remove','edit','copy'], 
	    'radio-group': ['remove','edit','copy'],
	    button: ['remove','edit','copy'],
	    file: ['remove','edit','copy'], 
	    header: ['remove','edit','copy'],
	    hidden: ['remove','edit','copy'],
	    paragraph: ['remove','edit','copy'],
	  },
    };
	console.log(options);
  formBuild =  $(fbTemplate).formBuilder(options);
 /*  var formData = '[{"type":"text","label":"Full Name","subtype":"text","className":"form-control","name":"text-1476748004559"},{"type":"select","label":"Occupation","className":"form-control","name":"select-1476748006618","values":[{"label":"Street Sweeper","value":"option-1","selected":true},{"label":"Moth Man","value":"option-2"},{"label":"Chemist","value":"option-3"}]},{"type":"textarea","label":"Short Bio","rows":"5","className":"form-control","name":"textarea-1476748007461"}]';
  formBuild.actions.setData(formData); */
}

