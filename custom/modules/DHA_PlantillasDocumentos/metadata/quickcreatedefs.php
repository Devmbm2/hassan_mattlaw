<?php
$module_name = 'DHA_PlantillasDocumentos';
$viewdefs [$module_name] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'enctype' => 'multipart/form-data',
        'hidden' => 
        array (
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
      'javascript' => '<script type="text/javascript" src="include/javascript/popup_parent_helper.js?s={$SUGAR_VERSION}&c={$JS_CUSTOM_VERSION}"></script>
                       <script type="text/javascript" src="include/javascript/jsclass_base.js"></script>
                       <script type="text/javascript" src="include/javascript/jsclass_async.js"></script>
                       <script type="text/javascript" src="modules/Documents/documents.js?s={$SUGAR_VERSION}&c={$JS_CUSTOM_VERSION}"></script>',
      'useTabs' => false,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'uploadfile',
            'displayParams' => 
            array (
              'onchangeSetFileNameTo' => 'document_name',
            ),
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'document_name',
            'displayParams' => 
            array (
              'size' => '60',
            ),
          ),
          1 => 
          array (
            'name' => 'caption_cos_fixed_c',
            'label' => 'LBL_CAPTION_COS_FIXED',
          ),
        ),
        2 => 
        array (
          0 => 'category_id',
          1 => 
          array (
            'name' => 'selection_contact_status_c',
            'studio' => 'visible',
            'label' => 'LBL_SELECTION_CONTACT_STATUS',
          ),
        ),
        3 => 
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
        4 => 
        array (
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'modulo',
            'studio' => 'visible',
            'label' => 'LBL_MODULO',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'description',
          ),
          1 => 
          array (
            'name' => 'aclroles',
            'customLabel' => '<span>{sugar_translate label=\'LBL_ROLES_WITH_ACCESS\' module=$fields.parent_type.value}<br>(<i>{sugar_translate label=\'LBL_ROLES_WITH_ACCESS_HELP\' module=$fields.parent_type.value}</i>) </span>',
            'displayParams' => 
            array (
              'size' => 5,
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
