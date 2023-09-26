<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$lead_id = $_REQUEST['id'];
header("Location:index.php?module=Leads&action=DetailView&record={$lead_id}");