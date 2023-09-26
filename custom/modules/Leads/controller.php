<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once 'modules/Leads/controller.php';

class CustomLeadsController extends LeadsController
{
public function action_intakeForm(){
        $this->view = 'intakeform';
    }
	public function action_getCaseType(){
        global $db;
		$caseType = $_REQUEST['case_type'];
		$module = $_REQUEST['module'];
		$sql = "SELECT ht_formbuilder.id,ht_formbuilder.description,ht_formbuilder.column_size FROM ht_formbuilder WHERE ht_formbuilder.case_type='{$caseType}' AND ht_formbuilder.related_module='{$module}' ";
		$result = $db->query($sql);
		$row = $db->fetchByAssoc($result);
		echo json_encode($row);
		die();		
    }
    public function action_SearchLeads(){
        global $db;
		$searchText = $_REQUEST['searcheditem'];
            if($searchText!=""){
            $sql = "SELECT * FROM leads INNER JOIN leads_cstm ON leads.id = leads_cstm.id_c WHERE  salutation LIKE '%".$searchText."%' OR first_name LIKE '%".$searchText."%' OR last_name LIKE '%".$searchText."%' OR concat(`first_name`,' ',`last_name`) LIKE '%".$searchText."%' OR concat(`last_name`,' ',`first_name`) LIKE '%".$searchText."%' OR concat(`salutation`,' ',`first_name`,' ',`last_name`) LIKE '%".$searchText."%' OR leads.phone_mobile LIKE '%".$searchText."%' OR leads_cstm.case_type_c  LIKE '%".$searchText."%'  OR source_c  LIKE '%".$searchText."%' LIMIT 200";
            }
            $ArrayOfAllLeadsRecords = $db->query($sql);
            $fetch_arry=array();
            while ($record = $GLOBALS["db"]->fetchByAssoc($ArrayOfAllLeadsRecords)) {
                 $fetch_arry[]=['id'=>$record['id'],'date_entered'=>'<a href="?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DLeads%26offset%3D1%26stamp%3D1652871695042970900%26return_module%3DLeads%26action%3DDetailView%26record%3D'.$record['id'].'">
                 '.$record['date_entered'].'
                 </a>','salutation'=>'<b><a href="?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DLeads%26offset%3D4%26stamp%3D1652871374005426400%26return_module%3DLeads%26action%3DDetailView%26record%3D'.$record['id'].'">
                '.$record['salutation']." ".$record['first_name']." ".$record['last_name'].'
                 </a><div class="inlineEditIcon"><!--?xml-stylesheet type="text/css" href="../css/style.css" ?-->
                 <!--?xml-stylesheet type="text/css" href="../css/colourSelector.php" ?-->
                 <svg version="1.1" id="inline_edit_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                 <g class="icon" id="Icon_6_">
                     <g>
                         <path class="icon" d="M64,368v80h80l235.727-235.729l-79.999-79.998L64,368z M441.602,150.398
                             c8.531-8.531,8.531-21.334,0-29.865l-50.135-50.135c-8.531-8.531-21.334-8.531-29.865,0l-39.468,39.469l79.999,79.998
                             L441.602,150.398z"></path>
                     </g>
                 </g>
                 </svg>
                 </div></b>','case_type_c'=>$record['case_type_c'],'source_c'=>$record['source_c'],'phone_mobile'=>
                ($record['phone_mobile'])?'<img style="cursor:pointer;vertical-align: sub;" src="custom/themes/default/images/messages.png" onclick="smstonumber(\''.$record['phone_mobile'].'\',\'Leads\',\''.$record['id'].'\');"><br>'.$record['phone_mobile']
                 :""
                 ,

                 'phone_work'=>$record['phone_work'],'phone_other'=>


                 ($record['phone_other'])?'<img style="cursor:pointer;vertical-align: sub;" src="custom/themes/default/images/messages.png" onclick="smstonumber(\''.$record['phone_other'].'\',\'Leads\',\''.$record['id'].'\');"><br>'.$record['phone_other']
                 :""

                 ,'damages_c'=>$record['damages_c'], 'converted'=>$record['converted']];
            }
            $output['data'] =  $fetch_arry;
           echo json_encode($output);
        die();
    }
}