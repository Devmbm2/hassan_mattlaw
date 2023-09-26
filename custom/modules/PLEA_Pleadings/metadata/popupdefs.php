<?php
$popupMeta = array (
    'moduleMain' => 'PLEA_Pleadings',
    'varName' => 'PLEA_Pleadings',
    'orderBy' => 'plea_pleadings.name',
    'whereClauses' => array (
  'document_name' => 'plea_pleadings.document_name',
  'pleading_name_c' => 'plea_pleadings_cstm.pleading_name_c',
  'category_id' => 'plea_pleadings.category_id',
  'subcategory_id' => 'plea_pleadings.subcategory_id',
  'active_date' => 'plea_pleadings.active_date',
  'exp_date' => 'plea_pleadings.exp_date',
),
    'searchInputs' => array (
  4 => 'document_name',
  5 => 'pleading_name_c',
  6 => 'category_id',
  7 => 'subcategory_id',
  8 => 'active_date',
  9 => 'exp_date',
),
    'searchdefs' => array (
  'document_name' => 
  array (
    'name' => 'document_name',
    'width' => '10%',
  ),
  'pleading_name_c' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_PLEADING_NAME',
    'width' => '10%',
    'name' => 'pleading_name_c',
  ),
  'category_id' => 
  array (
    'name' => 'category_id',
    'width' => '10%',
  ),
  'subcategory_id' => 
  array (
    'name' => 'subcategory_id',
    'width' => '10%',
  ),
  'active_date' => 
  array (
    'name' => 'active_date',
    'width' => '10%',
  ),
  'exp_date' => 
  array (
    'name' => 'exp_date',
    'width' => '10%',
  ),
),
);
