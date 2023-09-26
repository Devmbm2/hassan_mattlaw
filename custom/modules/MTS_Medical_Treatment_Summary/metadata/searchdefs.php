<?php
$module_name = 'MTS_Medical_Treatment_Summary';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'mts_medical_treatment_summary_contacts_name' => 
      array (
        'type' => 'relate',
        'rname' => 'name',
        'link' => true,
        'label' => 'LBL_MTS_MEDICAL_TREATMENT_SUMMARY_CONTACTS_FROM_CONTACTS_TITLE',
        'id' => 'MTS_MEDICAL_TREATMENT_SUMMARY_CONTACTSCONTACTS_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'mts_medical_treatment_summary_contacts_name',
		 'fields' => 
			  array (
				0 => 'first_name',
				1 => 'last_name',
			  ),
		  'db_concat_fields' => 
		  array (
			0 => 'first_name',
			1 => 'last_name',
		  ),
		
      ),
      'medical_provider_organization' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_MEDICAL_PROVIDER_ORGANIZATION',
        'id' => 'ACCOUNT_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'medical_provider_organization',
      ),
      'treatment_date' => 
      array (
        'type' => 'date',
        'label' => 'LBL_TREATMENT_DATE',
        'width' => '10%',
        'default' => true,
        'name' => 'treatment_date',
      ),
    ),
    'advanced_search' => 
    array (
      'mts_medical_treatment_summary_contacts_name' => 
      array (
        'type' => 'relate',
		'rname' => 'name',
        /* 'link' => true, */
        'label' => 'LBL_MTS_MEDICAL_TREATMENT_SUMMARY_CONTACTS_FROM_CONTACTS_TITLE',
        'width' => '10%',
        'default' => false,
        'id' => 'MTS_MEDICAL_TREATMENT_SUMMARY_CONTACTSCONTACTS_IDA',
        'name' => 'mts_medical_treatment_summary_contacts_name',
		 'fields' => 
			  array (
				0 => 'first_name',
				1 => 'last_name',
			  ),
		  'db_concat_fields' => 
		  array (
			0 => 'first_name',
			1 => 'last_name',
		  ),
      ),
      'treatment_date' => 
      array (
        'type' => 'date',
        'label' => 'LBL_TREATMENT_DATE',
        'width' => '10%',
        'default' => true,
        'name' => 'treatment_date',
      ),
      'medical_provider_person' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_MEDICAL_PROVIDER_PERSON',
        'id' => 'CONTACT_ID_C',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'medical_provider_person',
      ),
      'medical_provider_organization' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_MEDICAL_PROVIDER_ORGANIZATION',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'id' => 'ACCOUNT_ID_C',
        'name' => 'medical_provider_organization',
      ),
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'created_by' => 
      array (
        'type' => 'assigned_user_name',
        'label' => 'LBL_CREATED',
        'width' => '10%',
        'default' => true,
        'name' => 'created_by',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
