<?php
$viewdefs ['Users'] = 
array (
  'EditView' => 
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
	  'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/modules/Users/js/edit.js',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_USER_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'LBL_USER_INFORMATION' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'user_name',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
          1 => 
          array (
            'name' => 'is_admin',
            'studio' => 
            array (
              'listview' => false,
              'searchview' => false,
              'related' => false,
            ),
            'label' => 'LBL_IS_ADMIN',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'status',
            'customCode' => '{if $IS_ADMIN}@@FIELD@@{else}{$STATUS_READONLY}{/if}',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
          1 => 
          array (
            'name' => 'title',
            'customCode' => '{if $IS_ADMIN}@@FIELD@@{else}{$TITLE_READONLY}{/if}',
          ),
        ),
        2 => 
        array (
          0 => 'first_name',
          1 => 'last_name',
        ),
        3 => 
        array (
          0 => 'phone_work',
          1 => 'phone_mobile',
        ),
        4 => 
        array (
          0 => 'address_street',
          1 => 'address_city',
        ),
        5 => 
        array (
          0 => 'address_state',
          1 => 'address_postalcode',
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'sugar_login',
            'studio' => 
            array (
              'listview' => false,
              'searchview' => false,
              'formula' => false,
            ),
            'label' => 'LBL_SUGAR_LOGIN',
          ),
          1 => 
          array (
            'name' => 'UserType',
            'customCode' => '{if $IS_ADMIN}{$USER_TYPE_DROPDOWN}{else}{$USER_TYPE_READONLY}{/if}',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'attorney_signature_c',
            'studio' => 'visible',
            'label' => 'LBL_ATTORNEY_SIGNATURE',
          ),
          1 => 'default_letterhead',
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'initials_c',
            'label' => 'LBL_INITIALS',
          ),
          1 => 'show_on_calendar',
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'atty_bar_number_c',
            'label' => 'LBL_ATTY_BAR_NUMBER',
          ),
		  1 => 'updated_filter',
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'default_assistant_name',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
