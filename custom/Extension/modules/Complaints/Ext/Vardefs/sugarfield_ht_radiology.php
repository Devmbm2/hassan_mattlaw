<?php
 // created: 2016-12-23 14:45:48
$dictionary['Complaint']['fields']['complaint_ht_radiology'] = array(
	'name' => 'complaint_ht_radiology',
	'type' => 'link',
	'relationship' => 'complaint_ht_radiology',
	'source'=>'non-db',
	'vname'=>'LBL_COMPLAINT_HT_RADIOLOGY'
	);

	// Relationship Definition
	$dictionary["Complaint"]["relationships"]['complaint_ht_radiology'] = array(
	'lhs_module'=> 'Complaints',
	'lhs_table'=> 'complaints',
	'lhs_key' => 'id', 
	'rhs_module'=> 'ht_radiology',
	'rhs_table'=> 'ht_radiology',
	'rhs_key' => 'complaint_id',
	'relationship_type'=>'one-to-many',
	);
	
	
 ?>