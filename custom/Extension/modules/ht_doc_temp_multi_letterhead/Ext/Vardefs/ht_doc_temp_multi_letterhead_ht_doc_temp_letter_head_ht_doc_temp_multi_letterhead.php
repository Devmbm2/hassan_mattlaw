<?php
// created: 2019-09-24 09:18:57
$dictionary["ht_doc_temp_multi_letterhead"]["fields"]["ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head"] = array (
  'name' => 'ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head',
  'type' => 'link',
  'relationship' => 'ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head',
  'source' => 'non-db',
  'module' => 'ht_doc_temp_letter_head',
  'bean_name' => 'ht_doc_temp_letter_head',
  'vname' => 'LBL_HT_DOC_TEMP_MULTI_LETTERHEAD_HT_DOC_TEMP_LETTER_HEAD_FROM_HT_DOC_TEMP_LETTER_HEAD_TITLE',
  'id_name' => 'ht_doc_tem1d8aer_head_idb',
);
$dictionary["ht_doc_temp_multi_letterhead"]["fields"]["ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head_name"] = array (
  'name' => 'ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_HT_DOC_TEMP_MULTI_LETTERHEAD_HT_DOC_TEMP_LETTER_HEAD_FROM_HT_DOC_TEMP_LETTER_HEAD_TITLE',
  'save' => true,
  'id_name' => 'ht_doc_tem1d8aer_head_idb',
  'link' => 'ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head',
  'table' => 'ht_doc_temp_letter_head',
  'module' => 'ht_doc_temp_letter_head',
  'rname' => 'document_name',
);
$dictionary["ht_doc_temp_multi_letterhead"]["fields"]["ht_doc_tem1d8aer_head_idb"] = array (
  'name' => 'ht_doc_tem1d8aer_head_idb',
  'type' => 'link',
  'relationship' => 'ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_HT_DOC_TEMP_MULTI_LETTERHEAD_HT_DOC_TEMP_LETTER_HEAD_FROM_HT_DOC_TEMP_LETTER_HEAD_TITLE',
);
