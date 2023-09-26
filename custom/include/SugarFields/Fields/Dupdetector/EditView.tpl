{if empty({{sugarvar key='value' string=true}})}
    {assign var="value" value={{sugarvar key='default_value' string=true}} }
{else}
    {assign var="value" value={{sugarvar key='value' string=true}} }
{/if}
{{capture name=idname assign=idname}}{{sugarvar key='name'}}{{/capture}}
{{if !empty($displayParams.idName)}}
{{assign var=idname value=$displayParams.idName}}
{{/if}}
<input type='text' id='{{$idname}}' name='{{$idname}}' size='{{$displayParams.size|default:30}}'  class='dup_detector'
       {{if isset($displayParams.maxlength)}}maxlength='{{$displayParams.maxlength}}'{{elseif isset($vardef.len)}}maxlength='{{$vardef.len}}'{{/if}}
       value='{$value}' title='{{$vardef.help}}' {{if !empty($tabindex)}} tabindex='{{$tabindex}}' {{/if}}
       {{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}} {{$displayParams.field}}> &nbsp;<span id="{{$idname}}_dup_detector_info"></span>
{literal}
<script type="text/javascript">
if(typeof(ele_status) == "undefined")
    var ele_status = [];
if(typeof(global_submit) == "undefined")
    var global_submit = '';
if(typeof(total_element) == "undefined")
    var total_element;
if(typeof(inside_submit) == "undefined")
    var inside_submit = false;
if(typeof(popupCreate) == "undefined")
    var popupCreate = false;
YAHOO.util.Event.onDOMReady(function() {
    if (typeof (total_element) == 'undefined')
        total_element = 0;
    total_element++;
    var form_name = '{/literal}{$form_name}{literal}';
    if (form_name.substring(0, 16) == "form_QuickCreate")
        popupCreate = true;

    if (form_name.substring(0, 16) == "form_QuickCreate" || form_name.substring(0, 24) == "form_SubpanelQuickCreate" || form_name.substring(0, 18) == "form_DCQuickCreate")
        var curSubmit = $("input[name$='save_button']", $('#' + form_name));
    else
        var curSubmit = $("input[type=submit]", $('#' + form_name));

    var onclick_event = $(curSubmit).attr("onclick");
    $(curSubmit).attr("onclick", "");
    if (onclick_event != '') {
        if (popupCreate)
            global_submit = "var _form = document.getElementById('" + form_name + "'); _form.action.value='Popup';if(check_form('" + form_name + "')) SUGAR.ajaxUI.submitForm(_form); return false;";
        else
            global_submit = onclick_event;
    }

    var submitClickedButton = "";
    $('input[type="submit"]').click(function(evt) {
        submitClickedButton = evt.target.id;
    });

    $('#' + form_name).submit(function(e) {
        var clickedButtonId = submitClickedButton;
        if (clickedButtonId.slice(-25) != "subpanel_full_form_button" && clickedButtonId.slice(-22) != "subpanel_cancel_button" && clickedButtonId.slice(-19) != "popup_cancel_button")
        {
            inside_submit = true;
            e.preventDefault();
            $(curSubmit).attr("onclick", global_submit);
            $('#' + form_name + ' #{/literal}{{$idname}}{literal}').trigger("blur", "from_submit");
            return false;
        }

    });
    $('#' + form_name + ' #{/literal}{{$idname}}{literal}').blur(function(abc, xyz) {
        if (typeof (xyz) != 'undefined' && xyz == 'from_submit')
            inside_submit = true;
        else {
            inside_submit = false;
        }
        var class_info = $(this).attr('id') + "_dup_detector_info";
        var module_name = '{/literal}{$module}{literal}';
        var field_value = encodeURIComponent($(this).val());
        var field_name = $(this).attr('id');
        var availname = field_value;
        if (field_value != '') {
            $("#" + class_info).show();
            $("#" + class_info).fadeIn(400).html('<img src="custom/include/SugarFields/Fields/Dupdetector/image/ajax-loading.gif" />');
            var record_id = $('#' + form_name + ' input[name="record"]').val();
            var data = "record=" + record_id + "&module_name=" + module_name + "&field_name=" + field_name + "&field_value=" + field_value;
            SUGAR.ajaxUI.showLoadingPanel();
            $.ajax({
                type: "POST",
                url: "index.php?module=Dupdetector&action=check_dup&to_pdf=1&sugar_body_only=true&record_id=" + record_id,
                data: data,
                cache: false,
                async: true,
                success: function(result) {
                    if (result != '') {
                        res = eval('(' + result + ')');
                        total_element--;
                        if (res.status == '') {
                            $("#" + class_info).html('');
                            if (res.settings == true) {
                                for (validate_dup_key in validate['{/literal}{$form_name}{literal}']) {
                                    if (typeof (validate['{/literal}{$form_name}{literal}'][validate_dup_key][0]) != 'undefined' &&
                                            validate['{/literal}{$form_name}{literal}'][validate_dup_key][0] == '{/literal}{{$idname}}{literal}' && validate['{/literal}{$form_name}{literal}'][validate_dup_key][1] == 'error') {
                                    validate['{/literal}{$form_name}{literal}'].splice(validate_dup_key, 1);
                                    }
                                }
                            }
                        } else {
                            ele_status['{/literal}{{$idname}}{literal}'] = res.status;
                            var more_info_msg = '<img border="0"  id ="tooltip_' + field_name + '" onclick="return SUGAR.util.showHelpTips(this,ele_status[\'{/literal}{{$idname}}{literal}\']);" src="{/literal}{{$info_inline}}{literal}" >';
                            $("#" + class_info).html('<img src="custom/include/SugarFields/Fields/Dupdetector/image/error.gif" /> {/literal}{{$mdoule_language.LBL_MESSAGE_SIMILAR_FOUND}}{literal} ' + more_info_msg);
                            SUGAR.util.evalScript(more_info_msg);
                            if (res.settings == true) {
                                for (validate_dup_key in validate['{/literal}{$form_name}{literal}']) {
                                    if (typeof (validate['{/literal}{$form_name}{literal}'][validate_dup_key][0]) != 'undefined' &&
                                            validate['{/literal}{$form_name}{literal}'][validate_dup_key][0] == '{/literal}{{$idname}}{literal}' && validate['{/literal}{$form_name}{literal}'][validate_dup_key][1] == 'error') {
                                    validate['{/literal}{$form_name}{literal}'].splice(validate_dup_key, 1);
                                    }
                                }
                                addToValidate('{/literal}{$form_name}{literal}', '{/literal}{{$idname}}{literal}', 'error', true, '{/literal}{{$mdoule_language.LBL_WARNING_RESOLVE_CONFLICT}}{literal}');
                            }
                        }
                    }
                    SUGAR.ajaxUI.hideLoadingPanel();
                    if (total_element <= 0 && inside_submit == true) {
                        inside_submit = false;
                        $(curSubmit).trigger("click");
                    }
                },
                failure: function() {
                    SUGAR.ajaxUI.hideLoadingPanel();
                }
            });
        } else {
            $("#" + class_info).html('');
            if (inside_submit == true)
                $(curSubmit).trigger("click");
        }
    });
});
</script>
{/literal}