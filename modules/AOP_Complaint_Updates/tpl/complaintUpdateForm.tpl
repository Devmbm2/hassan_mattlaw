
<button id="addFileButton" class="button primary" type="button">{$MOD.LBL_ADD_COMPLAINT_FILE}</button>
{literal}
<script>
    $(document).ready(function(){
        var docCount = 0;
        $(document).on('change','.complaintDocumentTypeSelect',function(){
            var wrapper = $(this).closest('.complaintDocumentWrapper');
            if($(this).val() == 'internal'){
                wrapper.find('#complaint_update_file\\[\\]').hide();
                wrapper.find('.internalComplaintDocumentWrapper').show();
            }else{
                wrapper.find('#complaint_update_file\\[\\]').show();
                wrapper.find('.internalComplaintDocumentWrapper').hide();
            }

        });

        $('#addFileButton').click(function(e){
            var template = $('#updateFileRowTemplate').html();
            template = template.replace(/complaint_document_name/g, 'complaint_update_name_'+docCount);
            template = template.replace(/complaint_document_id/g, 'complaint_update_id_'+docCount);
            $(e.target).before(template);
            if(typeof sqs_objects == 'undefined'){
                sqs_objects = new Array;
            }
            sqs_objects['EditView_complaint_document_name_'+docCount]={
                "form":"EditView",
                "method":"query",
                'modules': 'Documents',
                "field_list":["name","id"],
                "populate_list":["complaint_document_name_"+docCount,"complaint_document_id_"+docCount],
                "required_list":["complaint_document_id_"+docCount],
                "conditions":[{"name":"name","op":"like_custom","end":"%","value":""}],
                "limit":"30",
                "no_match_text":"No Match"};
            SUGAR.util.doWhen(
                    "typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['EditView_complaint_document_name_"+docCount+"']) != 'undefined'",
                    enableQS
            );

            $('.complaintDocumentTypeSelect').change();
            docCount++;
        });
        $(document).on('click','.removeFileButton',function(e){
            $(e.target).closest('span').remove();
        });
    });
</script>
{/literal}
<script id="updateFileRowTemplate"  type="text/template">
    <span class="complaintDocumentWrapper">
        <select class="complaintDocumentTypeSelect">
            <option value="internal">{$MOD.LBL_SELECT_INTERNAL_COMPLAINT_DOCUMENT}</option>
            <option value="external">{$MOD.LBL_SELECT_EXTERNAL_COMPLAINT_DOCUMENT}</option>
        </select>
        <input type="file" id="complaint_update_file[]" name="complaint_update_file[]">
        <span class="internalComplaintDocumentWrapper">
            <input type="text" name="complaint_document_name" class="sqsEnabled" tabindex="0" id="complaint_document_name" size="" value="" title='' autocomplete="off">
            <input type="hidden" name="complaint_document_id" id="complaint_document_id" value="">

            <span class="id-ff multiple">
                <button type="button" name="btn_complaint_document_name" id="btn_complaint_document_name" tabindex="0" title="{$MOD.LBL_SELECT_COMPLAINT_DOCUMENT}" class="button firstChild" value="{$MOD.LBL_SELECT_COMPLAINT_DOCUMENT}"
                        {literal}
                        onclick='open_popup(
                                "Documents",
                                600,
                                400,
                                "",
                                true,
                                false,
                                {"call_back_function":"set_return","form_name":"EditView","field_to_name_array":{"id":"complaint_document_id","name":"complaint_document_name"}},
                                "single",
                                true
                                );' >
                        {/literal}
                <img src="themes/default/images/id-ff-select.png"></button>
                <button type="button" name="btn_clr_complaint_document_name"
                        id="btn_clr_complaint_document_name" tabindex="0" title="{$MOD.LBL_CLEAR_COMPLAINT_DOCUMENT}"  class="button lastChild"
                        onclick="SUGAR.clearRelateField(this.form, 'complaint_document_name', 'complaint_document_id');"  value="{$MOD.LBL_CLEAR_COMPLAINT_DOCUMENT}" ><img src="themes/default/images/id-ff-clear.png"></button>
            </span>
        </span>

<button class="removeFileButton" type="button">{$MOD.LBL_REMOVE_COMPLAINT_FILE}</button><br>
    </span>

</script>




