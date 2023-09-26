<?php
$viewdefs ['Cases'] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
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
        'LBL_EDITVIEW_PANEL6' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL5' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL4' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
		'LBL_RESOLUTION_STRATEGY_PANEL' => 
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
            'displayParam' => 
            array (
              'javascript' => 'load = initCaseType();',
            ),
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
          0 => 
          array (
            'name' => 'representation_capacity_c',
            'studio' => 'visible',
            'label' => 'LBL_REPRESENTATION_CAPACITY',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'type',
            'comment' => 'The type of issue (ex: issue, feature)',
            'label' => 'LBL_TYPE',
            'displayParam' => 
            array (
              'javascript' => 'load = initCaseType();',
            ),
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'description_short_c',
            'label' => 'LBL_DESCRIPTION_SHORT',
          ),
        ),
      ),
      'lbl_editview_panel6' => 
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
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'statute_of_limitations_c',
            'label' => 'LBL_STATUTE_OF_LIMITATIONS',
          ),
          1 => 'assigned_user_name',
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
        ),
      ),
      'lbl_editview_panel5' => 
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
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'source_c',
            'studio' => 'visible',
            'label' => 'LBL_SOURCE',
            'displayParam' => 
            array (
              'javascript' => 'load = initCaseSource();',
            ),
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
      ),
      'lbl_editview_panel1' => 
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
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'mdp_estimated_case_value_c',
            'label' => 'LBL_MDP_ESTIMATED_CASE_VALUE',
          ),
          1 => 
          array (
            'name' => 'amount_to_calc_closing_c',
            'label' => 'LBL_AMOUNT_TO_CALC_CLOSING',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'fee_percentage_c',
            'studio' => 'visible',
            'label' => 'LBL_FEE_PERCENTAGE',
          ),
          1 => 
          array (
            'name' => 'firm_fee_c',
            'label' => 'LBL_FIRM_FEE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'referral_fee_c',
            'label' => 'LBL_REFERRAL_FEE',
          ),
          1 => 
          array (
            'name' => 'cost_hold_back_c',
            'label' => 'LBL_COST_HOLD_BACK',
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
			'customCode' => '<textarea id="resolution_strategy" name="resolution_strategy" maxlength = "1000" rows="6" cols="80" title="" tabindex="0" style="width:100%;"></textarea>'
          ),
        ),
      ),
    ),
  ),
);
