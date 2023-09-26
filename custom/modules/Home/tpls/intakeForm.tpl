
<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>

<form action = "" name="caseintakeform" id="caseintakeform" method="post">
<h1>Create New Intake</h1>
<div><label for = "casetypeoptions">Case Type:</label>
<input type="hidden" id="search_module" value="{$search_module}">
<select name = "casetype" id="casetype">{$intakeform_type_list}</select>
</div>
<br>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="edit view">
	 <tr>
		<td  scope="row" width="100">
		<div id="statediv" style = "display:none;"><label for = "stateoptions">Did this accident happens in Florida?</label>
            <select name = "state" id="state">{$states_list}</select>
            </div>
            <div id = "intakeformdiv"></div>
		</td>
	 </tr>
</table>
<br>
<div id = "case-type-heading-div"><h1 id = "case-type-heading-text"></h1></div>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="edit view">
	 <tr>
		<td  scope="row" width="100">
            <div id = "specificformdiv" style = "display:none;"></div>
		</td>
	 </tr>
</table>
<br>
<input type = "button" name="savecaseForm" id="savecaseForm" value = "Save"/>
<input type = "button" name="resetcaseForm" id=resetcaseForm" value = "Cancel"/>
</form>

{sugar_getscript file="custom/modules/Home/js/intakeform.js"}
{sugar_getscript file="modules/ht_formbuilder/ht_formbuilder_utils.js"}
{sugar_getscript file="modules/ht_formbuilder/js/sweetAlert.js"}