<?php

// pre($this->bean->fields);
$module_name = 'PLEA_Pleadings';
$OBJECT_NAME = 'PLEA_PLEADINGS';

$listViewDefs [$module_name] =
array (
    'DATE_ENTERED' =>
    array (
      'type' => 'datetime',
      'label' => 'LBL_DATE_ENTERED',
      'width' => '10%',
      'default' => true,
    ),
  'DATE_FILED_C' =>
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_DATE_FILED',
    'width' => '10%',
    'link' => true,
  ),
  'PLEA_PLEADINGS_CASES_NAME' =>
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_PLEA_PLEADINGS_CASES_FROM_CASES_TITLE',
    'width' => '40%',
    'default' => true,
    'id' => 'PLEA_PLEADINGS_CASESCASES_IDA',
  ),
  'DOCUMENT_NAME' =>
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
  ),
  'SUBCATEGORY_ID' =>
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_SUBCATEGORY',
    'default' => true,
  ),
  'UPLOADFILE' =>
  array (
    'type' => 'file',
    'label' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '10%',
    'default' => true,
    'displayParams' =>
    array (
      'module' => 'PLEA_Pleadings',
    ),
  ),
  'RELATED_CASE_ASSIGNED_TO' =>
  array (
    'type' => 'varchar',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CASE_ASSIGNED_TO',
    'width' => '10%',
    'source' => 'non-db',
    'sortable' => false,
    'function' =>
    array (
      'name' => 'getrelated_case_assigned_to',
      'returns' => 'html',
      'include' => 'custom/include/custom_utils.php',
    ),
  ),
  'RELATED_CASE_ASSISTANT' =>
  array (
    'type' => 'varchar',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_RELATED_CASE_ASSISTANT',
    'width' => '10%',
    'source' => 'non-db',
    'sortable' => false,
  ),
  'CREATED_BY_NAME' =>
  array (
    'type' => 'varchar',
    'studio' => 'visible',
    'label' => 'LBL_CREATED_BY_NAME',
    'width' => '10%',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' =>
  array (
    'link' => true,
    'type' => 'relate',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'id' => 'ASSIGNED_USER_ID',
    'width' => '10%',
    'default' => false,
  ),
  'MODIFIED_BY_NAME' =>
  array (
    'width' => '10%',
    'label' => 'LBL_MODIFIED_USER',
    'module' => 'Users',
    'id' => 'USERS_ID',
    'default' => false,
    'sortable' => false,
    'related_fields' =>
    array (
      0 => 'modified_user_id',
    ),
  ),
);
