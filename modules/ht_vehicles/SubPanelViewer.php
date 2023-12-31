<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2016 Salesagility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/
global $beanList;
global $beanFiles, $app_list_strings;


if(empty($_REQUEST['module']))
{
	die("'module' was not defined");
}

if(empty($_REQUEST['record']))
{
	die("'record' was not defined");
}

if(!isset($beanList[$_REQUEST['module']]))
{
	die("'".$_REQUEST['module']."' is not defined in \$beanList");
}

if (!isset($_REQUEST['subpanel'])) {
    sugar_die('Subpanel was not defined');
}

$subpanel = $_REQUEST['subpanel'];
$record = $_REQUEST['record'];
$module = $_REQUEST['module'];

$collection = array();

if(isset($_REQUEST['collection_basic']) && $_REQUEST['collection_basic'][0] != 'null'){
    $_REQUEST['collection_basic'] = explode(',',$_REQUEST['collection_basic'][0]);
    $collection = $_REQUEST['collection_basic'];
}

if(empty($_REQUEST['inline']))
{
	insert_popup_header($theme);
}

//require_once('include/SubPanel/SubPanelDefinitions.php');
//require_once($beanFiles[$beanList[$_REQUEST['module']]]);
//$focus=new $beanList[$_REQUEST['module']];
//$focus->retrieve($record);

include('include/SubPanel/SubPanel.php');
$layout_def_key = '';
if(!empty($_REQUEST['layout_def_key'])){
	$layout_def_key = $_REQUEST['layout_def_key'];
}
require_once ('include/SubPanel/SubPanelDefinitions.php') ;
// retrieve the definitions for all the available subpanels for this module from the subpanel
$bean = BeanFactory::getBean($module);
$spd = new SubPanelDefinitions ( $bean ) ;
$aSubPanelObject = $spd->load_subpanel ( $subpanel ) ;
$custom_panel = $app_list_strings['sub_insurance_panels'];
if(in_array($subpanel, $custom_panel) ){
	$dynamic_template = 'modules/ht_vehicles/SubPanel/tpls/SubPanelDynamic.tpl';
}else{
	$dynamic_template = 'include/SubPanel/tpls/SubPanelDynamic.tpl';
}

$subpanel_object = new SubPanel($module, $record, $subpanel, $aSubPanelObject, $layout_def_key, $collection);
$subpanel_object->setTemplateFile($dynamic_template);

// echo (empty($_REQUEST['inline']))?$subpanel_object->get_buttons():'' ;  
ob_clean();
$subpanel_object->display();

$jsAlerts = new jsAlerts();
if (!isset($_SESSION['isMobile'])) {
    echo $jsAlerts->getScript();
}

if(empty($_REQUEST['inline']))
{
	insert_popup_footer($theme);
}

