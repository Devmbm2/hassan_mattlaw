function show_related_module_files_zip_menu(){
	var case_id= document.getElementsByName("record")[0].value;
	$.LoadingOverlay("show", {zIndex: 999999 } );
	$.ajax({
		url: 'index.php?module=Accounts&action=show_related_module_files_zip_menu&record='+case_id,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',
		async: true,
		success : function (result){
				YAHOO.SUGAR.MessageBox.show({msg: result, height:'700px', width:'200px',title: 'List Of Related Module'});
				$.LoadingOverlay("hide");
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
            var module = $('select#list_of_case_related_modules').val();
						window.modules=selected_modules;
						var selected_modules_types = $('select#list_of_case_related_modules_types').val();
						window.types=selected_modules_types;
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
					

						}
					})
					});
			
					$("#list_of_case_related_modules_type_files").css("display","none");
					$(".ms-options-wrap").css("width", "60%");
					$(".ms-options").css("width", "60%");
			

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
