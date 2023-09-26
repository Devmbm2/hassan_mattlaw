var wrongful_string_value, wrongful_string_option;
$(document).ready(function(){
	$(document).on('change','#casetype',function(){
		var case_type = $(this).val();
		 $("#casetype option[value='"+wrongful_string_value+"']").remove();
		let search_module = document.getElementById("search_module").value;
		$("#specificformdiv").empty();
		$("#case-type-heading-text").text("");
		// alert(case_type);
			if(case_type!=="")
			{
		$.ajax({
            url:"index.php?module=Home&action=getCaseType&sugar_body_only=true",   
            type: "post",
            // dataType: 'json',
            data: {case_type: case_type,search_module:search_module},
            success:function(result){
				var decode = JSON.parse(result);
				if(decode!="")
					{
					var id = decode.id;
					var description = decode.description;
					var column_size = decode.column_size;
					let condition_description = decode.condition_description;
						if(condition_description){
						var convert_condition_description = condition_description.replaceAll('&quot;', '"');
						var decode2 = JSON.parse(convert_condition_description);
						}
					var convert_desc = description.replaceAll('&quot;', '"');
					var html = renderForm(convert_desc);
					$("#intakeformdiv").empty();
					$("#statediv").css("display","block");
					$("#intakeformdiv").append(html);
					$("#epformbuilder").val(id);
						if("column_size")
						{
							$(".form-group").addClass(column_size);
							$(".rendered-form .form-control").css("width","90%");
							$("input[type=text], textarea").css("margin","0%");
						}
						else
						{
						$(".form-group").addClass("col-lg-12");
						$("input[type=text], textarea").css("margin","0%");
						}
					}
					else
					{
						$("#intakeformdiv").empty();
						$("#statediv").css("display","none");
					}
						if(decode2)
						{
						decode2.forEach(checkCondition);
						}
				$("select[name='assigned-lawyer']").parent().css("display","none");	
		}
        });
       
		}
		else
		{
			$("#intakeformdiv").empty();
			$("#statediv").css("display","none");
		}
	});
	$(document).on('change',"input[shape = 'date_of_incident_c']",function(){
		// console.log("here");
		
		if ($(this).val() != ''){


		if($("select[shape = 'case_sub_type']").val() != '')
		{
		var case_type = $("#casetype").val();
		let search_module = document.getElementById("search_module").value;
		case_type_option =  $("#casetype option:selected");
		let case_type_option_string = "Case Information";
		// $("#case-type-heading-text").show();
		$("#case-type-heading-text").text(case_type_option.text()+" "+ case_type_option_string);
		// alert(case_type);
			if(case_type!=="")
			{
		$.ajax({
            url:"index.php?module=Home&action=getSpecificIntakeForm&sugar_body_only=true",   
            type: "post",
            // dataType: 'json',
            data: {case_type: case_type,search_module:search_module},
            success:function(result){
            	var decode = '';
				 decode = JSON.parse(result);
				if(decode!="")
				{
					
					var id = decode.id;
					var description = decode.description;
					var column_size = decode.column_size;
					var convert_desc = description.replaceAll('&quot;', '"');
					let condition_description = decode.condition_description;
					if(condition_description){
					var convert_condition_description = condition_description.replaceAll('&quot;', '"');
					var decode2 = JSON.parse(convert_condition_description);
					}
					var html = renderForm(convert_desc);
					$("#specificformdiv").empty();
					$("#specificformdiv").append(html);
					$("#epspecficformbuilder").val(id);
					$("#specificformdiv").css("display",'block');
					if("column_size")
					{
						$(".form-group").addClass(column_size);
						$(".rendered-form .form-control").css("width","90%");
						$("input[type=text], textarea").css("margin","0%");
					}
					else
					{
					$(".form-group").addClass("col-lg-12");
					$("input[type=text], textarea").css("margin","0%");
					}

					
				}
				else
				{
					$("#specificformdiv").empty();
					$("#specificformdiv").css("display",'none');
				}
				if(decode2)
				{
				decode2.forEach(checkCondition);
				}
				
		}
        });
       
		}
		else
		{
			$("#specificformdiv").empty();
			$("#specificformdiv").css("display",'none');
		}
	}
	else{
		alert("Please Select Role to display Specific form for this case Type.");
	}
}
else{
	console.log("clear");
	$("#specificformdiv").empty();
	$("#specificformdiv").css("display",'none');
	$("#case-type-heading-text").text("");
}
	});
	$(document).on('click','#savecaseForm',function(){
		let errDetail = [];
		let canSubmit = true;
		var testid = $("#epformbuilder").val();
		var specificId = $("#epspecficformbuilder").val();
		let radio;
		  if(testid && specificId){
		document.caseintakeform.action = "?entryPoint=FormDataEntryPoint&id="+testid+"&specificid="+specificId;
			}
			else
			{
				alert("Please Fill the Specific Form before saving!");
			}
		// Checking the requeird fiedls
		const forms = document.querySelectorAll('form#caseintakeform');
        const form = forms[0];

        Array.from(form.elements).forEach((input) => {
       
		if(input.hasAttribute('required')){
			if(input.getAttribute('type') == "radio"){
			   radio = document.getElementsByName(input.getAttribute('name'));
			   errDetail["radio"] = false;
			   for (let i = 0; i < radio.length; i++) {
				if(radio[i].checked){
					errDetail["radio"] = true;
				}	
			}

			if(!errDetail["radio"])
			{
                   // Remove previous element
				if(input.parentElement.parentElement.nextElementSibling)
				input.parentElement.parentElement.nextElementSibling.remove();

				input.parentElement.parentElement.parentElement.append(createErr("radio"))
			}else{
                 
				// Remove previous element
				if(input.parentElement.parentElement.nextElementSibling)
				input.parentElement.parentElement.nextElementSibling.remove();

				errDetail["radio"] = true;
			}

			}else if(input.getAttribute("type") == "checkbox"){
				let checkboxes = document.getElementsByName(input.getAttribute('name'));
				errDetail["checkbox"] = false;
				for (let i = 0; i < checkboxes.length; i++) {
				 if(checkboxes[i].checked){
					 errDetail["checkbox"] = true;
				 }	


		    if(!errDetail["checkbox"])
			{
                   // Remove previous element
				if(input.parentElement.parentElement.nextElementSibling)
				input.parentElement.parentElement.nextElementSibling.remove();

				input.parentElement.parentElement.parentElement.append(createErr("checkbox"))
			}else{
                 
				// Remove previous element
				if(input.parentElement.parentElement.nextElementSibling)
				input.parentElement.parentElement.nextElementSibling.remove();

				errDetail["checkbox"] = true;
			}
			 }
 
			}else if((input.value).trim()==''){
		                	errDetail[input.getAttribute("id")] = false;
							// Remove previous element
							if(input.nextElementSibling)
							input.nextElementSibling.remove();
							if(input.getAttribute("type") == "date")
							{
								$(createErr("date")).insertAfter(input);
							}else if(input.getAttribute("type") == "file"){
								$(createErr("file")).insertAfter(input);
							}else{
								$(createErr()).insertAfter(input);
							}
							
          
      		} else{
                    
							// Remove previous element
							if(input.nextElementSibling)
							input.nextElementSibling.remove();
		
							errDetail[input.getAttribute("id")] = true;
						 }
		}
        });
        if(Object.keys(errDetail).length)
			{
			for (let x in errDetail) {
				if(errDetail[x]==false)
				{
					canSubmit=false;
					break;
				}
			  }
			}

		// Submiting the form
         if(canSubmit)
		 	{
			form.submit();
			 }
	});
	$(document).on('click',"input[name='resetcaseForm']",function(){
		Swal.fire({
		title: 'Are you sure you want to cancel this lead?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: 'rgb(237 208 61)',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, Cancel it!'
	  }).then((result) => {
		if (result.isConfirmed) {
		$( 'form#caseintakeform' ).each(function(){
              this.reset();
            	})

		$("#intakeformdiv").empty();
		$("#specificformdiv").empty();
	   $("#case-type-heading-text").text("");
	   $("#statediv").css("display","none");
	   Swal.fire(
      'Cancelled!',
      'Your lead has been cancelled.',
      'success'
    )
	}
	else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    Swal.fire(
      'Cancelled',
      'Your imaginary lead is safe :)',
      'error'
    )
  }
	});
	});

	$(document).on('change',"select[shape='case_sub_type']",function(){
		let case_sub_type = $(this).val();
		$("#casetype option[value='"+case_sub_type+"']").remove();
		$("input[shape='date_of_incident_c']").val('');
		// $("#casetype option:selected").remove();
		$("#casetype").append('<option value ="'+case_sub_type+'">'+SUGAR.language.languages.app_list_strings["case_type_list"][case_sub_type]+'</option>');
		$("#casetype").val(case_sub_type);
		$("#specificformdiv").empty();
	$("#specificformdiv").css("display",'none');
	$("#case-type-heading-text").text("");
	});

	$(document).on('change',"input[name='radio-group-wrongful-death']",function(){
		let add_hide_wrong = `<input type = "hidden" name="wrong-death" id="wrong-death" value="${$(this).val()}">`;
		$("#wrong-death").remove();
		$(this).parent().parent().append(add_hide_wrong);
		let wrongful_dealth_string_value = "_Death";
		let wrongful_dealth_option_string = "Wrongful Death";
		
		var case_type = $("#casetype").val();
		// alert(case_type);
		let check_wrongful = $("input[name='radio-group-wrongful-death").prop("checked");
		if(check_wrongful==true)
		{
			 wrongful_string_value = $("#casetype").val()+wrongful_dealth_string_value;
			 // wrongful_string_option =  $("#casetype option:selected");
			 $("#casetype option[value='"+wrongful_string_value+"']").remove();
			 // $("#casetype").append('<option value ="'+wrongful_string_value+'">'+wrongful_string_option.text()+" "+wrongful_dealth_option_string+'</option>');
				$("#casetype").append('<option value ="'+wrongful_string_value+'">'+SUGAR.language.languages.app_list_strings["case_type_list"][wrongful_string_value]+'</option>');
				$("#casetype").val(wrongful_string_value);
		}
		else
		{
			if(wrongful_string_value)
			{  
			// 	alert("1");
			// var return_case_type = wrongful_string_value.replace(wrongful_dealth_string_value, '');
			 $("#casetype option[value='"+wrongful_string_value+"']").remove();

			 let case_sub_type = $("select[shape='case_sub_type']").val();
			 $("#casetype").val(case_sub_type);
		    }
		}
	});
	
	$(document).on('change',"#state",function(){
		let case_type = $("#casetype").val();
		 if($(this).val()!='FL' && case_type!='Mass_Tort')
		         {		
		         	$("select[name='assigned-lawyer']").parent().css("display","block");
		         }
		         else
		         {
		         	$("select[name='assigned-lawyer']").parent().css("display","none");
		         }
	});
});
	
