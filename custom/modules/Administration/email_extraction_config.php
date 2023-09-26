<?php
if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');
global $current_user, $sugar_config;
global $mod_strings;
global $app_list_strings;
global $app_strings;
global $theme;
global $db;
if (!is_admin($current_user))
    sugar_die("Unauthorized access to administration.");
        require_once('modules/Configurator/Configurator.php');
        $obj=new SugarBean();
        echo getClassicModuleTitle(
                "Administration", array(
            "<a href='index.php?module=Administration&action=index'>" . translate('LBL_EMAIL_EXRACT_CONFIG', 'Administration') . "</a>",
            "Email Extraction Configurations",
                ), false
        );
        $sugar_smarty = new Sugar_Smarty();
    // get data of config for show in the table
        $query = "SELECT * FROM config WHERE category='email_config'";
        $result = $db->query($query);
     
        $config_data = array();
        while($row = $db->fetchByAssoc($result)) 
            {
                $config_email = $row['name'];
                $config_password= $row['value'];
            }
// for insert data in the config table 
    if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'save') 
    {   

        if(isset($_POST['user_name']))
        {
           $user_email = $_POST['user_name'];
          
        } 
        if(isset($_POST['user_password']))
        {
           $simple_pass = $_POST['user_password'];
           $encrypted_password=$obj->encrpyt_before_save($simple_pass);
           // if (!empty($encrypted_password))
           // {
           //  $pass_update=' , value="'.$encrypted_password.'" ';
           // }
        } 
        if (mysqli_num_rows($result) > 0) 
        {  
            
            $sql="UPDATE config SET name='".$user_email."'". $encrypted_password."  WHERE category='email_config' ";
            $db->query($sql);
        
        }else
        {
            $sql="INSERT INTO config (category, name, value) 
            VALUES ('email_config', '".$user_email."', '".$encrypted_password."')";
            $db->query($sql);
        }
        // SugarApplication::redirect('index.php?module=Administration&action=email_extraction_config');
        // exit();
    }
$sugar_smarty->assign('EXCLUDE_MODULES_HTML', $excludeModulesHTML);
$sugar_smarty->assign('MOD', $mod_strings);
$sugar_smarty->assign('APP', $app_strings);
$sugar_smarty->assign('APP_LIST', $app_list_strings);
$sugar_smarty->assign('LANGUAGES', get_languages());
$sugar_smarty->assign("JAVASCRIPT", get_set_focus_js());
if($config_email != "" && $config_password != "")
{
$sugar_smarty->assign('config_email', $config_email);
$sugar_smarty->assign('config_password', $simple_pass);
}
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
$sugar_smarty->display('custom/modules/Administration/email_extraction_config.tpl');
$javascript = new javascript();
$javascript->setFormName('ConfigureSettings');
echo $javascript->getScript();

