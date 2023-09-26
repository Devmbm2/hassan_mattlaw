<?php
$module_name = 'DHA_PlantillasDocumentos';
$_object_name = 'dha_plantillasdocumentos';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DELETE',
        ),
      ),
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
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => false,
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
            'name' => 'doc_type',
            'label' => 'LBL_DOC_TYPE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'uploadfile',
            'displayParams' => 
            array (
              'link' => 'uploadfile',
              'id' => 'id',
            ),
          ),
          1 => 
          array (
            'name' => 'use_letterhead',
            'studio' => 'visible',
            'label' => 'LBL_USE_LETTERHEAD',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'document_name',
            'label' => 'LBL_DOC_NAME',
          ),
          1 => 
          array (
            'name' => 'caption_cos_fixed_c',
            'label' => 'LBL_CAPTION_COS_FIXED',
          ),
        ),
        3 => 
        array (
          0 => 'category_id',
          1 => 'subcategory_id',
        ),
        4 =>
        array (
          0 =>
          array (
            'name' => 'selection_contact_status_c',
            'studio' => 'visible',
            'label' => 'LBL_SELECTION_CONTACT_STATUS',
          ),
          1 => '',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'select_contact_for_document_c',
            'studio' => 'visible',
            'label' => 'LBL_SELECT_CONTACT_FOR_DOCUMENT',
          ),
          1 => 
          array (
            'name' => 'idioma',
            'studio' => 'visible',
            'label' => 'LBL_IDIOMA_PLANTILLA',
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
            'name' => 'modulo',
            'studio' => 'visible',
            'label' => 'LBL_MODULO',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'label' => 'LBL_DOC_DESCRIPTION',
          ),
          1 => 
          array (
            'name' => 'aclroles',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'pre_suit_c',
            'studio' => 'visible',
            'label' => 'LBL_PRE_SUIT',
          ),
          1 => 
          array (
            'name' => 'insurance_c',
            'studio' => 'visible',
            'label' => 'LBL_INSURANCE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'investigation_c',
            'studio' => 'visible',
            'label' => 'LBL_INVESTIGATION',
          ),
          1 => 
          array (
            'name' => 'medical_information_c',
            'studio' => 'visible',
            'label' => 'LBL_MEDICAL_INFORMATION',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'litigation_c',
            'studio' => 'visible',
            'label' => 'LBL_LITIGATION',
          ),
          1 => 
          array (
            'name' => 'pleading_types_c',
            'studio' => 'visible',
            'label' => 'LBL_PLEADING_TYPES',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'closing_c',
            'studio' => 'visible',
            'label' => 'LBL_CLOSING',
          ),
        ),
      ),
    ),
  ),
);
