{*
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/

*}

<script type="text/javascript">

	global_langPrefix = "{$langprefix}";
	global_edit = true;
	global_view = "{$view}";
	global_style = "{$style}";
	global_t_step = {$t_step};
	global_current_user_id = "{$current_user_id}";
	global_current_user_name = "{$current_user_name}";
	global_time_format = "{$time_format}";
	global_enable_repeat = "{$enable_repeat}";
	global_items_draggable = "{$items_draggable}";
	global_items_resizable = "{$items_resizable}";
	global_cells_per_day = {$cells_per_day};
	global_dashlet = "{$dashlet}";
	global_grid_start_ts = {$grid_start_ts};
	global_basic_min_height = {$basic_min_height};
	global_timeslots = 30;
	global_start_week_day = "{$start_weekday}";
    global_datetime_format = "{$datetime_user_format}";
	global_year = "{$year}";
	global_month = "{$month}";
	global_day = "{$day}";
	global_start_time = "{$day_start_time}";
	global_end_time = "{$day_end_time}";
	global_colorList = {$activityColors};
	global_colorUsersList = {$shared_ids_colors_view};
	calendar_items = {$a_str};

	{literal}
	views = {
		sharedMonth: {
			type: 'month',
			duration: { months: 1 },
			buttonText: 'Shared Month'
		},
		sharedWeek: {
			type: 'agenda',
			duration: {days: 7},
			buttonText: 'Shared Week'
		},
		todayTomorrow: {
			type: 'agenda',
			duration: {days: 2},
			buttonText: 'Today Tomorrow'
		}
	};
	{/literal}

	{literal}
	YAHOO.util.Event.onDOMReady(function(){
		dom_loaded = true;
	});

	function check_cal_loaded(){
		return (typeof cal_loaded != 'undefined' && cal_loaded == true && typeof dom_loaded != 'undefined' && dom_loaded == true);
	}
	{/literal}



	SUGAR.util.doWhen(check_cal_loaded, function(){literal}{{/literal}

		CAL.view = "{$view}";
		CAL.style = "{$style}";
		CAL.t_step = {$t_step};
		CAL.current_user_id = global_current_user_id;
		CAL.current_user_name = global_current_user_name;
		CAL.time_format = "{$time_format}";
		CAL.enable_repeat = "{$enable_repeat}";
		CAL.items_draggable = "{$items_draggable}";
		CAL.items_resizable = "{$items_resizable}";
		CAL.cells_per_day = {$cells_per_day};
		CAL.current_params = {literal}{}{/literal};
		CAL.dashlet = "{$dashlet}";
		CAL.grid_start_ts = {$grid_start_ts};
		CAL.scroll_slot = {$scroll_slot};

		CAL.basic.min_height = {$basic_min_height};


		CAL.lbl_create_new = "{$MOD.LBL_CREATE_NEW_RECORD}";
		CAL.lbl_edit = "{$MOD.LBL_EDIT_RECORD}";
		CAL.lbl_saving = "{$MOD.LBL_SAVING}";
		CAL.lbl_loading = "{$MOD.LBL_LOADING}";
		CAL.lbl_sending = "{$MOD.LBL_SENDING_INVITES}";
		CAL.lbl_confirm_remove = "{$MOD.LBL_CONFIRM_REMOVE}";
		CAL.lbl_confirm_remove_all_recurring = "{$MOD.LBL_CONFIRM_REMOVE_ALL_RECURRING}";

		CAL.lbl_error_saving = "{$MOD.LBL_ERROR_SAVING}";
		CAL.lbl_error_loading = "{$MOD.LBL_ERROR_LOADING}";
		CAL.lbl_repeat_limit_error = "{$MOD.LBL_REPEAT_LIMIT_ERROR}";

		CAL.year = {$year};
		CAL.month = {$month};
		CAL.day = {$day};

		CAL.print = {$isPrint};



		CAL.field_list = new Array();
		CAL.field_disabled_list = new Array();

		CAL.act_types = [];
		CAL.act_types['FP_events'] = 'FP_event';
		CAL.act_types['Meetings'] = 'meeting';
		CAL.act_types['Calls'] = 'call';
		CAL.act_types['Tasks'] = 'task';

		{literal}

		CAL.init_edit_dialog({
			width: "{/literal}{$editview_width}{literal}",
			height: "{/literal}{$editview_height}{literal}"
		});

		YAHOO.util.Event.on("btn-save","click",function(){
			if(!validateForm()){
				return false;
			}
			if(!checkConflict()){
				CAL.dialog_save();
				location.reload('true');
			}
		});
		YAHOO.util.Event.on("btn-send-invites","click",function(){
			if(!CAL.check_forms())
				return false;
			CAL.get("send_invites").value = "1";
			CAL.dialog_save();
		});
		YAHOO.util.Event.on("btn-delete","click",function(){
			if(CAL.get("record").value != "")
				if(confirm(CAL.lbl_confirm_remove))
					CAL.dialog_remove();
		});
		YAHOO.util.Event.on("btn-cancel","click",function(){
			document.schedulerwidget.reset();
            if(document.getElementById('empty-search-message')) {
                document.getElementById('empty-search-message').style.display = 'none';
            }
//            CAL.editDialog.cancel();
		});
		YAHOO.util.Event.on("btn-full-form","click",function(){
			CAL.full_form();
		});
		CAL.select_tab("cal-tab-1");

		YAHOO.util.Event.on(CAL.get("btn-cancel-settings"), 'click', function(){
			CAL.settingsDialog.cancel();
		});

		YAHOO.util.Event.on(CAL.get("btn-save-settings"), 'click', function(){
			CAL.get("form_settings").submit();
		});

		{/literal}

		cal_loaded = null;
	});
