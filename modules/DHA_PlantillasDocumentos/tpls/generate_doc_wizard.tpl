<script type="text/javascript" src="modules/DHA_PlantillasDocumentos/librerias/jquery.steps.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
<script type="text/javascript" src="modules/DHA_PlantillasDocumentos/librerias/ckeditor5/ckeditor.js"></script>
<link rel="stylesheet" href="custom/include/select2/css/select2.css">
<script type="text/javascript" src="custom/include/select2/js/select2.js"></script>
<script type="text/javascript" src="{sugar_getjspath file='modules/DHA_PlantillasDocumentos/MassGenerateDocument.js'}"></script>
<script type="text/javascript" src="{sugar_getjspath file='custom/include/javascript/loadingoverlay.min.js'}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/split.js/1.2.0/split.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<link href="modules/DHA_PlantillasDocumentos/librerias/jquery.steps.css" rel="stylesheet" type="text/css"/>
<link href="modules/DHA_PlantillasDocumentos/librerias/doc_template_editor.css" rel="stylesheet" type="text/css"/>
<div id="gen_doc_wizard">
    <h3>Generate Template</h3>
    <section>
	<div class="gen-temp-content">
		<b>Select Template</b>: {html_options name=templates_list id=templates_list options=$templates_list }
		<div id="variables" class="split split-horizontal split-content">
		<div>
			<input type="text" id="search_sec" onkeyup="searchSections()" placeholder="Search for Sections.." title="Type in a Text">
		</div>
			<ul id="variables_list">
			  
			</ul>
			
		</div>
		
		<div id="compose_temp" class="split split-horizontal split-content">
			<main>
				<div class="centered">
					<div class="document-editor">
						<div class="toolbar-container"></div>
						<div class="content-container">
							<div id="template_editor">
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>

        
    </section>
    <h3>Select Records</h3>
    <section>
		<div class="select-records-content">
		 <form name="document_generation_form" id="document_generation_form" method="POST" enctype="multipart/form-data">
		 <input type='hidden' name='moduloplantilladocumento' id='MGD_moduloplantilladocumento' value='Cases'>
			<input type='hidden' name='module' id='MGD_module' value='DHA_PlantillasDocumentos'>
			<input type='hidden' name='action' id='MGD_action' value='getWizardSelectionPanel'>
			<input type='hidden' name='mode' id='MGD_mode' value=''>
			<input type='hidden' name='enPDF' id='MGD_enPDF' value='false'>
			<input type='hidden' name='from_view' value=''>
			<input type='hidden' name='related_selected' value=''>
			<input type='hidden' name='AttachGeneratedDocumentToRecord' value=''>
			<input type="hidden" name="FROM_MODULE" id="MGD_FROM_MODULE" value="Cases">
			<div id="myModal">
				
				<div class="row" style="margin-right: 0px; margin-left: inherit;">

					<div class="col-xs-4 col4 select_area" id="MGD_uid_section" style="display: none;">
						<div class="title">Select Record</div>
						<select name='uid' id='MGD_uid'>
						</select>
					</div>
				</div>
				<br>
				<br>
				<div class="row fields" style="margin-right: 0px; margin-left: inherit;" id="related_selection_panel">
					<div class="row fields" style="margin-right: 0px; margin-left: inherit;" id="related_selection_panel">
					</div>

				</div>
				<div style="display:none;"><textarea id="template_html" name="template_html" rows="6" cols="80" title="" tabindex="0" style="width:100%;" spellcheck="false" ></textarea></div>
		</form>	
		</div>
    </section>
    <h3>Preview</h3>
    <section>
        <div class="populate-variable-content">
			 <div>
				<button class="button primary" id="generate_pdf" onclick="javascript:generatePDF();" style="color: #0e0e0e;">Generate PDF</button>
			<!-- <div>
				<input type="text" id="search_var" onkeyup="searchVariables()" placeholder="Search for Variables.." title="Type in a Text">
			</div>
				<ul id="variables_values">
				  
				</ul> -->
				
			</div>
			
			<div id="result_preview" class="split split-horizontal split-content">
				<main>
					<div class="centered">
						<div class="pop-var-doc-edit">
							<div class="pop-var-toolbar-container"></div>
							<div class="pop-var-content-container">
								<div id="result_preview_editor">
								</div>
							</div>
						</div>
					</div>
				</main>
			</div>
		</div>
    </section>
