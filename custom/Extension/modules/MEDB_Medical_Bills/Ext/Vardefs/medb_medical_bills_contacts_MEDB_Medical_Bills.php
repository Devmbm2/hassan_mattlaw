<?php
// created: 2017-06-15 17:44:33
$dictionary["MEDB_Medical_Bills"]["fields"]["medb_medical_bills_contacts"] = array (
  'name' => 'medb_medical_bills_contacts',
  'type' => 'link',
  'relationship' => 'medb_medical_bills_contacts',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'vname' => 'LBL_MEDB_MEDICAL_BILLS_CONTACTS_FROM_CONTACTS_TITLE',
  'id_name' => 'medb_medical_bills_contactscontacts_ida',
);
$dictionary["MEDB_Medical_Bills"]["fields"]["medb_medical_bills_contacts_name"] = array (
  'name' => 'medb_medical_bills_contacts_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MEDB_MEDICAL_BILLS_CONTACTS_FROM_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'medb_medical_bills_contactscontacts_ida',
  'link' => 'medb_medical_bills_contacts',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["MEDB_Medical_Bills"]["fields"]["medb_medical_bills_contactscontacts_ida"] = array (
  'name' => 'medb_medical_bills_contactscontacts_ida',
  'type' => 'link',
  'relationship' => 'medb_medical_bills_contacts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MEDB_MEDICAL_BILLS_CONTACTS_FROM_MEDB_MEDICAL_BILLS_TITLE',
);
