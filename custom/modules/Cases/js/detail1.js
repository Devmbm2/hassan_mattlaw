var tmp = [];
$( document ).ready(function() {
	//$('#subpanel_title_def_defendants_cases').parent().hide(); // to hide the defandant subpanel title
	//$('#def_defendants_cases_create_button').closest('tr').hide();
    $('#get_case_workflows_select_button').attr('value','Select');
    var case_id= document.getElementsByName("record")[0].value;
    $.ajax({
    url: 'index.php?module=AOW_WorkFlow&action=Load_All_Workflows',
    type: 'POST',
    data:{record_id:case_id},
    success : function (result){
      console.log(result);
      $('#list_subpanel_get_case_workflows > table > tbody').html(result);

    }
    });
});

function execute_workflow(selected_record){
	var workflow_id = selected_record.name_to_value_array.subpanel_id;
	var case_id= document.getElementsByName("record")[0].value;
  	$.ajax({
		url: 'index.php?module=AOW_WorkFlow&action=select_workflow_manually',
		type: 'POST',
    data:{record_id:case_id,flow_id:workflow_id},
    success : function (result){
      console.log(result);
			$('#list_subpanel_get_case_workflows > table > tbody').html(result);

		}
  });
	// SUGAR.ajaxUI.showLoadingPanel();
	// $.ajax({
	// 	url: 'index.php?module=AOW_WorkFlow&action=execute_workflow_manually&record_id='+case_id+'&record_module=Cases&workflow_id='+workflow_id,
	// 	type: 'POST',
	// 	contentType: 'application/x-www-form-urlencoded',
	// 	dataType: 'text',
	// 	data: 'sugar_body_only=true',
	// 	async: true,
	// 	success : function (result){
	// 		SUGAR.ajaxUI.hideLoadingPanel();
	// 		window.location.reload();

	// 	}
	// });
}
   function show_case_related_events_report(id){
	window.open("index.php?action=cases_related_events&module=Cases&record="+id);
  }
  function show_case_related_damages_report(id){
	window.open("index.php?action=cases_related_damages&module=Cases&record="+id);
  }
function show_related_module_files_zip_menu(){ 
	var case_id= document.getElementsByName("record")[0].value;
	$.LoadingOverlay("show", {zIndex: 999999 } );
	$.ajax({
		url: 'index.php?module=Cases&action=show_related_module_files_zip_menu&record='+case_id,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',
		async: true,
		success : function (result){
				YAHOO.SUGAR.MessageBox.show({msg: result, height:'700px', width:'200px',title: 'List Of Related Module'});
				$.LoadingOverlay("hide");
				$( document ).ready(function() {
					$("#list_of_case_related_modules").multiselect({
						columns: 1,
						placeholder: "Select Related Modules",
						search: true,
						selectAll: true
					});
					if(window.modules){
						$.each(window.modules, function (index, obj) {
							$("#list_of_case_related_modules option[value='" + obj + "']").prop('selected', true); 
						 });
						 $("#list_of_case_related_modules").multiselect('reload');
				    }
					$("#list_of_case_related_modules_types").multiselect({
						columns: 1,
						placeholder: "Select Related Modules Documents Types",
						search: true,
						selectAll: true
					});
					if(window.types){
						$("#list_of_case_related_modules_types").find("option").prop("selected", false);
						$.each(window.types, function (index, obj) {
							$("#list_of_case_related_modules_types option[value='" + obj + "']").prop('selected', true); 
						 });
						 $("#list_of_case_related_modules_types").multiselect('reload');
					}
					$("#show_files").on("click",function(){
						var selected_modules = $('select#list_of_case_related_modules').val();
						window.modules=selected_modules;
						var selected_modules_types = $('select#list_of_case_related_modules_types').val();
						window.types=selected_modules_types;
						if(selected_modules == '' || selected_modules == null){
							alert('Please Select a Module.');
							return false;
						}
						$.LoadingOverlay("show", {zIndex: 999999 } );
						$.ajax({
						url: 'index.php?entryPoint=show_related_module_files_menu&record='+case_id+'&selected_modules='+selected_modules+'&selected_modules_types='+selected_modules_types+'&module=Cases',
						type: 'POST',
						contentType: 'application/x-www-form-urlencoded',
						dataType: 'text',
						data: 'sugar_body_only=true',
						async: true,
						success : function (result){
						YAHOO.SUGAR.MessageBox.show({msg: result, height:'700px', width:'200px',title: 'List Of Related Module'});
						$.LoadingOverlay("hide");	
						
						console.log(result);
						$("#list_of_case_related_modules_type_files").multiselect({
						columns: 1,
						placeholder: "Select Related Modules Documents Type Files",
						search: true,
						selectAll: true
					});
					$(".ms-options-wrap").css("width", "60%");
					$(".ms-options").css("width", "60%");
					$(".yui-panel-container").css("overflow-y","scroll");

					  $("input[name='checkbox']").change(function() {
					  var checked = $(this).val();
					  if ($(this).is(':checked')) {
					    tmp.push(checked);
					    console.log(tmp);
					  } else {
					    tmp.splice($.inArray(checked, tmp),1);
					  }

					});
					

						}
					})
					});
					$("#list_of_case_related_modules_type_files").css("display","none");
					$(".ms-options-wrap").css("width", "60%");
					$(".ms-options").css("width", "60%");
				});

		}

	});
	//read_more_btn();
}

