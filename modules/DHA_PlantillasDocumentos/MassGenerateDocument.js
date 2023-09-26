/* $( document ).ready(function() {
    $("input").change(function(){
		alert("The text has been changed.");
	});
}); */
function ht_showMassGeneratePresentationForm(){
	document.getElementById('massGeneratePresentation_form').style.display = '';
	
}
function ht_showMassGenerateDocumentForm(type = false){
		if($("#myModal").length > 0){
		
			$("#myModal").modal({
    		backdrop: 'static',
    		keyboard: false,
		});
			if(type == 'all' || type == 'favorites' || type == 'role'){
				$(".select_area").hide();
				$('.select_area').find('option').remove().end();
				getAllTemplateList(type);
			}else{
				clearDropdownFields();
				generateDropDown('#document_categories',category_list);
				//$('.select_area');
				$('#document_categories').change(function(){
					$(".row.fields").empty();
					$("#document_generation_form_submission_btn").removeAttr("disabled");
				});
			}
			
		}else{
			document.getElementById('massgeneratedocument_form').style.display = '';
		}
   }
   
function generateDropDown(selector,options,title = false){
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
			console.log(selected_value);
			console.log(element_id);
			console.log(selected_data);
			updateDependent(element_id,selected_data[0]);	
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
function generateMultiSelectDropDown(selector, options, title = false){
	//$(selector).select2().off('change');
	if(selector == '#contacts_select'){
		var plantilladocumento_id =	$("#document_list").val();
		getContactRoleList(plantilladocumento_id);
			$(selector).select2({
			data: options,
			width: '100%',
			dropdownParent: $('#myModal')
			})/* ;$(selector).select2('open') */.on(
			'change', function (evt) {
			var selected_value = $(evt.currentTarget).val();
			var element_id =  $(evt.currentTarget).attr('id')
			var selected_data =  $(evt.currentTarget).select2('data');
			updateDependent(element_id,selected_data[0]);	
			});		
	}
	else{
	$(selector).select2({
		data: options,
		width: '100%',
		dropdownParent: $('#myModal')
	})/* ;$(selector).select2('open') */.on(
		'change', function (evt) {
			var selected_value = $(evt.currentTarget).val();
			var element_id =  $(evt.currentTarget).attr('id')
			var selected_data =  $(evt.currentTarget).select2('data');
			updateDependent(element_id,selected_data[0]);	
	});
}
	if(title)
		//$(selector+"_selection .title1").text(title);
		$(selector+"_selection .title1").html(title).text();
	$(selector+"_selection").hide().show("slide", { direction: "right" }, 1000);
	$(document).on('change','#contactrole_list',function(){
			var role = $(this).val();
			if(role == ''){
			$(selector).select2({
			data: options,
			width: '100%',
			dropdownParent: $('#myModal')
			})/* ;$(selector).select2('open') */.on(
			'change', function (evt) {
			var selected_value = $(evt.currentTarget).val();
			var element_id =  $(evt.currentTarget).attr('id')
			var selected_data =  $(evt.currentTarget).select2('data');
			updateDependent(element_id,selected_data[0]);	
			});	
		}
		else{
			getRelatedContactsByRole(role);
		}
		
	});
}
 
function getRelatedContactsByRole(role_id){
	var case_id= document.getElementsByName("record")[0].value;
	if(role_id && case_id){
$.ajax({
		url: 'index.php?module=DHA_PlantillasDocumentos&action=getRelatedContactRoles&record='+role_id+'&case_id='+case_id,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){
			
				result = JSON.parse(result);
				console.log(result);
				$( document ).ready(function() {
				$("#contacts_select").empty();
				$("#contacts_select").select2({
		data: result.contact_list,
		width: '100%',
		dropdownParent: $('#myModal')
	})/* ;$(selector).select2('open') */.on(
		'change', function (evt) {
			var selected_value = $(evt.currentTarget).val();
			var element_id =  $(evt.currentTarget).attr('id')
			var selected_data =  $(evt.currentTarget).select2('data');
			updateDependent(element_id,selected_data[0]);	
	});
	
				});
				
		}
	});
}
}
function sendAjaxRequest(data){
	
}
function getTemplateList (){
	$('#letterhead_list_section').hide();
	$('#letterhead_list').find('option').remove().end();
	var category_id =	$("#document_categories").val();
	var subcategory_id =	$("#document_subctg").val();
	var pleading_type =	$("#pleading_types").val();
	var where = "&category_id="+category_id;
	if(subcategory_id == 'Pleadings' && !(pleading_type)){
		$('#document_list_section').hide();
		$('#document_list').find('option').remove().end();
		generateDropDown('#pleading_types',pleading_type_list,"Select Pleading Types");
		$('#pleading_types').change(function(){
			getTemplateList();
		});
		return;
	}
	else if(subcategory_id != 'Pleadings'){
		$("#pleading_types_section").hide();
		$('#pleading_types').find('option').remove().end();
	}
	if(subcategory_id){
		where += "&subcategory_id="+subcategory_id;
	}	
	if((pleading_type) && subcategory_id == 'Pleadings'){
		where += "&pleading_type="+pleading_type;
	}
	if(typeof(module_sugar_grp1) !== 'undefined'){
		where += "&target_module="+module_sugar_grp1;
	}
	$.LoadingOverlay("show", {
	   zIndex          : 99999999   
	});
	$.ajax({
		url: "index.php?module=DHA_PlantillasDocumentos&action=getTemplatesList&sugar_body_only=true"+where, 
		dataType:'JSON',
		async: true,
		success: function(result){
			options = JSON.parse(result);
			$.LoadingOverlay("hide");
			$('#document_list').html('');
			if(options){
				generateDropDown('#document_list',options,'Select Templates');
			}
		},
		error: function (error) {
			$.LoadingOverlay("hide");
		}
	});
	//generateDropDown('#templates_list',doc_category);
	//$("#templates_list_section").hide().show("slide", { direction: "right" }, 1000);
}

