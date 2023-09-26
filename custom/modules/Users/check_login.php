<?php 
global $db, $sugar_config;
//check_login.php
session_start();

$query = "
	SELECT user_session_id FROM users 
	WHERE id = '".$_SESSION['user_id']."'
";

$result = $db->query($query);

foreach($result as $row)
{
	// echo "here";die;
	if($_SESSION['user_session_id'] != $row['user_session_id'] && $sugar_config['simultaneouslogin'] == true)
	{
		$data['output'] = 'logout';
		session_id($_SESSION['user_session_id']);
		session_start();
		session_destroy();
	}
	else
	{
		$data['output'] = 'login';
	}
}

echo json_encode($data);
die();
?>