function select_all_it() {
	$("input[name='checkbox']").prop("checked",true);
$("input:checkbox[name='checkbox']:checked").each(function(){
  tmp.push($(this).val());
	  });
}
function unselect_all_it() {
	$("input[name='checkbox']").prop("checked",false);
	$("input:checkbox[name='checkbox']").each(function(){
  tmp.splice($.inArray($(this).val(), tmp),1);
	  });
}
function ClosePopup_it (e){
$($(e).parent().parent().parent().parent()).remove();
show_related_module_files_zip_menu();
  }
  function ClosePopup_down (e){
	//console.log(e);
	$($(e).parent().parent().parent()).remove();
	show_related_module_files_zip_menu();
	  }



function send_document_to_sign(){

	var case_id= document.getElementsByName("record")[0].value;
	$.LoadingOverlay("show", {zIndex: 999999 } );
	var html_show = '<div><table class="list view table" style="height: 60px; width: 700px; border-spacing:-2;" id="helloSignSelection"><tbody>';

html_show +='<tr><td style="width: 40%;text-align: center;">Documents:&nbsp;&nbsp;</td><td><select style="height:50%;width: 60%;" name="list_of_case_related_docs" id="list_of_case_related_docs" >';
html_show +='</select></td></tr>';
html_show +='<tr><td style="width: 40%;text-align: center;" >Contacts:&nbsp;&nbsp;</td><td><select style="height:50%;width: 60%;" name="list_of_case_related_contacts" id="list_of_case_related_contacts" >';
html_show +='</select></td></tr>';
html_show +='<tr><td style="width: 40%;"></td><td><input type="button" id = "send_for_signature" value="Send for Signature" onclick="send_doc_for_signature(\''+case_id+'\');"></td></tr></tbody></table><div>';
	$.ajax({
		url: 'index.php?module=Cases&action=getRelatedDocsContacts&record='+case_id,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',
		async: true,
		success : function (result){
				result = JSON.parse(result);
				YAHOO.SUGAR.MessageBox.show({msg: html_show, height:'700px', width:'200px',title: 'Send Document For Signature'});
				$.LoadingOverlay("hide");
				$( document ).ready(function() {
					$("#list_of_case_related_docs").select2({
						width: '80%',
						data: result.doc_list,
						dropdownParent: $('#helloSignSelection')
					});
					$("#list_of_case_related_contacts").select2({
						width: '80%',
						data: result.contact_list,
						dropdownParent: $('#helloSignSelection')
					});;
					// $(".ms-options-wrap").css("width", "60%");
					// $(".ms-options").css("width", "60%");
				});

		}
	});
}
function related_module_files_zip_download(record_id){
	var selectedCheckboxes = document.querySelectorAll('input[id="notes_id"]:checked');
	var selectedValues = Array.from(selectedCheckboxes, checkbox => checkbox.value);
	var selectedemails = document.querySelectorAll('input[id="emails_id"]:checked');
	console.log(selectedemails);
	var emailsValues = Array.from(selectedemails, checkbox => checkbox.value);
	console.log(emailsValues);
	var selected_records = tmp;
	var selected_modules = $('#list_of_case_related_modules').val();
	var selected_modules_types = $('#list_of_case_related_modules_types').val();
	if(selected_modules == '' || selected_modules == null){
		alert('Please Select a Module.');
		return false;
	}
	 window.open('index.php?entryPoint=related_module_files_zip_download&record_id='+record_id+'&selected_modules='+selected_modules+'&selected_modules_types='+selected_modules_types+'&tmp='+selected_records+'&selected_ids='+selectedValues+'&emailsValues='+emailsValues+'&module=Cases');
}
function send_doc_for_signature(record_id){
	var selected_doc = $('select#list_of_case_related_docs').val();
	var selected_contact = $('select#list_of_case_related_contacts').val();
	if(selected_doc == '' || selected_doc == null){
		alert('Please Select a Document.');
		return false;
	}
	if(selected_contact == '' || selected_contact == null){
		alert('Please Select a Contact.');
		return false;
	}

	$.ajax({
		url: 'index.php?module=Cases&action=sendDocHelloSign&record='+record_id+'&selected_doc='+selected_doc+'&selected_contact='+selected_contact,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',
		async: true,
		success : function (result){
			$.notify({
				message: result,
			},{
			element: 'body',
			position: null,
			type: "success",
			placement: {
					from: "top",
					align: "center"
				},
				offset: 20,
				delay: 3000,
				z_index: 15031,
				animate: {
					enter: 'animated bounceInDown',
					exit: 'animated bounceOutUp'
				}
			});

		}
	});
}

