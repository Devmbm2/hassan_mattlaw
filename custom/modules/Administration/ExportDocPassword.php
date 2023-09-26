
<?php


if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');
global $db, $app_list_strings;
global $beanList;
$cfg = new Configurator;
$smarty = new Sugar_Smarty();
$sql = "SELECT * from config WHERE category = 'ExportDocPassword'";
                $result = $db->query($sql);
                $row = $db->fetchByAssoc($result);
                $current_password = $row['value'];
if(isset($_POST['save'])){
        if ((isset($_POST["new_pass"]) && !empty($_POST['new_pass'])) && (isset($_POST["retype_pass"]) && !empty($_POST['retype_pass']))) {
                        //echo "Hello WOrld";

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
                        }else if(isset($_POST['save']) && !empty($_POST['old_pass'])){

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
        }

        // insert_data('config', array(
        //     'value' => JSON::encode($_POST['SelectedModules']),
        //     'name' => 'export_doc_Modules',
        //     'category'=>'ExportDocModules'
        // )
        // );
        function insert_data($table_name, $data) {
            global $db;
            $columns = implode(',', array_keys($data));
            $values = implode("','", array_values($data));
            $result = $db->query('select * from '.$table_name.' where category="ExportDocModules"');
            if($result->num_rows){
                $query="UPDATE `config` SET `value`='".array_values($data)[0]."' , `name`='".array_values($data)[1]."' , `category`='".array_values($data)[2]."' WHERE name='export_doc_Modules'";
            }else{
                $query = "INSERT INTO $table_name ($columns) VALUES ('$values')";
            }
            $result = $db->query($query);

            if($result){
                return true;
            } else {
                return false;
            }
        }
        if (array_key_exists("SelectedModules", $_POST)) {
            insert_data('config', array(
                'value' => JSON::encode($_POST['SelectedModules']),
                'name' => 'export_doc_Modules',
                'category'=>'ExportDocModules'
            )
            );
        }else{
            insert_data('config', array(
                'value' => "",
                'name' => 'export_doc_Modules',
                'category'=>'ExportDocModules'
            )
            );
        }


}
//print_r($_POST);die();

$result = $db->query('select * from config where category="ExportDocModules"');
$row = $db->fetchByAssoc($result);

$allModules=str_replace("quot","",preg_replace('/[^A-Za-z0-9_\-]/', '', explode(',',$row['value'])));
if(empty($allModules[0])){
    $allModules="";
}
$app_list_strings['aow_moduleList'] = $app_list_strings['moduleList'];
// unset($app_list_strings['moduleList']['KBDocuments']);
$AllModules=get_select_options_with_id($app_list_strings['aow_moduleList'],$allModules);
$smarty->assign('current_password', $current_password);
$smarty->assign('wrong_password', $wrong_password);
$smarty->assign('AllModules', $AllModules);
$smarty->display('custom/modules/Administration/tpls/ExportDocPassword.tpl');
echo $smarty;


