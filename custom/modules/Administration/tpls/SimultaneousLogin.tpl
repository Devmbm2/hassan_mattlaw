<form action="index.php?module=Administration&action=SimultaneousLogin" method="POST" entype="multipart/form-data">
<div class = "container">
<div class = "row">
<div class = "col-xs-10 col-sm-11 col-md-11">
<div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Simultaneous Logins Enable/Disable Feature</h3>
          <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
        </div>
        <div class="panel-body">
<div class="form-check">
  <input class="form-check-input" type="radio" name="loginradio" id="flexRadioDefault1" {if $loginValue == true} checked {/if} value = "enable">
  <label class="form-check-label" for="flexRadioDefault1">
    Enabled
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="loginradio" id="flexRadioDefault2"  {if $loginValue == false} checked {/if} value = "disable">
  <label class="form-check-label" for="flexRadioDefault2">
    Disabled
  </label>
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
{/literal}
