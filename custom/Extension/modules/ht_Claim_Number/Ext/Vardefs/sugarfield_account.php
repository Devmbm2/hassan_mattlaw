<?php
$dictionary['ht_Claim_Number']['fields']['account_name'] = array(
    'name' => 'account_name',
    'rname' => 'name',
    'id_name' => 'account_id',
    'vname' => 'LBL_ACCOUNT_NAME',
    'type' => 'relate',
    'link' => 'accounts',
    'table' => 'accounts',
    'join_name' => 'accounts',
    'isnull' => 'true',
    'module' => 'Accounts',
    'dbType' => 'varchar',
    'len' => 100,
    'source' => 'non-db',
    'unified_search' => true,
    'comment' => 'The name of the account represented by the account_id field',
    'required' => true,
    'importable' => 'required',
);

$dictionary['ht_Claim_Number']['fields']['account_id'] = array(
    'name' => 'account_id',
    'type' => 'relate',
    'dbType' => 'id',
    'rname' => 'id',
    'module' => 'Accounts',
    'id_name' => 'account_id',
    'reportable' => false,
    'vname' => 'LBL_ACCOUNT_ID',
    'audited' => true,
    'massupdate' => false,
    'comment' => 'The account to which the claim number is associated',
);


 ?>
