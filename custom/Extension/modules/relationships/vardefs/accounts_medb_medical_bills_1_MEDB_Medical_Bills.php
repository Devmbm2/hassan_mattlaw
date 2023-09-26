<?php
// created: 2019-09-24 10:25:35
$dictionary["MEDB_Medical_Bills"]["fields"]["accounts_medb_medical_bills_1"] = array (
  'name' => 'accounts_medb_medical_bills_1',
  'type' => 'link',
  'relationship' => 'accounts_medb_medical_bills_1',
  'source' => 'non-db',
  'module' => 'Accounts',
  'bean_name' => 'Account',
  'vname' => 'LBL_ACCOUNTS_MEDB_MEDICAL_BILLS_1_FROM_ACCOUNTS_TITLE',
  'id_name' => 'accounts_medb_medical_bills_1accounts_ida',
);
$dictionary["MEDB_Medical_Bills"]["fields"]["accounts_medb_medical_bills_1_name"] = array (
  'name' => 'accounts_medb_medical_bills_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ACCOUNTS_MEDB_MEDICAL_BILLS_1_FROM_ACCOUNTS_TITLE',
  'save' => true,
  'id_name' => 'accounts_medb_medical_bills_1accounts_ida',
  'link' => 'accounts_medb_medical_bills_1',
  'table' => 'accounts',
  'module' => 'Accounts',
  'rname' => 'name',
);
$dictionary["MEDB_Medical_Bills"]["fields"]["accounts_medb_medical_bills_1accounts_ida"] = array (
  'name' => 'accounts_medb_medical_bills_1accounts_ida',
  'type' => 'link',
  'relationship' => 'accounts_medb_medical_bills_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ACCOUNTS_MEDB_MEDICAL_BILLS_1_FROM_MEDB_MEDICAL_BILLS_TITLE',
);