</div>
{literal}
<script>
$( document ).ready(function() {
	window.template_name = 'document-file';
    $("#gen_doc_wizard").steps({
		headerTag: "h3",
		bodyTag: "section",
		transitionEffect: "slideLeft",
		autoFocus: true,
		onStepChanging: function (event, currentIndex, newIndex) {
			if(currentIndex == 0){
				storeTemplate();
			} 
			else if(currentIndex == 1){
				generatePreview();
			}
			<!-- if () { -->
				<!-- // alert and stop when some validation failed -->
				<!-- alert("Error"); -->
				<!-- return false; -->
			<!-- } else { -->
				<!-- // proceed -->
				return true;
			<!-- } -->
		}
		
	});
	Split(['#variables', '#compose_temp'], {
        gutterSize: 8,
        cursor: 'col-resize',
        sizes: [25, 75]
    });
	
	
	DecoupledEditor
	.create( document.querySelector( '#template_editor' ), {
		//toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
	} )
	.then( editor => {
		const toolbarContainer = document.querySelector( '.document-editor .toolbar-container' );

		toolbarContainer.prepend( editor.ui.view.toolbar.element );

		window.editor = editor;
	} )
	.catch( err => {
		console.error( err.stack );
	} );
	
	designPopulateVariable();
	getTemplatesList();
	
	$("select#templates_list").on("change", function() {
		var selec_value = $(this).val();
		$.post('index.php', {module: 'ht_doc_template_editor', action: 'get_data', record: selec_value}, function(content) {
			editor.setData( content );			
		});
		
	});
	getRecordsList();
	
	{/literal}
	{if !empty($smarty.request.record)}
	$("select#templates_list").val('{$smarty.request.record}').trigger('change');
	{/if}
	{literal}
	
	
});


function designPopulateVariable(){
	<!-- Split(['#populate_variables', '#result_preview'], { -->
        <!-- gutterSize: 8, -->
        <!-- cursor: 'col-resize', -->
        <!-- sizes: [25, 75] -->
    <!-- }); -->
	
	DecoupledEditor
	.create( document.querySelector( '#result_preview_editor' ), {
		//toolbar: [ 'sourcedialog']
	} )
	.then( preview_editor => {
		const toolbarContainer = document.querySelector( '.pop-var-doc-edit .pop-var-toolbar-container' );

		toolbarContainer.prepend( preview_editor.ui.view.toolbar.element );

		window.preview_editor = preview_editor;
	} )
	.catch( err => {
		console.error( err.stack );
	} );
}
function bindVariableClick(){
	$("#variables_list a").on("click", function() {
		var value = $(this).data('section');
		console.log(value);
		editor.model.change( writer => {
			writer.insertText( value, editor.model.document.selection.getFirstPosition() );
		} );
	});
}
function storeTemplate(){


	var temp_option = $("#templates_list option:selected");
	$.confirm({
		title: 'Save Template!',
		content: '' +
		'<form action="index.php" id="template_form">' +
		'<div class="form-group">' +
		'<label>Enter Template Name</label>' +
		'<input type="hidden" name="action" value="Save"/>' +
		'<input type="hidden" name="module" value="ht_doc_template_editor"/>' +
		'<input type="hidden" name="record" id="template_record" value="'+temp_option.val()+'"/>' +
		'<input type="text" name="name" id="template_name" placeholder="Template Name" value="'+temp_option.text()+'" class="name form-control" required />' +
		'<div style="display:none;"><textarea id="description" name="description" rows="6" cols="80" title="" tabindex="0" style="width:100%;" spellcheck="false" ></textarea></div>'+
		'</div>' +
		'</form>',
		buttons: {
			formSubmit: {
				text: 'Save',
				btnClass: 'btn-blue',
				action: function () {
					var name = this.$content.find('.name').val();
					if(!name){
						$.alert('provide a valid name');
						return false;
					}
					$.alert('Template name is ' + name);
					window.template_name = name;
					this.$content.find('#description').val(editor.getData());
					$.post('index.php', $('#template_form').serialize())
					<!-- $.ajax({  -->
					  <!-- type : 'GET',  -->
					  <!-- url : 'index.php?module=ht_doc_template_editor&action=Save&sugar_body_only=true',  -->
					  <!-- async : false,  -->
					  <!-- data : {description: , name: }, -->
					  <!-- beforeSend : function(){/*loading*/}, -->
					  <!-- dataType : 'json',  -->
					  <!-- success : function(result){ -->
					   
					  <!-- } -->
					<!-- }); -->
					<!-- $('#template_form').ajaxForm({url: 'index.php', type: 'post'}); -->
					<!-- console.log(this.$content.find('form').html()); -->
					<!-- ; -->
				}
			},
			cancel: function () {
				//close
			},
		},
		onContentReady: function () {
			// bind to events
			var jc = this;
			this.$content.find('form').on('submit', function (e) {
				console.log(e);
				<!-- var temp_name =  -->
				<!-- var temp_desc =  -->
				
				e.preventDefault();
				jc.$$formSubmit.trigger('click'); // reference the button and click it
			});
		}
	});
}
function getTemplatesList(){
	
	$.ajax({ 
	  type : 'GET', 
	  url : 'index.php?module=DHA_PlantillasDocumentos&action=getTempSectionList&sugar_body_only=true', 
	  async : false, 
	  beforeSend : function(){/*loading*/},
	  dataType : 'json', 
	  success : function(result){
	   var buffer="";
	   $('#variables_list').html(buffer);
		$.each(result, function(index, val){ 

			if(val['Matts description of this block of text'].length && val['Text from the template']){
				var item = val['Matts description of this block of text']; 
				buffer =" <li><a href='javascript:' data-section='"+val['Text from the template']+"'>"+item+"</a></li>"; 
			} 
			$('#variables_list').append(buffer);
		});
		
		bindVariableClick();
	  }
	 });
}
function searchSections() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("variables_list");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
function  getRecordsList() {
	var module_sugar_grp1 = 'Cases';
	var where = '';
	if (typeof(module_sugar_grp1) !== 'undefined') {
		where += "&target_module=" + module_sugar_grp1;
		where += "&module_records_list=" + module_sugar_grp1;
	}
	$.ajax({
		url: "index.php?module=DHA_PlantillasDocumentos&action=getTemplatesList&sugar_body_only=true" + where,
		dataType: 'JSON',
		async: true,
		success: function(result) {
			$.LoadingOverlay("hide");
			$('#MGD_uid').html('');
			if (typeof(result.records_list) !== 'undefined') {
				var records_list = JSON.parse(result.records_list);
				generateWizardDropDown('#MGD_uid', records_list, 'Select Records');
			}
		},
		error: function(error) {
			$.LoadingOverlay("hide");
		}
	});
}
function generateWizardDropDown(selector,options,title = false){
	$(selector).select2().off('change');
	$(selector).select2({
		data: options,
		width: '100%',
		dropdownParent: $('#myModal')
	})/* ;$(selector).select2('open') */.on(
		'change', function (evt) {
			var selected_value = $(evt.currentTarget).val();
			var element_id =  $(evt.currentTarget).attr('id')
			var selected_data =  $(evt.currentTarget).select2('data');
			getWizardPanelList(element_id,selected_data[0]);	
	});
	/*$('.select_area').on('mouseover', function (e) {
		var sub_select = $(e.currentTarget).find('select').attr('id');
		if(sub_select){
		//	$('#'+sub_select).select2('open');
		}
	}) .on('mouseout', function (evt) {
			var target = $(evt.currentTarget);
			var divPosition =	target.offset();
			var right = divPosition.left + target.width();
		if ( (evt.pageX >= right)  ||  (evt.pageY <= divPosition.top) || (evt.pageX <= divPosition.left)) {
			
			var sub_select = target.find('select').attr('id');
			if(sub_select){
				$('#'+sub_select).select2('close');
			}
		}	
			
	}); */
	if(title)
		$(selector+"_section .title").text(title);
	$(selector+"_section").hide().show("slide", { direction: "right" }, 1000);
}

