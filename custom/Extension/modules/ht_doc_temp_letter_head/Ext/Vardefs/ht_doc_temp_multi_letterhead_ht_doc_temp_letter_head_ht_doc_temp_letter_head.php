<?php
// created: 2019-09-24 09:18:57
$dictionary["ht_doc_temp_letter_head"]["fields"]["ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head"] = array (
  'name' => 'ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head',
  'type' => 'link',
  'relationship' => 'ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head',
  'source' => 'non-db',
  'module' => 'ht_doc_temp_multi_letterhead',
  'bean_name' => false,
  'vname' => 'LBL_HT_DOC_TEMP_MULTI_LETTERHEAD_HT_DOC_TEMP_LETTER_HEAD_FROM_HT_DOC_TEMP_MULTI_LETTERHEAD_TITLE',
  'id_name' => 'ht_doc_tem2268terhead_ida',
);
$dictionary["ht_doc_temp_letter_head"]["fields"]["ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head_name"] = array (
  'name' => 'ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_HT_DOC_TEMP_MULTI_LETTERHEAD_HT_DOC_TEMP_LETTER_HEAD_FROM_HT_DOC_TEMP_MULTI_LETTERHEAD_TITLE',
  'save' => true,
  'id_name' => 'ht_doc_tem2268terhead_ida',
  'link' => 'ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head',
  'table' => 'ht_doc_temp_multi_letterhead',
  'module' => 'ht_doc_temp_multi_letterhead',
  'rname' => 'document_name',
);
$dictionary["ht_doc_temp_letter_head"]["fields"]["ht_doc_tem2268terhead_ida"] = array (
  'name' => 'ht_doc_tem2268terhead_ida',
  'type' => 'link',
  'relationship' => 'ht_doc_temp_multi_letterhead_ht_doc_temp_letter_head',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_HT_DOC_TEMP_MULTI_LETTERHEAD_HT_DOC_TEMP_LETTER_HEAD_FROM_HT_DOC_TEMP_MULTI_LETTERHEAD_TITLE',
);
