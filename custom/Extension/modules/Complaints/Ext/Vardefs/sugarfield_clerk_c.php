<?php
 // created: 2017-06-05 12:57:53
$dictionary['Complaint']['fields']['clerk_c']['inline_edit']='1';
$dictionary['Complaint']['fields']['clerk_c']['labelValue']='Clerk';
$dictionary['Complaint']['fields']['clerk_c']['populate_list'] = array('name', 'id', 'ada_name_title_or_person_c', 'ada_address_city_c', 'ada_address_c', 'ada_phone_c', 'country', 'nickname_c');

$dictionary['Complaint']['fields']['clerk_c']['field_list']=array('clerk_c', 'account_id1_c', 'ada_coordinator', 'z_ada_clerk_contact_info_c', 'z_ada_clerk_address_c', 'z_ada_clerk_phone_number_c', 'country', 'z_person_named_clerk_c');

$dictionary['Complaint']['fields']['account_id1_c'] = array (
      'inline_edit' => 1,
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'account_id1_c',
      'vname' => 'LBL_CLERK_ACCOUNT_ID',
      'type' => 'id',
      'massupdate' => '0',
      'default' => NULL,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => false,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '36',
      'size' => '20',
      'id' => 'Complaintsaccount_id1_c',
      'custom_module' => 'Complaints',
    );

 ?>