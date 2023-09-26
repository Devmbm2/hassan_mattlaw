<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
global $db;
$smarty = new Sugar_Smarty();
$smarty->display("custom/modules/Cases/tpls/case_reports.tpl");