<link href="custom/include/multiselect/multiselect.css" rel="stylesheet" />
<link href='custom/include/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'/>
<script type="text/javascript" src="custom/include/multiselect/multiselect.js"></script>
<script type='text/javascript' src='https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js'></script>
<script type="text/javascript" src="modules/ht_formbuilder/js/sweetAlert.js"></script>
<h1>Setting User Restriction on Cases</h1>
<form action="index.php?module=Cases&action=restrictUser" method="POST" entype="multipart/form-data">
<div class "row">
<div class = "">
<label> Select Module: </label>
<br>
<select id = "modulelist" name = "modulelist">
{foreach from=$modulesList item=item key=key}
<option value = "{$key}">{$item}</option>
{/foreach}
</select>
</div>
<div class = "">
<label> Select Cases: </label>
<select id = "caseslist" name = "caseslist[]" multiple>
{foreach from=$CasesList item=item key=key}
<option value = "{$key}">{$item}</option>
{/foreach}
</select>
</div>
<div class = "">
<label> Select Contacts: </label>
<select id = "contactlist" name = "contactlist[]" multiple>
{foreach from=$ContactsList item=item key=key}
<option value = "{$key}">{$item}</option>
{/foreach}
</select>
</div>
<div class = "">
<label> Select Organizations: </label>
<select id = "accountlist" name = "accountlist[]" multiple>
{foreach from=$AccountsList item=item key=key}
<option value = "{$key}">{$item}</option>
{/foreach}
</select>
</div>
<div class = "">
<label> Select Users: </label>
<select id = "userslist" name = "userslist[]" multiple>
{foreach from=$UsersList item=item key=key}
<option value = "{$key}">{$item}</option>
{/foreach}
</select>
</div>
</div>
<br>
<br>
<div class = "row" style = "margin: 0">
<input type = "submit" name = "save" id = "save" value = "Save"/>
</div>
</form>
<br>
<br>
<table id="restrict_table" class = "table table-bordered" style="width:100%">
<thead>
<tr>
<th>
User
</th>
<th>
Case Name
</th>
<th>
Action
</th>
</tr>
</thead>
<tbody>
{foreach from=$RestrictedList item=item key=key}
<tr>
<td>
{$item.username}
</td>
<td>
{$item.casename}
</td>
<td>
<a href = "#" onclick = "unrestrictUser('{$item.userid}','{$item.caseid}');" style = "color:red;">Unrestrict</a>
</td>
</tr>
{/foreach}
</tbody>
</table>
<br>
<br>
<table id="restrict_table_contact" class = "table table-bordered" style="width:100%">
<thead>
<tr>
<th>
User
</th>
<th>
Contact Name
</th>
<th>
Action
</th>
</tr>
</thead>
<tbody>
{foreach from=$RestrictedListContacts item=item key=key}
<tr>
<td>
{$item.username}
</td>
<td>
{$item.contactname}
</td>
<td>
<a href = "#" onclick = "unrestrictUser('{$item.userid}','{$item.contactid}');" style = "color:red;">Unrestrict</a>
</td>
</tr>
{/foreach}
</tbody>
</table>
<br>
<br>
<table id="restrict_table_account" class = "table table-bordered" style="width:100%">
<thead>
<tr>
<th>
User
</th>
<th>
Organization Name
</th>
<th>
Action
</th>
</tr>
</thead>
<tbody>
{foreach from=$RestrictedListAccounts item=item key=key}
<tr>
<td>
{$item.username}
</td>
<td>
{$item.accountname}
</td>
<td>
<a href = "#" onclick = "unrestrictUser('{$item.userid}','{$item.accountid}');" style = "color:red;">Unrestrict</a>
</td>
</tr>
{/foreach}
</tbody>
</table>
{literal}
<script>
$(document).ready(function(){
	$("#caseslist").parent().hide();
 $("#contactlist").parent().hide();
 $("#accountlist").parent().hide();
 $("#restrict_table").hide();
$("#restrict_table_contact").hide();
$("#restrict_table_account").hide();
 $("#caseslist").multiselect({
	columns: 1,
	placeholder: "Select Case",
	search: true,
	selectAll: true
});
$("#contactlist").multiselect({
	columns: 1,
	placeholder: "Select Contact",
	search: true,
	selectAll: true
});
$("#accountlist").multiselect({
	columns: 1,
	placeholder: "Select Organization",
	search: true,
	selectAll: true
});
$("#userslist").multiselect({
	columns: 1,
	placeholder: "Select User",
	search: true,
	selectAll: true
});
$(".ms-options-wrap").css("width", "60%");
$(".ms-options").css("width", "60%");
$("#modulelist").css("width", "60%");

function unrestrictUser(userId,caseId){
	Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#edd03d',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Unrestrict this user!'
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = 'index.php?module=Cases&action=unrestrictUser&user_id='+userId+'&case_id='+caseId;
  }
})
}
$("#modulelist").on("change",function(){
	var module = $(this).val();
	console.log(module);
 if(module == 'Case'){
 $("#caseslist").parent().show();
 $("#restrict_table").DataTable();
 $("#restrict_table").show();
 $("#restrict_table_contact").hide();
 $("#restrict_table_account").hide();
 $("#contactlist").parent().hide();
 $("#accountlist").parent().hide();
 }
 else if(module == 'Contact'){
 $("#contactlist").parent().show();
 $("#restrict_table").hide();
  $("#restrict_table_contact").DataTable();
  $("#restrict_table_contact").show();
  $("#restrict_table_account").hide();
 $("#caseslist").parent().hide();
 $("#accountlist").parent().hide();
 }
 else if(module == 'Organization'){
 $("#accountlist").parent().show();
 $("#restrict_table").hide();
    $("#restrict_table_contact").hide();
    $("#restrict_table_account").DataTable();
    $("#restrict_table_account").show();
 $("#caseslist").parent().hide();
 $("#contactlist").parent().hide();
 }
 else{
 $("#caseslist").parent().hide();
 $("#contactlist").parent().hide();
 $("#accountlist").parent().hide();
 $("#restrict_table").hide();
$("#restrict_table_contact").hide();
$("#restrict_table_account").hide();
 }
})
})

</script>
<style>
table.dataTable tbody td
{
	text-align: center;
}
</style>
{/literal}
