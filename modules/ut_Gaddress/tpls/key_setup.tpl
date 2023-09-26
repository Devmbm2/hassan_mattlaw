{literal}
    <script language="javascript">
        addToValidate('KeySetting','g_key','varchar',true,{/literal}"{$MOD.LBL_FIELD_API_KEY}"{literal});
    </script>
{/literal}
<div style='padding:10px;'>
<form name="KeySetting" enctype="multipart/form-data" method="POST" action="index.php" >
<input name="action" value="save_key" type="hidden">
<input name="module" value="ut_Gaddress" type="hidden">
 <table border="0" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td valign="middle">
            <h2>{$MOD.LBL_SELECT_MODULE_HEADER_TITLE}&nbsp;</h2>
        </td>
        <td>
           <span style="float:right;"><h2><a href="http://www.urdhva-tech.com" target="_blank"><img width="200px" src='modules/ut_Gaddress/images/urdhvatech-logo.jpg' alt="Urdhva-Tech logo" /></a>&nbsp;</h2></span>
        </td>
    </tr>
    </table>
<table class="actionsContainer" width="100%" cellspacing="1" cellpadding="0" border="0">
<tbody><tr>
    <td>
        <input title="Save" accesskey="a" class="button primary" id="ConfigureSettings_save_button" onclick="return check_form('KeySetting');" name="save" value="  Save  " type="submit">
        &nbsp;<input title="" id="ConfigureSettings_cancel_button" onclick="document.location.href='index.php?module=Administration&amp;action=index'" class="button" name="cancel" value="  Cancel  " type="button">   </td>
    </tr>
</tbody></table>

    <table class="edit view" width="100%" cellspacing="1" cellpadding="0" border="0">
        <tr>
            <td scope="row" width="20%" align="left">
                {$MOD.LBL_KEY_SETUP_TITLE}&nbsp;<span class="required">*</span>
            </td>
            <td scope="col" width="">
                <input type="text" id="g_key" name="g_key" value="{$g_key}" size="50">
            </td>
        </tr>
        <tr>
            <td scope="row" width="20%" align="left" valign="top">
                Follow these steps to get an API key
            </td>
            <td>&nbsp;
            </td>
           
        </tr>
        <tr>
            <td scope="row" width="12.5%" align="left" valign="top">
                &nbsp;
            </td>
            <td  scope="col" style="vertical-align:bottom;"> 
                <ul>
                    <li>Go to the Google API Console. <a href="https://developers.google.com/maps/documentation/javascript/get-api-key?refresh=1" target="_blank">Get API Key</a></li>
                    <li>Create or select a project.</li>
                    <li>Click Continue to enable the API.</li>
                    <li>On the Credentials page, get an API key.</li>
                    <li>From the dialog displaying the API key</li>
                    <li>Copy and Paste Key to <b>{$MOD.LBL_KEY_SETUP_TITLE}</b> text box and Save</li>
                </ul>
            </td>
        </tr>
    </table>
</form>
</div>