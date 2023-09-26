<?php
$viewdefs ['Cases'] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 
          array (
            'customCode' => '<input type="button" onclick="window.open(\'index.php?entryPoint=printPdf&client_cost_total=true&templateID=a6fabfe4-4f0c-6565-dfdd-5a8e8c78cf9c&module=Cases&uid={$fields.id.value}\')" target="_blank" value="Cost Report" />',
          ),
          4 => 
          array (
            'customCode' => '<input type="button" onclick="window.open(\'index.php?&module=Cases&action=client_costs_to_be_paid&record={$fields.id.value}\')" target="_blank" target="_blank" value="CLIENT COSTS TO BE PAID" />',
          ), 
		  5 => 
          array (
            'customCode' => '<input type="button" onclick="window.open(\'index.php?&module=Cases&action=client_costs_waived&record={$fields.id.value}\')" target="_blank" target="_blank" value="CLIENT COSTS WAIVED" />',
          ),
		  6 => 
          array (
            'customCode' => '<input type="button" onclick="show_case_related_events_report(\'{$fields.id.value}\');" target="_blank" value="Events Report" />',
          ),
          7 => 
          array (
            'customCode' => '{if $fields.status.value != "Closed"} <input title="{$APP.LBL_CLOSE_BUTTON_TITLE}" id="close_button" class="button"  onclick="this.form.status.value=\'Closed\'; this.form.action.value=\'Save\';this.form.return_module.value=\'Cases\';this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$fields.id.value}\'"  name="button1"  value="{$APP.LBL_CLOSE_BUTTON_TITLE}"  type="submit">{/if}',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$APP.LBL_CLOSE_BUTTON_TITLE}',
              'htmlOptions' => 
              array (
                'title' => '{$APP.LBL_CLOSE_BUTTON_TITLE}',
                'class' => 'button',
                'onclick' => 'this.form.status.value=\'Closed\'; this.form.action.value=\'Save\';this.form.return_module.value=\'Cases\';this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$fields.id.value}\'',
                'name' => 'button1',
                'id' => 'close_button',
              ),
            ),
          ),
          8 => 
          array (
            'customCode' => '<input type="button" onclick="show_related_module_files_zip_menu();" target="_blank" value="Download Related Module Files AS Zip" />',
          ),
		  9 => 
          array (
            'customCode' => '<input type="button" onclick="send_document_to_sign();" target="_blank" value="Send Document to Sign" />',
          ),
        ),
        'hidden' => 
        array (
          0 => '<input type="hidden" name="status" value="">',
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_CASE_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL6' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL7' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL4' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL1' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL5' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL2' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
		'LBL_RESOLUTION_STRATEGY_PANEL' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL3' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'lbl_case_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'label' => 'LBL_SUBJECT',
          ),
          1 => 'status',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'client_c',
            'studio' => 'visible',
            'label' => 'LBL_CLIENT',
          ),
          1 => 
          array (
            'name' => 'injured_person_c',
            'studio' => 'visible',
            'label' => 'LBL_INJURED_PERSON',
          ),
        ),
        2 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'gender',
            'label' => 'LBL_GENDER',
          ),
        ),
        3 => 
        array (
          0 => 'type',
          1 => 
          array (
            'name' => 'representation_capacity_c',
            'studio' => 'visible',
            'label' => 'LBL_REPRESENTATION_CAPACITY',
          ),
        ),
      ),
      'lbl_detailview_panel6' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'date_of_2nd_incident_c',
            'label' => 'LBL_DATE_OF_2ND_INCIDENT',
          ),
          1 => 
          array (
            'name' => 'county_of_2nd_incident_c',
            'studio' => 'visible',
            'label' => 'LBL_COUNTY_OF_2ND_INCIDENT',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'location_of_2nd_incident_c',
            'label' => 'LBL_LOCATION_OF_2ND_INCIDENT',
          ),
          1 => 
          array (
            'name' => 'statute_of_limitations_2nd_c',
            'label' => 'LBL_STATUTE_OF_LIMITATIONS_2ND',
          ),
        ),
      ),
      'lbl_detailview_panel7' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'insurance_or_collectability_c',
            'studio' => 'visible',
            'label' => 'LBL_INSURANCE_OR_COLLECTABILITY',
          ),
          1 => 
          array (
            'name' => 'case_insurance_summary_c',
            'label' => 'LBL_CASE_INSURANCE_SUMMARY',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'damages_c',
            'studio' => 'visible',
            'label' => 'LBL_DAMAGES',
          ),
          1 => 
          array (
            'name' => 'liability_c',
            'studio' => 'visible',
            'label' => 'LBL_LIABILITY',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'case_description_c',
            'studio' => 'visible',
            'label' => 'LBL_CASE_DESCRIPTION',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'police_c',
            'studio' => 'visible',
            'label' => 'LBL_POLICE',
          ),
          1 => 
          array (
            'name' => 'number_potential_plaintif_c',
            'studio' => 'visible',
            'label' => 'LBL_NUMBER_POTENTIAL_PLAINTIF',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'date_of_incident_c',
            'label' => 'LBL_DATE_OF_INCIDENT',
          ),
          1 => 
          array (
            'name' => 'county_of_incident_c',
            'studio' => 'visible',
            'label' => 'LBL_COUNTY_OF_INCIDENT',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'location_of_incident_c',
            'label' => 'LBL_LOCATION_OF_INCIDENT',
			'type' => 'LocationAddress',
            'displayParams' => 
            array (
              'key' => 'location',
            ),
          ),
          1 => 
          array (
            'name' => 'statute_of_limitations_c',
            'label' => 'LBL_STATUTE_OF_LIMITATIONS',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
          1 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
        ),
		7 => 
        array (
          0 => 'default_assistant_lawyer_name',
          1 => '',
        ),
      ),
      'lbl_detailview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'source_c',
            'studio' => 'visible',
            'label' => 'LBL_SOURCE',
          ),
          1 => 
          array (
            'name' => 'language_spoken_c',
            'studio' => 'visible',
            'label' => 'LBL_LANGUAGE_SPOKEN',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'referral_person_c',
            'studio' => 'visible',
            'label' => 'LBL_REFERRAL_PERSON',
          ),
          1 => 
          array (
            'name' => 'referral_attorney_c',
            'studio' => 'visible',
            'label' => 'LBL_REFERRAL_ATTORNEY',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
          ),
          1 => 
          array (
            'name' => 'date_modified',
            'label' => 'LBL_DATE_MODIFIED',
            'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
          ),
        ),
      ),
      'lbl_detailview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'judge_c',
            'studio' => 'visible',
            'label' => 'LBL_JUDGE',
          ),
          1 => 
          array (
            'name' => 'clerk_c',
            'studio' => 'visible',
            'label' => 'LBL_CLERK',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'judge_assistant_c',
            'label' => 'LBL_JUDGE_ASSISTANT',
          ),
          1 => 
          array (
            'name' => 'judge_asst_phone_c',
            'label' => 'LBL_JUDGE_ASST_PHONE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'judge_asst_email_c',
            'label' => 'LBL_JUDGE_ASST_EMAIL',
          ),
          1 => 
          array (
            'name' => 'judge_web_page_c',
            'label' => 'LBL_JUDGE_WEB_PAGE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'court_style_caption_c',
            'studio' => 'visible',
            'label' => 'LBL_COURT_STYLE_CAPTION',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'court_venue_c',
            'studio' => 'visible',
            'label' => 'LBL_COURT_VENUE',
          ),
          1 => 
          array (
            'name' => 'court_case_number_c',
            'label' => 'LBL_COURT_CASE_NUMBER',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'court_division_c',
            'label' => 'LBL_COURT_DIVISION',
          ),
          1 => 
          array (
            'name' => 'pre_trial_conference_hearing_c',
            'label' => 'LBL_PRE_TRIAL_CONFERENCE_HEARING',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'caption_plaintiff_c',
            'studio' => 'visible',
            'label' => 'LBL_CAPTION_PLAINTIFF',
          ),
          1 => 
          array (
            'name' => 'caption_defendant_c',
            'studio' => 'visible',
            'label' => 'LBL_CAPTION_DEFENDANT',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'plural_p_c',
            'label' => 'LBL_PLURAL_P',
          ),
          1 => 
          array (
            'name' => 'plural_d_c',
            'label' => 'LBL_PLURAL_D',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'caption_counterclaim_c',
            'studio' => 'visible',
            'label' => 'LBL_CAPTION_COUNTERCLAIM',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'cos_c',
            'studio' => 'visible',
            'label' => 'LBL_COS',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'defandant_tab',
            'label' => 'LBL_DEFANDANT_TAB',
            'customCode' => '{$DEFANDANTS}',
          ),
        ),
      ),
      'lbl_detailview_panel5' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'total_insurance_available_c',
            'label' => 'LBL_TOTAL_INSURANCE_AVAILABLE',
          ),
          1 => 
          array (
            'name' => 'total_um_available_c',
            'label' => 'LBL_TOTAL_UM_AVAILABLE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'total_recovered_c',
            'label' => 'LBL_TOTAL_RECOVERED',
          ),
          1 => 
          array (
            'name' => 'mdp_estimated_case_value_c',
            'label' => 'LBL_MDP_ESTIMATED_CASE_VALUE',
          ),
        ),
      ),
      'lbl_detailview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'amount_to_calc_closing_c',
            'label' => 'LBL_AMOUNT_TO_CALC_CLOSING',
          ),
          1 => 
          array (
            'name' => 'fee_percentage_c',
            'studio' => 'visible',
            'label' => 'LBL_FEE_PERCENTAGE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'firm_fee_c',
            'label' => 'LBL_FIRM_FEE',
          ),
          1 => 
          array (
            'name' => 'referral_fee_c',
            'label' => 'LBL_REFERRAL_FEE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'total_costs_c',
            'label' => 'LBL_TOTAL_COSTS',
          ),
          1 => 
          array (
            'name' => 'cost_hold_back_c',
            'label' => 'LBL_COST_HOLD_BACK',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'costs_plus_holdback_c',
            'label' => 'LBL_COSTS_PLUS_HOLDBACK',
          ),
          1 => 
          array (
            'name' => 'total_medical_bills_c',
            'label' => 'LBL_TOTAL_MEDICAL_BILLS',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'total_lops_liens_c',
            'label' => 'LBL_TOTAL_LOPS_LIENS',
          ),
          1 => 
          array (
            'name' => 'total_to_client_c',
            'label' => 'LBL_TOTAL_TO_CLIENT',
          ),
        ),
      ),
	  'lbl_resolution_strategy_panel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'resolution_strategy',
            'label' => 'LBL_RESOLUTION_STRATEGY',
          ),
        ),
      ),
      'lbl_detailview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'days_presuit_1_c',
            'label' => 'LBL_DAYS_PRESUIT_1',
          ),
          1 => 
          array (
            'name' => 'days_presuit_2_c',
            'label' => 'LBL_DAYS_PRESUIT_2',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'days_presuit_3_c',
            'label' => 'LBL_DAYS_PRESUIT_3',
          ),
          1 => 
          array (
            'name' => 'days_presuit_4_c',
            'label' => 'LBL_DAYS_PRESUIT_4',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'days_presuit_5_c',
            'label' => 'LBL_DAYS_PRESUIT_5',
          ),
          1 => 
          array (
            'name' => 'days_presuit_5_1_c',
            'label' => 'LBL_DAYS_PRESUIT_5_1',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'days_presuit_5_2_c',
            'label' => 'LBL_DAYS_PRESUIT_5_2',
          ),
          1 => 
          array (
            'name' => 'days_presuit_5_3_c',
            'label' => 'LBL_DAYS_PRESUIT_5_3',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'days_presuit_5_4_c',
            'label' => 'LBL_DAYS_PRESUIT_5_4',
          ),
          1 => 
          array (
            'name' => 'days_presuit_5_5_c',
            'label' => 'LBL_DAYS_PRESUIT_5_5',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'days_presuit_6_c',
            'label' => 'LBL_DAYS_PRESUIT_6',
          ),
          1 => 
          array (
            'name' => 'days_presuit_6_1_c',
            'label' => 'LBL_DAYS_PRESUIT_6_1',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'days_presuit_6_2_c',
            'label' => 'LBL_DAYS_PRESUIT_6_2',
          ),
          1 => 
          array (
            'name' => 'days_presuit_6_3_c',
            'label' => 'LBL_DAYS_PRESUIT_6_3',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'days_presuit_6_4_c',
            'label' => 'LBL_DAYS_PRESUIT_6_4',
          ),
          1 => 
          array (
            'name' => 'days_presuit_6_5_c',
            'label' => 'LBL_DAYS_PRESUIT_6_5',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'days_presuit_6_6_c',
            'label' => 'LBL_DAYS_PRESUIT_6_6',
          ),
          1 => 
          array (
            'name' => 'days_lit_1_c',
            'label' => 'LBL_DAYS_LIT_1',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'days_lit_2_c',
            'label' => 'LBL_DAYS_LIT_2',
          ),
          1 => 
          array (
            'name' => 'days_lit_3_c',
            'label' => 'LBL_DAYS_LIT_3',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'days_lit_4_c',
            'label' => 'LBL_DAYS_LIT_4',
          ),
          1 => 
          array (
            'name' => 'days_lit_5_c',
            'label' => 'LBL_DAYS_LIT_5',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'days_lit_6_c',
            'label' => 'LBL_DAYS_LIT_6',
          ),
          1 => 
          array (
            'name' => 'days_lit_7_c',
            'label' => 'LBL_DAYS_LIT_7',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'days_lit_8_c',
            'label' => 'LBL_DAYS_LIT_8',
          ),
          1 => 
          array (
            'name' => 'days_pending_signed_closed_c',
            'label' => 'LBL_DAYS_PENDING_SIGNED_CLOSED',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'days_pending_reductions_c',
            'label' => 'LBL_DAYS_PENDING_REDUCTIONS',
          ),
          1 => 
          array (
            'name' => 'days_appeal_pending_c',
            'label' => 'LBL_DAYS_APPEAL_PENDING',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'days_referred_out_c',
            'label' => 'LBL_DAYS_REFERRED_OUT',
          ),
          1 => 
          array (
            'name' => 'date_case_closed_c',
            'label' => 'LBL_DATE_CASE_CLOSED',
          ),
        ),
        15 => 
        array (
          0 => 
          array (
            'name' => 'total_case_length_c',
            'label' => 'LBL_TOTAL_CASE_LENGTH',
          ),
          1 => 
          array (
            'name' => 'med_mal_pre_suit_monitor_c',
            'label' => 'LBL_MED_MAL_PRE_SUIT_MONITOR',
          ),
        ),
      ),
    ),
  ),
);
