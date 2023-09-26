<?php
$dictionary['Account']['fields']['accounts_ht_claim_number'] = array(
	'name' => 'accounts_ht_claim_number',
	'type' => 'link',
	'relationship' => 'accounts_ht_claim_number',
	'source'=>'non-db',
	'module'=>'ht_Claim_Number',
	'bean_name'=>'ht_Claim_Number',
	'vname'=>'LBL_ACCOUNTS_HT_CLAIM_NUMBER'
	);
	$dictionary["Account"]["relationships"]['accounts_ht_claim_number'] = array(
	'lhs_module'=> 'Accounts',
	'lhs_table'=> 'accounts',
	'lhs_key' => 'id',
	'rhs_module'=> 'ht_Claim_Number',
	'rhs_table'=> 'ht_claim_number',
	'rhs_key' => 'account_id',
	'relationship_type'=>'one-to-many',
	);

 ?>