function getAllTemplateList (type = ''){
	var params = '';
	if(type == 'favorites'){
		params = '&favorites=true';
	}
	$.LoadingOverlay("show", {
	   zIndex          : 99999999   
	});
	if(typeof(module_sugar_grp1) !== 'undefined'){
		params += "&target_module="+module_sugar_grp1;
	}
	$.ajax({
		url: "index.php?module=DHA_PlantillasDocumentos&action=getTemplatesList&sugar_body_only=true"+params, 
		dataType:'JSON',
		async: true,
		success: function(result){
			options = JSON.parse(result);
			console.log(options);
			$.LoadingOverlay("hide");
			$('#document_list').html('');
			if(options){
				generateDropDown('#document_list',options,'Select Templates');
			}
		},
		error: function (error) {
			$.LoadingOverlay("hide");
		}
	});
}



function getLetterheadList (template_id){
	// alert(template_id);
	if(typeof(template_id) == 'undefined'){
		return;
	}
	
	$.LoadingOverlay("show", {
	   zIndex          : 99999999   
	});
	$("#letterhead_list_section").hide();
	$('#letterhead_list').find('option').remove().end();
	$.ajax({
		url: "index.php?module=DHA_PlantillasDocumentos&action=getLetterHeadList&sugar_body_only=true&record="+template_id, 
		 dataType:'JSON',
		async: true,
		success: function(result){
			options = JSON.parse(result);
			console.log(options);
			$.LoadingOverlay("hide");
			$('#letterhead_list').html('');
			 if(options.length > 0){
				generateDropDown('#letterhead_list',options,'Select Letterhead');
			 }
		},
		error: function (error) {
			// console.log(error);
			$.LoadingOverlay("hide");
		}
	});
	//generateDropDown('#templates_list',doc_category);
	//$("#templates_list_section").hide().show("slide", { direction: "right" }, 1000);
}

function getContactRoleList (template_id){
	// alert(template_id);
	if(typeof(template_id) == 'undefined'){
		return;
	}
	
	$.LoadingOverlay("show", {
	   zIndex          : 99999999   
	});
	$("#contactrole_list_section").hide();
	$('#contactrole_list').find('option').remove().end();
	$.ajax({
		url: "index.php?module=DHA_PlantillasDocumentos&action=getContactRoleList&sugar_body_only=true&record="+template_id, 
		 dataType:'JSON',
		async: true,
		success: function(result){
			options = JSON.parse(result);
			console.log(options);
			$.LoadingOverlay("hide");
			$('#contactrole_list').html('');
			 if(options.length > 0){
				generateDropDown('#contactrole_list',options,'Select Contact Role');
			 }
		},
		error: function (error) {
			// console.log(error);
			$.LoadingOverlay("hide");
		}
	});
	//generateDropDown('#templates_list',doc_category);
	//$("#templates_list_section").hide().show("slide", { direction: "right" }, 1000);
}

