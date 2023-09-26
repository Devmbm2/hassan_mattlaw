<?php
require_once('include/MVC/View/views/view.detail.php');
class CasesViewDetail extends ViewDetail {
        function CasesViewDetail(){
        parent::ViewDetail();
}

function display() {
	global $current_user;
	if($current_user->id=="b0f1271b-0a49-d33b-9d80-6012ec0f15a8" OR  $current_user->id=='e4cd5835-f692-69de-3b3a-591598674c54' OR $current_user->id=='54f0da65-ef55-f73f-88f7-595f9370744a'){
    	}else{
        // unset($this->dv->defs['templateMeta']['form']['buttons'][3]);
	echo "<style>
	#close_button{
	display: none !important;}
	</style>";
	echo "<script type='text/javascript'>
				$( document ).ready(function() {
					$('#close_button').remove();
				});
			</script>";			
    	}	
	$this->populateCasesTemplates();
	$this->displayPopupHtml();
	/*echo "<style>
	.sub-panel > .panel-body > .tab-content > div
	{
		overflow:auto;
	}
	table.view
	{
		width:max-content;
		min-width:100%;
	}
	.table-responsive.list .pagination, .table-responsive.list .pagination tr, .table-responsive.list .pagination td, .table-responsive.list .pagination th
	{
		text-align: left !important;
	}
	</style>";*/
	echo "<script type='text/javascript'>var bean = ".json_encode($this->bean->toArray()).";
	$(document).ready(function(){
		if(bean['source_c']!='Referral_from_Attorney'){
                $(\"[field='referral_attorney_c']\").parent().html('');
                $(\"[field='referral_fee_c']\").parent().html('');
        }
        if(bean['source_c']!='Referral_from_NonAttorney' && bean['source_c']!='Former_Client'){
                $(\"[field='referral_person_c']\").parent().html('');
        }
        if(bean['client_c']==bean['injured_person_c']){
                $(\"[field='representation_capacity_c']\").parent().html('');
        }
        if(bean['type'].indexOf('Multiple_Claim') == -1){
           $('#date_of_2nd_incident_c').closest('.detail-view-row-item').hide();
           $('#statute_of_limitations_2nd_c').closest('.detail-view-row-item').hide();
           $('#location_of_2nd_incident_c').closest('.detail-view-row-item').hide();
           $('#county_of_2nd_incident_c').closest('.detail-view-row-item').hide();
	       $('#top-panel-0').parent().hide();
        }
        if((bean['type'].indexOf('Multiple_Claim') == -1) && (bean['type'].indexOf('Auto') == -1) && (bean['type'].indexOf('Trucking') == -1) && (bean['type'].indexOf('Bicycle') == -1) && (bean['type'].indexOf('Motorcycle') == -1)){
	   $('#number_potential_plaintif_c').closest('.detail-view-row-item').hide();
	}
	});
	</script>";
        //if((bean['type'].indexOf('Multiple_Claim') == -1) || (bean['type'].indexOf('Auto') == -1) || (bean['type'].indexOf('Trucking') == -1)){
	if($_REQUEST['doc_url']){
		echo "<script type='text/javascript'>
		$( document ).ready(function() {
			var win = window.open('{$_REQUEST['doc_url']}', '_blank');
			if (win == null || typeof(win)=='undefined') {  
				alert('Please disable your pop-up blocker and refresh this page'); 
			}else {  
				win.focus();
			}
		});
		</script>";
	}
	$fieldMappingDefandantUmDefandant['def_defendants_cases'] = array('attorney_id_1' => 'contact_id4_c', 
								  'attorney_name_1' => 'defense_attorney_c', 
								  'attorney_phone_1' => 'defense_attorney_phone_c',
								  'attorney_id_2' => 'contact_id5_c', 
								  'attorney_name_2' => 'defense_attorney_2_c', 
								  'attorney_phone_2' => 'defense_attorney_2_phone_c'
								);
	$fieldMappingDefandantUmDefandant['def_client_insurance_cases_1'] = array('attorney_id_1' => 'contact_id1', 
								  'attorney_name_1' => 'defense_attorney_c', 
								  'attorney_phone_1' => 'defense_attorney_phone_c',
								  'attorney_id_2' => 'contact_id2', 
								  'attorney_name_2' => 'defense_attorney_2_c', 
								  'attorney_phone_2' => 'defense_attorney_2_phone_c'
								);
	$defandants = $this->getRelatedDefandantData($fieldMappingDefandantUmDefandant);
	$this->ss->assign('DEFANDANTS', $defandants);
    parent::display();
	$time = time();
	//Prevent delete record from normal user
    if(!$GLOBALS['current_user']->is_admin){
		echo "<script type='text/javascript'>
				$( document ).ready(function() {
					$('#delete_button').hide();
				});
			</script>";
		//unset($this->dv->defs['templateMeta']['form']['buttons'][2]);
    }
	//echo "<script  src='custom/modules/Cases/js/hide_fields.js'></script>";
	echo '<link href="custom/include/multiselect/multiselect.css" rel="stylesheet" />';
	echo '<script type="text/javascript" src="custom/include/multiselect/multiselect.js"></script>';
	echo "<script  src='custom/modules/Cases/js/detail.js?v={$time}'></script>";
	echo "<script  src='custom/include/javascript/bootstrap-notify.min.js'></script>";
	echo '<script type="text/javascript">
		$( document ).ready(function() {
		  function DisplayClientCostReport(){
			 
			var bean_id = \'{$this->bean->id}\'; window.open("index.php?entryPoint=printPdf&client_cost_total=true&templateID=a6fabfe4-4f0c-6565-dfdd-5a8e8c78cf9c&module=Cases&uid="+bean_id); 
		  }
		   
		});
		
		</script>';
	echo "<script src='custom/include/SubPanel/SubPanel.js' defer></script>";
	
}
function getRelatedDefandantData($fieldMapping){
	$html = "";
	$html .= '<table id = "defandant" style="width: 100%;" >
			  <tr>
			  <td><span style = "font-size: 14px; font-weight: 700; color: #534d64;">Defendant</span></td>		  
			  <td><span style = "font-size: 14px; font-weight: 700; color: #534d64;">Attorney 1</span></td>
			  <td><span style = "font-size: 14px; font-weight: 700; color: #534d64;">Attorney 1 Phone</span></td>
			  <td><span style = "font-size: 14px; font-weight: 700; color: #534d64;">Attorney 2</span></td>
			  <td><span style = "font-size: 14px; font-weight: 700; color: #534d64;">Attorney 2 Phone</span></td>';		  
	$html  .= '</tr>';
	$relationships = array('def_defendants_cases', 'def_client_insurance_cases_1');
	foreach($relationships as $relationship){
		$attorney_id_1 = $fieldMapping[$relationship]['attorney_id_1'];
		$attorney_name_1 = $fieldMapping[$relationship]['attorney_name_1'];
		$attorney_phone_1 = $fieldMapping[$relationship]['attorney_phone_1'];
		$attorney_id_2 = $fieldMapping[$relationship]['attorney_id_2'];
		$attorney_name_2 = $fieldMapping[$relationship]['attorney_name_2'];
		$attorney_phone_2 = $fieldMapping[$relationship]['attorney_phone_2'];
		if($this->bean->load_relationship($relationship)){
			$relatedAttorney = $this->bean->$relationship->getBeans();
			if(!empty($relatedAttorney)){
				$attorny = array();
				foreach($relatedAttorney as $id => $data){
					$html .= '<tr>
					<td><a href="index.php?module='. $data->module_dir .'&action=DetailView&record='.$data->id .'" target="_blank">'. $data->name .'</a></td>  
					<td><a href="index.php?module=Contacts&action=DetailView&record='.$data->$attorney_id_1.'" target="_blank">'.$data->$attorney_name_1.'</a></td>
					<td>'.$data->$attorney_phone_1.'</td>
					<td><a href="index.php?module=Contacts&action=DetailView&record='.$data->$attorney_id_2.'" target="_blank">'.$data->$attorney_name_2.'</a></td>
					<td>'.$data->$attorney_phone_2.'</td>';	  
					$html  .= '</tr>';
				}
			}
		}
	}	
	$html .= "</table>";
	return $html;
}

protected function _displaySubPanels()
        {
        if (isset($this->bean) && !empty($this->bean->id) && (file_exists('modules/' . $this->module . '/metadata/subpaneldefs.php') || file_exists('custom/modules/' . $this->module . '/metadata/subpaneldefs.php') || file_exists('custom/modules/' . $this->module . '/Ext/Layoutdefs/layoutdefs.ext.php'))) {
                $GLOBALS['focus'] = $this->bean;
                require_once ('include/SubPanel/SubPanelTiles.php');
                $subpanel = new SubPanelTiles($this->bean, $this->module);
				
                //Dependent logic
                if (strpos($this->bean->type, "Companion") == false)
                {
                        unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['comp_companions_cases']);
                }
				/* unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['activities']); */
		unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['disc_discovery_cases_done']);
		unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['plea_pleadings_cases_done']);		
		$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['disc_discovery_cases_3rd']['order'] = 1;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['authorizations']['order'] = 2;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['bugs']['order'] = 3;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['ht_case_event_cases']['order'] = 4;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['cost_client_cost_cases']['order'] = 5;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['client_insurance']['order'] = 6;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts']['order'] = 7;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['correspondence']['order'] = 8;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['cases_ht_damages']['order'] = 9;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['defendant_insurance']['order'] = 10;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['def_defendants_cases']['order'] = 11;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['disc_discovery_cases']['order'] = 12;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['disc_discovery_cases_done']['order'] = 13;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['emails']['order'] = 14;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['cases_fp_events_1']['order'] = 15;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['hard_documents']['order'] = 16;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['investigation']['order'] = 17;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['neg_negotiations_cases']['order'] = 18;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['history']['order'] = 19;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['accounts']['order'] = 20;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['plea_pleadings_cases']['order'] = 21;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['plea_pleadings_cases_done']['order'] = 22;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['project']['order'] = 23;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['securitygroups']['order'] = 24;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['soft_documents']['order'] = 25;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['activities_done']['order'] = 26;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['activities']['order'] = 27;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['activities_overdue']['order'] = 28;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['activities_skipped']['order'] = 29;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['transcripts_statements']['order'] = 30;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['trail_documents']['order'] = 31;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['def_client_insurance_cases_1']['order'] = 32;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['ht_vehicles_cases_1']['order'] = 33;
	$subpanel->subpanel_definitions->layout_defs['subpanel_setup']['get_case_workflows']['order'] = 34;
                echo $subpanel->display();
            }
        }
		
