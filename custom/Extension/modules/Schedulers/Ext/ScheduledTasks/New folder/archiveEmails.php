<?php
$job_strings[] = 'archiveEmails';
function archiveEmails()
{
	set_time_limit(9000);
	ini_set('memory_limit', '2048M'); //blacklist while package scan
	require_once('custom/include/CacheEmails/CacheEmails.php');
	CacheEmails::import_emails();
	return true;
}
