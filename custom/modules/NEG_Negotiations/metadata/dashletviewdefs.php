<?php
$dashletData['NEG_NegotiationsDashlet']['searchFields'] = array (
  'date_entered' => 
  array (
    'default' => '',
  ),
  'date_modified' => 
  array (
    'default' => '',
  ),
  'assigned_lawyer_cases' => 
  array (
    'name' => 'assigned_lawyer_cases',
    'label' => 'LBL_ASSIGNED_LAWYER_CASES',
    'type' => 'enum',
    'width' => '10%',
    'options' => 'assigned_lawyer_cases_list',
    'default' => '',
  ),
  'done' => 
  array (
    'type' => 'bool',
    'label' => 'LBL_DONE',
    'width' => '10%',
    'name' => 'done',
    'default' => '',
  ),
);
$dashletData['NEG_NegotiationsDashlet']['columns'] = array (
  'date_of_negotiation_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_DATE_OF_NEGOTIATION',
    'width' => '10%',
    'name' => 'date_of_negotiation_c',
  ),
  'neg_negotiations_cases_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_NEG_NEGOTIATIONS_CASES_FROM_CASES_TITLE',
    'id' => 'NEG_NEGOTIATIONS_CASESCASES_IDA',
    'width' => '10%',
    'default' => true,
    'name' => 'neg_negotiations_cases_name',
  ),
  'document_name' => 
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
    'name' => 'document_name',
  ),
  'type' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'default' => true,
    'name' => 'type',
  ),
  'defendant' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_DEFENDANT',
    'id' => 'CONTACT_ID2_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
    'name' => 'defendant',
  ),
  'amount' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
    'name' => 'amount',
  ),
  'uploadfile' => 
  array (
    'type' => 'file',
    'label' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '10%',
    'studio' => 'visible',
    'default' => true,
    'displayParams' => 
    array (
      'module' => 'NEG_Negotiations',
    ),
    'name' => 'uploadfile',
  ),
  'related_case_assigned_to' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_RELATED_CASE_ASSIGNED_TO',
    'vname' => 'LBL_RELATED_CASE_ASSIGNED_TO',
    'width' => '10%',
    'default' => true,
    'sortable' => false,
    'name' => 'related_case_assigned_to',
  ),
  'done' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_DONE',
    'width' => '10%',
    'name' => 'done',
  ),
  'sent_rec' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SENT_REC',
    'width' => '10%',
    'default' => true,
    'name' => 'sent_rec',
  ),
  'date_entered' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => false,
    'name' => 'date_entered',
  ),
);