function select_all_options(field_name){
	if($("#"+field_name+"_select_all").is(':checked') ){
		$("#"+field_name+"_select > option").prop("selected","selected");
		$("#"+field_name+"_select").trigger("change");
	}else{
		$("#"+field_name+"_select > option").removeAttr("selected");
		 $("#"+field_name+"_select").trigger("change");
	 }
}
function generating_relationship_dropdowns(relationship_drop){
	$(".row.fields").empty();
	$.each(relationship_drop, function( index, value ){
		$.each(value.relation, function( index1, value1 ){
			if((value1.data[0].id) == 'mandatory'){
				if(value1.label != 'UM Defendants'){
					jQuery('.row.fields').append('<div class="relaton_mandatory col-xs-6 col-md-4 " id="'+index1+'_mandatory"><div class="title_'+index1+'" style="color:red">Please attach ' +value1.label+ ' first.</div></div>');				
				}
			}
			else{
				jQuery('.row.fields').append('<div class="'+index1+'_selection col-xs-6 col-md-4 select_area detail-view-field" id="'+index1+'_select_selection"><div class="title1"> </div><div><input type="checkbox" id="'+index1+'_select_all" onclick="select_all_options(\''+index1+'\')">Select All</div><select id="'+index1+'_select" multiple="multiple" name="mandatory_select"></select></div>');
				generateMultiSelectDropDown('#'+index1+'_select', value1.data, 'Select '+value1.label);	
			}
		});	
	});	
}

function getPanelList (){
	var category_id =	$("#document_categories").val();
	var plantilladocumento_id =	$("#document_list").val();
	var subcategory_id =	$("#document_subctg").val();
	if(subcategory_id !== 'Pleadings'){
		getLetterheadList(plantilladocumento_id);
	}
	var where = "&category_id="+category_id;
	if(plantilladocumento_id){
		 $("#document_generation_form #MGD_mode").val('selected');
		 $("#document_generation_form #MGD_action").val('htgetSelectionPanelJSON');
		 $("#document_generation_form #related_selected").val('');
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
					// console.log(result);
					generating_relationship_dropdowns(obj);	
					$.LoadingOverlay("hide");
				},
				error: function (error) {
					console.log(error);
					$.LoadingOverlay("hide");
				}
			});
	}

	/* $.ajax({
		url: "index.php?module=DHA_PlantillasDocumentos&action=htgetSelectionPanelJSON&sugar_body_only=true"+where, 
		dataType:'JSON',
		success: function(result){
			options = JSON.parse(result);
			$.LoadingOverlay("hide");
			if(options){
				generateDropDown('#document_list',options,'Select Templates');
				$("#related_selection_panel").slideUp( "slow" ).slideDown( "slow" );
			}
		},
		error: function (error) {
			$.LoadingOverlay("hide");;
		}
	}); */
}
function document_generation_form_submission(){
	if ($( ".relaton_mandatory" ).length){
	  alert('Please attach required data first.');
	}
	else if($("#letterhead_list").val()==""){
		alert('Please Select Letterhead for this');
	}
	else{
		// if($( "select[name^='mandatory_select']" ).length > 0){
			// if($( "select[name^='mandatory_select']" ).val() == null){
				 // alert('Please attach required data first.');
				 // return;
			// }
		// }
		var plantilladocumento_id =	$("#document_list").val();
		if(plantilladocumento_id){
			 $("#document_generation_form #MGD_mode").val('selected');
			 $("#document_generation_form #MGD_action").val('htgeneratedocument');
			 $("#document_generation_form [name='from_view']").val('customselection');
			 //var attach_case_value = $("#AttachGeneratedDocumentToRecord").val();
			 var attach_case_value = '';
			 if($('#AttachGeneratedDocumentToRecord_detailview').is(":checked")){
				 attach_case_value = 1;
			 }else{
				 attach_case_value = 0;
			 }
			 var data = '';
			$('.row.fields').children().each(function(i, obj) {
				var sel = $(obj).find('select');
				var sel_val = $(sel).val();
				if(sel_val != null){
					data += sel_val.join()+ ',';	
				}
				 
				
			});
			 $("#document_generation_form [name='related_selected']").val(data);
			 $("#document_generation_form [name='AttachGeneratedDocumentToRecord']").val(attach_case_value);
			  $('#document_generation_form').submit();
			 /* $.ajax({
				url: "index.php", 
				type: "POST",
					dataType:'html',
					data : $('#document_generation_form').serialize(),
					success: function(result){	
					},
					error: function (error) {
						console.log(error);
					}
				}); */
		}
	}
}

