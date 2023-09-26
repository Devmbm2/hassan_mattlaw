<?php
// created: 2022-05-27 17:21:01
$dictionary["Document"]["fields"]["fp_events_documents_1"] = array (
  'name' => 'fp_events_documents_1',
  'type' => 'link',
  'relationship' => 'fp_events_documents_1',
  'source' => 'non-db',
  'module' => 'FP_events',
  'bean_name' => 'FP_events',
  'vname' => 'LBL_FP_EVENTS_DOCUMENTS_1_FROM_FP_EVENTS_TITLE',
  'id_name' => 'fp_events_documents_1fp_events_ida',
);
$dictionary["Document"]["fields"]["fp_events_documents_1_name"] = array (
  'name' => 'fp_events_documents_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_FP_EVENTS_DOCUMENTS_1_FROM_FP_EVENTS_TITLE',
  'save' => true,
  'id_name' => 'fp_events_documents_1fp_events_ida',
  'link' => 'fp_events_documents_1',
  'table' => 'fp_events',
  'module' => 'FP_events',
  'rname' => 'name',
);
$dictionary["Document"]["fields"]["fp_events_documents_1fp_events_ida"] = array (
  'name' => 'fp_events_documents_1fp_events_ida',
  'type' => 'link',
  'relationship' => 'fp_events_documents_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_FP_EVENTS_DOCUMENTS_1_FROM_DOCUMENTS_TITLE',
);
