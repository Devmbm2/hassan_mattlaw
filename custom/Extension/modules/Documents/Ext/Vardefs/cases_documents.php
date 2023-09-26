<?php
// created: 2019-09-04 04:56:45
$dictionary["Document"]["fields"]["documents_cases"] = array (
  'name' => 'documents_cases',
  'type' => 'link',
  'relationship' => 'documents_cases',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'vname' => 'LBL_CASES',
  'id_name' => 'case_id',
);
$dictionary["Document"]["fields"]["cases_documents_name"] = array (
  'name' => 'cases_documents_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CASES',
  'save' => true,
  'id_name' => 'case_id',
  'link' => 'documents_cases',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
  // 'required' => true,
);
$dictionary["Document"]["fields"]["case_id"] = array (
  'name' => 'case_id',
  'type' => 'link',
  'relationship' => 'documents_cases',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CASES_NAME',
);

$dictionary["Document"]["indices"]["document_related_list"] = array (
  'name' => 'document_related_list',
  'type' => 'index',
  'fields' => array('document_name', 'subcategory_id', 'outgoing_document', 'category_id')
);