function updateDependent (element_id,selected_data){

	if(element_id == 'document_categories'){
		var options = subcategory_list[selected_data.id];
		if(typeof options != 'undefined' && options.length > 0){
			$("#document_list_section").hide();
			$('#document_subctg').html('');
			$('#pleading_types').html('');
			generateDropDown('#document_subctg',options,"Select "+selected_data.text);

			$('#document_subctg').change(function(){
				$(".row.fields").empty();
			});			
		}else{
			$("#document_subctg_section").hide();
			$("#pleading_types_section").hide();
			$('#document_subctg').find('option').remove().end();
			$('#pleading_types').find('option').remove().end();
			getTemplateList();
		}
	}
	if(element_id == 'document_subctg'){
		getTemplateList();
	}
	if(element_id == 'document_list'){
		console.log("here");
		getPanelList();
	}
}
function get_uids_massgeneratedocument (mode){
   // Basado en sugarListView.prototype.send_mass_update (la funcion para la recogida de datos del MassUpdate y del Borrado masivo)
   // Cuidado, se mira en los valores del form MassUpdate, pero los valores van a ir al form MassGenerateDocument
   
   var ar = new Array();

   switch(mode) {
      case 'selected':
         for(wp = 0; wp < document.MassUpdate.elements.length; wp++) {
            var reg_for_existing_uid = new RegExp('^'+RegExp.escape(document.MassUpdate.elements[wp].value)+'[\s]*,|,[\s]*'+RegExp.escape(document.MassUpdate.elements[wp].value)+'[\s]*,|,[\s]*'+RegExp.escape(document.MassUpdate.elements[wp].value)+'$|^'+RegExp.escape(document.MassUpdate.elements[wp].value)+'$');
            //when the uid is already in document.MassUpdate.uid.value, we should not add it to ar.
            if(typeof document.MassUpdate.elements[wp].name != 'undefined'
               && document.MassUpdate.elements[wp].name == 'mass[]'
               && document.MassUpdate.elements[wp].checked
               && !reg_for_existing_uid.test(document.MassUpdate.uid.value)) {
                     ar.push(document.MassUpdate.elements[wp].value);
            }
         }
         if(ar.length > 0) {
            if(document.MassUpdate.uid.value != '') document.MassUpdate.uid.value += ',';
            document.MassUpdate.uid.value += ar.join(',');
         }
         if(document.MassUpdate.uid.value == '') {
            alert(SUGAR.language.get("app_strings", "LBL_LISTVIEW_NO_SELECTED") );
            return false;
         }
         
         var resultado = document.MassUpdate.uid.value;
         break;
         
      case 'entire':
         // var entireInput = document.createElement('input');
         // entireInput.name = 'entire';
         // entireInput.type = 'hidden';
         // entireInput.value = 'index';
         // document.MassGenerateDocument.appendChild(entireInput);
         
         var resultado = 'all';
         break;
         
      default:
         return false;
   }
   
   return resultado;
}

// Ver las funciones getMassGenerateDocumentForm , handleMassGenerateDocument y action_generatedocument
$(function() {  
   $("#MassGenerateDocument_button_ListView").click(function(){
      if (document.MassUpdate.select_entire_list && document.MassUpdate.select_entire_list.value == 1)
         var mode = 'entire';
      else
         var mode = 'selected';
      
      var uids = get_uids_massgeneratedocument(mode);  // aqui se averigua la lista de ids seleccionados (caso de que el modo sea selected)
      if (uids){
         document.MassGenerateDocument.mode.value = mode;
         document.MassGenerateDocument.uid.value = uids;
         document.MassGenerateDocument.enPDF.value = false;
         document.MassGenerateDocument.submit();
      }
      return false; 
   }); 

   $("#MassGenerateDocument_button_DetailView").click(function(){  
      $("#MassGenerateDocument #MGD_mode").val('selected');
      $("#MassGenerateDocument #MGD_enPDF").val(false);
      $("#MassGenerateDocument").submit();
      return false; 
   });    

   $("#MassGenerateDocument_button_ListView_pdf").click(function(){
      if (document.MassUpdate.select_entire_list && document.MassUpdate.select_entire_list.value == 1)
         var mode = 'entire';
      else
         var mode = 'selected';
      
      var uids = get_uids_massgeneratedocument(mode);  // aqui se averigua la lista de ids seleccionados (caso de que el modo sea selected)
      if (uids){
         document.MassGenerateDocument.mode.value = mode;
         document.MassGenerateDocument.uid.value = uids;
         document.MassGenerateDocument.enPDF.value = true;
         document.MassGenerateDocument.submit();
      }
      return false; 
   }); 

   $("#MassGenerateDocument_button_DetailView_pdf").click(function(){  
      $("#MassGenerateDocument #MGD_mode").val('selected');
      $("#MassGenerateDocument #MGD_enPDF").val(true);
      $("#MassGenerateDocument").submit();
      return false; 
   });     
});  
function clearDropdownFields(){
	$("#document_subctg_section").hide();
	$("#pleading_types_section").hide();
	$("#document_list_section").hide();
	$("#letterhead_list_section").hide();
	$("#contactrole_list_section").hide();
	$("#document_categories").parent().css("display","block");
	$("#document_generation_form_submission_btn").attr("disabled","disabled");
	$('#myModal form')[0].reset();
}