function createErr(type)
{
	let errEl = document.createElement("span");
	let errMess;
	switch (type) {
		case 'checkbox':
		    errMess = document.createTextNode("Please choose option");
			break;
		case 'radio':
			errMess = document.createTextNode("Please choose option");
			break;
			
		case 'date':
			errMess=document.createTextNode("Please choose date first")
			break;	

		case 'file':
			errMess=document.createTextNode("Please upload a file first")
			break;	
	
		default:
			errMess=document.createTextNode("Please fill this field first")
			break;
	}
	
	errEl.classList.add('text-danger','font-weight-bolder')
	errEl.append(errMess);
	return errEl;
}

function checkCondition(item, index)
{
	switch (item.State)
	{
		case 'isEmpty':
		{
			if(item.Do == 'hide')
			{
				if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
				{
						if($("#"+item.IF).val().length==0)
						{
							// $("input[name="+item.Field+"]").parent().hide();
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
									}
								}
						}
						else{
								if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
									}
								}
						}		
			    }
			    else
			    {
			    	// $("#"+item.Field).parent().hide();
			    	// $("input[name="+item.Field+"]").parent().hide();
			    	if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
									}
								}
			    }
			}
			else if(item.Do == 'show')
			{
				if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
				{
						if($("#"+item.IF).val().length>0)
						{
							// $("#"+item.Field).parent().show();
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
									}
								}
						}
						else{
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
									}
								}
						}	
			    }
			    else
			    {
					// $("#"+item.Field).parent().show();
			    	if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
									}
								}
				}
			}
			else if(item.Do == 'hide-multiple')
			{
				if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
				{
					// $("#"+item.IF).on("keyup",function(){
						if($("#"+item.IF).val().length==0)
						{
							
							let explodebrk = item.Field.split(',');
				explodebrk.forEach((field)=>{
					console.log(field);
					// $("#"+field).parent().hide();
					
					if($("input[name="+field+"]").attr("type")=='radio' )
				{
					$("input[name="+field+"]").parent().parent().parent().hide();
				}
				
				else{
					if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
					$("input[name='"+field+"[]']").parent().parent().parent().hide();
				}
				else{
					$("input[name="+field+"],select[name="+field+"]").parent().hide();
				}
				}
				})
						}
						else
						{
								let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
							console.log(field);
							// $("#"+field).parent().hide();
					
									if($("input[name="+field+"]").attr("type")=='radio')
								{
									$("input[name="+field+"]").parent().parent().parent().show();
								}
								else{
									if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().show();
								}
								else{
									$("input[name="+field+"],select[name="+field+"]").parent().show();
								}
							}
								})
						}
					// })		
			    }
				
			}
			else if(item.Do == 'show-multiple')
			{
				if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
				{
					// $("#"+item.IF).on("keyup",function(){
						if($("#"+item.IF).val().length>0)
						{
							let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
							console.log(field);
							// $("#"+field).parent().hide();
					
								if($("input[name="+field+"]").attr("type")=='radio')
							{
								$("input[name="+field+"]").parent().parent().parent().show();
							}
							else{
								if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().show();
								}
								else{
								$("input[name="+field+"],select[name="+field+"]").parent().show();
							}
						}
							})
						}
						else
						{
								let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
							console.log(field);
							// $("#"+field).parent().hide();
					
									if($("input[name="+field+"]").attr("type")=='radio')
								{
									$("input[name="+field+"]").parent().parent().parent().hide();
								}
								else{
									if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().hide();
								}
								else{
									$("input[name="+field+"],select[name="+field+"]").parent().hide();
								}
							}
								})
						}
					// })		
			    }
				
			}
		}
		break;
		case 'isEqualTo':
		{
					// console.log(item.IF);
			    $("input[name="+item.IF+"],select[name="+item.IF+"],input[type='checkbox']").on('change',function(){
			    	var currentValue = $(this).val();
			    	var value = item.Value;
			    	// console.log(value);
				if(currentValue == value)
				{
					// if(item.Id == index )
					// {
						// $("#"+item.Field).parent().show();
						if(item.Do == 'hide')
						{
							// $("#"+item.Field).parent().hide();
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
									}
								}
						}
						else if(item.Do == 'show')
						{
							// $("#"+item.Field).parent().show();
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
									}
								}
				    }
				    	else if(item.Do == 'hide-multiple')
						{
							let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
								// $("#"+field).parent().hide();
								if($("input[name="+field+"]").attr("type")=='radio')
									{
										$("input[name="+field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+field+"],select[name="+field+"]").parent().hide();
									}
								}
							})
							
						}
						else if(item.Do == 'show-multiple')
						{
							let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
								// $("#"+field).parent().show();
								if($("input[name="+field+"]").attr("type")=='radio')
									{
										$("input[name="+field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+field+"],select[name="+field+"]").parent().show();
									}
								}
							})
							
						}
				    // }
				}
				
			})
		}
		break;
		case 'isNotEqualTo':
		{
					// console.log(item.IF);
			    $("input[name="+item.IF+"],select[name="+item.IF+"],input[type='checkbox']").on('change',function(){
			    	var currentValue = $(this).val();
			    	var value = item.Value;
			    	// console.log(value);
				if(currentValue != value)
				{
					// if(item.Id == index )
					// {
						// $("#"+item.Field).parent().show();
						if(item.Do == 'hide')
						{
							// $("#"+item.Field).parent().hide();
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
									}
								}
						}
						else if(item.Do == 'show')
						{
							// $("#"+item.Field).parent().show();
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
									}
								}
				    }
				    	else if(item.Do == 'hide-multiple')
						{
							let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
								// $("#"+field).parent().hide();
								if($("input[name="+field+"]").attr("type")=='radio')
									{
										$("input[name="+field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+field+"],select[name="+field+"]").parent().hide();
									}
								}
							})
							
						}
						else if(item.Do == 'show-multiple')
						{
							let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
								// $("#"+field).parent().show();
								if($("input[name="+field+"]").attr("type")=='radio')
									{
										$("input[name="+field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+field+"],select[name="+field+"]").parent().show();
									}
								}
							})
							
						}
				    // }
				}
				
			})
		}
		break;
		case 'isFilled':
		{
			if(item.Do == 'hide')
			{
				if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
				{
					$("#"+item.IF).on("keyup",function(){

						if($("#"+item.IF).val().length==0)
						{
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
									}
								}
							// $("#"+item.Field).parent().hide();
						}
						else{
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
									}
								}
						}
							
					})		
			    }	
						}
			// }
			else if(item.Do == 'show')
			{
				if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
				{
					$("#"+item.IF).on("keyup",function(){
						if($("#"+item.IF).val().length>0)
						{
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
									}
								}
							// $("#"+item.Field).parent().show();
						}
						else{
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
									}
								}
						}
					})		
			    }
			}
			else if(item.Do == 'show-multiple')
			{
				if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
				{
					$("#"+item.IF).on("keyup",function(){
						if($("#"+item.IF).val().length>0)
						{
							let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
							console.log(field);
							// $("#"+field).parent().hide();
					
								if($("input[name="+field+"]").attr("type")=='radio')
							{
								$("input[name="+field+"]").parent().parent().parent().show();
							}
							else{
								if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().show();
								}
								else{
								$("input[name="+field+"],select[name="+field+"]").parent().show();
							}
						}
							})
						}
						else
						{
								let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
							console.log(field);
							// $("#"+field).parent().hide();
					
									if($("input[name="+field+"]").attr("type")=='radio')
								{
									$("input[name="+field+"]").parent().parent().parent().hide();
								}
								else{
									if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().hide();
								}
								else{
									$("input[name="+field+"],select[name="+field+"]").parent().hide();
								}
							}
								})
						}
					})		
			    }
			}
			else if(item.Do == 'hide-multiple')
			{
				if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
				{
					$("#"+item.IF).on("keyup",function(){
						if($("#"+item.IF).val().length==0)
						{
							
							let explodebrk = item.Field.split(',');
				explodebrk.forEach((field)=>{
					console.log(field);
					// $("#"+field).parent().hide();
					
					if($("input[name="+field+"]").attr("type")=='radio')
				{
					$("input[name="+field+"]").parent().parent().parent().hide();
				}
				else{
					if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().hide();
								}
								else{
					$("input[name="+field+"],select[name="+field+"]").parent().hide();
				}
			}
				})
						}
						else
						{
								let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
							console.log(field);
							// $("#"+field).parent().hide();
					
									if($("input[name="+field+"]").attr("type")=='radio')
								{
									$("input[name="+field+"]").parent().parent().parent().show();
								}
								else{
									if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().show();
								}
								else{
									$("input[name="+field+"],select[name="+field+"]").parent().show();
								}
							}
								})
						}
					})		
			    }
			}
		}
		break;
	}
}
