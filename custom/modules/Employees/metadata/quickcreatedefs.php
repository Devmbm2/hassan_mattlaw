<?php
$viewdefs ['Employees'] = 
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
      'form' => 
      array (
        'headerTpl' => 'modules/Users/tpls/EditViewHeader.tpl',
        'footerTpl' => 'modules/Users/tpls/EditViewFooter.tpl',
      ),
      'useTabs' => true,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'employee_status',
            'customCode' => '{if $EDIT_REPORTS_TO || $IS_ADMIN}@@FIELD@@{else}{$EMPLOYEE_STATUS_READONLY}{/if}',
          ),
          1 => 
          array (
            'name' => 'title',
            'customCode' => '{if  $EDIT_REPORTS_TO || $IS_ADMIN}@@FIELD@@{else}{$TITLE_READONLY}{/if}',
          ),
        ),
        1 => 
        array (
          0 => 'first_name',
          1 => 
          array (
            'name' => 'last_name',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
        ),
        2 => 
        array (
          0 => 'phone_work',
          1 => 
          array (
            'name' => 'phone_mobile',
            'label' => 'LBL_MOBILE_PHONE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'address_street',
            'label' => 'LBL_PRIMARY_ADDRESS',
          ),
          1 => 
          array (
            'name' => 'address_city',
            'label' => 'LBL_CITY',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'email1',
            'displayParams' => 
            array (
              'required' => false,
            ),
          ),
          1 => 
          array (
            'name' => 'initials_c',
            'label' => 'LBL_INITIALS',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'address_state',
            'label' => 'LBL_STATE',
          ),
          1 => 
          array (
            'name' => 'address_postalcode',
            'label' => 'LBL_POSTAL_CODE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'atty_bar_number_c',
            'label' => 'LBL_ATTY_BAR_NUMBER',
          ),
          1 => 
          array (
            'name' => 'attorney_signature_c',
            'studio' => 'visible',
            'label' => 'LBL_ATTORNEY_SIGNATURE',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'label' => 'LBL_NOTES',
          ),
        ),
      ),
    ),
  ),
);
$viewdefs['Employees']['QuickCreate']['templateMeta'] = array (
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
  'form' => 
  array (
    'headerTpl' => 'modules/Users/tpls/EditViewHeader.tpl',
    'footerTpl' => 'modules/Users/tpls/EditViewFooter.tpl',
  ),
);
?>
