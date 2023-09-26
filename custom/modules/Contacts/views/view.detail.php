<?php
require_once('include/MVC/View/views/view.detail.php');
class ContactsViewDetail extends ViewDetail {
        function ContactsViewDetail(){
        parent::ViewDetail();
	}

	function display(){

	echo "<script type='text/javascript'>var bean = " .json_encode($this->bean->toArray()). ";
	if(bean['salutation']!='Honorable'){
                $(\"[field='judge_web_page_c']\").parent().html('');
        }
        if(bean['marital_status_c']!='Married' && bean['marital_status_c']!='Separated' && bean['marital_status_c']!='Life_Partner'){
                $(\"[field='spouse_name_c']\").parent().html('');
        }
        if((bean['salutation']!='Dr.' && bean['salutation']!='Prof.' && bean['salutation']!='Honorable' && bean['type_c']!='Doctor' && bean['type_c']!='Judge') || (bean['salutation']=='Sr.' || bean['salutation']=='Jr.' || bean['salutation']=='III' || bean['salutation']=='IV')){
                $(\"[field='assistant']\").parent().html('');
                $(\"[field='assistant_phone']\").parent().html('');
        }
        if(bean['work_injury_status_c']!='Yes'){
                $(\"[field='work_injury_details_c']\").parent().html('');
        }
        if(bean['type_c']!='Doctor'){
                $(\"[field='doctor_type_c']\").parent().html('');
        }
        if(bean['work_injury_c']!='Yes'){
                $(\"[field='work_injury_status_c']\").parent().html('');
        }
        if(bean['military_c']!='Yes'){
                $(\"[field='honorably_discharged_c']\").parent().html('');
        }
        if(bean['arrested_c']!='Yes'){
                $(\"[field='arrest_details_c']\").parent().html('');
        }
        if(bean['children_c']!='Yes'){
                $(\"[field='about_childrenc']\").parent().html('');
        }
	</script>
       <script type='text/javascript' src='custom/modules/Contacts/js/hide_fields.js'></script>";
       // echo "<style>
       //  .sub-panel > .panel-body > .tab-content > div
       //  {
       //          overflow:auto;
       //  }
       //  table.view
       //  {
       //          width:max-content;
       //          min-width:100%;
       //  }
       //  </style>";
       global $current_user;
       if (!$current_user->is_admin){
		/* echo "<script type='text/javascript' src='custom/modules/Contacts/js/mask_ssn_detail.js'></script>"; */
       }
	    /* $stream_html = $this->getStreamHtml(); */
		// echo $stream_html;die;
		/* $this->ss->assign('ACTIVITY_STREAM_HTML', $stream_html); */
        parent::display();
		$time = time();
		echo "<script  src='cache/include/javascript/sugar_grp_yui_widgets.js'></script>";
		/* echo '<link href="custom/include/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>';
		echo '<script type="text/javascript" src="custom/include/select2/js/select2.min.js"></script>'; */
		echo '<link href="custom/include/multiselect/multiselect.css" rel="stylesheet" />';
		echo '<script type="text/javascript" src="custom/include/multiselect/multiselect.js"></script>';
		echo "<script type='text/javascript' src='custom/modules/Contacts/js/detail.js?v={$time}'></script>";
	//	echo "<script type='text/javascript' src='custom/include/javascript/loadingoverlay.min.js'></script> ";
		$time = time();		
		/* echo "<link href='custom/modules/Contacts/contact.css?v={$time}' rel='stylesheet' type='text/css'/>"; */
		/* echo "<script  src='custom/include/twillio/message.js?v={$time}'></script>";
		echo '<div class="message_dialog_div" id="message_dialog_div" style="display:none;  background-color:white;">
		<div class="message_dialog" id="message_dialog" style="background-color:white;">
		</div>
		</div>'; */
		if($_REQUEST['doc_url']){
			$js =  "<script type='text/javascript'>";
			$js .=" \$( document ).ready(function() {";
			foreach($_REQUEST['doc_url'] AS $dURL){
				$js .="window.open('{$dURL}', '_blank');";
			}
			$js .="});</script>";
			echo $js;
		}
		echo "<script src='custom/include/SubPanel/SubPanel.js'></script>";
	}
	
/* 	function getStreamHtml(){
		global $db, $timedate, $current_user,$app_list_strings;
		$this->bean->load_relationship('contact_ht_sms');
		$params = array(
			'order_by' => 'date_entered ASC' ,
		);
		$caseActivities = $this->bean->contact_ht_sms->getBeans($params);
		$stream_html .= '<div class="commentsection" id="comment_section" style="padding: 25px;70px;max-height: 400px;overflow-y: scroll;">';
		foreach($caseActivities as $id => $act){
		$css_class = ($act->sent_received == 'sent') ? 'left':'right';
		$stream_html .='<div class="comments '.$css_class.'_comment" id="'.$act->id.'_row"><h5>'.$act->from_number.' | '.$act->date_entered.'</h5>'.nl2br(html_entity_decode($act->description)).'</div>';
		}
		$stream_html .='</div>';
		$stream_html .='<div id="stream_footer_content" style="padding: 0px 100px;">
				<input type="hidden" id="current_user_name" value="'.$current_user->name.'">
				<textarea id="new_activity_post" name="new_activity_post" rows="4" cols="100" title="" tabindex="0" style=" width: 100%;margin-top:+20px;"></textarea>
			</div>';
		$stream_html .= '<input type="button" value="Send Message" onclick="SendMessageApi(\''.$this->bean->id .'\' , \''.$this->bean->module_dir .'\', \''.$this->bean->phone_mobile .'\');" style=" margin-left: 583px;margin-top: 10px;">';
		return $stream_html;
	} */
		protected function _displaySubPanels()
        {
        if (isset($this->bean) && !empty($this->bean->id) && (file_exists('modules/' . $this->module . '/metadata/subpaneldefs.php') || file_exists('custom/modules/' . $this->module . '/metadata/subpaneldefs.php') || file_exists('custom/modules/' . $this->module . '/Ext/Layoutdefs/layoutdefs.ext.php'))) {
                $GLOBALS['focus'] = $this->bean;
                require_once ('include/SubPanel/SubPanelTiles.php');
                $subpanel = new SubPanelTiles($this->bean, $this->module);
		if ($this->bean->type_c == "Claims_Adjuster")
                {
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['leads']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['medb_medical_bills_contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['medr_medical_records_contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts_medp_medical_providers_1']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['mts_medical_treatment_summary_contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_ht_address_book']);
                }
		if ($this->bean->type_c == "Defendant")
                {
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['activities']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['history']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['documents']);
                   /* unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['cases']); */
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['medr_medical_recrods_contact']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts_medp_medical_providers_1']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['fp_events_contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['mts_medical_treatment_summary_contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['soft_documents']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts_documents_1']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts_neg_negotiations_1']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_ht_address_book']);
                }
		if ($this->bean->type_c == "Doctor")
                {
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['leads']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['medb_medical_bills_contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['medr_medical_records_contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts_medp_medical_providers_1']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['mts_medical_treatment_summary_contacts']);
                }
		if ($this->bean->type_c == "Expert_Witness")
                {
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['leads']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['medb_medical_bills_contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_medr_medical_records']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts_medp_medical_providers_1']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['mts_medical_treatment_summary_contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_ht_address_book']);
                }
		if ($this->bean->type_c == "Insured" || $this->bean->type_c == "Investigator" || $this->bean->type_c == "Lawyer" || $this->bean->type_c == "Lien_Holder" || $this->bean->type_c == "Police" || $this->bean->type_c == "Vendor" || $this->bean->type_c == "Witness_BandA" || $this->bean->type_c == "Witness_Fact")
                {
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['leads']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['medb_medical_bills_contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_medr_medical_records']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts_medp_medical_providers_1']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['mts_medical_treatment_summary_contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_ht_address_book']);
                }
		if ($this->bean->type_c == "Judge")
                {
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['leads']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['medb_medical_bills_contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_medr_medical_records']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts_medp_medical_providers_1']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['mts_medical_treatment_summary_contacts']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_ht_address_book']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts_neg_negotiations_1']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_ht_radiology']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_mdoc_incoming_bills']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['activities']);
                   unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts_documents_1']);
                }
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_ht_address_book']['order'] = 1;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['bugs']['order'] = 2;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['cases']['order'] = 3;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['campaigns']['order'] = 4;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_aos_contracts']['order'] = 5;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts']['order'] = 6;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['emails']['order'] = 7;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['fp_events_contacts']['order'] = 8;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['documents']['order'] = 9;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_aos_invoices']['order'] = 10;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['leads']['order'] = 11;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['lien_liens_lops_contacts']['order'] = 12;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['mts_medical_treatment_summary_contacts']['order'] = 13;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts_medp_medical_providers_1']['order'] = 14;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_medr_medical_records']['order'] = 15;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts_neg_negotiations_1']['order'] = 16;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['history']['order'] = 17;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['ForHistory']['order'] = 18;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['opportunities']['order'] = 19;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['project']['order'] = 20;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_aos_quotes']['order'] = 21;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_ht_radiology']['order'] = 22;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contact_mdoc_incoming_bills']['order'] = 23;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['medb_medical_bills_contacts']['order'] = 24;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['related_received_medical_bills']['order'] = 25;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['soft_documents']['order'] = 26;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['securitygroups']['order'] = 27;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['activities']['order'] = 28;
                $subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts_documents_1']['order'] = 29;
                echo $subpanel->display();
            }
        }
}
?>
