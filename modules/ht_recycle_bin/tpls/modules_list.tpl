{literal}
<style>
#smtpButtonGroup .yui-button {
    padding-top: 10px;
}
#smtpButtonGroup .yui-radio-button-checked button, .yui-checkbox-button-checked button {
    background-color: #CCCCCC;
    color: #FFFFFF;
    text-shadow: none;
}


{/literal}
</style>

<form enctype="multipart/form-data" name="selectmodulestep" method="post" action="index.php" id="selectmodulestep">
<input type="hidden" name="module" value="ht_recycle_bin">
<input type="hidden" name="action" value="index">
<p>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td valign="top" width='100%' scope="row">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="left" scope="row" colspan="3"><h3>{$MOD.LBL_STEP_MODULE}&nbsp;</h3></td>
                                </tr>
                                <tr>
                                    <td><select required tabindex='4' name='selected_module' id='selected_module'>{$MODULES_OPTIONS}</select></td>
                                </tr>
                                <tr>
                                    <td align="left" scope="row" colspan="3"><div class="hr">&nbsp;</div></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</p>
<br>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td align="left"><input title="{$MOD.LBL_NEXT}"  class="button" type="submit" name="button" value="{$MOD.LBL_NEXT}"  id="gonext"></td>
    </tr>
</table>
</form>
