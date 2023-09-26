/*
   Created By : Urdhva Tech Pvt. Ltd.
 Created date : 09/29/2017
   Contact at : contact@urdhva-tech.com
          Web : www.urdhva-tech.com
        Skype : urdhvatech
       Module : Dupdetector 1.2
*/
$(function() {
    //Enable sorting 
    $( ".droptrue" ).sortable({
        connectWith: ".connectedSortable",
        opacity: 0.6,
        cursor: 'move',
        scroll: true
    });
    $( ".list_droptrue" ).sortable({
        connectWith: ".list_connectedSortable",
        opacity: 0.6,
        cursor: 'move',
        scroll: true
    });
    $('a.editview_dupdetector').click(function(){
        $("#view_selection").css("display","none");
        $("#current_view").val("editview");
        $("#field_selection").css("display","block");
        update_field_column();
    });
    $('a.quickcreate_dupdetector').click(function(){
        $("#view_selection").css("display","none");
        $("#current_view").val("quickcreate");
        $("#field_selection").css("display","block");
        update_field_column();
    });
});
$( document ).delegate( "#dupdetector_module_list", "change", function() {
    if($("#field_selection").css("display") =='block')
        update_field_column();
});
//Update fields
function update_field_column() {
    var module_selected = $("#dupdetector_module_list").val();
    if(module_selected == ''){
        return;   
    }
    var callback = {
        success : function(r) {
            if (r.responseText) {
                if ((r.responseText=='') || (r.responseText==null)){
                    alert("There was an error processing your request.");
                    SUGAR.ajaxUI.hideLoadingPanel();
                } else {
                    res = eval('(' + r.responseText + ')');
                    if(res.default_field_li) {
                        $("#default_sortable").html(res.default_field_li);
                    }else{
                        $("#default_sortable").html();
                    }
                    if(res.selected_field_li) {
                        $("#selected_sortable").html(res.selected_field_li);
                    }
                    else{
                        $("#selected_sortable").html("");
                    }
                    SUGAR.ajaxUI.hideLoadingPanel();
                }
            }
        }
    };
    SUGAR.ajaxUI.showLoadingPanel();
    var current_view = $("#current_view").val();
    postData = '&view=' + current_view +'&module_selected='+module_selected;
    YAHOO.util.Connect.asyncRequest('POST', 'index.php?module=Dupdetector&sugar_body_only=true&to_pdf=1&action=DupFieldLayout',callback, postData);
}
//Fill textarea before submit
function check_submit_fields() {
    var default_field = '';
    $("#default_sortable > li").each(function(){
        default_field += $(this).attr("id") + ','; // special case
    });
    var selected_field = '';
    $("#selected_sortable > li").each(function(){
        selected_field += $(this).attr("id") + ',';
    });
    var module_selected = $("#dupdetector_module_list").val();
    var jsonOrderObj = [];
    jsonOrderObj.push({
        module:module_selected,
        selected_field:selected_field,
        default_field:default_field
    });
    var json_order_array = encodeURIComponent(JSON.stringify(jsonOrderObj));
    $("#answer_text").val(json_order_array);
    return true;
}
function submit_cancel(){
     $("#view_selection").css("display","block");
     $("#current_view").val("");
     $("#answer_text").val("");
     $("#field_selection").css("display","none");
}
function submit_save(){
        if(check_submit_fields()) {
            var module_selected = $("#dupdetector_module_list").val();
        if(module_selected == '') {
            return;   
        }
        var callback_save = {
            success : function(r) {
                if (r.responseText) {
                    if ((r.responseText=='') || (r.responseText==null)){
                        alert("There was an error processing your request.");
                        SUGAR.ajaxUI.hideLoadingPanel();
                    } else {
                        res = eval('(' + r.responseText + ')');
                        SUGAR.ajaxUI.hideLoadingPanel();
                         $("#view_selection").css("display","block");
                         $("#current_view").val("");
                         $("#answer_text").val("");
                         $("#field_selection").css("display","none");
                    }
                }
            }
        };
        SUGAR.ajaxUI.showLoadingPanel();
        var current_view = $("#current_view").val();
        var answer_text = $("#answer_text").val();
        if ($('#prevent_submit').is(':checked'))
            var prevent_submit = true;
        else
            var prevent_submit = false; 
        
        postData = '&view=' + current_view +'&module_selected='+module_selected+'&answer_text='+answer_text+'&prevent_submit='+prevent_submit;
        YAHOO.util.Connect.asyncRequest('POST', 'index.php?module=Dupdetector&sugar_body_only=true&to_pdf=1&action=savefield',callback_save, postData);
    }
}