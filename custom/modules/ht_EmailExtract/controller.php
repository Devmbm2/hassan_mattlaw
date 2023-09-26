<?php
require "modules/AOW_WorkFlow/aow_utils.php";
class ht_EmailExtractController extends SugarController{
    public function action_GetAllModulesFromDatabase(){
        global $app_list_strings,$db;
        // print_r($_GET['CodeType']=='module');die();
        if($_GET['CodeType']=='module'){
            $app_list_strings['AllModuleList'] = $app_list_strings['moduleList'];
            $moduleName=$db->query("Select convert_to_module from ht_emailextract where id = '".$_POST['recordID']."'");
            $moduleName=$db->fetchRow($moduleName);
            // print_r($moduleName);die();
            print_r( get_select_options_with_id($app_list_strings['AllModuleList'],$moduleName));
            die();
        }else{
            $vardef = getModuleFields($_POST['moduleName'],'EditView');
             $vardef .=' <option label="" value="email_address">Email Address</option>';
            print_r($vardef);
            die();
        }

    }




    public function action_OnEditloadMapingField(){
        global $db;
        $bean = BeanFactory::getBean('ht_EmailExtract', $_POST['record']);
        $decodedText = html_entity_decode($bean->fieldForJsonData);
        $Object = json_decode($decodedText);
        $moduleName=$db->query("Select convert_to_module from ht_emailextract where id = '".$_POST['record']."'");
        $html="";
        $moduleName=$db->fetchRow($moduleName);
        foreach($Object as $fields=>$value){
            $html.='<tr><td>  <input  type="button" class="button" id="remove_field"
            title="-" value="-"></td>
             <td>
            <select name="maping_fields[]" id="maping_fields" title="" style="width:200px">
              <option label="" value=""></option>
              '.getModuleFields($moduleName['convert_to_module'],'EditView',$fields).'
              <option label="" value="email_address" ';
              if($fields=="email_address"){ 
                $html.='selected="selected" ';
                 } 
                 $html.='>Email Address</option>
              </select></td>
              
              <td>
              <select name="_emails_day[]" id="_emails_day" title="" style="width:200px">
              <option label="" selected="selected" value="'.$value.'">'.$value.'</option>
                <option label="" value="subject">Subject</option>
                <option label="" value="sender_name">Sender Name</option>
                <option label="" value="sender_email">Sender Email</option>
                <option label="" value="body">Body</option>
                <option label="" value="da  te">Date</option>
                </select></td>
                </tr>';

        }
         print_r($html);
        die();

    }

   
    
}


?>