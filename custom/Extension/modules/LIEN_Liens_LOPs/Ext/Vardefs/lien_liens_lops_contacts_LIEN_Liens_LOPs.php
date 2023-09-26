<?php
// created: 2017-09-18 04:07:10
$dictionary["LIEN_Liens_LOPs"]["fields"]["lien_liens_lops_contacts"] = array (
  'name' => 'lien_liens_lops_contacts',
  'type' => 'link',
  'relationship' => 'lien_liens_lops_contacts',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'vname' => 'LBL_LIEN_LIENS_LOPS_CONTACTS_FROM_CONTACTS_TITLE',
  'id_name' => 'lien_liens_lops_contactscontacts_ida',
);
$dictionary["LIEN_Liens_LOPs"]["fields"]["lien_liens_lops_contacts_name"] = array (
  'name' => 'lien_liens_lops_contacts_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_LIEN_LIENS_LOPS_CONTACTS_FROM_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'lien_liens_lops_contactscontacts_ida',
  'link' => 'lien_liens_lops_contacts',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["LIEN_Liens_LOPs"]["fields"]["lien_liens_lops_contactscontacts_ida"] = array (
  'name' => 'lien_liens_lops_contactscontacts_ida',
  'type' => 'link',
  'relationship' => 'lien_liens_lops_contacts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_LIEN_LIENS_LOPS_CONTACTS_FROM_LIEN_LIENS_LOPS_TITLE',
);
