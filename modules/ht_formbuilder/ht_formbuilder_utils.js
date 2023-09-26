
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
			<input type = "hidden" name="epspecficformbuilder" id="epspecficformbuilder" value=""/>
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
	$(".option-actions").empty();
	$(".option-actions").append('<button id = "showmore">Load More</button>');
	$(document).on('change','.select2',function(e){
	var type = $(this).closest("li").attr("type");
	var options_container = $(this);
	var option_value = $(this).val();
	var module = $("#related_module").val();
	var case_type = $("#case_type").val();
	$(".field-options").css("height","350px");
	$(".field-options").css("overflow-y","scroll");
	let counter = 0;
	if(type === 'select')
	{
		$.ajax({
            url:"index.php?module=ht_formbuilder&action=getRelatedOptions&sugar_body_only=true",   
            type: "post",
            // dataType: 'json',
            data: {module_name: module, option_value: option_value, case_type: case_type},
            success:function(result){
				console.log(result);
				if(result)
				{
					$(options_container).parent().parent().parent().find("ol").empty();
					 var decode = JSON.parse(result);
					$.each(decode, function(k,v) {
						if(v !== "")
						{
							$(options_container).parent().parent().parent().find("ol").append('<li class="ui-sortable-handle"><input value="true" type="radio" checked="true" data-attr="selected" class="option-selected option-attr"><input value="'+v+'" type="text" placeholder="" data-attr="label" class="option-label option-attr"><input value='+k+' type="text" placeholder="" data-attr="value" class="option-value option-attr"><a class="remove btn formbuilder-icon-cancel" title="Remove Element"></a></li>')				
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
				}

			}

        });
		e.stopImmediatePropagation();
		return false;
	}

});
}
function customlogicpopup()
{
	if($('#main-modal-view').length)
		{
	 document.getElementById('main-modal-view').remove();
	}
let formRenderOpts = {
      dataType: 'xml',
      formData: '<form-template><fields><field type="select" required="true" label="IF" class-name="form-control" name="field-selected" id="field-selected" access="false" multiple="false"></field><field type="select" required="true" label="State" class-name="form-control" name="field-state" access="false" multiple="false"><option label="Please Select State" selected="true" disabled = "true" hidden="true" value="">Please Select State</option><option label="Is Empty" value="isEmpty">Is Empty</option><option label="Is Filled" value="isFilled">Is Filled</option><option label="Is Equal To" value="isEqualTo">Is Equal To</option><option label="Is Not Equal To" value="isNotEqualTo">Is Not Equal To</option></field><field type="select" required="true" label="Value" class-name="form-control" name="field-value" access="false" multiple="false"><option label="" value="" selected="true" disabled = "true" hidden="hidden">Please Select Value</option><option label="Yes" value="yes">Yes</option><option label="No" value="no">No</option></field><field type="select" required="true" label="DO" class-name="form-control" name="field-do" access="false" multiple="false"><option label="" value="" selected="true" disabled = "true" hidden = "hidden">Please Select What Do</option><option label="Hide" value="hide" selected="false">Hide</option><option label="Show" value="show" selected="false">Show</option><option label="Hide Multiple" value="hide-multiple" selected="false">Hide Multiple</option><option label="Show Multiple" value="show-multiple" selected="false">Show Multiple</option></field><field type="select" required="true" label="FIELD" class-name="form-control" name="field-selected2" access="false" multiple="false"></field></fields></form-template>'
    };	
let $renderContainer = $('<form/>');
    $renderContainer.formRender(formRenderOpts);
      var modalhtml = `<div id='main-modal-view'>
<style>
.w3-container,.w3-panel{padding:2.01em 16px;background:#ffffff;}.w3-panel{margin-top:16px;margin-bottom:16px}
.w3-modal{z-index:3;display:none;padding-top:100px;position:fixed;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.4)}
.w3-modal-content{margin:auto;background-color:#fff;position:relative;padding:0;outline:0;width:875px}
.w3-btn,.w3-button{border:none;display:inline-block;padding:8px 16px;vertical-align:middle;overflow:hidden;text-decoration:none;color:#000;background-color:inherit;text-align:center;cursor:pointer;white-space:nowrap;font-size: x-large;}
.w3-display-topright{position:absolute;right:0;top:0}
.w3-button:hover{color:#000!important;background-color:#ccc!important}
.w3-animate-top{position:relative;animation: animatetop 0.4s;}
.w3-animate-top{position:relative;animation:animatetop 0.4s}@keyframes animatetop{from{top:-300px;opacity:0} to{top:0;opacity:1}}
footer{width:auto;background-color:unset;}
</style>
<div class="w3-container">

  <div id="showhtml" class="w3-modal">
    <div class="w3-modal-content w3-animate-top">
    <div class="w3-container"> 
        <span id="close" class="w3-button w3-display-topright">&times;</span>
        <h2>Set Up Condition Logic</h2>
        <p class = "error-message" style="color:red;"><p>
        <p class = "success-message" style="color:green;"><p>
        <div style = "float:right;">
        <button class="button" name="view" id="view" onclick="viewcustomlogicpopup()">View Condition Logics</button>
        </div>
        </div>
      <div class="w3-container">
      
      <form id = "logic-form">
      	${$renderContainer.html()}
      	<footer>
      	<input type = "submit" id= "save-logicbtn" name="save-logic" value="Save">
      	</footer>
      	</form>
      </div>
      
    </div>
  </div>
</div>
</div>`;
	$("body").append(modalhtml);
	$(".form-group").addClass("col-lg-4");
	$(".rendered-form .form-control").css("width","90%");
	let multipleSelectname = $("#field-selected2").attr("name");
	$("#field-state").on("change",function(){
		var state = $(this).val();
		if(state == 'isEmpty' || state == 'isFilled')
		{
			$("#field-value").parent().hide();
		}
		else
		{
			$("#field-value").parent().show();
		}
	});
	$("#field-do").on("change",function(){
		var did = $(this).val();
		if(did == "hide-multiple" || did == "show-multiple")
		{
			$("#field-selected2").attr("multiple","multiple");
			let name = multipleSelectname + "[]";
			$("#field-selected2").attr("name",name);
		}
		else
		{
			$("#field-selected2").removeAttr("multiple","multiple");
			$("#field-selected2").attr("name",multipleSelectname);
		}
		});
		$('form#logic-form').on('submit', function (e) {
          e.preventDefault();
			let formid = $("#ruuid").val();
			if(formid){
			 $.ajax({
            type: 'post',
            url: 'index.php?module=ht_formbuilder&action=saveLogicForm&sugar_body_only=true&formID='+formid,
            data: $('form#logic-form').serialize(),
            success: function (result) {
            	console.log(result);
            	if(result=='true')
            	{
              $(".error-message").text("");
              $(".success-message").text("");
              $(".success-message").text("This record created Successfully!");
              $( 'form#logic-form' ).each(function(){
              this.reset();
            	})
          		let timerInterval
							Swal.fire({
								title: 'Condition is Set!',
								html: 'Your condition has been set successfully.',
								icon:'success',
								showConfirmButton: false,
									timer: 1800,
									willClose: () => {
									clearInterval(timerInterval)
								}
							}).then((result) => {
							/* Read more about handling dismissals below */
									if (result.dismiss === Swal.DismissReason.timer) {}});
           		 }
            	else if(result=='error')
            	{
            		$(".error-message").text("");
            		$(".success-message").text("");
            		$(".error-message").text("This record already exist!");
            	}
            	else
            	{
            		$(".error-message").text("");
            		$(".success-message").text("");
            		$(".error-message").text("Form is not submitted due to some reasons!");
            	}
            }
          });
			}
			
		});
		document.getElementById('showhtml').style.display='block';
		var form_rendering_json = formBuild.actions.getData('json');
    	let decode = JSON.parse(form_rendering_json);
    	$("#field-selected").empty();
    	$("#field-selected2").empty();
    	$("#field-selected").append('<option label="Please Select Field" value="" selected="true" disabled hidden></option>');
    	$("#field-selected").on('change', function(){
    		let if_val = $(this).val();
    		$.each(decode, function(index, value) {
    			if(value.name == if_val){
    				console.log(if_val);
    				if(value.values){
    		$("#field-value").empty();
				$.each(value.values, function(index, value) {
			  console.log(value.value);
			  $("#field-value").append('<option label="'+value.label+'" value="'+value.value+'">'+value.label+'</option>');
			  // Will stop running after "three"
			});	
	}
    			}
  
  // Will stop running after "three"
			});	
  })
    	$("#field-selected2").append('<option label="Please Select Field" value="" selected="true" disabled hidden></option>');
    	decode.forEach(myFunction);
	}
	function myFunction(item, index) {
	// console.log(item.values);	
  $("#field-selected").append('<option label="'+item.label+'" value="'+item.name+'">'+item.label+'</option>');
  $("#field-selected2").append('<option label="'+item.label+'" value="'+item.name+'">'+item.label+'</option>');
}
function myFunction2(item, index) {
	console.log(if_val);

	
  // $("#field-selected").append('<option label="'+item.label+'" value="'+item.name+'">'+item.label+'</option>');
  // $("#field-selected2").append('<option label="'+item.label+'" value="'+item.name+'">'+item.label+'</option>');
}

function viewcustomlogicpopup(data='')
	{
		if($('#main-modal-view').length)
		{
	 document.getElementById('main-modal-view').remove();
	}
		let json='';
	
		let formid = $("#ruuid").val();
		$.ajax({
            type: 'post',
            url: 'index.php?module=ht_formbuilder&action=getSaveLogicDetail&sugar_body_only=true',
            data: {formid:formid},
            success: function (result) {
				if(result){
			 json=JSON.parse(result)
			}
			 console.log(json)
			 var table=	` <table class="table table-bordered ">
			 <thead>
				 <tr class="font-weight-bold">
					 <th>IF</th>
					 <th>State</th>
					 <th>Value</th>
					 <th>Do</th>
					 <th>Field</th>
					 <th>Action</th>
				 </tr>
			 </thead>
			 <tbody id="condition_body">
			 </tbody>
			 </table>
			 `;
			   var modalhtml1 = `<div id='main-modal-view'>
		 <style>
		 .table{margin-top: 1vw;}
		 .w3-container,.w3-panel{padding:3.01em 16px;background:#ffffff;}.w3-panel{margin-top:16px;margin-bottom:16px}
		 .w3-modal{z-index:3;display:none;padding-top:90px;position:fixed;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.4)}
		 .w3-modal-content{margin:auto;background-color:#fff;position:relative;padding:0;outline:0;width:800px}
		 .w3-btn,.w3-button{border:none;display:inline-block;padding:8px 16px;vertical-align:middle;overflow:hidden;text-decoration:none;color:#000;background-color:inherit;text-align:center;cursor:pointer;white-space:nowrap;font-size: x-large;}
		 .w3-display-topright{position:absolute;right:0;top:0}
		 .w3-button:hover{color:#000!important;background-color:#ccc!important}
		 .w3-animate-top{position:relative;animation: animatetop 0.4s;}
			.w3-animate-top{position:relative;animation:animatetop 0.4s}@keyframes animatetop{from{top:-300px;opacity:0} to{top:0;opacity:1}}
		 </style>
		 <div class="w3-container">
		   <div id="viewhtml" class="w3-modal">
			 <div class="w3-modal-content w3-animate-top">
			 <div class="w3-container"> 
        <span id="close" class="w3-button w3-display-topright">&times;</span>
        <h2>All Condition Logics</h2>
		 		<div style = "float:right;">
        <button class="button" name="new" id="new" onclick="customlogicpopup()">Add New Condition Logic</button>
        </div>
        </div>
        <div class="w3-container" style = "height:380px;overflow-y:scroll;">
				 ${table}
				 </div>
			 </div>
		   </div>
		 </div>
		 </div>`;
			 $("body").append(modalhtml1);
				 document.getElementById('viewhtml').style.display='block';
				 var tr;
		       json.forEach(element => {
				  console.log("print")
				 var obj=element;
				 tr=$('<tr/>');
				 tr.append("<td>"+getLabel(obj.IF)+"</td>");
				 tr.append("<td>"+obj.State+"</td>");
				 tr.append("<td>"+capitalize(obj.Value)+"</td>");
				 tr.append("<td>"+capitalize(obj.Do)+"</td>");
				 if(obj.Do == "hide-multiple" || obj.Do=="show-multiple")
				 {
					tr.append("<td>"+getMultipleLabel((Array.isArray(obj.Field) ? obj.Field : obj.Field.split(',') ))+"</td>");
				 }else{
					tr.append("<td>"+getLabel(obj.Field)+"</td>");
				 }

				 tr.append(`
				 <td>
				  <button class='btn btn-sm btn-danger mr-1' onclick='deleteCondition(${obj.Id},${JSON.stringify(json)})'>Delete</button>
				  <button class='btn btn-sm btn-success' onclick='updateCondition(${obj.Id},${JSON.stringify(json)})'>Edit</button>
				 </td>
				 
				 `);
			 
				 $('#condition_body').append(tr);
				});
			}
		});
	
			   
			}
	
function deleteCondition(id,json)
{
	  Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	  }).then((result) => {
		if (result.isConfirmed) {
			let formid = $("#ruuid").val();
			let newjson=[];
			
			json.forEach(element => {
				if(element.Id != id){
					newjson.push(element);
				}
			});
		
			$.ajax({
				type: 'post',
				url: 'index.php?module=ht_formbuilder&action=updateLogicForm&sugar_body_only=true',
				data: {formid:formid,condition_description:JSON.stringify(newjson)},
				success: function (result) {
					if(result)
					{

					document.getElementById("main-modal-view").remove();
					viewcustomlogicpopup();


					let timerInterval
					Swal.fire({
						title: 'Deleted !',
						html: 'Your condition has been deleted',
						icon:'success',
						showConfirmButton: false,
						timer: 1800,
						willClose: () => {
							clearInterval(timerInterval)
						}
					}).then((result) => {
					/* Read more about handling dismissals below */
							if (result.dismiss === Swal.DismissReason.timer) {

				          	}
					});

					}else{
						let timerInterval
						Swal.fire({
							title: 'Failed to delete !',
							icon:'error',
							showConfirmButton: false,
							timer: 1800,
							willClose: () => {
								clearInterval(timerInterval)
							}
						}).then((result) => {
						/* Read more about handling dismissals below */
								if (result.dismiss === Swal.DismissReason.timer) {
	
								  }
						});
					}
					
				}
			});
					
		}
	  });
}
function updateCondition(id,json)
{
	
	document.getElementById("main-modal-view").remove();
	let mutiple=false;
	let formid = $("#ruuid").val();
	let condionalLogic;
	let updatejson = json;
	
		   updatejson.forEach(element => {
			if(element.Id == id)
			condionalLogic = element;					
	        });  

  
	if(condionalLogic.Do == "show-multiple" || condionalLogic.Do == "hide-multiple"){
			  mutiple=true;
			  condionalLogic.Field = (Array.isArray(condionalLogic.Field)) ? condionalLogic.Field : condionalLogic.Field.split(",");
	}
   
	
	let formRenderOpts = {
		dataType: 'xml',
		formData: `<form-template>
						<fields>
							<field type="select" required="true" label="IF" class-name="form-control" name="field-selected" id="field-selected" access="false" multiple="false"></field>
							<field type="select" required="true" label="State" class-name="form-control" name="field-state" access="false" multiple="false">
									<option label="Please Select State" selected="true" disabled = "true" value="">Please Select State</option>
									<option label="" selected="false" disabled = "false" value=""></option>
									<option label="Is Empty" value="isEmpty"  selected="${ condionalLogic.State =='isEmpty' ? 'true' : 'false'}" >Is Empty</option>
									<option label="Is Filled" value="isFilled" selected="${ condionalLogic.State =='isFilled' ? 'true' : 'false'}" >Is Filled</option>
									<option label="Is Equal To" value="isEqualTo"  selected="${ condionalLogic.State =='isEqualTo' ? 'true' : 'false'}">Is Equal To</option>
									<option label="Is Not Equal To" value="isNotEqualTo"  selected="${ condionalLogic.State =='isNotEqualTo' ? 'true' : 'false'}">Is Not Equal To</option>
							</field>
							<field type="select" required="true" label="Value" class-name="form-control" name="field-value" access="false" multiple="false">
									<option label="" value="" selected="true" disabled = "true">Please Select Value</option>
									<option label="" selected="false" disabled = "false" value=""></option>
									<option label="Yes" value="yes"  selected="${ condionalLogic.Value =='yes' ? 'true' : 'false'}">Yes</option>
									<option label="No" value="no"  selected="${ condionalLogic.Value =='no' ? 'true' : 'false'}">No</option>
							</field>
							<field type="select" required="true" label="DO" class-name="form-control" name="field-do" access="false" multiple="false">
									<option label="" value="" selected="true" disabled = "true">Please Select What Do</option>
									<option label="" disabled = "false" value=""></option>
									<option label="Hide" value="hide"  selected="${ condionalLogic.Do =='hide' ? 'true' : 'false'}">Hide</option>
									<option label="Show" value="show"  selected="${ condionalLogic.Do =='show' ? 'true' : 'false'}">Show</option>
									<option label="Hide Multiple" value="hide-multiple" selected="${ condionalLogic.Do =='hide-multiple' ? 'true' : 'false'}">Hide Multiple</option>
									<option label="Show Multiple" value="show-multiple" selected="${ condionalLogic.Do =='show-multiple' ? 'true' : 'false'}">Show Multiple</option>
							</field>
								<field type="select" required="true" label="FIELD" class-name="form-control" name="field-selected2" access="false" multiple="${mutiple}">
							</field>
						</fields>
					</form-template>`
		};


	let $renderContainer = $('<form/>');
	$renderContainer.formRender(formRenderOpts);
	var modalhtml = `<div id='main-modal-view'>
<style>
.w3-container,.w3-panel{padding:2.01em 16px;background:#ffffff;}.w3-panel{margin-top:16px;margin-bottom:16px}
.w3-modal{z-index:3;padding-top:100px;position:fixed;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.4)}
.w3-modal-content{margin:auto;background-color:#fff;position:relative;padding:0;outline:0;width:875px}
.w3-btn,.w3-button{border:none;display:inline-block;padding:8px 16px;vertical-align:middle;overflow:hidden;text-decoration:none;color:#000;background-color:inherit;text-align:center;cursor:pointer;white-space:nowrap;font-size: x-large;}
.w3-display-topright{position:absolute;right:0;top:0}
.w3-button:hover{color:#000!important;background-color:#ccc!important}
.w3-animate-top{position:relative;animation: animatetop 0.4s;}
.w3-animate-top{position:relative;animation:animatetop 0.4s}@keyframes animatetop{from{top:-300px;opacity:0} to{top:0;opacity:1}}
footer{width:auto;background-color:unset;}
</style>
<div class="w3-container">

	<div id="showhtml" class="w3-modal">
	<div class="w3-modal-content w3-animate-top">
	<div class="w3-container"> 
		<span id='close' class="w3-button w3-display-topright">&times;</span>
		<h2>Update Condition Logic</h2>
		<div style = "float:right;">
        <button class="button" name="view" id="view" onclick="viewcustomlogicpopup()">Back</button>
        </div>
        <p class = "error-message" style="color:red;"><p>
        <p class = "success-message" style="color:green;"><p>
		</div>
		<div class="w3-container"> 
		<form id = "update-logic-form">
			${$renderContainer.html()}
			<footer>
			<input type='hidden' id='record-to-be-updated' value=''> 
			<input type = "submit" id= "update-logicbtn" name="update-logic" value="Update">
			</footer>
			</form>
		</div>
	</div>
	</div>
</div>
</div>`;
$("body").append(modalhtml);
if(condionalLogic.State =="isEmpty" || condionalLogic.State == "isFilled")
	{
		
		$("#field-value").parent().hide();
	}
	$(".form-group").addClass("col-lg-4");
	$(".rendered-form .form-control").css("width","90%");
	$("#field-state").on("change",function(){
		var state = $(this).val();
		if(state == 'isEmpty')
		{
			$("#field-value").parent().hide();
		}
		else
		{
			$("#field-value").parent().show();
		}
	});
	$("#field-do").on("change",function(){
		var did = $(this).val();
		
		if(did == "hide-multiple" || did == "show-multiple")
		{
			$("#field-selected2").attr("multiple","multiple");
		}
		else
		{
			$("#field-selected2").removeAttr("multiple","multiple");
		}
		});
	var form_rendering_json = formBuild.actions.getData('json');
	let decode = JSON.parse(form_rendering_json);
	$("#field-selected").empty();
	$('#record-to-be-updated').val(condionalLogic.Id)
	$("#field-selected2").empty();
	$("#field-selected").append('<option label="Please Select Field" value="" disabled></option>');
	$("#field-selected2").append('<option label="Please Select Field" value=""  disabled></option>');
	$("#field-value").empty();
	decode.forEach((item, index)=>{
		$("#field-selected").append(`<option label="${item.label}" value="${item.name}" ${condionalLogic.IF == item.name ? 'selected': ''}>${item.label}</option>`);

    	if(item.values){
				$.each(item.values, function(index, value) {
			  console.log(value.value);
			  $("#field-value").append(`<option label="${value.label}" value="${value.value}" ${condionalLogic.Value == value.value ? 'selected': ''}>${value.label}</option>`);
			  // Will stop running after "three"
			});	
	}
    			// }
		if(mutiple)
		{
			$("#field-selected2").append(`<option label="${item.label}" value="${item.name}" ${checkIfItMatchesArrayOfMultipleField(condionalLogic.Field,item.name) ? 'selected': ''}>${item.label}</option>`);
		}else{
			$("#field-selected2").append(`<option label="${item.label}" value="${item.name}" ${condionalLogic.Field == item.name ? 'selected': ''}>${item.label}</option>`);
		}
		
	});
$("#field-selected").on('change', function(){
    		let if_val = $(this).val();
    		$.each(decode, function(index, value) {
    			if(value.name == if_val){
    				console.log(if_val);
    				if(value.values){
    		$("#field-value").empty();
				$.each(value.values, function(index, value) {
			  console.log(value.value);
			  $("#field-value").append('<option label="'+value.label+'" value="'+value.value+'">'+value.label+'</option>');
			  // Will stop running after "three"
			});	
	}
    			}
  
  // Will stop running after "three"
			});	
  })
	// Sending ajax on submitting
$('body').on('submit','form#update-logic-form', function (e) {
	e.preventDefault();
    // Getting the data in serializeArray
	let formData = ($('form#update-logic-form').serializeArray())
	let formDataObject={};
	let mutiple_update = false;
	let idToMatch =parseInt($("#record-to-be-updated").val());
  
	 
	// Getting it into a single array
	formData.forEach(element => {

		if(element.name.indexOf('[]') > -1 || formDataObject.field_selected2)
		{
			formDataObject[capitalize(element.name.replace("field-selected2","Field").replace("[]",''))] +=`${element.value},`;
	
		}else{

			if(element.name == "field-selected2")
			{
				formDataObject[capitalize(element.name.replace("field-selected2","Field"))] += `${element.value},`;

			}else if(element.name == "field-selected"){
				formDataObject[capitalize(element.name.replace("field-selected","IF"))] = element.value;
			}else{
				formDataObject[capitalize(element.name.replace("field-",""))] = element.value;
			}
			
		}
		
	});
	formDataObject['Id'] = idToMatch;

	// Coreectign the field array
	for (key in formDataObject) {
		 if(key == "Field")
		 {
			 formDataObject[key] = formDataObject[key].replace('undefined','').trim().slice(0, -1);
		 }
	  }

	  let formid = $("#ruuid").val();
 $.ajax({
            type: 'post',
            url: 'index.php?module=ht_formbuilder&action=updateNewLogicForm&sugar_body_only=true',
            data: {formid:formid,updated_record:JSON.stringify(formDataObject)},
            success: function (result) {
            	if(result=='true')
            	{
					if($('.error-message'))
					$('.error-message').remove();

					let timerInterval
					Swal.fire({
						title: 'Updated !',
						html: 'Your condition has been updated',
						icon:'success',
						showConfirmButton: false,
							timer: 1800,
						willClose: () => {
							clearInterval(timerInterval)
						}
					}).then((result) => {
					/* Read more about handling dismissals below */
							if (result.dismiss === Swal.DismissReason.timer) {
									
				          	}
							  
					});	

           		}
				   
				   else if(result=='error')
				   {
					   $(".error-message").text("");
					   $(".success-message").text("");
					   $(".error-message").text("Condition Already Applied On This Record");
				   }  
				   else{

					let timerInterval
						Swal.fire({
							title: 'Failed to update !',
							icon:'error',
							showConfirmButton: false,
							timer: 1800,
							willClose: () => {
								clearInterval(timerInterval)
							}
						}).then((result) => {
						/* Read more about handling dismissals below */
								if (result.dismiss === Swal.DismissReason.timer) {
								  }
						});         
				}	
            }
          });
		  e.stopImmediatePropagation();

  });
			 
		
	

}
$('body').on('click', 'span#close', function() {
    document.getElementById("main-modal-view").remove();
});