</script>

<div class="modal fade modal-cal-edit" tabindex="-1" role="dialog">
<div class="message_dialog_div" id="message_dialog_div" style="display:none;  background-color:white;">
	<div class="message_dialog" id="message_dialog_Events" style="background-color:white;overflow-y: auto;
	overflow-x: auto;">
	</div>
</div>
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="title-cal-edit"></h4>
			</div>
			<div class="modal-body">
				<!--->
				<div class="container-fluid">
						{sugar_include type="smarty" file=$form}
						<div id="scheduler"></div>
					{if $enable_repeat}
						{sugar_include type="smarty" file=$repeat}
					{/if}
				</div>
				<!--->
			</div>
			<div class="modal-footer">
				<button id="btn-save" class="button" type="button">{$MOD.LBL_SAVE_BUTTON}</button>
				<button id="btn-cancel" class="button" type="button" data-dismiss="modal">{$MOD.LBL_CANCEL_BUTTON}</button>
				<button id="btn-delete" class="button" type="button">{$MOD.LBL_DELETE_BUTTON}</button>
				<button id="btn-send-invites" class="button" type="button" style="display:none">{$MOD.LBL_SEND_INVITES}</button>
				<button id="btn-full-form" class="button" type="button">{$APP.LBL_FULL_FORM_BUTTON_LABEL}</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade modal-cal-tasks-edit" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="title-cal-tasks-edit">{$MOD.LNK_TASK}</h4>
			</div>
			<div class="modal-body">
				<!--->
				<div class="container-fluid">

				</div>
				<!--->
			</div>
			<div class="modal-footer">
				<button id="btn-view-task" class="button" type="button">{$MOD.LNK_TASK_VIEW}</button>
				<button id="btn-tasks-full-form" class="button" type="button">{$APP.LBL_FULL_FORM_BUTTON_LABEL}</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade modal-cal-events-edit" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="title-cal-events-edit">{$MOD.LNK_EVENT}</h4>
			</div>
			<div class="modal-body">
				<!--->
				<div class="container-fluid">

				</div>
				<!--->
			</div>
			<div class="modal-footer">
				<button id="btn-view-events" class="button" type="button">{$MOD.LNK_EVENT_VIEW}</button>
				<button id="btn-events-full-form" class="button" type="button">{$APP.LBL_FULL_FORM_BUTTON_LABEL}</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade modal-cal-tasks-view" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="title-cal-tasks-edit">{$MOD.LNK_DEADLINE_TASK_TITLE}</h4>
			</div>
			<div class="modal-body">
				<!--->
				<table class = "table table-striped table-hover" id="deadline_task" width = "100%">
				<thead class="thead-light">
				<tr>
				<th>
				#
				</th>
				<th>
				Task
				</th>
				<th>
				Deadline Days Left
				</th>
				<th>
				Action
				</th>
				</tr>
				</thead>
				<tbody>
				{foreach from=$deadline_tasks_list item=item key=key}
				<tr>
				<td style = "text-align:center;">
				{$key+1}
				</td>
				<td style = "text-align:center;">
				{$item.name}
				</td>
				<td style = "text-align:center;">
				{$item.days}
				</td>
				<td style = "text-align:center;">
				<a href = "index.php?action=DetailView&module=Tasks&record={$item.id}&return_module=Tasks&return_action=DetailView&offset=5">
				{$MOD.LNK_TASK_VIEW}
				</a>
				</td>
				</tr>
				{/foreach}
				</tbody>
				</table>
				<!--->
				<input type = "hidden" id ="count_task" value = "{$empty_deadline_list}">
			</div>
			<div class="modal-footer">
				<button id="btn-tasks-close" class="button" type="button" data-dismiss="modal">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

{if $settings}
{sugar_include type="smarty" file=$settings}
{/if}

<script type="text/javascript">
{literal}
var task_count = $("#count_task").val();
if(task_count != 0){
$(".modal-cal-tasks-view").modal("show");
}
{/literal}
{$GRjavascript}
</script>
<!--
<script type="text/javascript">

{literal}

