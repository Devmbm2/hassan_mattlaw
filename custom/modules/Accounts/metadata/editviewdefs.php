<?php
$viewdefs ['Accounts'] = 
array (
  'EditView' => 
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
            'type' => 'dupdetector',
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
          ),
          1 => 
          array (
            'name' => 'phone_fax',
            'label' => 'LBL_FAX',
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
            'studio' => 'false',
            'label' => 'LBL_EMAIL',
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
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_street',
            'hideLabel' => true,
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'billing',
              'rows' => 2,
              'cols' => 30,
              'maxlength' => 150,
            ),
          ),
        ),
        6 => 
        array (
          0 => 'account_type',
          1 => 
          array (
            'name' => 'ownership',
            'comment' => '',
            'label' => 'LBL_OWNERSHIP',
          ),
        ),
        7 => 
        array (
          0 => 'type_of_corporation',
          1 => 'states',
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'country',
            'studio' => 'visible',
            'label' => 'LBL_COUNTRY',
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
        10 => 
        array (
          0 => 
          array (
            'name' => 'website',
            'type' => 'link',
            'label' => 'LBL_WEBSITE',
          ),
          1 => 
          array (
            'name' => 'mr_monitor_records_accounts_1_name',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'save_contact',
            'label' => 'LBL_SAVE_CONTACT',
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
            'hideLabel' => true,
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'shipping',
              'copy' => 'billing',
              'rows' => 2,
              'cols' => 30,
              'maxlength' => 150,
            ),
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
