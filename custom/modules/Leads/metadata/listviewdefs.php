<?php
$listViewDefs ['Leads'] = 
array (
  'DATE_ENTERED' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => true,
	'link' => true,
  ),
  'NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'orderBy' => 'name',
    'default' => true,
    'related_fields' => 
    array (
      0 => 'first_name',
      1 => 'last_name',
      2 => 'salutation',
    ),
  ),
  'CASE_TYPE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CASE_TYPE',
    'width' => '10%',
  ),
  'LEADRANK_C' =>
  array (
    'type' => 'enum',
    'label' => 'LBL_LEADRANK_C',
    'width' => '10%',
    'default' => true,
    // 'related_fields' =>
    // array (
    //   0 => 'leadrank_c',
    // )
  ),
  'SOURCE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_SOURCE',
    'width' => '10%',
  ),
  'PHONE_MOBILE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_MOBILE_PHONE',
    'default' => true,
  ),
  'PHONE_WORK' => 
  array (
    'width' => '15%',
    'label' => 'LBL_LIST_PHONE',
    'default' => true,
  ),
  'PHONE_OTHER' => 
  array (
    'width' => '10%',
    'label' => 'LBL_OTHER_PHONE',
    'default' => true,
  ),
  'DAMAGES_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_DAMAGES',
    'width' => '10%',
  ),
  'CONVERTED' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_CONVERTED',
    'width' => '10%',
  ),
  'CASE_DESCRIPTION_C' => 
  array (
    'type' => 'text',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_CASE_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
  ),
  'LIABILITY_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_LIABILITY',
    'width' => '10%',
  ),
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
  ),
  'STATUTE_OF_LIMITATIONS_C' => 
  array (
    'type' => 'date',
    'default' => false,
    'label' => 'LBL_STATUTE_OF_LIMITATIONS',
    'width' => '10%',
  ),
  'EMAIL1' => 
  array (
    'width' => '16%',
    'label' => 'LBL_LIST_EMAIL_ADDRESS',
    'sortable' => false,
    'customCode' => '{$EMAIL1_LINK}{$EMAIL1}</a>',
    'default' => false,
  ),
  'PHONE_HOME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_HOME_PHONE',
    'default' => false,
  ),
  'REASON_FOR_LOST_LEAD_C' => 
  array (
    'type' => 'text',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_REASON_FOR_LOST_LEAD',
    'sortable' => false,
    'width' => '10%',
  ),
  'PRIMARY_ADDRESS_STREET' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_STREET',
    'default' => false,
  ),
  'PRIMARY_ADDRESS_CITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_CITY',
    'default' => false,
  ),
  'PRIMARY_ADDRESS_STATE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_STATE',
    'default' => false,
  ),
  'PRIMARY_ADDRESS_POSTALCODE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_POSTALCODE',
    'default' => false,
  ),
  'STATUS' => 
  array (
    'width' => '7%',
    'label' => 'LBL_LIST_STATUS',
    'default' => false,
  ),
  'DATE_OF_INCIDENT_C' => 
  array (
    'type' => 'date',
    'default' => false,
    'label' => 'LBL_DATE_OF_INCIDENT',
    'width' => '10%',
  ),
  'FIRST_NAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_FIRST_NAME',
    'width' => '10%',
    'default' => false,
  ),
  'COUNTY_OF_INCIDENT_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_COUNTY_OF_INCIDENT',
    'width' => '10%',
  ),
  'LAST_NAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_LAST_NAME',
    'width' => '10%',
    'default' => false,
  ),
  'REFERRAL_PERSON_C' => 
  array (
    'type' => 'relate',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_REFERRAL_PERSON',
    'id' => 'CONTACT_ID_C',
    'link' => true,
    'width' => '10%',
  ),
  'LEAD_SOURCE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LEAD_SOURCE',
    'default' => false,
  ),
  'REFERRAL_ATTORNEY_C' => 
  array (
    'type' => 'relate',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_REFERRAL_ATTORNEY',
    'id' => 'CONTACT_ID1_C',
    'link' => true,
    'width' => '10%',
  ),
  'CREATED_BY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_CREATED',
    'default' => false,
  ),
  'MODIFIED_BY_NAME' => 
  array (
    'width' => '5%',
    'label' => 'LBL_MODIFIED',
    'default' => false,
  ),
  'DECEASED_PLAINTIFF_HAS_SPOUS_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_DECEASED_PLAINTIFF_HAS_SPOUS',
    'width' => '10%',
  ),
  'FALL_DOWN_DAMAGES_C' => 
  array (
    'type' => 'multienum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_FALL_DOWN_DAMAGES',
    'width' => '10%',
  ),
);