function getWizardPanelList (){
	var MGD_uid =	$("#MGD_uid").val();
	if(MGD_uid){
		 $("#document_generation_form #MGD_mode").val('selected');
		 $("#document_generation_form #MGD_action").val('wizardGenDoc');
			$("#document_generation_form #related_selected").val('');
		 $("#document_generation_form #template_html").val(editor.getData());
		 $("#document_generation_form [name='from_view']").val('');
		 $.LoadingOverlay("show", {
		   zIndex          : 99999999   
		});
		 $.ajax({
			url: "index.php", 
			type: "POST",
			async: true,
				dataType:'html',
				data : $('#document_generation_form').serialize(),
				success: function(result){
					var obj = JSON.parse(result);
					generating_relationship_dropdowns(obj);	
					$.LoadingOverlay("hide");
				},
				error: function (error) {
					console.log(error);
					$.LoadingOverlay("hide");
				}
			});
	}
}
function generatePreview (){
	var MGD_uid =	$("#MGD_uid").val();
	if(MGD_uid){
		 $("#document_generation_form #MGD_mode").val('selected');
		 $("#document_generation_form #MGD_action").val('wizardGenDoc');
		 		  var records_list = '';
			$('.row.fields').children().each(function(i, obj) {
				var sel = $(obj).find('select');
				var sel_val = $(sel).val();
				if(sel_val != null){
					records_list += sel_val.join()+ ',';	
				}
				 
				
			});
		$("#document_generation_form [name='related_selected']").val(records_list);
		 
		 $("#document_generation_form #template_html").val(editor.getData());
		 $("#document_generation_form [name='from_view']").val('');
		 $.LoadingOverlay("show", {
		   zIndex          : 99999999   
		});
		 $.ajax({
			url: "index.php?preview=true", 
			type: "POST",
			async: true,
				dataType:'html',
				data : $('#document_generation_form').serialize(),
				success: function(content){
					preview_editor.setData( content );	
					$.LoadingOverlay("hide");
				},
				error: function (error) {
					console.log(error);
					$.LoadingOverlay("hide");
				}
			});
	}
}

function generatePDF (){
	var doc = new jsPDF();
	var specialElementHandlers = {
		'#copyright_data': function (element, renderer) {
			return true;
		}
	};

    doc.fromHTML($('#result_preview_editor').html(), 15, 15, {
        'width': 170,
            'elementHandlers': specialElementHandlers
    });
    doc.save(window.template_name+'.pdf');
}
</script>
<style>
    .select2-results__options {
        height: 500px !important;
        max-height: 500px !important;
    }
</style>
{/literal}
