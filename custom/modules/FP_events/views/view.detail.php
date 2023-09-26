<?php
require_once('include/MVC/View/views/view.detail.php');
class FP_eventsViewDetail extends ViewDetail {
	function FP_eventsViewDetail(){
		parent::ViewDetail();
	}
	function display() {
		$get_elements= "SELECT * FROM notes  WHERE document_id IS NOT NULL AND document_id!='' AND document_id='{$this->bean->id}' AND deleted=0";
        $result_elements = $this->bean->db->query($get_elements);
        $this->bean->attachments =
        '<table id="note_attachment_preview"><tr>';
        $count = 0;
        $note_ids = array();
        $file_names = array();
        $file_types = array();
        while($row = $this->bean->db->fetchByAssoc($result_elements)){
        $this->bean->attachments .='<td id="'.$row['id'].'" style="padding-top: 20px;padding-right: 15px;"><a href="index.php?entryPoint=download&id='.$row['id'].'&type=Notes" class="tabDetailViewDFLink" target="_blank">'.$row['filename'].'</a><img src="themes/Suite7/images/2ndaryclose.png" style="width: 12px; cursor:pointer;margin-left: 5px;" onclick="delete_attachment(\''.$row['id'].'\');remove_attachment(\''.$row['id'].'\');"/></td>';
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
        $this->bean->attachments .= '</tr></table>';
        $this->ss->assign('NOTE_IDS', implode(',', $note_ids));
        $this->ss->assign('FILE_NAMES', implode(',', $file_names));
        $this->ss->assign('FILE_TYPES', implode(',', $file_types));
        $this->ss->assign('ELEMENTS_FILES', $this->bean->attachments);
		echo "<script type='text/javascript'>var bean = ".json_encode($this->bean->toArray()).";
		if(bean['type_c']!='Deposition'){
					$(\"[field='deponent_c']\").parent().html('');
			}
			if(bean['type_c']!='Deposition' && bean['type_c']!='Compulsory_Medical_Exam'){
					$(\"[field='videographer_c']\").parent().html('');
			}
			if(bean['type_c']!='Deposition' && bean['type_c']!='Trial' && bean['type_c']!='Hearing' && bean['type_c']!='Statement_Under_Oath'){
					$(\"[field='court_reporter_c']\").parent().html('');
			}
			if(bean['type_c']!='Deposition' && bean['type_c']!='Trial' && bean['type_c']!='Hearing' && bean['type_c']!='Mediation' && bean['type_c']!='Intake' && bean['type_c']!='Meeting'){
					$(\"[field='travel_start_c']\").parent().html('');
					$(\"[field='travel_end_c']\").parent().html('');
			}
		</script>";
			//<script type='text/javascript' src='custom/modules/FP_events/js/hide_fields.js'></script>";
			$this->populateEventsTemplates();
			$this->displayPopupHtml();
			parent::display();
			if($_REQUEST['redirect'] == '1'){
				echo '
					<script type="text/javascript">
					$(document).ready(function(){
						$("#delete_button")[0].onclick = null;
						$("#delete_button").click(function() {
							var _form = document.getElementById("formDetailView"); 
							_form.return_module.value="Calendar";
							_form.return_action.value="index"; 
							_form.action.value="Delete"; 
							if(confirm("Are you sure you want to delete this record?")) 
							SUGAR.ajaxUI.submitForm(_form); 
							return false;
							
						});
						
					});	
					</script> 
				';
			}
	}
		function populateEventsTemplates(){
		global $app_list_strings;

		$sql = "SELECT id, name FROM aos_pdf_templates WHERE deleted = 0 AND type='FP_events' AND active = 1";

		$res = $this->bean->db->query($sql);
        $app_list_strings['template_ddown_c_list'] = array();
		while($row = $this->bean->db->fetchByAssoc($res)){
			$app_list_strings['template_ddown_c_list'][$row['id']] = $row['name'];
		}
	}

	function displayPopupHtml(){
		global $app_list_strings,$app_strings, $mod_strings;
        $templates = array_keys($app_list_strings['template_ddown_c_list']);
        if($templates){

		echo '	<div id="popupDiv_ara" style="display:none;position:fixed;top: 39%; left: 41%;opacity:1;z-index:9999;background:#FFFFFF;">
				<form id="popupForm" action="index.php?entryPoint=generatePdf" method="post">
 				<table style="border: #000 solid 2px;padding-left:40px;padding-right:40px;padding-top:10px;padding-bottom:10px;font-size:110%;" >
					<tr height="20">
						<td colspan="2">
						<b>'.$app_strings['LBL_SELECT_TEMPLATE'].':-</b>
						</td>
					</tr>';
			foreach($templates as $template){
				$template = str_replace('^','',$template);
				$js = "document.getElementById('popupDivBack_ara').style.display='none';document.getElementById('popupDiv_ara').style.display='none';var form=document.getElementById('popupForm');if(form!=null){form.templateID.value='".$template."';form.submit();}else{alert('Error!');}";
				echo '<tr height="20">
				<td width="17" valign="center"><a href="#" onclick="'.$js.'"><img src="themes/default/images/txt_image_inline.gif" width="16" height="16" /></a></td>
				<td><b><a href="#" onclick="'.$js.'">'.$app_list_strings['template_ddown_c_list'][$template].'</a></b></td></tr>';
			}
		echo '		<input type="hidden" name="templateID" value="" />
				<input type="hidden" name="task" value="pdf" />
				<input type="hidden" name="module" value="'.$_REQUEST['module'].'" />
				<input type="hidden" name="uid" value="'.$this->bean->id.'" />
				</form>
				<tr style="height:10px;"><tr><tr><td colspan="2"><button style=" display: block;margin-left: auto;margin-right: auto" onclick="document.getElementById(\'popupDivBack_ara\').style.display=\'none\';document.getElementById(\'popupDiv_ara\').style.display=\'none\';return false;">Cancel</button></td></tr>
				</table>
				</div>
				<div id="popupDivBack_ara" onclick="this.style.display=\'none\';document.getElementById(\'popupDiv_ara\').style.display=\'none\';" style="top:0px;left:0px;position:fixed;height:100%;width:100%;background:#000000;opacity:0.5;display:none;vertical-align:middle;text-align:center;z-index:9998;">
				</div>
				<script>
					function showPopup(task){
						var form=document.getElementById(\'popupForm\');
						var ppd=document.getElementById(\'popupDivBack_ara\');
						var ppd2=document.getElementById(\'popupDiv_ara\');
						if('.count($templates).' == 1){
							form.task.value=task;
							form.templateID.value=\''.$template.'\';
							form.submit();
						}else if(form!=null && ppd!=null && ppd2!=null){
							ppd.style.display=\'block\';
							ppd2.style.display=\'block\';
							form.task.value=task;
						}else{
							alert(\'Error!\');
						}
					}
				</script>';
		}
		else{
			echo '<script>
				function showPopup(task){
				alert(\''.$mod_strings['LBL_NO_TEMPLATE'].'\');
				}
			</script>';
		}
	}
}
