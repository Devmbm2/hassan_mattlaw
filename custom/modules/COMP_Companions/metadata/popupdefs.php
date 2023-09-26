<?php
$popupMeta = array (
    'moduleMain' => 'COMP_Companions',
    'varName' => 'COMP_Companions',
    'orderBy' => 'comp_companions.name',
    'whereClauses' => array (
  'name' => 'comp_companions.name',
  'companion' => 'comp_companions.companion',
  'relationship_to_main_client' => 'comp_companions.relationship_to_main_client',
  'comp_companions_cases_name' => 'comp_companions.comp_companions_cases_name',
  'case_type_c' => 'comp_companions_cstm.case_type_c',
  'assigned_lawyer_cases' => 'comp_companions.assigned_lawyer_cases',
),
    'searchInputs' => array (
  1 => 'name',
  4 => 'companion',
  5 => 'relationship_to_main_client',
  6 => 'comp_companions_cases_name',
  7 => 'case_type_c',
  8 => 'assigned_lawyer_cases',
),
    'searchdefs' => array (
  'name' => 
  array (
    'name' => 'name',
    'width' => '10%',
  ),
  'companion' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_COMPANION',
    'id' => 'CONTACT_ID_C',
    'link' => true,
    'width' => '10%',
    'name' => 'companion',
  ),
  'relationship_to_main_client' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_RELATIONSHIP_TO_MAIN_CLIENT',
    'width' => '10%',
    'name' => 'relationship_to_main_client',
  ),
  'comp_companions_cases_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_COMP_COMPANIONS_CASES_FROM_CASES_TITLE',
    'id' => 'COMP_COMPANIONS_CASESCASES_IDA',
    'width' => '10%',
    'name' => 'comp_companions_cases_name',
  ),
  'case_type_c' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_CASE_TYPE',
    'width' => '10%',
    'name' => 'case_type_c',
  ),
  'assigned_lawyer_cases' => 
  array (
    'name' => 'assigned_lawyer_cases',
    'label' => 'LBL_ASSIGNED_LAWYER_CASES',
    'type' => 'enum',
    'width' => '10%',
    'options' => 'assigned_lawyer_cases_list',
  ),
),
    'listviewdefs' => array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
    'name' => 'name',
  ),
  'COMPANION' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_COMPANION',
    'id' => 'CONTACT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
    'name' => 'companion',
  ),
  'RELATIONSHIP_TO_MAIN_CLIENT' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_RELATIONSHIP_TO_MAIN_CLIENT',
    'width' => '10%',
    'default' => true,
    'name' => 'relationship_to_main_client',
  ),
  'COMP_COMPANIONS_CASES_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_COMP_COMPANIONS_CASES_FROM_CASES_TITLE',
    'id' => 'COMP_COMPANIONS_CASESCASES_IDA',
    'width' => '10%',
    'default' => true,
    'name' => 'comp_companions_cases_name',
  ),
  'CASE_TYPE_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_CASE_TYPE',
    'width' => '10%',
  ),
  'ASSIGNED_LAWYER_CASES' => 
  array (
    'label' => 'LBL_ASSIGNED_LAWYER_CASES',
    'type' => 'enum',
    'width' => '10%',
    'default' => true,
  ),
),
);
