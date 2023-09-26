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
 */

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

class NEG_NegotiationsViewEdit extends ViewEdit{

 	public function __construct()
 	{
 		parent::__construct();
 		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
 	}
    public function display()
    {
		global $app_list_strings;
        if (isset($_REQUEST['parent_id']) && $_REQUEST['parent_id'] != '' && isset($_REQUEST['parent_type']) &&  $_REQUEST['parent_type'] == 'Cases'){
         $case = new aCase();
         $case->retrieve($_REQUEST['parent_id']);
         $_REQUEST['case_type_c'] = $app_list_strings['case_type_list'][$case->type];//get value from dropdown by key
         }

        if (isset($this->bean->id)) {
            $this->ss->assign('FILE_OR_HIDDEN', 'hidden');
            if (empty($_REQUEST['isDuplicate']) || $_REQUEST['isDuplicate'] === 'false') {
                $this->ss->assign('DISABLED', 'disabled');
            }
        } else {
            $this->ss->assign('FILE_OR_HIDDEN', 'file');
        }
		$formName = $this->ev->formName;
		if(empty($formName)){
			$formName = 'EditView';
		}
        if($_REQUEST['IsModelDropdown']==true){
                $get_elements= "SELECT *
                FROM notes
                WHERE parent_id IS NOT NULL AND parent_id!='' AND parent_id='{$_REQUEST['attachments']}' AND deleted=0";
        }else{
                $get_elements= "SELECT * FROM notes  WHERE document_id IS NOT NULL AND document_id!='' AND document_id='{$this->bean->id}' AND deleted=0";
        }
        $result_elements = $this->bean->db->query($get_elements);
        if($result_elements->num_rows==1){
             while($row = $this->bean->db->fetchByAssoc($result_elements)){
                 $this->bean->uploadfile=$row['name'];
             }

        }
// pre($_REQUEST);
        parent::display();
		$time = time();
		echo '<link href="custom/include/multiselect/multiselect.css" rel="stylesheet" />';
		echo '<script type="text/javascript" src="custom/include/multiselect/multiselect.js"></script>';
		echo "<script  src='custom/include/javascript/visible/neg_case_type.js'></script>";
		echo "
		<script type='text/javascript'>
			 $(document).ready(function(){
				var formName = '{$formName}';
				$('#multiple_assigned_users, #events_multiple_assigned_users').multiselect({
					columns: 1,
					placeholder: 'Select Multiple Assigned Users',
					search: true,
					selectAll: true
				});
				negName();
				$('#initial_counter').attr('onchange','negName();');
				$('#'+formName+ ' #type').attr('onchange','negName();');
				$('#sent_rec').attr('onchange','negName();');
				$('#account_id_c').on('change',function(){negName();});
				$('#insurance_company').on('blur',function(){negName();});
				$('#btn_insurance_company').on('blur',function(){negName();});

				$('#insurance_company').on('change',function(){negName();});
				$('#amount').on('keyup',function(){negName();});
			 });
			function negName() {
				var initial_counter = $('#initial_counter').val();
				var type = $('#'+formName+ ' #type option:selected').text();
				var sent_rec = $('#sent_rec option:selected').text();
				var ins_com = $('#insurance_company').val();
				var amount = $('#amount').val();
				if (amount.length != 0){amount = '$'+Number(amount).toLocaleString('en-US')}
				var negName = '';
				negName = initial_counter+' '+type+' '+sent_rec+' '+ins_com+' '+amount;
				//document.EditView.document_name.value = negName;
				$('#'+formName+ ' #document_name').val(negName);
			}
		</script>";
        echo "<script type='text/javascript' src='custom/modules/Documents/js/events.js?v={$time}'></script>";
        echo '
            <div class="message_dialog_div" id="message_dialog_div" style="display:none;  background-color:white;">
                <div class="message_dialog" id="message_dialog_Events" style="background-color:white;overflow-y: auto;
                overflow-x: auto;">
                </div>
            </div>
        ';

    }
}
