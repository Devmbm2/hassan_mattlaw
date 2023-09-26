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


require_once('custom/modules/Cases/CaseContactRelationship.php');


global $app_strings;
global $app_list_strings;
global $mod_strings;
global $sugar_version, $sugar_config;

$focus = new CaseContactRelationship();

if(isset($_REQUEST['record'])) {
    $focus->retrieve($_REQUEST['record']);
}
/* print"<pre> CaseContact:";print_r($focus); */
if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
	$focus->id = "";
}

// Prepopulate either side of the relationship if passed in.
safe_map('case_name', $focus);
safe_map('case_id', $focus);
safe_map('contact_name', $focus);
safe_map('contact_id', $focus);
safe_map('case_role', $focus);
/* safe_map('contact_role', $focus); */


$GLOBALS['log']->info("Case contact relationship");

$json = getJSONobj();
require_once('include/QuickSearchDefaults.php');
$qsd = QuickSearchDefaults::getQuickSearchDefaults();
$sqs_objects = array('contact_name' => $qsd->getQSParent());
$sqs_objects['contact_name']['populate_list'] = array('contact_name', 'contact_id');
$quicksearch_js = '<script type="text/javascript" language="javascript">sqs_objects = ' . $json->encode($sqs_objects) . '</script>';
echo $quicksearch_js;

$xtpl=new XTemplate ('custom/modules/Cases/CaseContactRelationshipEdit.html');
$xtpl->assign("MOD", $mod_strings);
$xtpl->assign("APP", $app_strings);

$xtpl->assign("RETURN_URL", "&return_module=$currentModule&return_action=DetailView&return_id=$focus->id");
$xtpl->assign("RETURN_MODULE", $_REQUEST['return_module']);
$xtpl->assign("RETURN_ACTION", $_REQUEST['return_action']);
$xtpl->assign("RETURN_ID", $_REQUEST['return_id']);
$xtpl->assign("ID", $focus->id);
$xtpl->assign("CASE",$caseName = Array("NAME" => $focus->case_name, "ID" => $focus->case_id));
$xtpl->assign("CONTACT",$contactName = Array("NAME" => $focus->contact_name, "ID" => $focus->contact_id));

echo getClassicModuleTitle($mod_strings['LBL_MODULE_NAME'], array($mod_strings['LBL_MODULE_NAME'],$mod_strings['LBL_CASE_CONTACT_FORM_TITLE']." ".$caseName['NAME'] . " - ". $contactName['NAME']), true);

$xtpl->assign("CASE_ROLE_OPTIONS", get_select_options_with_id($app_list_strings['relationship_to_case_list'], $focus->case_role));




$xtpl->parse("main");

$xtpl->out("main");


$javascript = new javascript();
$javascript->setFormName('EditView');
$javascript->setSugarBean($focus);
$javascript->addToValidateBinaryDependency('contact_name', 'alpha', $app_strings['ERR_SQS_NO_MATCH_FIELD'] . $mod_strings['LBL_CONTACT_NAME'], 'false', '', 'contact_id');
echo $javascript->getScript();


?>
