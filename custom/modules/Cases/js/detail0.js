var tmp = [];
var count = false;
$( document ).ready(function() {
	//$('#subpanel_title_def_defendants_cases').parent().hide(); // to hide the defandant subpanel title
	//$('#def_defendants_cases_create_button').closest('tr').hide();
	$(window).load(function(e) {
		e.stopImmediatePropagation();
		$("#bootstrap-container").append('<div class="loader"></div>');	
	});

var record_id = $("input[name=record]").val();
// if(!count)
//  {
// //$.LoadingOverlay("show", {zIndex: 999999 } );
// setTimeout(function() { 

// var ajaxurl = 'index.php?module=Cases&action=showsubpanels&record='+record_id+'&showpanels=1';
//     $.ajax({
//         url: ajaxurl,
//         type: 'post',
//         data: {"show_subpanels": 1},
//         success: function(response) { 
		
//         	var success =  $(response).find("#content");
// 		$(success).css("padding","0");
// 			console.log(success); // div#success
//         	// console.log(response);
//         	// panelbody = response.getElementById("tabbed_subpanels_wrapper"); 
//         	// panelbody = document.getElementById("tabbed_subpanels_wrapper"); 
//         	$(".loader").hide();
//         	$("#content").append(success);
//         	$.get('custom/Extension/application/tabbed_subpanels/tabbed_subpanels.js');
// 		$("input[name=return_action]").val('DetailView');
// 		//$.LoadingOverlay("hide");
//         }
//     });
//  }, 500);
// count=true;
// }
var workflow_end_status_c = $('#workflow_end_status_c').val();
// alert(workflow_end_status_c);
      if(workflow_end_status_c == 'Not_Done'){
        $("#workflow_not_done_c").parent().parent().show();
        $("#workflow_opt_out_reason_c").val('');
        $("#workflow_opt_out_reason_c").parent().parent().hide();
  
      }
      else if(workflow_end_status_c == 'Opt_Out'){
        $("#workflow_opt_out_reason_c").parent().parent().show();
        $("#workflow_not_done_c").parent().parent().hide();
        $("#workflow_not_done_c").val('');
        $("#workflow_end_reason_c").parent().parent().hide();
        $("#workflow_end_reason_c").val('');
      }
      else{
        $("#workflow_not_done_c").parent().parent().hide();
        $("#workflow_not_done_c").val('');
        $("#workflow_end_reason_c").parent().parent().hide();
        $("#workflow_end_reason_c").val('');
        $("#workflow_opt_out_reason_c").val('');
        $("#workflow_opt_out_reason_c").parent().parent().hide();
      }

      var workflow_not_done_c = $('#workflow_not_done_c').val();
      if(workflow_not_done_c == 'Other'){
        $("#workflow_end_reason_c").parent().parent().show();
      }
      else{
        $("#workflow_end_reason_c").parent().parent().hide();
      }
});


