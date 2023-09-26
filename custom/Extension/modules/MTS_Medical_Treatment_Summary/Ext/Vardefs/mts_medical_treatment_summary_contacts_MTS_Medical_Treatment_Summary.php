<?php
// created: 2018-01-20 19:59:20
$dictionary["MTS_Medical_Treatment_Summary"]["fields"]["mts_medical_treatment_summary_contacts"] = array (
  'name' => 'mts_medical_treatment_summary_contacts',
  'type' => 'link',
  'relationship' => 'mts_medical_treatment_summary_contacts',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'vname' => 'LBL_MTS_MEDICAL_TREATMENT_SUMMARY_CONTACTS_FROM_CONTACTS_TITLE',
  'id_name' => 'mts_medical_treatment_summary_contactscontacts_ida',
);
$dictionary["MTS_Medical_Treatment_Summary"]["fields"]["mts_medical_treatment_summary_contacts_name"] = array (
  'name' => 'mts_medical_treatment_summary_contacts_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MTS_MEDICAL_TREATMENT_SUMMARY_CONTACTS_FROM_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'mts_medical_treatment_summary_contactscontacts_ida',
  'link' => 'mts_medical_treatment_summary_contacts',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'name',
   'fields' => 
      array (
        0 => 'first_name',
        1 => 'last_name',
      ),
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["MTS_Medical_Treatment_Summary"]["fields"]["mts_medical_treatment_summary_contactscontacts_ida"] = array (
  'name' => 'mts_medical_treatment_summary_contactscontacts_ida',
  'type' => 'link',
  'relationship' => 'mts_medical_treatment_summary_contacts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_MTS_MEDICAL_TREATMENT_SUMMARY_CONTACTS_FROM_MTS_MEDICAL_TREATMENT_SUMMARY_TITLE',
);
