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
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 
          array (
            'customCode' => '<input type="button" onclick="window.location.replace(\'index.php?module=MTS_Medical_Treatment_Summary&action=export_csv&record={$fields.id.value}\');"  value="Export CSV" />',
          ),
		  4 => 
          array (
            'customCode' => '<input type="button" onclick="window.location.replace(\'index.php?module=MTS_Medical_Treatment_Summary&action=export_excel&record={$fields.id.value}\');"  value="Export Excel" />',
          ),
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
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_DETAILVIEW_PANEL4' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL3' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'lbl_detailview_panel4' => 
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
          0 => 
          array (
            'name' => 'mts_medical_treatment_summary_contacts_name',
          ),
        ),
        2 => 
        array (
          0 => 'summary_title_list',
          1 => '',
        ),
        3 => 
        array (
          0 => 'document_name',
          1 => 'uploadfile',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'show_file_first',
          ),
        ),
        5 => 
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
        6 => 
        array (
          0 => 
          array (
            'name' => 'treatment_description_summary',
            'studio' => 'visible',
            'label' => 'LBL_TREATMENT_DESCRIPTION_SUMMARY',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'treatment_work_product_note',
            'studio' => 'visible',
            'label' => 'LBL_TREATMENT_WORK_PRODUCT_NOTE',
          ),
        ),
        8 => 
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
        9 => 
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
        10 => 
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
        11 => 
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
        12 => 
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
        13 => 
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
        14 => 
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
        15 => 
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
        16 => 
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
        17 => 
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
        18 => 
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
        19 => 
        array (
          0 => 
          array (
            'name' => 'missing_record_we_need_to_get',
            'label' => 'LBL_MISSING_RECORD_WE_NEED_TO_GET',
          ),
        ),
      ),
      'lbl_detailview_panel3' => 
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
        2 => 
        array (
          0 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
          1 => 
          array (
            'name' => 'date_entered',
            'comment' => 'Date record created',
            'label' => 'LBL_DATE_ENTERED',
          ),
        ),
      ),
    ),
  ),
);