function getLabel(obj)
{
	let label;
	var form_rendering_json = formBuild.actions.getData('json');
	let decode = JSON.parse(form_rendering_json);
	decode.forEach(element => {
		
		if(element.name == obj)
		{
			label = element.label;
		}
	});

	return label;
}
function capitalize(s)
{
	if(s== undefined || s==null ||s=='')
	return null;

    return s[0].toUpperCase() + s.slice(1);
}

function getMultipleLabel(fields)
{
	let retString='';
	fields.forEach(element=>{
        retString+=`${getLabel(element)} <br>`;
	});
	return retString;
}

function checkIfItMatchesArrayOfMultipleField(fields,name)
{
    let matches = false;
	fields.forEach(element=>{
		if(element==name){
		     matches = true;
		}
	});
      
	return matches;
}
function getTypeForm(type)
{
	let question_type = $("#question_type").val();
	$("#name").parent().parent().show();
  let case_type;
	let rel_module_old = document.getElementById("related_module").value;
	if(type == "case_type")
	 {
		 case_type = $("#case_type").val();
	 }else if(type == "case_sub_type")
	 {
		 case_type = $("#case_sub_type").val();
	 }
	 if(case_type)
	 {
	$("#name").parent().parent().show();
		$.ajax({
			url: "index.php?module=ht_formbuilder&action=getIntakeForum&sugar_body_only=true&type_id="+type,
			type: "post",
			data: {case_type: case_type,question_type:question_type, rel_module_old: rel_module_old },
			success: function (result) {

				var decode = JSON.parse(result);
				if (decode == false) {
					$("#name").val('');
					$("input[name='record']").val('');
					$(".form-builder").remove();
					loadTreeDataNew($("#related_module").val());
				}
				else {
					existingFormId = decode.id;
					$(".form-builder").remove();
					$("form#EditView #description").html(decode.description)
					$("#name").val(decode.name);
					$("#column_size").val(decode.column_size);
					$("#ruuid").val(decode.id);
					loadTreeData(decode.related_module);
				}
			}
		});
	}
	else {
		$("#intakeformdiv").empty();
	}
}