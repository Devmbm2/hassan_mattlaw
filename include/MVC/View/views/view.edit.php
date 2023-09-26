<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2017 SalesAgility Ltd.
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
 * FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
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
 * reasonably feasible for technical reasons, the Appropriate Legal Notices must
 * display the words "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */


if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}


require_once('include/EditView/EditView2.php');

class ViewEdit extends SugarView
{
    /**
     * @var EditView $ev
     */
    public $ev;

    /**
     * @inheritdoc
     */
    public $type = 'edit';

    /**
     * @var boolean $useForSubpanel determine whether view can be used for subpanel creates
     */
    public $useForSubpanel = false;

    /**
     * @var boolean to determine whether or not SubpanelQuickCreate has a separate display function
     */
    public $useModuleQuickCreateTemplate = false;

    /**
     * @var boolean used to passed showTitle to $ev used for backwards compatibility
     */
    public $showTitle = true;

    /**
     * ViewEdit constructor.
     */
    public function __construct()
    {
        parent::__construct();
		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
    }

    /**
     * @deprecated deprecated since version 7.6, PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code, use __construct instead
     */
    public function ViewEdit()
    {
        $deprecatedMessage = 'PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code';
        if (isset($GLOBALS['log'])) {
            $GLOBALS['log']->deprecated($deprecatedMessage);
        } else {
            trigger_error($deprecatedMessage, E_USER_DEPRECATED);
        }
        self::__construct();
    }


    /**
     * @see SugarView::preDisplay()
     */
    public function preDisplay()
    {
        $metadataFile = $this->getMetaDataFile();
        $this->ev = $this->getEditView();
        $this->ev->ss =& $this->ss;
        $this->ev->setup($this->module, $this->bean, $metadataFile);
    }

