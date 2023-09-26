<?php
// created: 2018-08-17 15:40:05
$dictionary["MDOC_Incoming_Bills"]["fields"]["medb_medical_bills_mdoc_incoming_bills_1"] = array (
  'name' => 'medb_medical_bills_mdoc_incoming_bills_1',
  'type' => 'link',
  'relationship' => 'medb_medical_bills_mdoc_incoming_bills_1',
  'source' => 'non-db',
  'module' => 'MEDB_Medical_Bills',
  'bean_name' => 'MEDB_Medical_Bills',
  'vname' => 'LBL_MEDB_MEDICAL_BILLS_MDOC_INCOMING_BILLS_1_FROM_MEDB_MEDICAL_BILLS_TITLE',
  'id_name' => 'medb_medical_bills_mdoc_incoming_bills_1medb_medical_bills_ida',
);
$dictionary["MDOC_Incoming_Bills"]["fields"]["medb_medical_bills_mdoc_incoming_bills_1_name"] = array (
  'name' => 'medb_medical_bills_mdoc_incoming_bills_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MEDB_MEDICAL_BILLS_MDOC_INCOMING_BILLS_1_FROM_MEDB_MEDICAL_BILLS_TITLE',
  'save' => true,
  'id_name' => 'medb_medical_bills_mdoc_incoming_bills_1medb_medical_bills_ida',
  'link' => 'medb_medical_bills_mdoc_incoming_bills_1',
  'table' => 'medb_medical_bills',
  'module' => 'MEDB_Medical_Bills',
  'rname' => 'document_name',
  'required' => true,
);
$dictionary["MDOC_Incoming_Bills"]["fields"]["medb_medical_bills_mdoc_incoming_bills_1medb_medical_bills_ida"] = array (
  'name' => 'medb_medical_bills_mdoc_incoming_bills_1medb_medical_bills_ida',
  'type' => 'link',
  'relationship' => 'medb_medical_bills_mdoc_incoming_bills_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MEDB_MEDICAL_BILLS_MDOC_INCOMING_BILLS_1_FROM_MDOC_INCOMING_BILLS_TITLE',
);
