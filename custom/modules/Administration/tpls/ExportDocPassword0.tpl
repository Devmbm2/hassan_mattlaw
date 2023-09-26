<form action="index.php?module=Administration&action=ExportDocPassword" method="POST" entype="multipart/form-data">
<div class = "container">
<div class = "row">
<div class = "col-xs-10 col-sm-11 col-md-11">
<div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Export Document Password Settings</h3>
          <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
        </div>
        <div class="panel-body">
        {if $wrong_password }
        <div class="alert alert-info" role="alert">
  {$wrong_password}
</div>
{/if}
        <div class="form-group row">
  <label for="current_pass" class="col-sm-2 col-form-label">Current Password:</label>
  <div class="col-sm-2">
  <input type = "password" name = "current_pass" id = "current_pass" value = "{$current_password}" class = "form-control" readonly/>
  {if $current_password == ''}
  <span><a href="#" onclick = "createForm();">create password</a><span>
  {else}
  <span><a href="#" onclick = "changeForm();">change password</a><span>
  {/if}
  </div>
</div>

<div class="form-group row">
  <label for="old_pass" class="col-sm-2 col-form-label">Old Password:</label>
  <div class="col-sm-2">
  <input type = "password" name = "old_pass" id = "old_pass" class = "form-control"/>
  </div>
</div>
<div class="form-group row">
  <label for="new_pass" class="col-sm-2 col-form-label">New Password:</label>
  <div class="col-sm-2">
  <input type = "password" name = "new_pass" id = "new_pass" class = "form-control"/>
  </div>
</div>
<div class="form-group row">
  <label for="retype_pass" class="col-sm-2 col-form-label">Re-Type Password:</label>
  <div class="col-sm-2">
  <input type = "password" name = "retype_pass" id = "retype_pass" class = "form-control"/>
  </div>
</div></div></div></div></div>
<br>
<br>
<div class = "row" style = "margin: 0">
<input type = "submit" name = "save" id = "save" value = "Save"/>
<input type = "reset" name = "cancel" id = "cancel" value = "Cancel"/>
</div>
</div>
</form>
{literal}
<style>
.row{
    margin-top:40px;
    padding: 0 10px;
}

.clickable{
    cursor: pointer;   
}

.panel-heading span {
  margin-top: -20px;
  font-size: 15px;
}
.panel-body {
    padding: 15px;
}
.panel-primary>.panel-heading {
    color: #fff;
    background-color: #444;
    border-color: #444;
    }
    .panel-primary {
    border-color: #fff;
}
</style>
<script>
$(document).ready(function(){
    $("#old_pass").parent().parent().hide();
    $("#new_pass").parent().parent().hide();
    $("#retype_pass").parent().parent().hide();
})
function changeForm(){
    $("#old_pass").parent().parent().toggle();
    $("#new_pass").parent().parent().toggle();
    $("#retype_pass").parent().parent().toggle();
}
function createForm(){
    $("#old_pass").parent().parent().hide();
    $("#new_pass").parent().parent().toggle();
    $("#retype_pass").parent().parent().toggle();
}
</script>
{/literal}
