<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
<form action = "" name="caseintakeform" id="caseintakeform" method="post">
<h1>Create New Intake</h1>
<div><label for = "casetypeoptions">Case Type:</label>
<select name = "casetype" id="casetype">{$case_type_list}</select>
</div>
<br>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="edit view">
	 <tr>
		<td  scope="row" width="100">
            <div id = "intakeformdiv"></div>
		</td>
	 </tr>
</table>
<br>
<input type = "button" name="savecaseForm" id="savecaseForm" value = "Save"/>
</form>
{literial}
<script type="text/javascript">
$(document).ready(function() { 
alert("1");

});
</script>
{/literial}
{sugar_getscript file="custom/modules/Cases/js/caseform.js"}
{sugar_getscript file="modules/ht_formbuilder/ht_formbuilder_utils.js"}
