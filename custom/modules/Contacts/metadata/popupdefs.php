<?php
// global $db;
// $data = array();
// $this_Table = 'contacts';
// $this_parent = $_REQUEST['relate_id_advanced'];
// if(!empty($this_parent)){
// $sql = "select distinct contacts_cases.contact_id as parent_id From contacts INNER JOIN contacts_cases ON contacts.id=contacts_cases.contact_id where contacts_cases.case_id='{$this_parent}' AND contacts_cases.deleted = 0 AND contacts.deleted=0";
// $result = $db->query($sql);
// while($row = $db->fetchByAssoc($result)){
//   $data[] = $row['parent_id'];
// }
// $conversion = json_encode($data);
// $replace1 = str_replace("[",'',$conversion);
// $replace2 = str_replace("]",'',$replace1);
// }

$popupMeta = array (
    'moduleMain' => 'Contact',
    'varName' => 'CONTACT',
    'orderBy' => 'contacts.first_name, contacts.last_name',
    'whereClauses' => array (
  'first_name' => 'contacts.first_name',
  'last_name' => 'contacts.last_name',
  'account_name' => 'accounts.name',
  'name' => 'contacts.name',
  'middle_name' => 'contacts.middle_name',
  'salutation' => 'contacts.salutation',
  'suffix' => 'contacts.suffix',
),
    // 'whereStatement'=> $this_Table.".id IN ({$replace2})",
    'searchInputs' => array (
  0 => 'first_name',
  1 => 'last_name',
  2 => 'account_name',
  7 => 'name',
  8 => 'middle_name',
  9 => 'salutation',
  10 => 'suffix',
),
    'create' => array (
  'formBase' => 'ContactFormBase.php',
  'formBaseClass' => 'ContactFormBase',
  'getFormBodyParams' => 
  array (
    0 => '',
    1 => '',
    2 => 'ContactSave',
  ),
  'createButton' => 'LNK_NEW_CONTACT',
),
    'searchdefs' => array (
  'salutation' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_SALUTATION',
    'width' => '10%',
    'name' => 'salutation',
  ),
  'suffix' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_SUFFIX',
    'width' => '10%',
    'name' => 'suffix',
  ),
  'name' => 
  array (
    'type' => 'name',
    'link' => true,
    'label' => 'LBL_NAME',
    'width' => '10%',
    'name' => 'name',
  ),
  'first_name' => 
  array (
    'name' => 'first_name',
    'width' => '10%',
  ),
  'middle_name' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_MIDDLE_NAME',
    'width' => '10%',
    'name' => 'middle_name',
  ),
  'last_name' => 
  array (
    'name' => 'last_name',
    'width' => '10%',
  ),
  'account_name' => 
  array (
    'name' => 'account_name',
    'type' => 'varchar',
    'width' => '10%',
  ),
),
    'listviewdefs' => array (
 'CUSTOM_FULL_NAME' => 
  array(
    'type' => 'varchar',
	'width' => '20%', 		
	'label' => 'LBL_LIST_NAME', 
	'link' => true,
	'default' => true,
	),
  'FIRST_NAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_FIRST_NAME',
    'width' => '10%',
    'default' => true,
    'link' => true,
    'name' => 'first_name',
  ),
  'MIDDLE_NAME' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_MIDDLE_NAME',
    'width' => '10%',
    'name' => 'middle_name',
  ),
  'LAST_NAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_LAST_NAME',
    'width' => '10%',
    'default' => true,
    'name' => 'last_name',
  ),
  'TYPE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'name' => 'type_c',
  ),
  'DOCTOR_TYPE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_DOCTOR_TYPE',
    'width' => '10%',
    'name' => 'doctor_type_c',
  ),
  'ACCOUNT_NAME' => 
  array (
    'width' => '25%',
    'label' => 'LBL_LIST_ACCOUNT_NAME',
    'module' => 'Accounts',
    'id' => 'ACCOUNT_ID',
    'default' => true,
    'sortable' => true,
    'ACLTag' => 'ACCOUNT',
    'related_fields' => 
    array (
      0 => 'account_id',
    ),
    'name' => 'account_name',
  ),
),
);
// if(empty($this_parent)){
//   $popupMeta['whereStatement'] = '';
// }