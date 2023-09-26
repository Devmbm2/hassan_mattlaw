<?php
//todo: make something similar for "fown for maintainance"

phpinfo();
 // session_start();
 if(in_array($_REQUEST['ht_debug'], array('true', '1')) || $_SESSION['ht_debug']=='true'){
	 ini_set('display_errors', 1);
	 ini_set('display_startup_errors', 1);
	 error_reporting(E_ALL);
	 //whatever
	 // we'll also set this in session: $_SESSION['ht_debug']='true';
 }
 
 
