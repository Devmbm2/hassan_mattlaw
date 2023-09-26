{literal}
<script type="text/javascript">
    var selectTabDetailView = function(tab,relation) {
           $('#content div.tab-content div.tab-pane-NOBOOTSTRAPTOGGLER.'+relation).hide();
          $('#content div.tab-content div.tab-pane-NOBOOTSTRAPTOGGLER.'+relation+'#tab-content-'+tab).show().addClass('active').addClass('in');
       };
</script> 
{/literal}
<form action="index.php" method="post" name="MassGenerateDocument" id="MassGenerateDocument">
<div class="moduleTitle" align="right">
	
	<label style=''><input type='checkbox'  name='AttachGeneratedDocumentToRecord' id='AttachGeneratedDocumentToRecord' value='1' {if $smarty.request.AttachGeneratedDocumentToRecord eq "1"}checked="checked"{/if}>&nbsp; {$LABEL_CHECKBOX}</label>
	<input type="submit" id="MassGenerateDocument_button_ListView" name="MassGenerateDocument_button_ListView" value="Generate Document" class="button">&nbsp;
</div>
			{foreach  from=$smarty.request key=request_index item=request_data}
				{if $request_index neq 'AttachGeneratedDocumentToRecord'}
				<input type="hidden" name="{$request_index}" id="MGD_{$request_index}" value='{$request_data}'>
				{/if}
			{/foreach}
				<input type="hidden" name="from_view"  value="customselection">
{foreach name=section from=$SELECTION_ARRAY key=record_index item=record_data}
<div class="moduleTitle">
    <h2 class="module-title-text">{$record_data.name}</h2>
</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%" id="">
    <tbody>
        <tr>
            <td class="buttons" align="left" nowrap="" width="80%">
                <div class="actionsContainer">
                    
                </div>
            </td>
            <td align="right" width="20%" class="buttons"></td>
        </tr>
    </tbody>
</table>
<div class="detail-view">
    <ul class="nav nav-tabs">
        {assign var=counter value=0}
        {foreach from=$record_data.relation key=relation item=relation_data}
        {assign var=counter value=$counter+1}
        <li role="presentation" class="{if $counter eq 1}active{else}hidden-xs{/if}">
            <a id="tab{$record_index}{$counter}" data-toggle="tab" class="hidden-xs section_{$record_index}">
            {$relation_data.label}
            </a>
        </li>
        {/foreach}
    </ul>
    <div class="clearfix"></div>
    <div class="tab-content">
        {assign var=counter value=0}
        {foreach from=$record_data.relation key=relation item=relation_data}
        {assign var=counter value=$counter+1}
        <div class="tab-pane-NOBOOTSTRAPTOGGLER {if $counter eq 1}active{else}hidden-xs{/if} fade in section_{$record_index}" id="tab-content-{$record_index}{$counter}">
            <table cellpadding="0" cellspacing="0" border="0" class="list view table-responsive">
                <thead>
                    <tr height="20">
                        <th class="td_alt" style="width: 20px;">  
						<input id="top_check_{$record_index}_{$counter}" title="Select this row" onclick="select_all_childs(this)" type="checkbox" class="listview-checkbox">
                        </th>
                        <th scope="col" align="left"   class="">
                            <div>
                                Name &nbsp;&nbsp;  																									
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
					{assign var=record_counter value=0}
					{foreach from=$relation_data.data key=record_id item=record_name}
					{assign var=record_counter value=$record_counter+1}
                    <tr height="20" class="{if $record_counter%2==1}odd{else}even{/if}ListRowS1">
                        <td style="width: 20px;">
                            <input title="Select this row" type="checkbox" class="listview-checkbox" name="related_selected[]" value="{$record_id}">
                        </td>
                        <td scope="row" align="left" valign="top" type="name" field="name" class=" ">
                            <b>
                            {$record_name}
                            </b>
                        </td>
                    </tr>
					{/foreach}
                </tbody>
            </table>
		</div>
        {/foreach}
    </div>
</div>
</form>
{literal}
<script type="text/javascript">
    $(function(){
         {/literal} $('#content ul.nav.nav-tabs > li > a.section_{$record_index}[data-toggle="tab"]').click(function(e) {literal} {
              if(typeof $(this).parent().find('a').first().attr('id') != 'undefined') {
                  var tab = parseInt($(this).parent().find('a').first().attr('id').match(/tab([0-9]+)/)[1]);
                  selectTabDetailView(tab,'{/literal}section_{$record_index}{literal}');
              }
          });
      });
      
</script> 
</div>
{/literal}
{/foreach}
{literal}
<script>
function select_all_childs(element){
	var id = $(element).attr('id');
	$("#"+id).closest('table').find("tbody input[type='checkbox']").prop('checked', element.checked);
}

SUGAR.util.doWhen("document.getElementById('form') != null",
    function(){SUGAR.util.buildAccessKeyLabels();});
</script>         
<script type="text/javascript" src="include/InlineEditing/inlineEditing.js"></script>
<script type="text/javascript" src="modules/Favorites/favorites.js"></script>
{/literal}