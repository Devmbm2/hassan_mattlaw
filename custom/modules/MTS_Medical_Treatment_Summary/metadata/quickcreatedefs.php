<?php
$module_name = 'MTS_Medical_Treatment_Summary';
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
      'javascript' => '{sugar_getscript file="include/javascript/popup_parent_helper.js"}
	{sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}
	{sugar_getscript file="modules/Documents/documents.js"}',
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
          1 => '',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'mts_medical_treatment_summary_contacts_name',
            'label' => 'LBL_MTS_MEDICAL_TREATMENT_SUMMARY_CONTACTS_FROM_CONTACTS_TITLE',
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
          1 => 
          array (
            'name' => 'uploadfile',
            'customCode' => '{if $fields.id.value!=""}
            				{assign var="type" value="hidden"}
            		 		{else}
            		 		{assign var="type" value="file"}
            		  		{/if}
            		  		<input name="uploadfile" type = {$type} size="30" maxlength="" onchange="setvalue(this);" value="{$fields.filename.value}">{$fields.filename.value}',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
        ),
        4 => 
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
        5 => 
        array (
          0 => 
          array (
            'name' => 'treatment_description_summary',
            'studio' => 'visible',
            'label' => 'LBL_TREATMENT_DESCRIPTION_SUMMARY',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'treatment_work_product_note',
            'studio' => 'visible',
            'label' => 'LBL_TREATMENT_WORK_PRODUCT_NOTE',
          ),
        ),
        7 => 
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
        8 => 
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
        9 => 
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
        10 => 
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
        11 => 
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
        12 => 
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
        13 => 
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
        14 => 
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
        15 => 
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
        16 => 
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
        17 => 
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
        18 => 
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
