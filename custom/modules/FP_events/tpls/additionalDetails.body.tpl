<input id="type" type="hidden" value="{$OBJECT_NAME}"/>
{if !empty($FIELD.ID)}
    <input id="id" type="hidden" value="{$FIELD.ID}"/>
{/if}

{if !empty($FIELD.NAME)}
    <div>
        <strong>{$MOD.LBL_NAME}</strong>
		
        <a target="_blank" href="index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3D{$MODULE_NAME}%26offset%3D1%26stamp%3D1578897609098900600%26return_module%3DFP_events%26action%3DDetailView%26record%3D{$FIELD.ID}">{$FIELD.NAME}</a>
    </div>
{/if}

{if !empty($FIELD.CASES_FP_EVENTS_1_NAME)}
    <div>
        <strong>Case</strong>
        <a target="_blank" href="index.php?action=DetailView&module=Cases&record={$FIELD.CASES_FP_EVENTS_1CASES_IDA}">{$FIELD.CASES_FP_EVENTS_1_NAME}</a>
    </div>
{/if}

{if !empty($FIELD.PARENT_NAME)}
    <div>
        <strong>Host</strong>
        <a target="_blank" href="index.php?action=DetailView&module={$FIELD.PARENT_TYPE}&record={$FIELD.PARENT_ID}">{$FIELD.PARENT_NAME}</a>
    </div>
{/if}

{if !empty($FIELD.DATE_START)}
    <div data-field="DATE_START" data-date="{$FIELD.DB_DATE_START}">
        <strong>{$MOD.LBL_DATE}</strong>
        {$FIELD.DATE_START}
    </div>
{/if}

{if !empty($FIELD.DURATION_HOURS)  or !empty($FIELD.DURATION_MINUTES)}
    <div>
        <strong>{$MOD.LBL_DURATION}</strong>
        {if !empty($FIELD.DURATION_HOURS)}
            {$FIELD.DURATION_HOURS} {$MOD.LBL_HOURS_ABBREV}
        {/if}

        {if !empty($FIELD.DURATION_MINUTES)}
            {$FIELD.DURATION_MINUTES} {$MOD.LBL_MINSS_ABBREV}
        {/if}
    </div>
{/if}

{if !empty($FIELD.FP_EVENT_LOCATIONS_FP_EVENTS_1_NAME)}
    <div>
        <strong>{$MOD.LBL_LOCATION}</strong>
        <a target="_blank" href="index.php?module=FP_Event_Locations&action=DetailView&record={$FIELD.FP_EVENT_LOCATIONS_FP_EVENTS_1FP_EVENT_LOCATIONS_IDA}">{$FIELD.FP_EVENT_LOCATIONS_FP_EVENTS_1_NAME}</a>
    </div>
{/if}

{if !empty($FIELD.STATUS)}
    <div>
        <strong>{$MOD.LBL_STATUS}</strong>
        {$FIELD.STATUS}
    </div>
{/if}

{if !empty($FIELD.DESCRIPTION)}
    <div>
        <strong>{$MOD.LBL_DESCRIPTION}</strong>
        {$FIELD.DESCRIPTION}
    </div>
{/if}
