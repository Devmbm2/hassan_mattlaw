  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>

<form id="ConfigureSettings" name="ConfigureSettings" enctype='multipart/form-data' method="POST"
      action="index.php?module=Administration&action=IntakeFormBuilder&do=save">

    <span class='error'>{$error.main}</span>

    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="actionsContainer">
        <tr>
            <td>
                {$BUTTONS}
                 </td>
        </tr>
    </table>




    <table width="100%" border="0" cellspacing="1" cellpadding="0" class="edit view">
         <tr>
            <td  scope="row" width="100">
			<div id="build-wrap"></div>
            </td>
        </tr>
    </table>
    <div style="padding-top: 2px;">
        {$BUTTONS}
    </div>
    {$JAVASCRIPT}
</form>
{literal}
<script>
jQuery($ => {
  const fbTemplate = document.getElementById('build-wrap');
  $(fbTemplate).formBuilder();
});
</script>
<style>
#build-wrap {
  padding: 0;
  margin: 10px 0;
  background: #f2f2f2 url('https://formbuilder.online/assets/img/noise.png');
}
</style>
{/literal}