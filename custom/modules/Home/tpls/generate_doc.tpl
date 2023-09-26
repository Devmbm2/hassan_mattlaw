<link rel="stylesheet" href="custom/include/select2/css/select2.css">
<script type="text/javascript" src="custom/include/select2/js/select2.js"></script>
<script type="text/javascript" src="{sugar_getjspath file='modules/DHA_PlantillasDocumentos/MassGenerateDocument.js'}"></script>
<script type="text/javascript" src="{sugar_getjspath file='custom/include/javascript/loadingoverlay.min.js'}"></script>

<form name="document_generation_form" id="document_generation_form" method="POST" enctype="multipart/form-data">
    <input type='hidden' name='module' id='MGD_module' value='DHA_PlantillasDocumentos'>
    <input type='hidden' name='action' id='MGD_action' value='htgetSelectionPanelJSON'>
    <input type='hidden' name='mode' id='MGD_mode' value=''>
    <input type='hidden' name='enPDF' id='MGD_enPDF' value='false'>
    <input type='hidden' name='from_view' value=''>
    <input type='hidden' name='related_selected' value=''>
    <input type='hidden' name='AttachGeneratedDocumentToRecord' value=''>
    <input type="hidden" name="FROM_MODULE" id="MGD_FROM_MODULE" value="Cases">
    <table border="0" cellspacing="1" cellpadding="1">
        <tr>
            <td>
                <input title="Generate Document" class="button primary" onclick="document_generation_form_submission();" type="button" name="button" value="Generate Document">

            </td>
            <td>
                <input type="checkbox" name="AttachGeneratedDocumentToRecord" id="AttachGeneratedDocumentToRecord_detailview" value="1" checked="checked">&nbsp; Attach Document with Record &nbsp;</label>
            </td>

        </tr>
    </table>
    <div id="myModal">
        <div class="row" style="margin-right: 0px; margin-left: inherit;">

            <div class="col-xs-4 col4">
                <div class="title">Select Module</div>
                {html_options name="moduloplantilladocumento" id="MGD_moduloplantilladocumento" options=$enabled_modules}
                </select>
            </div>
        </div>

        <div class="row" style="margin-right: 0px; margin-left: inherit;">

            <div class="col-xs-4 col4 select_area" id="MGD_uid_section" style="display: none;">
                <div class="title">Select Record</div>
                <select name='uid' id='MGD_uid'>
                </select>
            </div>

            <div class="col-xs-4 col4 select_area" id="document_list_section" style="display: none;">
                <div class="title">Document List</div>
                <select id="document_list" name="plantilladocumento_id">
                </select>
            </div>
            <div class="col-xs-4 col4 select_area" id="letterhead_list_section" style="display: none;">
                <div class="title">Select Letterhead</div>
                <select id="letterhead_list" name="letterhead_id">
                </select>
            </div>
            <div class="col-xs-4 col4 select_area" id="contactrole_list_section" style="display: none;">
                <div class="title">Select Contact Role</div>
                <select id="contactrole_list" name="contactrole_id">
                </select>
            </div>
        </div>
        <br>
        <br>
        <div class="row fields" style="margin-right: 0px; margin-left: inherit;" id="related_selection_panel">
            <div class="row fields" style="margin-right: 0px; margin-left: inherit;" id="related_selection_panel">
            </div>

        </div>
</form>
{literal}
<script>
    ht_showMassGenerateDocumentForm
    $(document).ready(function() {
        $('#MGD_moduloplantilladocumento').change(function() {
            var module_sugar_grp1 = $('#MGD_moduloplantilladocumento').val();
            var where = '';
            if (typeof(module_sugar_grp1) !== 'undefined') {
                where += "&target_module=" + module_sugar_grp1;
                where += "&module_records_list=" + module_sugar_grp1;
            }
            $.ajax({
                url: "index.php?module=DHA_PlantillasDocumentos&action=getTemplatesList&sugar_body_only=true" + where,
                dataType: 'JSON',
                async: true,
                success: function(result) {
                    $.LoadingOverlay("hide");
                    $('#document_list').html('');
                    $('#MGD_uid').html('');
                    if (typeof(result.records_list) !== 'undefined') {
                        var records_list = JSON.parse(result.records_list);
                        generateDropDown('#MGD_uid', records_list, 'Select Records');
                    }
                    if (typeof(result.templates_list) !== 'undefined') {
                        var templates_list = JSON.parse(result.templates_list);
                        generateDropDown('#document_list', templates_list, 'Select Templates');
                    }
                },
                error: function(error) {
                    $.LoadingOverlay("hide");
                }
            });
        });
    });
</script>
<style>
    .select2-results__options {
        height: 500px !important;
        max-height: 500px !important;
    }
</style>
{/literal}