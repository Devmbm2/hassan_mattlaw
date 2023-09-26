<link href="custom/include/multiselect/multiselect.css" rel="stylesheet" />
<link href='custom/include/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'/>
<script type="text/javascript" src="custom/include/multiselect/multiselect.js"></script>
<script type='text/javascript' src='https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js'></script>
<script type="text/javascript" src="modules/ht_formbuilder/js/sweetAlert.js"></script>
{literal}
<style>
.row
{
	margin-bottom:15px;
}
form
{
	margin:0px 20px;
}
</style>
{/literal}
<h1>Setting Default Time or Estimated Time for a case</h1>
<form action="index.php?module=Cases&action=caseTime" method="POST" entype="multipart/form-data">
<div class = "row" style = "margin-bottom:30px;">
<div class = "">
<label> Select Cases: </label>
<select id = "case_time" name = "case_time">
{foreach from=$CasesList item=item key=key}
<option value = "{$key}">{$item}</option>
{/foreach}
</select>
</div>
</div>
<div class = "row">
<div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class = "col-lg-3">
<label style = "Padding-right:30px;"> Attorney Time: </label>
</div>
<div class = "col-lg-9">
<input class = "form-control" type = "number" name="attorney_hours" id="attorney_hours" style = "width:10%; display:inline-block;" min="0"/>
&nbsp;:
<input class = "form-control" type = "number" name="attorney_minutes" id="attorney_minutes" style = "width:10%;display:inline-block;" min="0"/>
</div>
</div>
</div>
<div class = "row">
<div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class = "col-lg-3">
<label style = "Padding-right:30px;"> Paralegal Time: </label>
</div>
<div class = "col-lg-9">
<input class = "form-control" type = "number" name="paralegal_hours" id="paralegal_hours" style = "width:10%; display:inline-block;" min="0"/>
&nbsp;:
<input class = "form-control" type = "number" name="paralegal_minutes" id="paralegal_minutes" style = "width:10%;display:inline-block;" min="0"/>
</div>
</div>
</div>
<div class = "row">
<div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class = "col-lg-3">
<label style = "Padding-right:30px;"> Legal Assistant Time: </label>
</div>
<div class = "col-lg-9">
<input class = "form-control" type = "number" name="legal_assistant_hours" id="legal_assistant_hours" style = "width:10%; display:inline-block;" min="0"/>
&nbsp;:
<input class = "form-control" type = "number" name="legal_assistant_minutes" id="legal_assistant_minutes" style = "width:10%;display:inline-block;" min="0"/>
</div>
</div>
</div>
<div class = "row">
<div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class = "col-lg-3">
<label style = "Padding-right:30px;"> IT Document filing and organizing time: </label>
</div>
<div class = "col-lg-9">
<input class = "form-control" type = "number" name="document_hours" id="document_hours" style = "width:10%; display:inline-block;" min="0"/>
&nbsp;:
<input class = "form-control" type = "number" name="document_minutes" id="document_minutes" style = "width:10%;display:inline-block;" min="0"/>
</div>
</div>
</div>
<br>
<br>
<div class = "row" style = "margin: 0;">
<input type = "submit" name = "save" id = "save" value = "Save"/>
<input type = "reset" name = "cancel" id = "cancel" value = "Cancel"/>
</div>
</form>
{literal}
<script>
$(document).on("change","#case_time",function(){
	var case_ID = $(this).val();
	if(case_ID){
	$.ajax({
    url: 'index.php?module=Cases&action=getCaseTime',
    type: 'POST',
    data:{case_id:case_ID,sugar_body_only:true},
    success: function(response) {
    console.log(response);
    var decoder = JSON.parse(response);
    $.each(decoder,function(k,v){
    $("#attorney_hours").val(v.attorney_time_hour);
    $("#attorney_minutes").val(v.attorney_time_minute);
    $("#paralegal_hours").val(v.paralegal_time_hour);
    $("#paralegal_minutes").val(v.paralegal_time_minute);
    $("#legal_assistant_hours").val(v.legal_time_hour);
    $("#legal_assistant_minutes").val(v.legal_time_minute);
    $("#document_hours").val(v.document_time_hour);
    $("#document_minutes").val(v.document_time_minute);
    })
      
    }
  });
	}


})

</script>
{/literal}
