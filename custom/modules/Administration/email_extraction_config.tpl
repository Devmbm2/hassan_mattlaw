<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
{literal}
  <style>

</style>
{/literal}
{$BUTTONS}
    <br><br><br>
    <form id="ConfigureSettings" name="ConfigureSettings"  method="POST"
    action="index.php?module=Administration&action=email_extraction_config&do=save" autocomplete = "off"> 
    <table width="100%" border="0" cellspacing="1" cellpadding="0" style="background-color: white; height:150px;">
    <tbody>
    <tr>
<td class="dataLabel" width="5%">
Email ID:&nbsp;
                        <span class="required">*</span>
                </td>
<td class="dataLabel" width="65%">
                        <input type="text" id="user_name" name="user_name" size="75" {if $config_email} value="{$config_email}" {else} value = ""{/if} style="width:400px;">
                </td>
</tr>
<tr>
<td class="dataLabel" width="5%">
Password:&nbsp;
                        <span class="required">*</span>
                </td>
<td class="dataLabel" width="65%">
                        <input type="password" id="user_password" name="user_password" size="75" {if $config_password} value="{$config_password}" {else} autocomplete="new-password"{/if} style="width:400px;">
                        </td>
</tr>

</tbody>
</table>
    <br><br>
    {$BUTTONS}
    {$JAVASCRIPT}
    </form>
    <br>
    <br><br><br>
{literal}
<script>
  // for edit the record from the table
  function editRecord(record_email) 
  {
    $.ajax({
      url: 'index.php?module=Administration&action=email_extraction_config&edit=yes&record_email='+record_email,
      type: 'POST',
      contentType: 'application/x-www-form-urlencoded',
      dataType: 'text',
      data: 'sugar_body_only=true',						
      async: true,			
      success : function (result){
        show_edit(result);
      }
    });
  }
  // show data in the edit form 
  function show_edit(result)
  {
    $("#edit_from").show();
    var jsonArray = JSON.parse(result);
    $("#pre_username").val(jsonArray[0].name);
      $("#edit_username").val(jsonArray[0].name);
      $("#password-input").val(jsonArray[0].value  ); 
  }

</script>

{/literal}