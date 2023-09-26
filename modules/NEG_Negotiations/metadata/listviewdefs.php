<?php
$module_name = 'NEG_Negotiations';
$OBJECT_NAME = 'NEG_NEGOTIATIONS';
$listViewDefs [$module_name] = 
array (
  'DOCUMENT_NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
  ),
  'NEG_NEGOTIATIONS_CASES_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_NEG_NEGOTIATIONS_CASES_FROM_CASES_TITLE',
    'id' => 'NEG_NEGOTIATIONS_CASESCASES_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'SENT_REC' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SENT_REC',
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
  'INITIAL_COUNTER' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_INITIAL_COUNTER',
    'width' => '10%',
    'default' => true,
  ),
  'AMOUNT' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'INSURANCE_COMPANY' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_INSURANCE_COMPANY',
    'id' => 'ACCOUNT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'ADJUSTER_LAWYER' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_ADJUSTER_LAWYER',
    'id' => 'CONTACT_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'RESPONSE' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_RESPONSE',
    'width' => '10%',
    'default' => true,
  ),
  'MODE' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_MODE',
    'width' => '10%',
    'default' => true,
  ),
  'UPLOADFILE' => 
  array (
    'type' => 'file',
    'label' => 'LBL_FILE_UPLOAD',
    'width' => '10%',
    'default' => true,
  ),
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
  'COMPANION' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_COMPANION',
    'id' => 'CONTACT_ID1_C',
    'link' => true,
    'width' => '10%',
    'default' => false,
  ),
  'DEFENDANT' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_DEFENDANT',
    'id' => 'CONTACT_ID2_C',
    'link' => true,
    'width' => '10%',
    'default' => false,
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
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
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
);
?>
