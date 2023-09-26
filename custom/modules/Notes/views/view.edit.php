<?php
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2016 Salesagility Ltd.
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
require_once('include/MVC/View/views/view.edit.php');
require_once('include/SugarTinyMCE.php');

class NotesViewEdit extends ViewEdit {

    function __construct(){
        parent::__construct();
		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
    }

  

		public function display()
    {
		/* if(!empty($this->bean->id)){ */
			/* echo '<div class="message_dialog_div" id="message_dialog_div" style="display:none;  background-color:white;">
				<div class="message_dialog" id="message_dialog" style="background-color:white;">
				</div>
			</div>';
			$module=$_REQUEST['module'];
			$this->ev->defs['templateMeta']['includes'][]['file'] = 'custom/include/select2/js/select2.min.js';
			$this->ev->defs['templateMeta']['includes'][]['file'] = 'custom/include/select2/css/select2.min.css';
			$this->ev->defs['templateMeta']['includes'][]['file'] = 'custom/include/slack/slack_popup.js'; */
			/* $this->ev->defs['templateMeta']['form']['buttons'][] = array('customCode' => '<input type="button" class="button" id = "slack_notification" onClick="sendMessage(\'{$fields.id.value}\' , \'{$module}\');" title="Send Slack Notification" value="Save & Notify">',); */
			/* print"<pre>";print_r($this->ev->defs['templateMeta']['form']['buttons']); */
			/* if(empty($this->bean->id)){
				sugar_die($GLOBALS['app_strings']['ERROR_NO_RECORD']);
			} */
		/* } */
        $this->ev->process();
        parent::display();
		/* echo "<script type='text/javascript' src='custom/include/javascript/loadingoverlay.min.js'></script> ";
		echo "<script type='text/javascript'>
		 $('#slack_notification').on('click', function(e) {
				$('#send_message')[0].onclick = null;
				$('#send_message').click(function() { 
					var user_id = $('#validator').val();
					var sms_text1 = $('#user_notes').val();
					if(sms_text1 == '' || user_id == null || user_id == ''){
						alert('Please enter some message before proceeding.');
						return false;
					}else{
						$('#user_id').val(user_id);
						$('#sms_text').val(sms_text1);
						$('#send_slack_notification').val('send');
						$('.container-close').trigger('click');
						var _form = document.getElementById('EditView'); _form.action.value='Save'; if(check_form('EditView'))SUGAR.ajaxUI.submitForm(_form);return false;
					}
				
				});				
		});
		</script> ";
		echo "<link href='custom/include/select2/css/select2.min.css' rel='stylesheet' type='text/css'/>";
			echo "<script type='text/javascript' src='custom/include/select2/js/select2.min.js'></script> "; */
			
    }
}
	
