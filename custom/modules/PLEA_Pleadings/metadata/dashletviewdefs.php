<?php
$dashletData['PLEA_PleadingsDashlet']['searchFields'] = array (
  'OUTGOING_DOCUMENT' => 
  array (
    'type' => 'bool',
    'width' => '15%',
    'label' => 'LBL_OUTGOING_DOCUMENT',
    'default' => '',
  ),
    'assigned_lawyer_cases' => 
  array (
       'name' => 'assigned_lawyer_cases',
		'label' => 'LBL_ASSIGNED_LAWYER_CASES',
		'type' => 'enum',
        'options' => 'assigned_lawyer_cases_list',
	'query_type' => 'default',
    'operator' => 'subquery',
    'subquery' => 'SELECT plea_pleadings.id
					FROM `plea_pleadings`
					INNER JOIN plea_pleadings_cases_c ON (plea_pleadings_cases_c.deleted = 0 AND plea_pleadings_cases_c.plea_pleadings_casesplea_pleadings_idb = plea_pleadings.id)
					INNER JOIN cases ON (cases.deleted = 0 AND cases.id = plea_pleadings_cases_c.plea_pleadings_casescases_ida)
					INNER JOIN users ON (users.deleted = 0 AND cases.assigned_user_id = users.id)
					WHERE CONCAT_WS(" ", users.first_name, users.last_name) LIKE',
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
  'columns' => 
  array (
    'default' => '',
  ),
);
$dashletData['PLEA_PleadingsDashlet']['columns'] = array (
 'date_entered' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
  'date_filed_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_DATE_FILED',
    'width' => '10%',
    'link' => true,
  ),
  'plea_pleadings_cases_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_PLEA_PLEADINGS_CASES_FROM_CASES_TITLE',
    'width' => '40%',
    'default' => true,
    'id' => 'PLEA_PLEADINGS_CASESCASES_IDA',
  ),
  'document_name' => 
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
  ),
  'subcategory_id' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_SUBCATEGORY',
    'default' => true,
  ),
  'uploadfile' => 
  array (
    'type' => 'file',
    'label' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '10%',
    'default' => true,
    'displayParams' => 
    array (
      'module' => 'PLEA_Pleadings',
    ),
  ),
  'related_case_assigned_to' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CASE_ASSIGNED_TO',
    'width' => '10%',
    'source' => 'non-db',
	'sortable' => false,
    'function' => 
    array (
      'name' => 'getrelated_case_assigned_to',
      'returns' => 'html',
      'include' => 'custom/include/custom_utils.php',
    ),
  ),
  'outgoing_document' => 
  array (
    'type' => 'bool',
    'width' => '15%',
    'label' => 'LBL_OUTGOING_DOCUMENT',
    'default' => true,
    'ext2' => 'PLEA_Pleadings',
  ),
  'incoming_or_outgoing' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_INCOMING_OR_OUTGOING',
    'width' => '10%',
    'default' => true,
  ),
  'assigned_user_name' => 
  array (
    'link' => true,
    'type' => 'relate',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'id' => 'ASSIGNED_USER_ID',
    'width' => '10%',
    'default' => false,
  ),
  'modified_by_name' => 
  array (
    'width' => '10%',
    'label' => 'LBL_MODIFIED_USER',
    'module' => 'Users',
    'id' => 'USERS_ID',
    'default' => false,
    'sortable' => false,
    'related_fields' => 
    array (
      0 => 'modified_user_id',
    ),
  ),
);
