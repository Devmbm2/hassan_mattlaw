<?php
if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');
global $db, $app_list_strings;
$cfg = new Configurator;
$smarty = new Sugar_Smarty();
$sql = "SELECT * from config WHERE category = 'ExportDocPassword'";
$result = $db->query($sql);
$row = $db->fetchByAssoc($result);
$current_password = $row['value'];
// die();
if(isset($_POST['save']) && empty($_POST['old_pass'])){
    $new_pass = md5($_REQUEST['new_pass']);
    $retype_pass = md5($_REQUEST['retype_pass']);
    if ($new_pass == $retype_pass)
    {
        if($result){
            if (mysqli_num_rows($result) > 0) {
                $update_data = "UPDATE `config` SET `value`='{$new_pass}' WHERE `category` = 'ExportDocPassword'";
                $db->query($update_data);
                $current_password = $new_pass;
            }
            else
            {
                $insert_data = "INSERT INTO `config`(`category`, `name`, `value`) VALUES ('ExportDocPassword','export_doc_password','{$new_pass}')";
                $db->query($insert_data);
                $current_password = $new_pass;
                $wrong_password = 'Your password is created successfully';
            }
        }
        echo "<meta http-equiv='refresh' content='5'>";
    }
}
else if(isset($_POST['save']) && !empty($_POST['old_pass'])){
    $old_pass = md5($_REQUEST['old_pass']);
    $new_pass = md5($_REQUEST['new_pass']);
    $retype_pass = md5($_REQUEST['retype_pass']);
    if ($old_pass == $current_password)
    {
        if($result){
                $update_data = "UPDATE `config` SET `value`='{$new_pass}' WHERE `category` = 'ExportDocPassword'";
                $db->query($update_data);
                $current_password = $new_pass;
                $wrong_password = 'Your password is successfully updated.';
        }
        
    }
    else{
        $wrong_password = 'You have entered wrong old password!';
    }
    echo "<meta http-equiv='refresh' content='5'>";
}
else{
    $wrong_password = '';
}

$smarty->assign('current_password', $current_password);
$smarty->assign('wrong_password', $wrong_password);
$smarty->display('custom/modules/Administration/tpls/ExportDocPassword.tpl');
echo $smarty;

