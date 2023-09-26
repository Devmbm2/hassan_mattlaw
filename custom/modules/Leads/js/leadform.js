$(document).ready(function(){
	$(document).on('change','#casetype',function(){
		var case_type = $(this).val();
		// alert(case_type);
		if(case_type!=="")
		{
		$.ajax({
            url:"index.php?module=Leads&action=getCaseType&sugar_body_only=true",   
            type: "post",
            // dataType: 'json',
            data: {case_type: case_type},
            success:function(result){
				var decode = JSON.parse(result);
				if(decode!="")
				{
					
					var id = decode.id;
					var description = decode.description;
					var column_size = decode.column_size;
					var convert_desc = description.replaceAll('&quot;', '"');
					var html = renderForm(convert_desc);
					$("#intakeformdiv").empty();
					$("#intakeformdiv").append(html);
					$("#epformbuilder").val(id);
					$(".rendered-form").addClass("container");
					if("column_size")
					{
						$(".form-group").addClass(column_size);
					}
					else
					{
					$(".form-group").addClass("col-lg-12");
					}
				}
				else
				{
					$("#intakeformdiv").empty();
				}
			}
        });
	}
	else
	{
		$("#intakeformdiv").empty();
	}
	});
	$(document).on('click','#saveleadForm',function(){
		var site_url = window.location.protocol+window.location.hostname+window.location.pathname;
		var testid = $("#epformbuilder").val();
		document.leadintakeform.action = "?entryPoint=FormDataEntryPoint&id="+testid;
		var form = document.getElementById("leadintakeform");
		form.submit();
		// return window.location.href = '?entryPoint=FormDataEntryPoint&id='+testid;
	});
});