<?php
// created: 2018-08-17 15:36:21
$dictionary["MREQ_MEDB_Requests"]["fields"]["mdoc_medb_doc_mreq_medb_requests"] = array (
  'name' => 'mdoc_medb_doc_mreq_medb_requests',
  'type' => 'link',
  'relationship' => 'mdoc_medb_doc_mreq_medb_requests',
  'source' => 'non-db',
  'module' => 'MDOC_Incoming_Bills',
  'bean_name' => false,
  'vname' => 'LBL_MDOC_MEDB_DOC_MREQ_MEDB_REQUESTS_FROM_MDOC_INCOMING_BILLS_TITLE',
  'id_name' => 'mdoc_medb_doc_mreq_medb_requestsmdoc_incoming_bills_ida',
);
$dictionary["MREQ_MEDB_Requests"]["fields"]["mdoc_medb_doc_mreq_medb_requests_name"] = array (
  'name' => 'mdoc_medb_doc_mreq_medb_requests_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MDOC_MEDB_DOC_MREQ_MEDB_REQUESTS_FROM_MDOC_INCOMING_BILLS_TITLE',
  'save' => true,
  'id_name' => 'mdoc_medb_doc_mreq_medb_requestsmdoc_incoming_bills_ida',
  'link' => 'mdoc_medb_doc_mreq_medb_requests',
  'table' => 'mdoc_incoming_bills',
  'module' => 'MDOC_Incoming_Bills',
  'rname' => 'document_name',
);
$dictionary["MREQ_MEDB_Requests"]["fields"]["mdoc_medb_doc_mreq_medb_requestsmdoc_incoming_bills_ida"] = array (
  'name' => 'mdoc_medb_doc_mreq_medb_requestsmdoc_incoming_bills_ida',
  'type' => 'link',
  'relationship' => 'mdoc_medb_doc_mreq_medb_requests',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_MDOC_MEDB_DOC_MREQ_MEDB_REQUESTS_FROM_MDOC_INCOMING_BILLS_TITLE',
);
