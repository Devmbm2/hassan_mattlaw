<script type="text/javascript" src="cache/include/javascript/sugar_grp_yui_widgets.js"></script>
<script type="text/javascript" src="include/javascript/tiny_mce/tiny_mce.js"></script>
<form name="enableTemplatesModules" method="POST">

   
   <input type="hidden" name="module" value="Administration">
   <input type="hidden" name="action" value="index">
   
   <table border="0" cellspacing="1" cellpadding="1">
      <tr>
         <td>
            <input title="{$APP.LBL_SAVE_BUTTON_LABEL}" accessKey="{$APP.LBL_SAVE_BUTTON_TITLE}" class="button primary" onclick="SUGAR.saveTemplatesSettings();" type="button" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">
            <input title="{$APP.LBL_CANCEL_BUTTON_LABEL}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="document.enableTemplatesModules.action.value='';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}">
         </td>
      </tr>
   </table>
   
   <br> 
     
  <div class='add_table' style='margin-bottom:5px'>
      <table class="edit view" style='margin-bottom:0px;' border="0" cellspacing="0" cellpadding="0" width="25%">
         <tr>
            <tr>
			 <td scope="row" nowrap="nowrap">{sugar_translate module='DHA_PlantillasDocumentos' label='LBL_ATTORNEYS_LIST'} 
				 &nbsp;{sugar_help text=$MOD.LBL_ATTORNEYS_LIST_HELP}
			 </td>
			 <td>   
    
    
				<textarea style="margin: 12px;height: 168px;width: 403px;" id='ATTORNEYS_LIST' name='ATTORNEYS_LIST' rows="8" cols="150">{$ATTORNEYS_LIST_VALUE}</textarea>
	<script type="text/javascript">
	{literal}
      tinyMCE.init({
	theme : "advanced",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        mode : "exact",
	height : "200px",
	width: "500px",
        elements : "ATTORNEYS_LIST"
      });
	{/literal}
	</script>
			 </td>
         </tr>
       </table>
   </div>
 
   
   <table border="0" cellspacing="1" cellpadding="1">
      <tr>
         <td>
            <input title="{$APP.LBL_SAVE_BUTTON_LABEL}" class="button primary" onclick="SUGAR.saveTemplatesSettings();" type="button" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">
            <input title="{$APP.LBL_CANCEL_BUTTON_LABEL}" class="button" onclick="document.enableTemplatesModules.action.value='';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}">
         </td>
      </tr>
   </table>
</form>


<script type="text/javascript">

{literal}
   (function(){
    var Connect = YAHOO.util.Connect;
      Connect.url = 'index.php';
      Connect.method = 'POST';
      Connect.timeout = 300000;
      var get = YAHOO.util.Dom.get;
      
      
      SUGAR.saveTemplatesSettings = function(){
		tinyMCE.triggerSave();
         ajaxStatus.showStatus(SUGAR.language.get('app_strings', 'LBL_SAVING'));
         Connect.asyncRequest(
            Connect.method, 
            Connect.url, 
            {success: SUGAR.saveCallBack},
            SUGAR.util.paramsToUrl({
               module: "DHA_PlantillasDocumentos",
               action: "saveTemplateConfig",
               attorneys_list : get('ATTORNEYS_LIST').value,
            })
         );
         
         return true;
      }
      
      SUGAR.saveCallBack = function(o) {
         ajaxStatus.flashStatus(SUGAR.language.get('app_strings', 'LBL_DONE_BUTTON_LABEL'));
         if (o.responseText == "true") {
            window.location.assign('index.php?module=Administration&action=index');
         } 
         else {
            YAHOO.SUGAR.MessageBox.show({msg:o.responseText});
         }
      }
   })();
{/literal}

</script>
