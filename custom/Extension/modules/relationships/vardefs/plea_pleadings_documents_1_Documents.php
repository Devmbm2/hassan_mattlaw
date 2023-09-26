<?php
// created: 2022-07-19 14:01:32
$dictionary["Document"]["fields"]["plea_pleadings_documents_1"] = array (
  'name' => 'plea_pleadings_documents_1',
  'type' => 'link',
  'relationship' => 'plea_pleadings_documents_1',
  'source' => 'non-db',
  'module' => 'PLEA_Pleadings',
  'bean_name' => 'PLEA_Pleadings',
  'vname' => 'LBL_PLEA_PLEADINGS_DOCUMENTS_1_FROM_PLEA_PLEADINGS_TITLE',
  'id_name' => 'plea_pleadings_documents_1plea_pleadings_ida',
);
$dictionary["Document"]["fields"]["plea_pleadings_documents_1_name"] = array (
  'name' => 'plea_pleadings_documents_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PLEA_PLEADINGS_DOCUMENTS_1_FROM_PLEA_PLEADINGS_TITLE',
  'save' => true,
  'id_name' => 'plea_pleadings_documents_1plea_pleadings_ida',
  'link' => 'plea_pleadings_documents_1',
  'table' => 'plea_pleadings',
  'module' => 'PLEA_Pleadings',
  'rname' => 'document_name',
);
$dictionary["Document"]["fields"]["plea_pleadings_documents_1plea_pleadings_ida"] = array (
  'name' => 'plea_pleadings_documents_1plea_pleadings_ida',
  'type' => 'link',
  'relationship' => 'plea_pleadings_documents_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_PLEA_PLEADINGS_DOCUMENTS_1_FROM_DOCUMENTS_TITLE',
);
