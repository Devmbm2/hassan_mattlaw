

<form id="ConfigureSettings" name="ConfigureSettings" enctype='multipart/form-data' method="POST"
      action="index.php?module=Administration&action=UAdmin&do=save">

    <span class='error'>{$error.main}</span>

    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="actionsContainer">
        <tr>
            <td>
                {$BUTTONS}
                 </td>
        </tr>
    </table>




    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="edit view">
        <tr><th align="left" scope="row" colspan="4"><h4>Exclude from taking</h4></th>
        </tr>
        <tr>
            <td  scope="row" width="100">Exclude IPs: </td>
            <td width="200">
                <input size="50" type='text' name='pcua[excludeip]' value='{$config.pcua.excludeip}' >
            </td>
            <td  scope="row" width="100">Exclude Users: </td>
            <td width="200">
                {$EXCLUDE_USERS_HTML}
            </td>
        </tr>
        <tr>
            <td  scope="row">Exclude Actions: </td>
            <td>
                {$EXCLUDE_ACTIONS_HTML}
            </td>
            <td  scope="row">Exclude Modules: </td>
            <td>
                {$EXCLUDE_MODULES_HTML}
            </td>
        </tr>
    </table>
    <div style="padding-top: 2px;">
        {$BUTTONS}
    </div>
    {$JAVASCRIPT}
</form>
