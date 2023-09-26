<?php
$module_name = 'DHA_PlantillasDocumentos';
$OBJECT_NAME = 'DHA_PLANTILLASDOCUMENTOS';
$listViewDefs [$module_name] = 
array (
  'FILE_URL' => 
  array (
    'width' => '2%',
    'label' => '&nbsp;',
    'link' => true,
    'default' => true,
    'related_fields' => 
    array (
      0 => 'file_ext',
    ),
    'sortable' => false,
    'studio' => false,
  ),
  'MODULO_URL' => 
  array (
    'width' => '2%',
    'label' => '&nbsp;',
    'link' => false,
    'default' => true,
    'sortable' => false,
    'studio' => false,
  ),
  'DOCUMENT_NAME' => 
  array (
    'width' => '25%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
  ),
  'CATEGORY_ID' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_CATEGORY',
    'default' => true,
  ),
  'SUBCATEGORY_ID' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_SUBCATEGORY',
    'default' => true,
  ),
  'PRE_SUIT_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_PRE_SUIT',
    'width' => '10%',
  ),
  'LITIGATION_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_LITIGATION',
    'width' => '10%',
  ),
  'UPLOADFILE' => 
  array (
    'type' => 'file',
    'label' => 'LBL_FILE_UPLOAD',
    'width' => '10%',
    'default' => true,
	'displayParams' => array ( 'module' => 'DHA_PlantillasDocumentos', ),
  ),
  'CAPTION_COS_FIXED_C' => 
  array (
    'type' => 'bool',
    'default' => false,
    'label' => 'LBL_CAPTION_COS_FIXED',
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
  'FILE_EXT' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_FILE_EXTENSION',
    'width' => '10%',
    'default' => false,
  ),
  'CREATED_BY_NAME' => 
  array (
    'width' => '2%',
    'label' => 'LBL_LIST_LAST_REV_CREATOR',
    'default' => false,
    'sortable' => false,
  ),
  'INSURANCE_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_INSURANCE',
    'width' => '10%',
  ),
  'INVESTIGATION_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_INVESTIGATION',
    'width' => '10%',
  ),
  'SELECTION_CONTACT_STATUS_C' => 
  array (
    'type' => 'radioenum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_SELECTION_CONTACT_STATUS',
    'width' => '10%',
  ),
  'PLEADING_TYPES_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_PLEADING_TYPES',
    'width' => '10%',
  ),
  'MEDICAL_INFORMATION_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_MEDICAL_INFORMATION',
    'width' => '10%',
  ),
  'CLOSING_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_CLOSING',
    'width' => '10%',
  ),
  'IDIOMA' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_IDIOMA_PLANTILLA',
    'width' => '10%',
  ),
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
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
  'SELECT_CONTACT_FOR_DOCUMENT_C' => 
  array (
    'type' => 'multienum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_SELECT_CONTACT_FOR_DOCUMENT',
    'width' => '10%',
  ),
);
