<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
<form action = "index.php?module=Cases&&action=sol" name="statueoflimitform" id="statueoflimitform" method="post" >
<h1>Set Statue of limitation</h1>
 <label for = "statesdom"  style="font-weight: bold; font-size:15px; bordered ">State</label>
<select name="states_dom" id="states_dom" required="true">{$states_dom}</select>

<div id="tablediv" class="">
<br>
<input type = "submit" name="savecaseForm" id="savecaseFormupper" class="savecaseForm" value = "Save"/>

<table class="table table-bordered table-responsive " id="tableid" style="margin-top: 5px; ">
           <thead>    
			<tr  style="font-weight: bold; font-size:15px; bordered " >
				<th style="text-align: left">Case Types</th>
                <th style="text-align: left">SOL Category</th>
                <th style="text-align: left">SOL</th>
               
            </tr>
        </thead>
        <tbody id="statue_body">

		{foreach from=$complaint_type_list item=item key=key}
			<tr  class="trclass">
			<td><input name="case_type[]" value="{$key}" readonly id="case_type" style="font-weight: bold; font-size:15px; width: 350px;"></td>
			<td ><select name = "sol_category[]" id="sol_category">{$sol_category}</select>
			<td ><select name = "sol_time[]" id="sol_time">{$sol_time}</select>
			</td>
			</td>
		
			</tr>
		{/foreach} 
        </tbody>
        </table>
		</div>
<br>

<input type = "submit" name="savecaseForm" id="savecaseFormlower" class="savecaseForm" value = "Save"/>
</form>
{sugar_getscript file="custom/modules/Cases/js/caseform.js"}
{sugar_getscript file="custom/modules/Cases/js/statue.js"}
{sugar_getscript file="modules/ht_formbuilder/ht_formbuilder_utils.js"}
{sugar_getscript file="modules/ht_formbuilder/js/sweetAlert.js"}

{literal}
	<style>
	table, th, td {
  border: 1px solid rgb(211, 6, 6);
}
	
	</style>
	{/literal}