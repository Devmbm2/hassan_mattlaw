<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */
/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/


require_once('custom/modules/Cases/CaseAccountRelationship.php');


global $app_strings;
global $app_list_strings;
global $mod_strings;
global $sugar_version, $sugar_config;

$focus = new CaseAccountRelationship();

if(isset($_REQUEST['record'])) {
    $focus->retrieve($_REQUEST['record']);
}

if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
	$focus->id = "";
}
// Prepopulate either side of the relationship if passed in.
safe_map('case_name', $focus);
safe_map('case_id', $focus);
safe_map('account_name', $focus);
safe_map('account_id', $focus);
//safe_map('case_role', $focus);
safe_map('account_role', $focus);


$GLOBALS['log']->info("Case account relationship");

$json = getJSONobj();
require_once('include/QuickSearchDefaults.php');
$qsd = QuickSearchDefaults::getQuickSearchDefaults();
$sqs_objects = array('account_name' => $qsd->getQSParent());
$sqs_objects['account_name']['populate_list'] = array('account_name', 'account_id');
$quicksearch_js = '<script type="text/javascript" language="javascript">sqs_objects = ' . $json->encode($sqs_objects) . '</script>';
echo $quicksearch_js;

$xtpl=new XTemplate ('custom/modules/Cases/CaseAccountRelationshipEdit.html');
$xtpl->assign("MOD", $mod_strings);
$xtpl->assign("APP", $app_strings);

$xtpl->assign("RETURN_URL", "&return_module=$currentModule&return_action=DetailView&return_id=$focus->id");
$xtpl->assign("RETURN_MODULE", $_REQUEST['return_module']);
$xtpl->assign("RETURN_ACTION", $_REQUEST['return_action']);
$xtpl->assign("RETURN_ID", $_REQUEST['return_id']);
$xtpl->assign("ID", $focus->id);
$xtpl->assign("CASE",$caseName = Array("NAME" => $focus->case_name, "ID" => $focus->case_id));
$xtpl->assign("ACCOUNT",$accountName = Array("NAME" => $focus->account_name, "ID" => $focus->account_id));

echo getClassicModuleTitle($mod_strings['LBL_MODULE_NAME'], array($mod_strings['LBL_MODULE_NAME'],$mod_strings['LBL_CASE_ACCOUNT_FORM_TITLE']." ".$caseName['NAME'] . " - ". $accountName['NAME']), true);

$xtpl->assign("CASE_ROLE_OPTIONS", get_select_options_with_id($app_list_strings['relationship_to_case_list'], $focus->case_role));




$xtpl->parse("main");

$xtpl->out("main");


$javascript = new javascript();
$javascript->setFormName('EditView');
$javascript->setSugarBean($focus);
$javascript->addToValidateBinaryDependency('account_name', 'alpha', $app_strings['ERR_SQS_NO_MATCH_FIELD'] . $mod_strings['LBL_ACCOUNT_NAME'], 'false', '', 'account_id');
echo $javascript->getScript();


?>
