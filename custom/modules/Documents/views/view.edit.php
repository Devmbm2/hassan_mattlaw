<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

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


class DocumentsViewEdit extends ViewEdit
{

    /**
     * @see SugarView::ViewEdit()
     */
     function __construct(){
        //parent::__construct();
        parent::ViewEdit();
        $this->useForSubpanel = true;
		$this->useModuleQuickCreateTemplate = true;
     }

    /**
     * @deprecated deprecated since version 7.6, PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code, use __construct instead
     */
    function DocumentsViewEdit(){
        $deprecatedMessage = 'PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code';
        if(isset($GLOBALS['log'])) {
            $GLOBALS['log']->deprecated($deprecatedMessage);
        }
        else {
            trigger_error($deprecatedMessage, E_USER_DEPRECATED);
        }
        self::__construct();
    }


 	/**
	 * @see SugarView::display()
	 */
	public function display()
 	{
		global $app_list_strings, $mod_strings;
		global$current_user;
		$load_signed=false;
		if ((isset($_REQUEST['load_signed_id']) && !empty($_REQUEST['load_signed_id']))) {

			$load_signed=true;
			if (isset($_REQUEST['record'])) {
				$this->bean->related_doc_id=$_REQUEST['record'];
			}
			if (isset($_REQUEST['selected_revision_id'])) {
				$this->bean->related_doc_rev_id=$_REQUEST['selected_revision_id'];
			}

			$this->bean->id=null;
			$this->bean->document_name=null;
			$this->bean->filename=null;
			$this->bean->is_template=0;
		} //if

		if (!empty($this->bean->id) ||
            (empty($this->bean->id) && !empty($_REQUEST['record']) && !empty($_REQUEST['action']) && strtolower($_REQUEST['action'])=='quickedit')
        ) {
			$this->ss->assign("FILE_OR_HIDDEN", "hidden");
			if (!$this->ev->isDuplicate) {
				$this->ss->assign("DISABLED", "disabled");
			}
		} else {
			$this->bean->revision = 1;
		    $this->ss->assign("FILE_OR_HIDDEN", "file");
		}

		$popup_request_data = array(
			'call_back_function' => 'document_set_return',
			'form_name' => 'EditView',
			'field_to_name_array' => array(
				'id' => 'related_doc_id',
				'document_name' => 'related_document_name',
				),
			);
		$json = getJSONobj();
		$this->ss->assign('encoded_document_popup_request_data', $json->encode($popup_request_data));


		//get related document name.
		if (!empty($this->bean->related_doc_id)) {
			$this->ss->assign("RELATED_DOCUMENT_NAME",Document::get_document_name($this->bean->related_doc_id));
			$this->ss->assign("RELATED_DOCUMENT_ID",$this->bean->related_doc_id);
			if (!empty($this->bean->related_doc_rev_id)) {
				$this->ss->assign("RELATED_DOCUMENT_REVISION_OPTIONS", get_select_options_with_id(DocumentRevision::get_document_revisions($this->bean->related_doc_id), $this->bean->related_doc_rev_id));
			} else {
				$this->ss->assign("RELATED_DOCUMENT_REVISION_OPTIONS", get_select_options_with_id(DocumentRevision::get_document_revisions($this->bean->related_doc_id), ''));
			}
		} else {
			$this->ss->assign("RELATED_DOCUMENT_REVISION_DISABLED", "disabled");
		}


		//set parent information in the form.
		if (isset($_REQUEST['parent_id'])) {
			$this->ss->assign("PARENT_ID",$_REQUEST['parent_id']);
		} //if

		if (isset($_REQUEST['parent_name'])) {
			$this->ss->assign("PARENT_NAME", $_REQUEST['parent_name']);

			if (!empty($_REQUEST['parent_type'])) {
				switch (strtolower($_REQUEST['parent_type'])) {

					case "contracts" :
						$this->ss->assign("LBL_PARENT_NAME",$mod_strings['LBL_CONTRACT_NAME']);
						break;

					//todo remove leads case.
					case "leads" :
						$this->ss->assign("LBL_PARENT_NAME",$mod_strings['LBL_CONTRACT_NAME']);
						break;
				} //switch
			} //if
		} //if

		if (isset($_REQUEST['parent_type'])) {
			$this->ss->assign("PARENT_TYPE",$_REQUEST['parent_type']);
		}

		if ($load_signed) {
			$this->ss->assign("RELATED_DOCUMENT_REVISION_DISABLED", "disabled");
			$this->ss->assign("RELATED_DOCUMENT_BUTTON_AVAILABILITY", "hidden");
			$this->ss->assign("LOAD_SIGNED_ID",$_REQUEST['load_signed_id']);
		} else {
			$this->ss->assign("RELATED_DOCUMENT_BUTTON_AVAILABILITY", "button");
		} //if-else
		/* print"<pre>";print_r($_REQUEST); */
		////////////////////////////////////
			$get_elements= "SELECT *
						FROM notes
						WHERE document_id IS NOT NULL AND document_id!='' AND document_id='{$this->bean->id}' AND deleted=0";
		$result_elements = $this->bean->db->query($get_elements);
		$this->bean->attachments = '<table id="note_attachment_preview"><tr>';
		$count = 0;
		$note_ids = array();
		$file_names = array();
		$file_types = array();
		/* echo '<script type="text/javascript">
			var documents_id = [];
			var documents_names = [];
			var documents_types = [];
			</script>'; */
		while($row = $this->bean->db->fetchByAssoc($result_elements)){
			$this->bean->attachments .='
			<td id="'.$row['id'].'" style="padding-top: 20px;padding-right: 15px;"><a href="index.php?entryPoint=download&id='.$row['id'].'&type=Notes" class="tabDetailViewDFLink" target="_blank">'.$row['filename'].'</a><img src="themes/Suite7/images/2ndaryclose.png" style="width: 12px; cursor:pointer;margin-left: 5px;" onclick="delete_attachment(\''.$row['id'].'\');"/></td>';
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
		/* echo $this->bean->attachments;die;echo 'tttttttttt'; */
		$this->bean->attachments .= '</tr></table>';
		$this->ss->assign('NOTE_IDS', implode(',', $note_ids));
		$this->ss->assign('FILE_NAMES', implode(',', $file_names));
		$this->ss->assign('FILE_TYPES', implode(',', $file_types));
		$this->ss->assign('ELEMENTS_FILES', $this->bean->attachments);
		///////////////////////////////////
		/* echo $this->bean->subcategory_id;die; */
		/* print"<pre>";print_r($_REQUEST); */
		if (isset($_REQUEST['parent_id']) && $_REQUEST['parent_id'] != '' && isset($_REQUEST['parent_type']) &&  $_REQUEST['parent_type'] == 'Cases'){
                         $case = new aCase();
                         $case->retrieve($_REQUEST['parent_id']);
                         $_REQUEST['case_type_c'] = $case->type;
                         $_REQUEST['case_status_c'] = $case->status;
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
                 $this->bean->filename=$row['name'];
             }

        }

// pre($_REQUEST);
 		parent::display();
         if(!empty($_REQUEST['attachments'])){
            echo "<style>
                div.modal-content{
                    width:900px;
                }
            </style>";
        }
		echo '
			<div class="message_dialog_div" id="message_dialog_div" style="display:none;  background-color:white;">
				<div class="message_dialog" id="message_dialog_Events" style="background-color:white;overflow-y: auto;
				overflow-x: auto;">
				</div>
			</div>
		';
		echo "<script type='text/javascript' src='custom/modules/Documents/js/events.js?v={$time}'></script>";
		echo "<script type='text/javascript' src='custom/modules/Documents/js/edit_view.js?v={$time}'></script>";
		if($_REQUEST['subcategory_id'] == 'Trial'){
			echo "
			<script type='text/javascript'>
				$(document).ready(function(){
					$('#format_c').parent().parent().hide();
				});
			</script>
			";
		}
		if($this->bean->subcategory_id == 'Investigation' || $_REQUEST['subcategory_id'] == 'Investigation' || $this->bean->subcategory_id == 'Transcripts_Statements' || $_REQUEST['subcategory_id'] == 'Transcripts_Statements'){
			echo "
			<script type='text/javascript'>
				$(document).ready(function(){
					$('#detailpanel_0').parent().show();
				});
			</script>
			";
		}else{
				echo "
			<script type='text/javascript'>
				$(document).ready(function(){
					$('#detailpanel_0').parent().hide();
				});
			</script>
			";
		}


                echo "
                <script type='text/javascript'>
                        $(document).ready(function(){
				//docName();
				$('#subcategory_id').on('change','docName();');
                                $('#contacts_documents_1_name').on('blur',function(){docName();});
                                $('#btn_contacts_documents_1_name').on('blur',function(){docName();});
				$('#contacts_documents_1contacts_ida').on('change',function(){docName();});
                                $('#date_of_document_c').attr('onchange','docName();');
                                $('#format_c').attr('onchange','docName();');
                        });
				function docName(){
				    if($('#subcategory_id').val() == 'Transcripts_Statements'){
						var deponent = $('#contacts_documents_1_name').val();
						var date = $('#date_of_document_c').val();
						var format = $('#format_c option:selected').text();
						var docName = deponent+' '+date+' '+format;
						$('#document_name').val(docName);
						//document.EditView.document_name.value = docName;
				    }
				}
                </script>
                ";
		if($_REQUEST['target_action'] == 'QuickCreate' && $_REQUEST['action'] == 'SubpanelCreates'&& $_REQUEST['parent_type'] == 'MEDB_Medical_Bills' && $current_user->id != 1){

			echo "
			<script type='text/javascript'>
				$(document).ready(function(){
					$('#doc_type').attr('disabled',true);
					$('#subcategory_id').attr('disabled',true);
					$('#hard_or_soft_doc').attr('disabled',true);
					$('#authors_name_c').closest('.edit-view-row-item').hide();
				});
			</script>
			";
		}
		if($_REQUEST['target_action'] == 'QuickCreate' && $_REQUEST['action'] == 'SubpanelCreates'&& $_REQUEST['parent_type'] != 'MEDB_Medical_Bills'){

			echo "
			<script type='text/javascript'>
				$(document).ready(function(){
					addToValidate('EditView','authors_name_c','varchar',true,'Authors Name');
					$('div[data-label=\"LBL_AUTHORS_NAME\"]').html('Author Name: <font color=#ff0000>*</font>');
				});
			</script>
			";
		}

		if($_REQUEST['return_relationship'] != 'medb_medical_bills_documents_reductions'){
			echo "
			<script type='text/javascript'>
				$(document).ready(function(){
					$('#medb_medical_bills_name').parent().parent().hide();
					$('#category_id').attr('disabled',false);
				});
			</script>
			";
		}
 	}

	/**
	 * @see SugarView::_getModuleTitleParams()
	 */
	protected function _getModuleTitleParams($browserTitle = false)
	{
    	$params = array();
    	$params[] = $this->_getModuleTitleListParam($browserTitle);
    	if(!empty($this->bean->id)){
			$params[] = "<a href='index.php?module={$this->module}&action=DetailView&record={$this->bean->id}'>".$this->bean->document_name."</a>";
			$params[] = $GLOBALS['app_strings']['LBL_EDIT_BUTTON_LABEL'];
		}else{
			$params[] = $GLOBALS['app_strings']['LBL_CREATE_BUTTON_LABEL'];
		}

		return $params;
    }

}
