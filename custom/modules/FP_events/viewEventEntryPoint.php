<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$event_id = $_REQUEST['id'];
header("Location:index.php?module=FP_events&action=DetailView&record={$event_id}");