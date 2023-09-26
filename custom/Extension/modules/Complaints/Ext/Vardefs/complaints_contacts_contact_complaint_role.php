<?php
$dictionary['Complaint']['fields']['complaint_contact_fields'] = array (
			'name' => 'complaint_contact_fields',
			'rname' => 'id',
			'relationship_fields'=>array('id' => 'contact_complaint_id', 'contact_role' => 'contact_complaint_role'),
			'vname' => 'LBL_COMPLAINT_CONTACT_FIELDS',
			'type' => 'relate',
			'link' => 'contacts',
			'link_type' => 'relationship_info',
			'join_link_name' => 'contacts_complaints',
			'source' => 'non-db',
			'importable' => false,
            'duplicate_merge'=> 'disabled',
			'studio' => array('listview' => false),
			'join_primary' => false, //this is key!!! See SugarBean.php and search for join_primary for more info
);

$dictionary['Complaint']['fields']['contact_complaint_id'] = array (
			'name' => 'contact_complaint_id',
			'type' => 'varchar',
			'source' => 'non-db',
			'vname' => 'LBL_CONTACT_COMPLAINT_ID',
			'studio' => array('listview' => false),
);

$dictionary['Complaint']['fields']['contact_complaint_role'] = array (
			'name' => 'contact_complaint_role',
			'type' => 'enum',
    		'source' => 'non-db',
			'vname' => 'LBL_CONTACT_COMPLAINT_ROLE',
			'options' => 'relationship_to_complaint_list',
            'link' => 'contacts', 
			//'rname_link' => 'complaint_role',
			'rname_link' => 'contact_role',
);

