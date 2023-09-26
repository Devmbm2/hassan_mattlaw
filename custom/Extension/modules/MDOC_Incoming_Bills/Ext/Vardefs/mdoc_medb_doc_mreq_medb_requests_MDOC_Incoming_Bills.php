<?php
// created: 2018-08-17 15:36:21
$dictionary["MDOC_Incoming_Bills"]["fields"]["mdoc_medb_doc_mreq_medb_requests"] = array (
  'name' => 'mdoc_medb_doc_mreq_medb_requests',
  'type' => 'link',
  'relationship' => 'mdoc_medb_doc_mreq_medb_requests',
  'source' => 'non-db',
  'module' => 'MREQ_MEDB_Requests',
  'bean_name' => 'MREQ_MEDB_Requests',
  'vname' => 'LBL_MDOC_MEDB_DOC_MREQ_MEDB_REQUESTS_FROM_MREQ_MEDB_REQUESTS_TITLE',
  'id_name' => 'mdoc_medb_doc_mreq_medb_requestsmreq_medb_requests_idb',
);
$dictionary["MDOC_Incoming_Bills"]["fields"]["mdoc_medb_doc_mreq_medb_requests_name"] = array (
  'name' => 'mdoc_medb_doc_mreq_medb_requests_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MDOC_MEDB_DOC_MREQ_MEDB_REQUESTS_FROM_MREQ_MEDB_REQUESTS_TITLE',
  'save' => true,
  'id_name' => 'mdoc_medb_doc_mreq_medb_requestsmreq_medb_requests_idb',
  'link' => 'mdoc_medb_doc_mreq_medb_requests',
  'table' => 'mreq_medb_requests',
  'module' => 'MREQ_MEDB_Requests',
  'rname' => 'document_name',
);
$dictionary["MDOC_Incoming_Bills"]["fields"]["mdoc_medb_doc_mreq_medb_requestsmreq_medb_requests_idb"] = array (
  'name' => 'mdoc_medb_doc_mreq_medb_requestsmreq_medb_requests_idb',
  'type' => 'link',
  'relationship' => 'mdoc_medb_doc_mreq_medb_requests',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_MDOC_MEDB_DOC_MREQ_MEDB_REQUESTS_FROM_MREQ_MEDB_REQUESTS_TITLE',
);
