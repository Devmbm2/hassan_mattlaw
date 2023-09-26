<?php
$popupMeta = array (
    'moduleMain' => 'DHA_PlantillasDocumentos',
    'varName' => 'DHA_PlantillasDocumentos',
    'orderBy' => 'dha_plantillasdocumentos.name',
    'whereClauses' => array (
  'document_name' => 'dha_plantillasdocumentos.document_name',
  'modulo' => 'dha_plantillasdocumentos.modulo',
  'idioma' => 'dha_plantillasdocumentos.idioma',
  'category_id' => 'dha_plantillasdocumentos.category_id',
  'subcategory_id' => 'dha_plantillasdocumentos.subcategory_id',
  'status_id' => 'dha_plantillasdocumentos.status_id',
  'assigned_user_name' => 'dha_plantillasdocumentos.assigned_user_name',
  'description' => 'dha_plantillasdocumentos.description',
  'aclroles' => 'dha_plantillasdocumentos.aclroles',
),
    'searchInputs' => array (
  1 => 'document_name',
  2 => 'modulo',
  3 => 'idioma',
  4 => 'category_id',
  5 => 'subcategory_id',
  6 => 'status_id',
  7 => 'assigned_user_name',
  8 => 'description',
  9 => 'aclroles',
),
    'searchdefs' => array (
  'document_name' => 
  array (
    'name' => 'document_name',
    'width' => '10%',
  ),
  'modulo' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_MODULO',
    'width' => '10%',
    'name' => 'modulo',
  ),
  'idioma' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_IDIOMA_PLANTILLA',
    'width' => '10%',
    'name' => 'idioma',
  ),
  'category_id' => 
  array (
    'name' => 'category_id',
    'width' => '10%',
  ),
  'subcategory_id' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SF_SUBCATEGORY',
    'width' => '10%',
    'name' => 'subcategory_id',
  ),
  'status_id' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_DOC_STATUS',
    'width' => '10%',
    'name' => 'status_id',
  ),
  'assigned_user_name' => 
  array (
    'link' => 'assigned_user_link',
    'type' => 'relate',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'width' => '10%',
    'name' => 'assigned_user_name',
  ),
  'description' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'name' => 'description',
  ),
  'aclroles' => 
  array (
    'type' => 'multienum',
    'studio' => 'visible',
    'label' => 'LBL_ROLES_WITH_ACCESS',
    'width' => '10%',
    'name' => 'aclroles',
  ),
),
);
