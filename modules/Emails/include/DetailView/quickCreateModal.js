function openQuickCreateModal(module, paramStr, fromAddr) {
  "use strict";


  var quickCreateBox = $('<div></div>').appendTo('#content');
  quickCreateBox.messageBox({
"showHeader": false,
"showFooter": false,
"size": 'lg'});
quickCreateBox.setBody(
    '<div class="email-in-progress"><img src="themes/' + SUGAR.themes.theme_name + '/images/loading.gif"></div>'
  );
  quickCreateBox.show();


  $.ajax({
    type: "GET",
    cache: false,
    url: 'index.php?module=' +module + '&action=EditView&in_popup=1&sugar_body_only=1' + paramStr
  }).done(function (data) {
    if (data.length === 0) {
      console.error("Unable to display QuickCreateView");
      quickCreateBox.setBody(SUGAR.language.translate('', 'ERR_AJAX_LOAD'));
      return;
    }
    quickCreateBox.setBody(data);


    quickCreateBox.find('input').each(function () {
      if ($(this).attr('id') === 'CANCEL') {
        $(this).attr('onclick', "$('#" + quickCreateBox.attr('id') + "').remove(); return false;");
      }
      if ($(this).attr('id') === 'SAVE') {
        $(this).attr('onclick', "submitQuickCreateForm('" + quickCreateBox.attr('id') + "'); return false;");
      }
    }, quickCreateBox);


    quickCreateBox.find('input[type="email"]').val(fromAddr);


    $('<input>', {
      id: 'quickCreateModule',
      name: 'quickCreateModule',
      value: module,
      type: 'hidden'
    }).appendTo('#EditView');
    $('<input>', {
      id: 'parentEmailRecordId',
      name: 'parentEmailRecordId',
      value: $('#parentEmailId').val(),
      type: 'hidden'
    }).appendTo('#EditView');


  }).fail(function (data) {
    quickCreateBox.controls.modal.content.html(SUGAR.language.translate('', 'LBL_EMAIL_ERROR_GENERAL_TITLE'));
  });

}


function submitQuickCreateForm(parentId) {
var _form =document.getElementById('EditView');
      _form.action.value='Save';
          if(check_form('EditView')){
            SUGAR.ajaxUI.submitForm(_form);
          }
}




function showErrorMessage(msg) {
  var errorBox = $('<div></div>').appendTo('#content');
  errorBox.messageBox({"size": 'lg'});
  errorBox.setBody(msg);
  errorBox.show();
  errorBox.on('ok', function () {
    errorBox.remove();
  });
  errorBox.on('cancel', function () {
    errorBox.remove();
  });
}