function execute_workflow(selected_record){
	var workflow_id = selected_record.name_to_value_array.subpanel_id;
	var case_id= document.getElementsByName("record")[0].value;
	SUGAR.ajaxUI.showLoadingPanel();
	$.ajax({
		url: 'index.php?module=AOW_WorkFlow&action=execute_workflow_manually&record_id='+case_id+'&record_module=Cases&workflow_id='+workflow_id,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){
			SUGAR.ajaxUI.hideLoadingPanel();
			window.location.reload();	
			
		}
	});
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
					$("#list_of_case_related_modules_types").multiselect({
						columns: 1,
						placeholder: "Select Related Modules Documents Types",
						search: true,
						selectAll: true
					});
					$("#show_files").on("click",function(){
						var selected_modules = $('select#list_of_case_related_modules').val();
						var selected_modules_types = $('select#list_of_case_related_modules_types').val();
						if(selected_modules == '' || selected_modules == null){
							alert('Please Select a Module.');
							return false;
						}
						$.LoadingOverlay("show", {zIndex: 999999 } );
						$.ajax({
						url: 'index.php?entryPoint=show_related_module_files_menu&record='+case_id+'&selected_modules='+selected_modules+'&selected_modules_types='+selected_modules_types,
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
					  $("#select_all").click(function() {
					  	$("input[name='checkbox']").prop("checked",true);
					  $("input:checkbox[name='checkbox']:checked").each(function(){
					    tmp.push($(this).val());
							});
					  });
					  $("#unselect_all").click(function() {
					  	$("input[name='checkbox']").prop("checked",false);
					  	$("input:checkbox[name='checkbox']").each(function(){
					    tmp.splice($.inArray($(this).val(), tmp),1);
							});
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
function send_document_to_multi_contact(){

	var case_id= document.getElementsByName("record")[0].value;
	$.LoadingOverlay("show", {zIndex: 999999 } );
	var html_show = '<div><table class="list view table" style="height: 60px; width: 700px; border-spacing:-2;" id="helloSignSelection"><tbody>';

html_show +='<tr><td style="width: 40%;text-align: center;">Documents:&nbsp;&nbsp;</td><td><select style="height:50%;width: 60%;" name="list_of_case_related_docs" id="list_of_case_related_docs" >';
html_show +='</select></td></tr>';
html_show +='<tr><td style="width: 40%;text-align: center;" >Select Contacts Role:&nbsp;&nbsp;</td><td><select style="height:50%;width: 60%;" name="list_of_case_related_contacts_role" id="list_of_case_related_contacts_role" >';
html_show +='</select></td></tr>';
html_show +='<tr><td style="width: 40%;text-align: center;display:none" id="contactsroletd">Select Contacts:&nbsp;&nbsp;</td><td><select style="height:50%;width: 60%;display:none;" name="list_of_case_related_contacts" id="list_of_case_related_contacts" multiple>';
html_show +='</select></td></tr>';
html_show +='<tr><td style="width: 40%;"></td><td><input type="button" id = "send_document" value="Send Document" onclick="send_doc(\''+case_id+'\');"></td></tr></tbody></table><div>';
	$.ajax({
		url: 'index.php?module=Cases&action=getRelatedDocContactRoles&record='+case_id,
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
					$("#list_of_case_related_contacts_role").select2({
						width: '80%',
						data: result.contact_list,
						dropdownParent: $('#helloSignSelection')
					});
					$("#list_of_case_related_contacts_role").on('change',function(){
						var role = $(this).val();
						getRelatedContactsByRole(role);
					})
					// $(".ms-options-wrap").css("width", "60%");
					// $(".ms-options").css("width", "60%");
				});
				
		}
	});
}
function getRelatedContactsByRole(role_id){
	var case_id= document.getElementsByName("record")[0].value;
	if(role_id && case_id){
		$("#contactsroletd").css("display","block");
		$("#list_of_case_related_contacts").css("display","block");
$.ajax({
		url: 'index.php?module=Cases&action=getRelatedContactRoles&record='+role_id+'&case_id='+case_id,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){
			console.log(result);
				result = JSON.parse(result);
				$( document ).ready(function() {
					$("#list_of_case_related_contacts").empty();
					$("#list_of_case_related_contacts").select2({
						width: '80%',
						data: result.contact_list,
						dropdownParent: $('#helloSignSelection')
					});
					// $(".ms-options-wrap").css("width", "60%");
					// $(".ms-options").css("width", "60%");
				});
				
		}
	});
}
}
function related_module_files_zip_download(record_id){
	console.log(tmp);
	var selected_records= tmp;
	$("#selected_records").val(tmp);
	var selected_modules = $('#list_of_case_related_modules').val();
	var selected_modules_types = $('#list_of_case_related_modules_types').val();
	if(selected_modules == '' || selected_modules == null){
		alert('Please Select a Module.');
		return false;
	}if(tmp == '' || tmp == null){
		alert('Please Select files to download.');
		return false;
	}
	$("#download_zip_form").submit();
	 // window.open('index.php?entryPoint=related_module_files_zip_download&record_id='+record_id+'&selected_modules='+selected_modules+'&selected_modules_types='+selected_modules_types+'&tmp='+selected_records);

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
			let status_list = SUGAR.language.languages.app_list_strings.sentoutstatus_list;
			// let status_list_result = JSON.parse(status_list);
			console.log(selected_doc);
			
			let html_show = `
				<table id="table" style="width:400px;">
				<tbody>
				<tr>
				<td>
				Document Status
				</td>
				<td>
				<select id = "sentoutlist">
				</select>
				</td>
				</tr>
				<tr>
				<td><input id = "set_doc_status" type = "button" name = "Submit" value = "Set Status" onclick = "setStatus('`+selected_doc+`');"/></td>
				</tr>
				</tbody>
				</table>
			`;

				YAHOO.SUGAR.MessageBox.show({
            msg: html_show,
            // height: '70px',
            width: '200px',
            position: 'centre',
            title: 'Set this Document in progress to track Date Sent!',
        });
				$.each(status_list, function( index, value ){
				$("#sentoutlist").append(`<option value =`+index+`>`+value+`</option>` );
					console.log(value);
				});

		}
	});
}
function setStatus(selected_doc){
var status = $("#sentoutlist").val();
if(status == 'Progress'){
$.ajax({
		url: 'index.php?module=Cases&action=setDocStatus&selected_doc='+selected_doc,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){
			console.log(result);
		}
	});
}
else{
	alert("Please select the option progress so we can track date sent of document.");
}
				}
function send_doc(record_id){
	var selected_doc = $('select#list_of_case_related_docs').val();
	var selected_role = $('select#list_of_case_related_contacts_role').val();
	var selected_contact = $('select#list_of_case_related_contacts').val();
	if(selected_doc == '' || selected_doc == null){
		alert('Please Select a Document.');
		return false;
	}
	if(selected_contact == '' || selected_contact == null){
		alert('Please Select a Contact.');
		return false;
	}
	alert(selected_contact);
	// $.ajax({
	// 	url: 'index.php?module=Cases&action=sendDocHelloSign&record='+record_id+'&selected_doc='+selected_doc+'&selected_contact='+selected_contact,
	// 	type: 'POST',
	// 	contentType: 'application/x-www-form-urlencoded',
	// 	dataType: 'text',
	// 	data: 'sugar_body_only=true',						
	// 	async: true,			
	// 	success : function (result){
	// 		$.notify({
	// 			message: result,
	// 		},{
	// 		element: 'body',
	// 		position: null,
	// 		type: "success",
	// 		placement: {
	// 				from: "top",
	// 				align: "center"
	// 			},
	// 			offset: 20,
	// 			delay: 3000,
	// 			z_index: 15031,
	// 			animate: {
	// 				enter: 'animated bounceInDown',
	// 				exit: 'animated bounceOutUp'
	// 			}
	// 		});	
				
	// 	}
	// });
}
document.addEventListener('DOMContentLoaded', function() {

	var elements = document.querySelectorAll('[id*="list_subpanel"]');
	console.log(elements);
	for (var i = 0; i < elements.length; i++) {
	  var table = elements[i].querySelector('table > thead > tr:nth-child(2) > td > table');
	  if (table) {
		var firstRow = table.querySelector('tr:first-of-type');
		if (firstRow) {
		  var lastTd = firstRow.lastElementChild;
		  if (lastTd) {
			lastTd.align = 'left'; // Update the float property
			var firstTd = firstRow.firstElementChild;
			firstRow.insertBefore(lastTd, firstTd);
		  }
		}
	  }
	}
  });