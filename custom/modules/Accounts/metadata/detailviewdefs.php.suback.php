<?php
// created: 2017-10-18 23:45:28
$viewdefs['Accounts']['DetailView'] = array (
  'templateMeta' => 
  array (
    'form' => 
    array (
      'buttons' => 
      array (
        0 => 'EDIT',
        1 => 'DUPLICATE',
        2 => 'DELETE',
        3 => 'FIND_DUPLICATES',
        'AOS_GENLET' => 
        array (
          'customCode' => '<input type="button" class="button" onClick="showPopup();" value="{$APP.LBL_PRINT_AS_PDF}">',
        ),
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
    ),
    'useTabs' => true,
    'tabDefs' => 
    array (
      'LBL_ACCOUNT_INFORMATION' => 
      array (
        'newTab' => true,
        'panelDefault' => 'expanded',
      ),
      'LBL_PANEL_ADVANCED' => 
      array (
        'newTab' => true,
        'panelDefault' => 'expanded',
      ),
      'LBL_PANEL_ASSIGNMENT' => 
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
          'comment' => 'Name of the Company',
          'label' => 'LBL_NAME',
        ),
        1 => 
        array (
          'name' => 'nickname_c',
          'label' => 'LBL_NICKNAME',
        ),
      ),
      1 => 
      array (
        0 => 
        array (
          'name' => 'phone_office',
          'comment' => 'The office phone number',
          'label' => 'LBL_PHONE_OFFICE',
        ),
        1 => 
        array (
          'name' => 'phone_fax',
          'comment' => 'The fax phone number of this company',
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
          'name' => 'billing_address_street',
          'label' => 'LBL_BILLING_ADDRESS',
          'type' => 'address',
          'displayParams' => 
          array (
            'key' => 'billing',
          ),
        ),
        1 => 
        array (
          'name' => 'description',
          'comment' => 'Full text of the note',
          'label' => 'LBL_DESCRIPTION',
        ),
      ),
      4 => 
      array (
        0 => 
        array (
          'name' => 'account_type',
          'comment' => 'The Company is of this type',
          'label' => 'LBL_TYPE',
        ),
        1 => 
        array (
          'name' => 'expert_type_c',
          'studio' => 'visible',
          'label' => 'LBL_EXPERT_TYPE',
        ),
      ),
      5 => 
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
      6 => 
      array (
        0 => 
        array (
          'name' => 'website',
          'type' => 'link',
          'label' => 'LBL_WEBSITE',
          'displayParams' => 
          array (
            'link_target' => '_blank',
          ),
        ),
      ),
    ),
  ),
);