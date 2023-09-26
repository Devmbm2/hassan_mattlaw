{php}
global $sugar_config;
{/php}
{literal}
<style>
#zoom_users {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size: 16px;
}

#zoom_users td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

#panel-heading{
	background: #444444;
	color: white;
	height: 40px;
	padding: 10px;
}
{/literal}
</style>

<div class="moduleTitle">
    <h2 class="module-title-text">
        <a href="#">Zoom</a><span class="pointer">»</span> CONFIGURATION
    </h2>
    <div class="clear"></div>
</div>

<form id="zoom" name="zoom" method="POST" action="index.php?module=FP_events&action=saveconfig">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="dcQuickEdit">
        <tr>
            <td style="padding-bottom: 2px;" width="100%">
                <input title="SAVE" name="save_zoom_config"  class="button" type="submit"  value="SAVE">
                <input title="CANCEL" onclick="document.location.href = 'index.php?module=Administration&action=index'" class="button" type="button" value="CANCEL">
            </td>
        </tr>
    </table>

   

    <div class="clear"></div>
    <div class="clear"></div>
    <br>
    <div name="twilio" id="twilio">
        <div class="panel panel-default">
            <div class="panel-heading ">
                <a class="" role="button" data-toggle="collapse-edit" aria-expanded="false">
                    <div class="col-xs-10 col-sm-11 col-md-11">
                       Configure the Zoom API parameters
                    </div>
                </a>
            </div>

            <div class="panel-body panel-collapse collapse in" id="detailpanel_-1">
                <div class="tab-content">
                    <!-- tab_panel_content.tpl -->  
                    <div class="row edit-view-row">    
                        <div>
                            <div class="col-xs-12 col-sm-4 label" style="color: black;">
                            Application Key :
                            </div>
                            <div class="col-xs-12 col-sm-8 edit-view-field " type="varchar">
                                <input type="text" name="application_key" id="application_key" size="50" maxlength="255" value="{$config.zoom.application_key}">
                            </div>
                            <!-- [/hide] -->
                        </div>
                    </div>
                    <div class="row edit-view-row">    
                        <div>
                            <div class="col-xs-12 col-sm-4 label" style="color: black;">
                            Application Secret :
                            </div>
                            <div class="col-xs-12 col-sm-8 edit-view-field " type="varchar">
                                <input type="text" name="application_secret" id="application_secret" size="50" maxlength="255" value="{$config.zoom.application_secret}">
                            </div>
                            <!-- [/hide] -->
                        </div>
                    </div>
                     <div class="clear"></div>
                     <div class="clear"></div>
                </div>
            </div>
        </div>

    </div>

</form>
