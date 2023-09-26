<?php
// created: 2022-08-03 13:18:36
$dictionary["Call"]["fields"]["neg_negotiations_calls_1"] = array (
  'name' => 'neg_negotiations_calls_1',
  'type' => 'link',
  'relationship' => 'neg_negotiations_calls_1',
  'source' => 'non-db',
  'module' => 'NEG_Negotiations',
  'bean_name' => 'NEG_Negotiations',
  'vname' => 'LBL_NEG_NEGOTIATIONS_CALLS_1_FROM_NEG_NEGOTIATIONS_TITLE',
  'id_name' => 'neg_negotiations_calls_1neg_negotiations_ida',
);
$dictionary["Call"]["fields"]["neg_negotiations_calls_1_name"] = array (
  'name' => 'neg_negotiations_calls_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_NEG_NEGOTIATIONS_CALLS_1_FROM_NEG_NEGOTIATIONS_TITLE',
  'save' => true,
  'id_name' => 'neg_negotiations_calls_1neg_negotiations_ida',
  'link' => 'neg_negotiations_calls_1',
  'table' => 'neg_negotiations',
  'module' => 'NEG_Negotiations',
  'rname' => 'document_name',
);
$dictionary["Call"]["fields"]["neg_negotiations_calls_1neg_negotiations_ida"] = array (
  'name' => 'neg_negotiations_calls_1neg_negotiations_ida',
  'type' => 'link',
  'relationship' => 'neg_negotiations_calls_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_NEG_NEGOTIATIONS_CALLS_1_FROM_CALLS_TITLE',
);
