<?php
ob_clean();
$bean = BeanFactory::getBean($_REQUEST['related_type'], $_REQUEST['related_id']);
if($_REQUEST['related_type'] == 'Accounts'){
	$related_address = array(
		'primary_address_street'         => $bean->billing_address_street,
		'location_address_city_c'        =>   $bean->billing_address_city,
		'location_address_state_c'       =>  $bean->billing_address_state,
		'location_address_postalcode_c'  => $bean->billing_address_postalcode,
		'phone_at_location_of_event_c'  => $bean->phone_office
	);
	echo json_encode($related_address);die;
}else if($_REQUEST['related_type'] == 'Contacts'){
	$related_address = array(
		'primary_address_street'         => $bean->primary_address_street,
		'location_address_city_c'        =>   $bean->primary_address_city,
		'location_address_state_c'       =>  $bean->primary_address_state,
		'location_address_postalcode_c'  => $bean->primary_address_postalcode,
		'phone_at_location_of_event_c'  => $bean->phone_work
	);
	echo json_encode($related_address);die;
}


