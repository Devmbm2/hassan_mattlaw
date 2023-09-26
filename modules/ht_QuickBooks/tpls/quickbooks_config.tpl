{php}
global $sugar_config;
{/php}
<script
      type="text/javascript"
      src="https://appcenter.intuit.com/Content/IA/intuit.ipp.anywhere-1.3.3.js">
 </script>

 <script type="text/javascript">
    {literal}
    var redirectUrl = window.location.href;
    var res = redirectUrl.split("?"); 
     intuit.ipp.anywhere.setup({
             grantUrl:  res[0]+"?entryPoint=QuickBooksAccessToken",
             datasources: {
                  quickbooks : true,
                  payments : true
            },
             paymentOptions:{
                   intuitReferred : true
            }
     });
    {/literal}     
 </script>
<div class="moduleTitle">
    <h2 class="module-title-text">
        <a href="#">QuickBooks</a><span class="pointer">»</span> CONFIGURATION
    </h2>
    <div class="clear"></div>
</div>

<form id="Gateway_opt" name="Gateway_opt" method="POST" action="">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="dcQuickEdit">
        <tr>
            <td style="padding-bottom: 2px;" width="100%">
                <input title="SAVE" name="save_quickbooks"  class="button" type="submit" value="SAVE">
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
                       Configure the QuickBooks API parameters
                    </div>
                </a>
            </div>

            <div class="panel-body panel-collapse collapse in" id="detailpanel_-1">
                <div class="tab-content">
                    <!-- tab_panel_content.tpl -->
                    <br>
                    <div class="row edit-view-row">
                        <div>
                            <div class="col-xs-12 col-sm-4 label" style="color: black;">
                            Disable QuickBooks : 
                            </div>
                            <div class="col-xs-12 col-sm-8 edit-view-field " type="varchar">
                                <input type="checkbox" name="disable_quickbooks" id="disable_quickbooks" size="50" maxlength="255" {$disable_quickbooks}>
                            </div>
                            <!-- [/hide] -->
                        </div>
                    </div>    
                    <div class="row edit-view-row">    
                        <div>
                            <div class="col-xs-12 col-sm-4 label" style="color: black;">
                            Client Id :
                            </div>
                            <div class="col-xs-12 col-sm-8 edit-view-field " type="varchar">
                                <input type="text" name="client_id" id="client_id" size="50" maxlength="255" value="{$client_id}">
                            </div>
                            <!-- [/hide] -->
                        </div>
                    </div>
                    <div class="row edit-view-row">    
                        <div>
                            <div class="col-xs-12 col-sm-4 label" style="color: black;">
                            Client Secret :
                            </div>
                            <div class="col-xs-12 col-sm-8 edit-view-field " type="varchar">
                                <input type="text" name="client_secret" id="client_secret" size="50" maxlength="255" value="{$client_secret}">
                            </div>
                            <!-- [/hide] -->
                        </div>
                    </div>
                    <div class="row edit-view-row">    
                        <div>
                            <div class="col-xs-12 col-sm-4 label" style="color: black;">
                            Company Id :
                            </div>
                            <div class="col-xs-12 col-sm-8 edit-view-field " type="varchar">
                                <input type="text" name="company_id" id="company_id" size="50" maxlength="255" value="{$company_id}">
                            </div>
                            <!-- [/hide] -->
                        </div>
                    </div> 
                    <div class="row edit-view-row">    
                        <div>
                            <div class="col-xs-12 col-sm-4 label" style="color: black;">
                            Webhooks Token :
                            </div>
                            <div class="col-xs-12 col-sm-8 edit-view-field " type="varchar">
                                <input type="text" name="webhook_token" id="webhook_token" size="50" maxlength="255" value="{$webhook_token}">
                            </div>
                            <!-- [/hide] -->
                        </div>
                    </div> 
					<div class="row edit-view-row">    
                        <div>
                            <div class="col-xs-12 col-sm-4 label" style="color: black;">
                            Redirect URI :
                            </div>
                            <div class="col-xs-12 col-sm-8 edit-view-field " type="varchar">
                                {$redirect_uri}
                            </div>
                            <!-- [/hide] -->
                        </div>
                    </div>                    
                    {if empty($access_token) and (!empty($client_id) and !empty($client_secret) and !empty($company_id) and !empty($webhook_token))}
                    <br>
                    <div class="row edit-view-row">    
                        <div>
                            <div class="col-xs-12 col-sm-4 label" style="color: black;">                            
                            </div>
                            <div class="col-xs-12 col-sm-8 edit-view-field " type="varchar">
                                <ipp:connectToIntuit></ipp:connectToIntuit>
                            </div>
                            <!-- [/hide] -->
                        </div>
                    </div>                    
                    {/if}
                    <br>
                     <div class="clear"></div>
                     <div class="clear"></div>
                </div>
            </div>
        </div>

    </div>

</form>