    /**
     * @inheritdoc
     */
    public function display()
    {
		global $app_list_strings, $sugar_config, $db, $mod_strings;
		echo '<div class="message_dialog_div" id="message_dialog_div" style="display:none;  background-color:white;">
				<div class="message_dialog" id="message_dialog" style="background-color:white;">
				</div>
			</div>';
			$module=$_REQUEST['module'];
			$target_module=$_REQUEST['target_module'];
			$formName = $this->ev->formName;
			if(empty($formName)){
				$formName = 'EditView';
			}
			if($formName != 'EditView'){
				$module = $_REQUEST['target_module'];
			}
			/* echo $module; */
			if($module != 'AOW_WorkFlow'){
			$this->ev->defs['templateMeta']['includes'][]['file'] = 'cache/include/javascript/sugar_grp1.js';
			$this->ev->defs['templateMeta']['includes'][]['file'] = 'cache/include/javascript/sugar_grp_yui_widgets.js';
			$this->ev->defs['templateMeta']['includes'][]['file'] = 'custom/include/slack/slack_popup.js';
			$this->ev->defs['templateMeta']['form']['hidden'] = array(
			    '<input type="hidden" name="redirect" id="redirect" value="" >',
				'<input type="hidden" name="sms_text" id ="sms_text" value="">',
				'<input type="hidden" name="user_id" id ="user_id" value="">',
				'<input type="hidden" name="send_slack_notification" id ="send_slack_notification" value="">',
				'<input type="hidden" name="case_attachments_file_id[]" id="case_attachments_file_id" value="{$NOTE_IDS}">',
				'<input type="hidden" name="case_attachments_file_name[]" id="case_attachments_file_name" value={$FILE_NAMES}>',
				'<input type="hidden" name="case_attachments_file_types[]" id="case_attachments_file_types value="{$file_types}">',
			);
			if($module == 'Leads'){
				$this->ev->defs['templateMeta']['form']['buttons'][0] = array('customCode' => '<input title="Save" accesskey="a" class="button primary" onclick="if(!limitation_warning()) return false;var _form = document.getElementById(\''. $formName .'\'); _form.action.value=\'Save\';if(custom_validation())if(check_form(\''. $formName .'\'))SUGAR.ajaxUI.submitForm(_form);return false;" type="submit" name="button" value="Save" id="SAVE">',);
			}else if($module == 'FP_events'){
				$this->ev->defs['templateMeta']['form']['buttons'][0] = array('customCode' => '<input title="Save" accesskey="a" class="button primary" onclick="var _form = document.getElementById(\''. $formName .'\'); _form.action.value=\'Save\';if(custom_validation())if(check_form(formName))if(!checkConflict())if(check_cancel_reset())SUGAR.ajaxUI.submitForm(_form);return false;" type="submit" name="button" value="Save" id="SAVE">',);
			}else if($module == 'PLEA_Pleadings' || $module == 'DISC_Discovery' || $module == 'NEG_Negotiations'){
				$this->ev->defs['templateMeta']['form']['buttons'][0] = array('customCode' => '<input title="Save" accesskey="a" class="button primary" onclick="var _form = document.getElementById(\''. $formName .'\'); _form.action.value=\'Save\';if(custom_validation())if(check_form(formName))if(!DocumentCheckConflict(\''. $module .'\'))SUGAR.ajaxUI.submitForm(_form);return false;" type="submit" name="button" value="Save" id="SAVE">',);
			}
			else{
				$this->ev->defs['templateMeta']['form']['buttons'][0] = array('customCode' => '<input title="Save" accesskey="a" class="button primary" onclick="var _form = document.getElementById(\''. $formName .'\'); _form.action.value=\'Save\';if(custom_validation())if(check_form(\''. $formName .'\'))SUGAR.ajaxUI.submitForm(_form);return false;" type="submit" name="button" value="Save" id="SAVE">',);
			}
			$this->ev->defs['templateMeta']['form']['buttons'][] = array('customCode' => '<input type="button" class="button" id = "slack_notification"  title="Send Slack Notification" value="Save & Notify">',);
			$this->ev->process();
			$required_fields = array();
			foreach($this->bean->field_name_map as $field_name => $field_data){
				if($field_name != 'id' && $field_name != 'bug_number' && $field_data['required'] ){
					$required_fields[$field_name] = $mod_strings[$field_data['vname']];
				}
			}
            if($module == 'Documents'){
				$this->ev->defs['templateMeta']['form']['buttons'][0] = array('customCode' => '<input title="Save" accesskey="a" class="button primary" onclick="get_all_workflows_related_todocuments();return false;" type="submit" name="button" value="Save" id="SAVE">',);
			}
			echo $this->ev->display($this->showTitle);
			$formName = $this->ev->formName;
			if(empty($formName)){
				$formName = 'EditView';
			}
			/* echo $formName; */
			echo "<script type='text/javascript' src='custom/include/javascript/loadingoverlay.min.js'></script>";
			echo "<script type='text/javascript'>
			var formName = '{$formName}';
			 $('#'+ formName +' #slack_notification').on('click', function(e) {
				 var result = check_form(formName);
				 $.LoadingOverlay('show', {zIndex: 999999 } );
				setTimeout(function(){
				if(result == false){
					$.LoadingOverlay('hide');
					return;
				}else{
					$.LoadingOverlay('hide');
					sendMessage('{$this->bean->id}' , '{$module}', true, '{$formName}');

				}
				}, 3000);



			});


		</script> ";
		echo "<link href='custom/include/select2/css/select2.min.css' rel='stylesheet' type='text/css'/>";
		echo "<script type='text/javascript' src='custom/include/select2/js/select2.min.js'></script> ";
		echo "
		<script type='text/javascript'>
				var fields = ['phone_alternate', 'phone_work', 'phone_other', 'phone_mobile', 'phone_office', 'ada_phone_c', 'judge_asst_phone_c', 'phone_at_location_of_event_c', 'attorney1_phone', 'attorney2_phone', 'attorney3_phone', 'attorney4_phone', 'attorney5_phone', 'caller_number_c', 'caller_office_phone_c', 'adjuster_phone_c', 'defense_attorney_phone_c', 'defense_attorney_2_phone_c', 'z_bad_driver_1_phone_number_c', 'z_ada_clerk_phone_number_c', 'z_bad_driver_2_phone_number_c', 'z_bad_driver_3_phone_number_c', 'z_bad_driver_4_phone_number_c', 'z_bad_driver_4_phone_number_c', 'adjuster_phone'];
				$.each(fields, function(index, value){
					if($('#'+value).length > 0){
						$('#'+value).mask('999-999-9999 X 99999999999999');
					}
				});

				var required_fields = ".json_encode($required_fields).";

		function custom_validation(){
			console.log('custom_validation()');
			if(required_fields != ''){
				var msg = 'The Following fields are required:';
				var count = 0;
				$.each(required_fields, function( index, value ) {
				  if($('#'+ formName +' #'+index).val() == ''){
					  count = count +1;
					  msg = msg + '<br>' + value;
				  }
				});
				var module = '{$module}';
				var target_module = '{$target_module}';
				if(count > 0){
					YAHOO.SUGAR.MessageBox.show({msg: msg, width:'500px',title: 'Required Fields'});
					return false;

				}
				if(count > 0){
					if(module == 'MTS_Medical_Treatment_Summary' || target_module == 'MTS_Medical_Treatment_Summary'){
						if($('#medical_provider_organization').val() == '' && $('#medical_provider_person').val() == ''){
							var msg = msg + '<br>'+ 'One OF the Following two Fields should be filled to Save the Record:<br><br> Medical Provider Organization <br> Medical Provider Person';
						}
					}
					YAHOO.SUGAR.MessageBox.show({msg: msg, width:'500px',title: 'Required Fields'});
					return false;

				}else{
					if(module == 'MTS_Medical_Treatment_Summary' || target_module == 'MTS_Medical_Treatment_Summary'){
						var msg = 'One OF the Following two Fields should be filled to Save the Record: <br><br> Medical Provider Organization <br> Medical Provider Person';
						if($('#medical_provider_organization').val() == '' && $('#medical_provider_person').val() == ''){
							YAHOO.SUGAR.MessageBox.show({msg: msg, width:'500px',title: 'Required Fields'});
							return false;
						}
						else{
							return true;
						}
					}else{
						return true;
					}
				}
			}
			return true;
		}

			</script>
		";
			}
			else{
				$this->ev->process();
				echo $this->ev->display($this->showTitle);
			}
	}

    /**
     * Get a new EditView object
     * @return EditView
     */
    public function getEditView()
    {
        if(empty($this->ev)) {
            $this->ev = new EditView();
        }

        return $this->ev;
    }
}

