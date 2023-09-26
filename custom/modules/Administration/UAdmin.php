<?php

if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');

global $current_user, $sugar_config;
global $mod_strings;
global $app_list_strings;
global $app_strings;
global $theme;

if (!is_admin($current_user))
    sugar_die("Unauthorized access to administration.");

require_once('modules/Configurator/Configurator.php');

echo getClassicModuleTitle(
        "Administration", array(
    "<a href='index.php?module=Administration&action=index'>" . translate('LBL_MODULE_NAME', 'Administration') . "</a>",
    "Users Activity Settings",
        ), false
);

$cfg = new Configurator();
$sugar_smarty = new Sugar_Smarty();
$errors = array();

if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'save') {
    if(isset($_POST['pcua']['excludeactions'])) 
        $_POST['pcua']['excludeactions'] = implode(',',$_POST['pcua']['excludeactions']);
    else
        $_POST['pcua']['excludeactions'] = '';
    if(isset($_POST['pcua']['excludemodules'])) 
        $_POST['pcua']['excludemodules'] = implode(',',$_POST['pcua']['excludemodules']);
    else
        $_POST['pcua']['excludemodules'] = '';
    if(isset($_POST['pcua']['excludeusers'])) 
        $_POST['pcua']['excludeusers'] = implode(',',$_POST['pcua']['excludeusers']);
    else
        $_POST['pcua']['excludeusers'] = '';
    
    foreach ($_POST as $key => $value) {
        if (strcmp("$value", 'true') == 0) {
            $value = true;
        }
        if (strcmp("$value", 'false') == 0) {
            $value = false;
        }
        $_POST[$key] = $value;
    }

    $cfg->saveConfig();

    SugarApplication::redirect('index.php?module=Administration&action=index');
    exit();
}

$excludeUsersHTML = '<select multiple="multiple" size="5" name="pcua[excludeusers][]">';
$excludeUsers = isset($sugar_config['pcua']['excludeusers']) ? explode(',',$sugar_config['pcua']['excludeusers']) : array();
$users = get_user_array();
foreach ($users as $id=>$username) 
{
    $selected ='';
    if (in_array($id,$excludeUsers)){
        $selected ='selected="selected"';
    }
    $excludeUsersHTML .="<option $selected value='$id'>$username</option>";
}
$excludeUsersHTML .= '</select>';
$sugar_smarty->assign('EXCLUDE_USERS_HTML', $excludeUsersHTML);

$excludeActionsHTML = '<select multiple="multiple" size="5" name="pcua[excludeactions][]">';
$excludeActions = isset($sugar_config['pcua']['excludeactions']) ? explode(',',$sugar_config['pcua']['excludeactions']) : array();
foreach ($app_list_strings['usersactivity_actions'] as $key=>$action) 
{
    $selected ='';
    if (in_array($key,$excludeActions)){
        $selected ='selected="selected"';
    }
    $excludeActionsHTML .="<option $selected value='$key'>$action</option>";
}
$excludeActionsHTML .= '</select>';
$sugar_smarty->assign('EXCLUDE_ACTIONS_HTML', $excludeActionsHTML);

$excludeModulesHTML = '<select multiple="multiple" size="5" name="pcua[excludemodules][]">';
$excludeModules = isset($sugar_config['pcua']['excludemodules']) ? explode(',',$sugar_config['pcua']['excludemodules']) : array();
foreach (UsersActivity::getAllModuleList() as $key=>$module) 
{
    $selected ='';
    if (in_array($key,$excludeModules)){
        $selected ='selected="selected"';
    }
    $excludeModulesHTML .="<option $selected value='$key'>$module</option>";
}
$excludeModulesHTML .= '</select>';
$sugar_smarty->assign('EXCLUDE_MODULES_HTML', $excludeModulesHTML);

$sugar_smarty->assign('MOD', $mod_strings);
$sugar_smarty->assign('APP', $app_strings);
$sugar_smarty->assign('APP_LIST', $app_list_strings);
$sugar_smarty->assign('LANGUAGES', get_languages());
$sugar_smarty->assign("JAVASCRIPT", get_set_focus_js());
$sugar_smarty->assign('config', $sugar_config);
$sugar_smarty->assign('error', $errors);


$buttons = <<<EOQ
    <input title="{$app_strings['LBL_SAVE_BUTTON_TITLE']}"
                       accessKey="{$app_strings['LBL_SAVE_BUTTON_KEY']}"
                       class="button primary"
                       type="submit"
                       name="save"
                       onclick="return check_form('ConfigureSettings');"
                       value="  {$app_strings['LBL_SAVE_BUTTON_LABEL']}  " >
                &nbsp;<input title="{$mod_strings['LBL_CANCEL_BUTTON_TITLE']}"  onclick="document.location.href='index.php?module=Administration&action=index'" class="button"  type="button" name="cancel" value="  {$app_strings['LBL_CANCEL_BUTTON_LABEL']}  " >
EOQ;

$sugar_smarty->assign("BUTTONS", $buttons);

$sugar_smarty->display('custom/modules/Administration/UAdmin.tpl');

$javascript = new javascript();
$javascript->setFormName('ConfigureSettings');
echo $javascript->getScript();

