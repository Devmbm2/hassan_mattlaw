<?php
// created: 2017-06-15 18:28:51
$dictionary["MEDR_Medical_Records"]["fields"]["medr_medical_records_contacts"] = array (
  'name' => 'medr_medical_records_contacts',
  'type' => 'link',
  'relationship' => 'medr_medical_records_contacts',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'vname' => 'LBL_MEDR_MEDICAL_RECORDS_CONTACTS_FROM_CONTACTS_TITLE',
  'id_name' => 'medr_medical_records_contactscontacts_ida',
);
$dictionary["MEDR_Medical_Records"]["fields"]["medr_medical_records_contacts_name"] = array (
  'name' => 'medr_medical_records_contacts_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MEDR_MEDICAL_RECORDS_CONTACTS_FROM_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'medr_medical_records_contactscontacts_ida',
  'link' => 'medr_medical_records_contacts',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["MEDR_Medical_Records"]["fields"]["medr_medical_records_contactscontacts_ida"] = array (
  'name' => 'medr_medical_records_contactscontacts_ida',
  'type' => 'link',
  'relationship' => 'medr_medical_records_contacts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MEDR_MEDICAL_RECORDS_CONTACTS_FROM_MEDR_MEDICAL_RECORDS_TITLE',
);