YAHOO.util.Event.onDOMReady(function(){
	var schedulerLoader = new YAHOO.util.YUILoader({
		require : ["jsclass_scheduler"],
        skin: { base: 'blank', defaultSkin: '' },
		onSuccess: function(){
			var root_div = document.getElementById('scheduler');
			var sugarContainer_instance = new SugarContainer(document.getElementById('scheduler'));
			sugarContainer_instance.start(SugarWidgetScheduler);
		}
	});
	schedulerLoader.addModule({
		name :"jsclass_scheduler",
		type : "js",
		fullpath: "modules/Meetings/jsclass_scheduler.js",
		varName: "global_rpcClient",
		requires: []
	});
	schedulerLoader.insert();
});

setTimeout(function() {
        var script = document.createElement('script');
script.src = "modules/Calendar/fullcalendar/lang-all.js";
document.getElementsByTagName('head')[0].appendChild(script);
    }, 1000);
 {/literal}
</script>
-->
<script type="text/javascript" src="include/javascript/jsclass_base.js"></script>
<script type="text/javascript" src="include/javascript/jsclass_async.js"></script>

<style type="text/css">
{literal}
	.schedulerDiv h3{
		display: none;
	}
	.schedulerDiv{
		width: auto !important;
	}
	.ActiveButtonClass{
		font-weight: 500;
		background: #edd03d;
		padding: 0 20px 0 20px;
		margin: 0 0 0 0;
		border: none;
		border-radius: 3px;
		letter-spacing: 1px;
		line-height: 34px;
		height: 34px;
		text-transform: uppercase;
		color:black;
		margin-top:10px;
}
#sugarMsgWindow_c{
left:calc(50vw - 25%) !important;
}

#sugarMsgWindow > div.bd > div{
	height:200px;
	overflow:scroll;
	overflow-x: hidden;
}
{/literal}
</style>



<link type="text/css" href="{sugar_getjspath file="modules/Calendar/fullcalendar/fullcalendar.css"}" rel="stylesheet" />
<link type="text/css" href="{sugar_getjspath file="modules/Calendar/fullcalendar/fullcalendar.print.css"}" media='print' rel="stylesheet" />

<script src='{sugar_getjspath file="include/javascript/qtip/jquery.qtip.min.js"}'></script>
<script src='{sugar_getjspath file="modules/Calendar/fullcalendar/lib/moment.min.js"}'></script>
<!--<script src='{sugar_getjspath file="modules/Calendar/fullcalendar/fullcalendar.min.js"}'></script>-->
<script>
{literal}
$(document).ready(function(){
	const script = document.createElement('script');

// use local file
// script.src = 'script.js';

script.src ='modules/Calendar/fullcalendar/fullcalendar.min.js';
script.async = true;
script.onload = () => {
  	console.log('Script loaded successfuly');
	const script2 = document.createElement('script');
	script2.src ='custom/modules/Calendar/Cal.js';
	script2.async = true;
	document.body.appendChild(script2);
};

script.onerror = () => {
  console.log('Error occurred while loading script');
  location.reload();
};

document.body.appendChild(script);
})

{/literal}
</script>
<script src='{sugar_getjspath file="custom/include/javascript/loadingoverlay.min.js"}'></script>


<div id='calendarContainer'></div>
<!--{sugar_getscript file="custom/modules/Calendar/Cal.js"}-->
{sugar_getscript file="custom/modules/Calendar/events.js"}
{sugar_getscript file="cache/include/javascript/sugar_grp_yui_widgets.js"}
{literal}
<script>
		function myCallback(response) {
			if(response.responseText=='noRecordFound'){
				return false;
			}
					var handleOK = function() {
							//this.hide();
							$("#AssignForm").attr('action','index.php?module=Calendar&action=assignCasesToEvents');
							$("#AssignForm").submit();
							/*var data = "[";
							$('#EventsTable > tbody > tr').each(function() {
									var eventID = $(this).find('td:first').data('id');
									var caseID = $(this).find("td:eq(1) select").val();
										data+= `{"eventID": "`+eventID+`","caseID":"`+caseID+`"},`

								});
								data = data.slice(0, -1);
								data+="]";
								function CasesToEventsAssignment(response){
								console.log(response.responseText)
								}

								http_fetch_async(
									'index.php?module=Calendar&action=assignCasesToEvents',
									CasesToEventsAssignment,
									'my2Request', "AssignedCasesToEvents="+JSON.parse(JSON.stringify(data))+"&sugar_body_only=true");
									*/
						};
							YAHOO.SUGAR.MessageBox.show({
							msg: '',
							height: '600px',
							width: '700px',
							position: 'center',
							title: 'Assign Cases to events',
							buttons:[
									{
										 text: 'Active',
										 handler: handleOK ,
										 isDefault:true,
									},
								]
						});
						$("#yui-gen0-button").addClass('ActiveButtonClass');
				$("#sugarMsgWindow > div.bd").append(`<div class="container" style="width: 600px;font-size:15px; background-color:white;">`+response.responseText+`</div>`);
		}
		function FetchEventsAnsShowPopup(){
		http_fetch_async(
		'index.php?module=Calendar&action=FetchedAllEventsWhichHasNoCase',
		myCallback,
		'myRequest', 'sugar_body_only=true');
		}
		FetchEventsAnsShowPopup();
</script>
{/literal}
