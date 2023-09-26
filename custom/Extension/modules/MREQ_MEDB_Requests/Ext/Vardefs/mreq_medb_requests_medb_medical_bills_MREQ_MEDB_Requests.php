<?php
// created: 2018-08-17 15:14:58
$dictionary["MREQ_MEDB_Requests"]["fields"]["mreq_medb_requests_medb_medical_bills"] = array (
  'name' => 'mreq_medb_requests_medb_medical_bills',
  'type' => 'link',
  'relationship' => 'mreq_medb_requests_medb_medical_bills',
  'source' => 'non-db',
  'module' => 'MEDB_Medical_Bills',
  'bean_name' => 'MEDB_Medical_Bills',
  'vname' => 'LBL_MREQ_MEDB_REQUESTS_MEDB_MEDICAL_BILLS_FROM_MEDB_MEDICAL_BILLS_TITLE',
  'id_name' => 'mreq_medb_requests_medb_medical_billsmedb_medical_bills_ida',
);
$dictionary["MREQ_MEDB_Requests"]["fields"]["mreq_medb_requests_medb_medical_bills_name"] = array (
  'name' => 'mreq_medb_requests_medb_medical_bills_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MREQ_MEDB_REQUESTS_MEDB_MEDICAL_BILLS_FROM_MEDB_MEDICAL_BILLS_TITLE',
  'save' => true,
  'id_name' => 'mreq_medb_requests_medb_medical_billsmedb_medical_bills_ida',
  'link' => 'mreq_medb_requests_medb_medical_bills',
  'table' => 'medb_medical_bills',
  'module' => 'MEDB_Medical_Bills',
  'rname' => 'document_name',
);
$dictionary["MREQ_MEDB_Requests"]["fields"]["mreq_medb_requests_medb_medical_billsmedb_medical_bills_ida"] = array (
  'name' => 'mreq_medb_requests_medb_medical_billsmedb_medical_bills_ida',
  'type' => 'link',
  'relationship' => 'mreq_medb_requests_medb_medical_bills',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MREQ_MEDB_REQUESTS_MEDB_MEDICAL_BILLS_FROM_MREQ_MEDB_REQUESTS_TITLE',
);
