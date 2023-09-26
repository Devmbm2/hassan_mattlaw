<?php
$module_name = 'ht_EmailExtract';
$viewdefs [$module_name] =
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
      'includes' =>
      array (
        // 2 =>
        // array (
        //   'file' => 'custom/modules/ht_EmailExtract/js/edit.js',
        // ),
      ),
      'useTabs' => false,
      'tabDefs' =>
      array (
        'DEFAULT' =>
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' =>
    array (
      'default' =>
      array (
        0 =>
        array (
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        1 =>
        array (
          0 =>
          array (
            'name' => 'from_email',
            'label' => 'LBL_FROM_EMAIL',
          ),
          1 =>
          array (
            'name' => 'convert_to_module',
            'label' => 'LBL_CONVERT_TO_MODULE',
          ),
        ),
        // 2 =>
        // array (
        //   0 =>
        //   array (
        //     'name' => 'NoOfDaysForEmailExtraction',
        //     'label' => 'LBL_sync_emails_day',
        //   ),
        //   1 =>
        //   array (
        //     'name' => 'only_sync_status',
        //     'label' => 'LBL_ONLY_SYNC_STATUS',
        //   ),
        // ),
        // 2 =>
        // array (
        //   0 =>
        //   array (
        //     'name' => 'CheckDuplicate_C',
        //     'label' => 'LBL_CHECKDUPLICATE_C',
        //   ),
        // ),
        2 =>
        array (
          0 =>
          array (
            'name' => 'is_active',
            'label' => 'LBL_IS_ACTIVE',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
