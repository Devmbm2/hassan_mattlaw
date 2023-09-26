{literal}
    <style>
        .droptrue li { list-style-type: none; margin: 1; padding: 0; margin-right: 10px; background: #eee; padding: 5px;}
        .droptrue { padding: 0;margin:1px;height:200px;}
    </style>
    <script language="javascript" src = "modules/Dupdetector/javascript/field_layout.js" ></script>
{/literal}
<table border="0" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td valign="middle">
            <h2>{$MOD.LBL_DUP_FIELD_CONFIGURATION_TITLE}&nbsp;</h2>
        </td>
        <td>
           <span style="float:right;"><h2><a href="http://www.urdhva-tech.com" target="_blank"><img width="200px" src='modules/Dupdetector/images/urdhvatech-logo.jpg' alt="Urdhva-Tech logo" /></a>&nbsp;</h2></span>
        </td>
    </tr>
</table>
<form id="EditView" name="EditView" method="POST" action="index.php">
<input type='hidden' id='module' name='module' value='Dupdetector' />
<input type='hidden' id='action' name='action' value='savefield' />
<input type='hidden' id='current_view' name='current_view' value='' />
<textarea cols="60" rows="4" name="answer_text" id="answer_text" style="display:none;"></textarea>

<table width='100%' class="edit view">
<tr>
    <td scope='col' width='25%'>
        <label for="select_module">{$MOD.LBL_SELECT_MODULE}&nbsp;{sugar_help text=$MOD.LBL_SELECT_MODULE_HELP} </label>
    </td>
    <td width='25%'>
        <select id='dupdetector_module_list' name='dupdetector_module_list'>{$MODULE_LIST_OPTION}</select>
    </td>
    <td scope='col' width='25%'>
        <label for="prevent_submit">{$MOD.LBL_PREVENT_SUBMIT}&nbsp;{sugar_help text=$MOD.LBL_PREVENT_SUBMIT_HELP} </label>
    </td>
    <td  width='25%'>
        <input type="checkbox" {$checkbox_value} id="prevent_submit" name="prevent_submit">
    </td>
</tr>
</table>
<div id='view_selection' name='view_selection'>
<table width='100%' class="edit view">
<tr>
    <td scope='col' width='50%' colspan='2' align="center">
        <a href="javascript:void(0);" class="editview_dupdetector">
            <img src="themes/default/images/icon_EditView.gif" />
        </a><br/>
        <span>EditView</span>
    </td>
    <td scope='col' width='50%' colspan='2' align="left">
        <a href="javascript:void(0);" class="quickcreate_dupdetector">
            <img src="themes/default/images/icon_QuickCreate.gif" />
        </a><br/>
        <span>QuickCreateView</span>
    </td>
</tr>
</table>
</div>
<div id='field_selection' name='field_selection' style='display:none;'>
<table width='100%' class="edit view">
<tr>
    <td scope='col' width='32%' colspan='3'>
        <div id="dup_detector_field_list" style="float:left;">
                        <fieldset id="field_list" style="height:300px;width:250px;">
                            <legend>{$MOD.LBL_MODULE_FIELD_LEGEND}</legend>
                            <ul id='default_sortable' class="droptrue connectedSortable" style='height:280px;overflow:auto;' >
                                {$field_default_li}
                            </ul>
                        </fieldset>
        </div>
        <div id="dup_detector_selected" style="float:left;">
                        <fieldset id="column_1_module" style="height:300px;width:250px;">
                            <legend>{$MOD.LBL_MODULE_FIELD_SELECTED_LEGEND}</legend>
                            <ul id='selected_sortable' class="droptrue connectedSortable" style='height:280px;overflow:auto;'>
                                {$field_selected_li}
                            </ul>
                        </fieldset>
        </div>
    </td>
    <td style='text-align:left' width='40%' >
        <div style="margin-top: 50px; text-align: left; margin-left: -30px;">
            <ul>
                <li>{$MOD.LBL_MODULE_CONFIG_HELP_1_TEXT}</li>
                <li>{$MOD.LBL_MODULE_CONFIG_HELP_2_TEXT}</li>
                <li>{$MOD.LBL_MODULE_CONFIG_HELP_3_TEXT}</li>
                <li>{$MOD.LBL_MODULE_CONFIG_HELP_4_QUESTION}&nbsp;{sugar_help text=$MOD.LBL_MODULE_CONFIG_HELP_4_ANSWER}</li>
            </ul>
        </div>
    </td>
</tr>
<td scope='col' colspan='4'>
    <input type='button' id='save' name='save' onclick="return submit_save();" value='{$app_strings.LBL_SAVE_BUTTON_LABEL}'>
    <input type='button' id='cancel' name='cancel' onclick="return submit_cancel();" value='{$app_strings.LBL_CANCEL_BUTTON_LABEL}'>
</td>
</tr>
</table>
</div>
</tr>
</table>
</form>