<?php
$module_name = 'MTS_Medical_Treatment_Summary';
$_object_name = 'mts_medical_treatment_summary';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'form' => 
      array (
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
      'useTabs' => true,
      'tabDefs' => 
      array (
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
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'treatment_date',
            'label' => 'LBL_TREATMENT_DATE',
          ),
        ),
        1 => 
        array (
          0 => 'document_name',
          1 => 'uploadfile',
        ),
        2 => 
        array (
          0 => 'description',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'medical_provider_organization',
            'studio' => 'visible',
            'label' => 'LBL_MEDICAL_PROVIDER_ORGANIZATION',
          ),
          1 => 
          array (
            'name' => 'medical_provider_person',
            'studio' => 'visible',
            'label' => 'LBL_MEDICAL_PROVIDER_PERSON',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'treatment_description_summary',
            'studio' => 'visible',
            'label' => 'LBL_TREATMENT_DESCRIPTION_SUMMARY',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'treatment_work_product_note',
            'studio' => 'visible',
            'label' => 'LBL_TREATMENT_WORK_PRODUCT_NOTE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'symptom_1',
            'studio' => 'visible',
            'label' => 'LBL_SYMPTOM_1',
          ),
          1 => 
          array (
            'name' => 'pain_scale',
            'studio' => 'visible',
            'label' => 'LBL_PAIN_SCALE',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'symptom_2',
            'studio' => 'visible',
            'label' => 'LBL_SYMPTOM_2',
          ),
          1 => 
          array (
            'name' => 'pain_scale_2',
            'studio' => 'visible',
            'label' => 'LBL_PAIN_SCALE_2',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'symptom_3',
            'studio' => 'visible',
            'label' => 'LBL_SYMPTOM_3',
          ),
          1 => 
          array (
            'name' => 'pain_scale_3',
            'studio' => 'visible',
            'label' => 'LBL_PAIN_SCALE_3',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'symptom_4',
            'studio' => 'visible',
            'label' => 'LBL_SYMPTOM_4',
          ),
          1 => 
          array (
            'name' => 'pain_scale_4',
            'studio' => 'visible',
            'label' => 'LBL_PAIN_SCALE_4',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'symptom_5',
            'studio' => 'visible',
            'label' => 'LBL_SYMPTOM_5',
          ),
          1 => 
          array (
            'name' => 'pain_scale_5',
            'studio' => 'visible',
            'label' => 'LBL_PAIN_SCALE_5',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'symptom_6',
            'studio' => 'visible',
            'label' => 'LBL_SYMPTOM_6',
          ),
          1 => 
          array (
            'name' => 'pain_scale_6',
            'studio' => 'visible',
            'label' => 'LBL_PAIN_SCALE_6',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'symptom_7',
            'studio' => 'visible',
            'label' => 'LBL_SYMPTOM_7',
          ),
          1 => 
          array (
            'name' => 'pain_scale_7',
            'studio' => 'visible',
            'label' => 'LBL_PAIN_SCALE_7',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'symptom_8',
            'studio' => 'visible',
            'label' => 'LBL_SYMPTOM_8',
          ),
          1 => 
          array (
            'name' => 'pain_scale_8',
            'studio' => 'visible',
            'label' => 'LBL_PAIN_SCALE_8',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'symptom_9',
            'studio' => 'visible',
            'label' => 'LBL_SYMPTOM_9',
          ),
          1 => 
          array (
            'name' => 'pain_scale_9',
            'studio' => 'visible',
            'label' => 'LBL_PAIN_SCALE_9',
          ),
        ),
        15 => 
        array (
          0 => 
          array (
            'name' => 'symptom_10',
            'studio' => 'visible',
            'label' => 'LBL_SYMPTOM_10',
          ),
          1 => 
          array (
            'name' => 'pain_sclae_10',
            'studio' => 'visible',
            'label' => 'LBL_PAIN_SCLAE_10',
          ),
        ),
        16 => 
        array (
          0 => 
          array (
            'name' => 'symptom_other',
            'label' => 'LBL_SYMPTOM_OTHER',
          ),
          1 => 
          array (
            'name' => 'pain_scale_other',
            'studio' => 'visible',
            'label' => 'LBL_PAIN_SCALE_OTHER',
          ),
        ),
        17 => 
        array (
          0 => 
          array (
            'name' => 'missing_record_we_need_to_get',
            'label' => 'LBL_MISSING_RECORD_WE_NEED_TO_GET',
          ),
          1 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
        ),
        18 => 
        array (
          0 => 
          array (
            'name' => 'mts_medical_treatment_summary_contacts_name',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'cpt_codes_treatment',
            'studio' => 'visible',
            'label' => 'LBL_CPT_CODES_TREATMENT',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'icd_codes',
            'studio' => 'visible',
            'label' => 'LBL_ICD_CODES',
          ),
        ),
      ),
    ),
  ),
);
;
?>
