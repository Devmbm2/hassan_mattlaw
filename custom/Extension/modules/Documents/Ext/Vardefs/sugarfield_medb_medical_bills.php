<?php
$dictionary['Document']['fields']['medb_medical_bills_name'] = array(
    'required'  => false,
    'source'    => 'non-db',
    'name'      => 'medb_medical_bills_name',
    'vname'     => 'LBL_MEDB_MEDICAL_BILLS_NAME',
    'type'      => 'relate',
    'rname'     => 'name',
    'id_name'   => 'medb_medical_bills_id',
    'link'      => 'medb_medical_bills_documents_reductions',
    'table'     => 'medb_medical_bills',
    'isnull'    => 'true',
    'module'    => 'MEDB_Medical_Bills',
    );
$dictionary['Document']['fields']['medb_medical_bills_id'] = array(
    'name'              => 'medb_medical_bills_id',
    'rname'             => 'id',
    'vname'             => 'LBL_MEDB_MEDICAL_BILLS_ID',
    'type'              => 'id',
    'table'             => 'medb_medical_bills',
    'isnull'            => 'true',
    'module'            => 'MEDB_Medical_Bills',
    'dbType'            => 'id',
    'reportable'        => false,
    'massupdate'        => false,
    'duplicate_merge'   => 'disabled',
    );
$dictionary["Document"]["fields"]["medb_medical_bills_documents_reductions"] = array (
  'name' => 'medb_medical_bills_documents_reductions',
  'type' => 'link',
  'relationship' => 'medb_medical_bills_documents_reductions',
  'source' => 'non-db',
  'reportable' => false,
  'vname' => 'LBL_MEDB_MEDICAL_BILLS_DOCUMENTS_REDUCTIONS',
);	

