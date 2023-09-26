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

class PLEA_PleadingsViewEdit extends ViewEdit{
	public function __construct()
 	{
        // pre($_REQUEST);
 		parent::__construct();
 		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
 	}
    public function display()
    {

		$sugarConfig = SugarConfig::getInstance();
		echo "<script>
			YUI.applyConfig({
				base: '" . $sugarConfig->get('site_url') . "/include/javascript/yui3/build/',
				combine: false
			});</script>";
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
		// if($_REQUEST['IsModelDropdown']==true){
        //         $get_elements= "SELECT *
        //         FROM notes
        //         WHERE parent_id IS NOT NULL AND parent_id!='' AND parent_id='{$_REQUEST['attachments']}' AND deleted=0";
        // }else{
                $get_elements= "SELECT * FROM notes  WHERE document_id IS NOT NULL AND document_id!='' AND document_id='{$this->bean->id}' AND deleted=0";
        // }
        $result_elements = $this->bean->db->query($get_elements);
        $this->bean->attachments = '<table id="note_attachment_preview"><tr>';
        $count = 0;
        $note_ids = array();
        $file_names = array();
        $file_types = array();
        while($row = $this->bean->db->fetchByAssoc($result_elements)){
            $this->bean->attachments .='
            <td id="'.$row['id'].'" style="padding-top: 20px;padding-right: 15px;"><a href="index.php?entryPoint=download&id='.$row['id'].'&type=Notes" class="tabDetailViewDFLink" target="_blank">'.$row['filename'].'</a><img src="themes/Suite7/images/2ndaryclose.png" style="width: 12px; cursor:pointer;margin-left: 5px;" onclick="delete_attachment(\''.$row['id'].'\');remove_attachment(\''.$row['id'].'\');"/></td>';
            $count++;
            if($count % 3 == 0) {
                $this->bean->attachments .='</tr><tr>';
            }
            $note_ids[] = $row['id'];
            $file_names[] = $row['filename'];
            $file_types[] = $row['file_mime_type'];
            echo '<script type="text/javascript">
                    documents_id.push("'.$row['id'].'");
                    documents_names.push("'.$row['filename'].'");
                    documents_types.push("'.$row['file_mime_type'].'")
            </script>';
        }
// pre($_REQUEST);
        $this->bean->attachments .= '</tr></table>';
        $this->ss->assign('NOTE_IDS', implode(',', $note_ids));
        $this->ss->assign('FILE_NAMES', implode(',', $file_names));
        $this->ss->assign('FILE_TYPES', implode(',', $file_types));
        $this->ss->assign('ELEMENTS_FILES', $this->bean->attachments);
        parent::display();
		global $app_list_strings;
		global $mod_strings;
		$time = time();

        if(!empty($_REQUEST['attachments'])){
            echo "<style>
                div.modal-content{
                    width:900px;
                }
            </style>";
        }
		echo "
		<link href='custom/include/multiselect/multiselect.css' rel='stylesheet' />
		<script type='text/javascript' src='custom/include/multiselect/multiselect.js'></script>
		<script type='text/javascript'>
				var display_hide_fields = '';
				display_hide_fields = ".json_encode($app_list_strings['pleading_show_hide_fields']).";
					$(document).ready(function(){
						var formName = '{$formName}';
						$('#'+ formName +' #events_multiple_assigned_users').multiselect({
							columns: 1,
							placeholder: 'Select Multiple Assigned Users',
							search: true,
							selectAll: true
						});

					});
		</script>
		<script type='text/javascript' src='custom/include/javascript/visible/ht_fields_show_hide.js?v={$time}'></script>
		<script type='text/javascript' src='custom/modules/PLEA_Pleadings/js/add_validate.js?v={$time}'></script>
		<script type='text/javascript' src='custom/include/javascript/visible/plead_noticetype.js?v={$time}'></script>
		<script type='text/javascript' src='custom/include/javascript/visible/plead_casetype.js?v={$time}'></script>
		<script type='text/javascript' src='custom/modules/Documents/js/events.js?v={$time}'></script>
		<script type='text/javascript' src='custom/modules/PLEA_Pleadings/js/event_add_validate.js?v={$time}'></script>
		<script type='text/javascript' src='custom/modules/PLEA_Pleadings/js/edit.js?v={$time}'></script>
		";
		echo '
			<div class="message_dialog_div" id="message_dialog_div" style="display:none;  background-color:white;">
				<div class="message_dialog" id="message_dialog_Events" style="width:200px;height:400px;background-color:white;overflow-y: auto;
				overflow-x: auto;">
				</div>
			</div>
		';
    }
}
