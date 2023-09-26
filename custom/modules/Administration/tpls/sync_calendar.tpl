<form enctype='multipart/form-data' method="POST" action="">
    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="edit view" style="margin-top: 30px;">
        <tr>
            <th align="left" scope="row" colspan="4"><h4>Activate or Deactivate Sync Calender Events Scheduler</h4></th>
        </tr>
        <tr>
            <td nowrap width="5%" scope="row" style="font-weight: 900;">
                Sync Calender Events:
            </td>
            <td width="25%">
                <input type="checkbox" style="margin: 12px;" id="sync_events" name="sync_events" size="60" value="checked" {$sync_events}>
            </td>
        </tr>
    </table>
    <div style="padding-top: 2px;">
        <input class="button save_scheduler_settings" type="button" name="save_scheduler_settings" value="save"/>
        <input onclick="document.location.href='index.php?module=Administration&action=index'" class="button"  type="button" name="cancel" value="cancel"/>
    </div>
</form>
{literal}
    <script src="custom/modules/Administration/js/calendar_events.js"></script>
    <script src='custom/modules/Administration/js/sweetalert.js'></script>
{/literal}