	function populateCasesTemplates(){
		global $app_list_strings, $current_user;

		$sql = "SELECT id, name FROM aos_pdf_templates WHERE deleted=0 AND type='Cases' AND active = 1 AND id='a6fabfe4-4f0c-6565-dfdd-5a8e8c78cf9c'";

		$res = $this->bean->db->query($sql);

        $app_list_strings['template_ddown_c_list'] = array();
		while($row = $this->bean->db->fetchByAssoc($res)){
            if($row['id']){
			    $app_list_strings['template_ddown_c_list'][$row['id']] = $row['name'];
            }
		}
	}

	function displayPopupHtml(){
		global $app_list_strings,$app_strings, $mod_strings;
        $templates = array_keys($app_list_strings['template_ddown_c_list']);
		if($templates){

		echo '	<div id="popupDiv_ara" style="display:none;position:fixed;top: 39%; left: 41%;opacity:1;z-index:9999;background:#FFFFFF;">
				<form id="popupForm" action="index.php?entryPoint=printPdf&client_cost_total=true&display=true" method="post">
 				<table style="border: #000 solid 2px;padding-left:40px;padding-right:40px;padding-top:10px;padding-bottom:10px;font-size:110%;" >
					<tr height="20">
						<td colspan="2">
						<b>'.$app_strings['LBL_SELECT_TEMPLATE'].':-</b>
						</td>
					</tr>';
			foreach($templates as $template){
                if(!$template){
                    continue;

                }
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
?>
