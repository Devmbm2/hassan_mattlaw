<?php
$module_name = 'DISC_Discovery';
$OBJECT_NAME = 'DISC_DISCOVERY';
$listViewDefs [$module_name] = 
array (
  'DOCUMENT_NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
  ),
  'SENT_RECEIVED' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SENT_RECEIVED',
    'width' => '10%',
    'default' => true,
  ),
  'TYPE' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'default' => true,
  ),
  'Q_A' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_Q_A',
    'width' => '10%',
    'default' => true,
  ),
  'TO_FROM' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_TO_FROM',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'PARENT_NAME' => 
  array (
    'type' => 'parent',
    'studio' => 'visible',
    'label' => 'LBL_FLEX_RELATE',
    'link' => true,
    'sortable' => false,
    'ACLTag' => 'PARENT',
    'dynamic_module' => 'PARENT_TYPE',
    'id' => 'PARENT_ID',
    'related_fields' => 
    array (
      0 => 'parent_id',
      1 => 'parent_type',
    ),
    'width' => '10%',
    'default' => true,
  ),
  'STATUS_ID' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_DOC_STATUS',
    'width' => '10%',
    'default' => true,
  ),
  'STATUS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_DOC_STATUS',
    'width' => '10%',
    'default' => true,
  ),
  'NEXT_STEP' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_NEXT_STEP',
    'width' => '10%',
    'default' => true,
  ),
  'EXP_DATE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_EXP_DATE',
    'default' => true,
  ),
  'DONE' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_DONE',
    'width' => '10%',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'link' => true,
    'type' => 'relate',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'id' => 'ASSIGNED_USER_ID',
    'width' => '10%',
    'default' => true,
  ),
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => false,
  ),
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => false,
  ),
  'DATE_SERVED' => 
  array (
    'type' => 'date',
    'label' => 'LBL_DATE_SERVED',
    'width' => '10%',
    'default' => false,
  ),
  'RESPONSE_DATE' => 
  array (
    'type' => 'date',
    'label' => 'LBL_RESPONSE_DATE',
    'width' => '10%',
    'default' => false,
  ),
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
  ),
  'COMPANION' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_COMPANION',
    'id' => 'CONTACT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => false,
  ),
  'DATE_OF_INCIDENT' => 
  array (
    'type' => 'date',
    'label' => 'LBL_DATE_OF_INCIDENT',
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
?>
