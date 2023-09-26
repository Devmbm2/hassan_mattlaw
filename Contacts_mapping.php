<?php

$module_fields_mapping = array(
	/* 'CON_Last_Name' => array('name' =>'last_name', 'type' => 'text'), */
	'CON_Last_Name' => array('name' =>'last_name', 'type' => 'text'),
	'CON_FirstName' => array('name' =>'first_name', 'type' => 'text'),
	'CON_Middle_Initial'=> array('name' =>'middle_name', 'type' => 'text'),
	'CON_Salutation' => array('name' =>'salutation', 'type' => 'text'),
	'CON_WorkTelephone' => array('name' =>'phone_work', 'type' => 'phone'),
	'CON_HomeTelephone' => array('name' =>'phone_home', 'type' => 'phone'),
	'CON_CellPhone' => array('name' =>'phone_mobile', 'type' => 'phone'),
	'CON_Main_Address1' => array('name' =>'primary_address_street', 'type' => 'text'),
	'CON_Main_Address2' => array('name' =>'?'),
	'CON_Main_City' => array('name' =>'primary_address_city', 'type' => 'text'),
	'CON_Main_State' => array('name' =>'primary_address_state', 'type' => 'text'),
	'CON_Main_Zip' => array('name' =>'primary_address_postalcode'),
	'CON_Email' => array('name' =>'?'),
	'CON_SSN' => array('name' =>'?'),
	'CON_DOB' => array('name' =>'birthdate', 'type' => 'date'),
	'CON_MarStatus' => array('name' =>'?'), //marital_status_c
	'CON_Sex' => array('name' =>'?'),
	'CON_Memo' => array('name' =>'description', 'type' => 'text'),
	'CON_CreateDate'=> array('name' =>'date_entered', 'type' => 'date'),
);


/* print"<pre>";print_r($module_fields_mapping);die; */