$(document).ready(function() {
	var elements = document.querySelectorAll('[id*="list_subpanel"]');
	console.log('all elements'+elements.length);
	for (var i = 0; i < elements.length; i++) {
	  var table = elements[i].querySelector('table > thead > tr:nth-child(2) > td > table');
	  console.log('table found'+table);
	  if (table) {
		var firstRow = table.querySelector('tr:first-of-type');
		console.log('firstRow'+firstRow);
		if (firstRow) {
		  var lastTd = firstRow.lastElementChild;
		console.log('lastTd'+lastTd);
		  if (lastTd) {
			lastTd.align = 'left'; 
			var firstTd = firstRow.firstElementChild;
			firstRow.insertBefore(lastTd, firstTd);
			console.log('swapping is working');
		  }
		}
	  }
	}

  });

 function read_more_btn(e) {
        var descriptionShort = e.parentNode.querySelector(".description-short");
        var descriptionFull = e.parentNode.querySelector(".description-full");
        var viewlessButton = e.parentNode.querySelector("#view-less-button");
        descriptionShort.style.display = "none";
        descriptionFull.style.display = "inline";
        e.style.display = "none";
		viewlessButton.style.display = "inline";
}

function view_less_btn(e) {
    var descriptionShort = e.parentNode.querySelector(".description-short");
    var descriptionFull = e.parentNode.querySelector(".description-full");
    var readMoreButton = e.parentNode.querySelector("#read-more-button");

    descriptionFull.style.display = "none";
    descriptionShort.style.display = "inline";
    e.style.display = "none";
    readMoreButton.style.display = "inline";	
}