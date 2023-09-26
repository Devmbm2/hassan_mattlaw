<?php
// created: 2018-08-17 18:34:17
$dictionary["Document"]["fields"]["medr_medical_records_documents_1"] = array (
  'name' => 'medr_medical_records_documents_1',
  'type' => 'link',
  'relationship' => 'medr_medical_records_documents_1',
  'source' => 'non-db',
  'module' => 'MEDR_Medical_Records',
  'bean_name' => 'MEDR_Medical_Records',
  'vname' => 'LBL_MEDR_MEDICAL_RECORDS_DOCUMENTS_1_FROM_MEDR_MEDICAL_RECORDS_TITLE',
  'id_name' => 'medr_medical_records_documents_1medr_medical_records_ida',
);
$dictionary["Document"]["fields"]["medr_medical_records_documents_1_name"] = array (
  'name' => 'medr_medical_records_documents_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MEDR_MEDICAL_RECORDS_DOCUMENTS_1_FROM_MEDR_MEDICAL_RECORDS_TITLE',
  'save' => true,
  'id_name' => 'medr_medical_records_documents_1medr_medical_records_ida',
  'link' => 'medr_medical_records_documents_1',
  'table' => 'medr_medical_records',
  'module' => 'MEDR_Medical_Records',
  'rname' => 'document_name',
);
$dictionary["Document"]["fields"]["medr_medical_records_documents_1medr_medical_records_ida"] = array (
  'name' => 'medr_medical_records_documents_1medr_medical_records_ida',
  'type' => 'link',
  'relationship' => 'medr_medical_records_documents_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MEDR_MEDICAL_RECORDS_DOCUMENTS_1_FROM_DOCUMENTS_TITLE',
);
