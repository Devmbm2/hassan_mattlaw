<?php
// created: 2018-08-17 16:07:17
$dictionary["Document"]["fields"]["medb_medical_bills_documents_1"] = array (
  'name' => 'medb_medical_bills_documents_1',
  'type' => 'link',
  'relationship' => 'medb_medical_bills_documents_1',
  'source' => 'non-db',
  'module' => 'MEDB_Medical_Bills',
  'bean_name' => 'MEDB_Medical_Bills',
  'vname' => 'LBL_MEDB_MEDICAL_BILLS_DOCUMENTS_1_FROM_MEDB_MEDICAL_BILLS_TITLE',
  'id_name' => 'medb_medical_bills_documents_1medb_medical_bills_ida',
);
$dictionary["Document"]["fields"]["medb_medical_bills_documents_1_name"] = array (
  'name' => 'medb_medical_bills_documents_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MEDB_MEDICAL_BILLS_DOCUMENTS_1_FROM_MEDB_MEDICAL_BILLS_TITLE',
  'save' => true,
  'id_name' => 'medb_medical_bills_documents_1medb_medical_bills_ida',
  'link' => 'medb_medical_bills_documents_1',
  'table' => 'medb_medical_bills',
  'module' => 'MEDB_Medical_Bills',
  'rname' => 'document_name',
);
$dictionary["Document"]["fields"]["medb_medical_bills_documents_1medb_medical_bills_ida"] = array (
  'name' => 'medb_medical_bills_documents_1medb_medical_bills_ida',
  'type' => 'link',
  'relationship' => 'medb_medical_bills_documents_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MEDB_MEDICAL_BILLS_DOCUMENTS_1_FROM_DOCUMENTS_TITLE',
);
