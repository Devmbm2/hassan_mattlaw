<?php
$viewdefs ['Complaints'] = 
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
        'LBL_COMPLAINT_INFORMATION' => 
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
      ),
    ),
    'panels' => 
    array (
      'lbl_complaint_information' => 
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
              'javascript' => 'load = initComplaintType();',
            ),
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'representation_capacity_c',
            'studio' => 'visible',
            'label' => 'LBL_REPRESENTATION_CAPACITY',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'type',
            'comment' => 'The type of issue (ex: issue, feature)',
            'label' => 'LBL_TYPE',
            'displayParam' => 
            array (
              'javascript' => 'load = initComplaintType();',
            ),
          ),
        ),
        4 => 
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
            'name' => 'complaint_insurance_summary_c',
            'label' => 'LBL_COMPLAINT_INSURANCE_SUMMARY',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'complaint_description_c',
            'studio' => 'visible',
            'label' => 'LBL_COMPLAINT_DESCRIPTION',
          ),
        ),
        3 => 
        array (
          0 => 
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
          0 => 'assigned_user_name',
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
              'javascript' => 'load = initComplaintSource();',
            ),
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
            'name' => 'court_complaint_number_c',
            'label' => 'LBL_COURT_COMPLAINT_NUMBER',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'court_division_c',
            'label' => 'LBL_COURT_DIVISION',
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
    ),
  ),
);
