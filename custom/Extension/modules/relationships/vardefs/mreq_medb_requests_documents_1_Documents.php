<?php
// created: 2018-08-17 16:49:20
$dictionary["Document"]["fields"]["mreq_medb_requests_documents_1"] = array (
  'name' => 'mreq_medb_requests_documents_1',
  'type' => 'link',
  'relationship' => 'mreq_medb_requests_documents_1',
  'source' => 'non-db',
  'module' => 'MREQ_MEDB_Requests',
  'bean_name' => 'MREQ_MEDB_Requests',
  'vname' => 'LBL_MREQ_MEDB_REQUESTS_DOCUMENTS_1_FROM_MREQ_MEDB_REQUESTS_TITLE',
  'id_name' => 'mreq_medb_requests_documents_1mreq_medb_requests_ida',
);
$dictionary["Document"]["fields"]["mreq_medb_requests_documents_1_name"] = array (
  'name' => 'mreq_medb_requests_documents_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MREQ_MEDB_REQUESTS_DOCUMENTS_1_FROM_MREQ_MEDB_REQUESTS_TITLE',
  'save' => true,
  'id_name' => 'mreq_medb_requests_documents_1mreq_medb_requests_ida',
  'link' => 'mreq_medb_requests_documents_1',
  'table' => 'mreq_medb_requests',
  'module' => 'MREQ_MEDB_Requests',
  'rname' => 'document_name',
);
$dictionary["Document"]["fields"]["mreq_medb_requests_documents_1mreq_medb_requests_ida"] = array (
  'name' => 'mreq_medb_requests_documents_1mreq_medb_requests_ida',
  'type' => 'link',
  'relationship' => 'mreq_medb_requests_documents_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MREQ_MEDB_REQUESTS_DOCUMENTS_1_FROM_DOCUMENTS_TITLE',
);
