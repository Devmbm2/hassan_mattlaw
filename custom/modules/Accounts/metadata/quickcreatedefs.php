<?php
$viewdefs ['Accounts'] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/Accounts/Account.js',
        ),
        1 => 
        array (
          'file' => 'custom/include/javascript/visible/org_type.js',
        ),
		2 => 
        array (
          'file' => 'custom/modules/Accounts/js/type_of_corporation.js',
        ),
      ),
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_ACCOUNT_INFORMATION' => 
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
      'lbl_account_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
          ),
          1 => 
          array (
            'name' => 'nickname_c',
            'type' => 'dupdetector',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'phone_office',
            'type' => 'dupdetector',
          ),
          1 => 
          array (
            'name' => 'phone_fax',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'phone_alternate',
            'comment' => 'An alternate phone number',
            'label' => 'LBL_PHONE_ALT',
          ),
          1 => 
          array (
            'name' => 'email1',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'case_role',
            'label' => 'LBL_CASE_ACCOUNT_ROLE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_street',
            'comment' => 'The street address used for billing address',
            'label' => 'LBL_BILLING_ADDRESS_STREET',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_city',
            'comment' => 'The city used for billing address',
            'label' => 'LBL_BILLING_ADDRESS_CITY',
          ),
          1 => 
          array (
            'name' => 'billing_address_state',
            'comment' => 'The state used for billing address',
            'label' => 'LBL_BILLING_ADDRESS_STATE',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_postalcode',
            'comment' => 'The postal code used for billing address',
            'label' => 'LBL_BILLING_ADDRESS_POSTALCODE',
          ),
          1 => 
          array (
            'name' => 'country',
            'studio' => 'visible',
            'label' => 'LBL_COUNTRY',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'account_type',
          ),
          1 => 
          array (
            'name' => 'expert_type_c',
            'studio' => 'visible',
            'label' => 'LBL_EXPERT_TYPE',
          ),
        ),
		9 => 
        array (
          0 => 'type_of_corporation',
          1 => 'states',
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'ownership',
            'comment' => '',
            'label' => 'LBL_OWNERSHIP',
          ),
          1 => '',
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'medicine_type_c',
            'studio' => 'visible',
            'label' => 'LBL_MEDICINE_TYPE',
          ),
          1 => 
          array (
            'name' => 'tax_id_number_c',
            'label' => 'LBL_TAX_ID_NUMBER',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'website',
          ),
          1 => 
          array (
            'name' => 'mr_monitor_records_accounts_1_name',
            'label' => 'LBL_MR_MONITOR_RECORDS_ACCOUNTS_1_FROM_MR_MONITOR_RECORDS_TITLE',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'ra_name_c',
            'label' => 'LBL_RA_NAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'shipping_address_street',
            'comment' => 'The street address used for for shipping purposes',
            'label' => 'LBL_SHIPPING_ADDRESS_STREET',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'ada_name_title_or_person_c',
            'label' => 'LBL_ADA_NAME_TITLE_OR_PERSON',
          ),
          1 => '',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'ada_address_c',
            'label' => 'LBL_ADA_ADDRESS',
          ),
          1 => 
          array (
            'name' => 'ada_address_city_c',
            'label' => 'LBL_ADA_ADDRESS_CITY',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'ada_address_state_c',
            'label' => 'LBL_ADA_ADDRESS_STATE',
          ),
          1 => 
          array (
            'name' => 'ada_address_postalcode_c',
            'label' => 'LBL_ADA_ADDRESS_POSTALCODE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'ada_phone_c',
            'label' => 'LBL_ADA_PHONE',
          ),
          1 => 
          array (
            'name' => 'ada_email_c',
            'label' => 'LBL_ADA_EMAIL',
          ),
        ),
      ),
    ),
  ),
);
