<?php
// created: 2019-09-16 10:18:47
$dictionary["Document"]["fields"]["contacts_documents_1"] = array (
  'name' => 'contacts_documents_1',
  'type' => 'link',
  'relationship' => 'contacts_documents_1',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'vname' => 'LBL_CONTACTS_DOCUMENTS_1_FROM_CONTACTS_TITLE',
  'id_name' => 'contacts_documents_1contacts_ida',
);
$dictionary["Document"]["fields"]["contacts_documents_1_name"] = array (
  'name' => 'contacts_documents_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CONTACTS_DOCUMENTS_1_FROM_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'contacts_documents_1contacts_ida',
  'link' => 'contacts_documents_1',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["Document"]["fields"]["contacts_documents_1contacts_ida"] = array (
  'name' => 'contacts_documents_1contacts_ida',
  'type' => 'link',
  'relationship' => 'contacts_documents_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CONTACTS_DOCUMENTS_1_FROM_DOCUMENTS_TITLE',
);
