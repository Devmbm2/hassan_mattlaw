<?php
// created: 2019-09-28 00:22:37
$dictionary["NEG_Negotiations"]["fields"]["contacts_neg_negotiations_1"] = array (
  'name' => 'contacts_neg_negotiations_1',
  'type' => 'link',
  'relationship' => 'contacts_neg_negotiations_1',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'vname' => 'LBL_CONTACTS_NEG_NEGOTIATIONS_1_FROM_CONTACTS_TITLE',
  'id_name' => 'contacts_neg_negotiations_1contacts_ida',
);
$dictionary["NEG_Negotiations"]["fields"]["contacts_neg_negotiations_1_name"] = array (
  'name' => 'contacts_neg_negotiations_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CONTACTS_NEG_NEGOTIATIONS_1_FROM_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'contacts_neg_negotiations_1contacts_ida',
  'link' => 'contacts_neg_negotiations_1',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["NEG_Negotiations"]["fields"]["contacts_neg_negotiations_1contacts_ida"] = array (
  'name' => 'contacts_neg_negotiations_1contacts_ida',
  'type' => 'link',
  'relationship' => 'contacts_neg_negotiations_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CONTACTS_NEG_NEGOTIATIONS_1_FROM_NEG_NEGOTIATIONS_TITLE',
);
