<?php
require_once('include/MVC/View/views/view.detail.php');
class DocumentsViewDetail extends ViewDetail {
	function DocumentsViewDetail(){
		parent::ViewDetail();
	}

function display() {

	echo "<script type='text/javascript'>
		var bean = 	bean = ".json_encode($this->bean->toArray()).";
		$(document).ready(function(){
			$('#trial_type').parent().parent().hide();
			if(bean['subcategory_id']!='Transcripts_Statements'){
				$('#transcript_types_c').parent().parent().hide();
				$('#format_c').parent().parent().hide();
				$('#contacts_documents_1contacts_ida').parent().parent().hide();
			}
			if(bean['subcategory_id']!='Client_Insurance'){
				$('#insurance_type_c').parent().parent().hide();
			}
			if(bean['subcategory_id']!='Authorizations'){
				$('#authorization_types_c').parent().parent().hide();
			}
			if(bean['subcategory_id']!='Defendant_Insurance'){
				$('#def_insurance_types_c').parent().parent().hide();
			}
			if(bean['subcategory_id']!='Investigation'){
				$('#investigation_types_c').parent().parent().hide();
			}
			if(bean['transcript_type_c']!='Trial_Transcript'){
				$('#trial_transcript_types_c').parent().parent().hide();
			}
			if(bean['insurance_type_c']!='Uninsured_Motorist_Stacked'){
				$('#number_of_vehicles_stacking_c').parent().parent().hide();
			}
			if(bean['subcategory_id']=='Trial'){
				$('#trial_type').parent().parent().show();
			}
		});
		</script>";
	if($_REQUEST['doc_url']){
		echo "<script type='text/javascript'>
		\$( document ).ready(function() {
			var win = window.open('{$_REQUEST['doc_url']}', '_blank');
			if (win == null || typeof(win)=='undefined') {  
				alert('Please disable your pop-up blocker and refresh this page'); 
			}else {  
				win.focus();
			}
		});
		</script>";
	}
        parent::display();
		echo "<script type='text/javascript' src='custom/modules/Documents/js/detail.js'></script>";
		
}
protected function _displaySubPanels()
        {
        if (isset($this->bean) && !empty($this->bean->id) && (file_exists('modules/' . $this->module . '/metadata/subpaneldefs.php') || file_exists('custom/modules/' . $this->module . '/metadata/subpaneldefs.php') || file_exists('custom/modules/' . $this->module . '/Ext/Layoutdefs/layoutdefs.ext.php'))) {
                $GLOBALS['focus'] = $this->bean;
                require_once ('include/SubPanel/SubPanelTiles.php');
                $subpanel = new SubPanelTiles($this->bean, $this->module);
                //Dependent logic
                if ($this->bean->subcategory_id != "Transcripts_Statements" && $this->bean->subcategory_id != "Investigation"){
                        unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['document_notes_media']);
                }
                echo $subpanel->display();
            }
        }
}
?>
