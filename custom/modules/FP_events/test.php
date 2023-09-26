<?php
/* phpinfo(); */
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
/* include_once 'custom/include/zoom/Zoom_Api.php';
$zoom_meeting = new Zoom_Api($GLOBALS['sugar_config']['zoom']); */
/* print"<pre>";print_r($zoom_meeting); */
/* $response = $zoom_meeting->getAllUsers();
print"<pre>";print_r($response); */

include_once 'custom/include/zoom/Zoom_Api.php';

$createUserArray['action']      = 'create';
$createUserArray['user_info']   = array(
	'email'  => 'testusman332@gmail.com',
	'type'   => '1',
	'first_name'   => 'ht',
	'last_name'   => 'ht test last',
);

$zoom_meeting = new Zoom_Api($GLOBALS['sugar_config']['zoom']);
$response = $zoom_meeting->createUser($createUserArray);

print"<pre>123";print_r($response);