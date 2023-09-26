<?php
require_once "modules/Cases/controller.php";

class CustomCasesController extends CasesController
{
	public function action_client_costs_to_be_paid(){
		require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
		global $db, $timedate, $current_user, $app_list_strings;

		$date_time = $timedate->getInstance()->nowDb();
		$current_date = date('Y/m/d', strtotime($date_time));
		$current_time = date('H:i:s A', strtotime($date_time));

		$header = '<table style="table-layout: fixed;height: 60px; width: 800px;" border="0">

				<tr border="0" style="height: 51px; color: white;border:none;">
					<td  style="width: 232px; height: 51px;border:none;"><span style="color:black;font-size:15px;"><b>CLIENT COSTS TO BE PAID</b></span></td>
					<td></td><td></td><td></td>
					<td  style="width: 253px; height: 51px;border:none;"><span style="color:black;float:right;font-size:10px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:10px;">Time Printed:<b>'.$current_time.'</b></span></td>
				</tr>
		</table>';

		$html = '<table style="border-collapse:collapse; table-layout:fixed;width:100%;word-wrap:break-word;" border="1">
				<thead>
				<tr>
				<td  style="width:15%;font-size: 14px;font-weight: bold; "><strong>Date</strong></td>
				<td  style="width:20%;font-size: 14px;font-weight: bold; "><strong>Payee</strong></td>
				<td  style="width:15%;font-size: 14px;font-weight: bold; "><strong>Type </strong></td>
				<td  style="width:15%;font-size: 14px;font-weight: bold; "><strong>Amount</strong></td>
				<td  style="width:10%;font-size: 14px;font-weight: bold; "><strong>Check</strong></td>


				</tr>
				</thead>
		';
		$total = 0;
		$case_bean = BeanFactory::getBean('Cases', $_REQUEST['record']);
		if($case_bean->load_relationship('cost_client_cost_cases')){
			if($case_bean->load_relationship('cost_client_cost_cases')){
				$query = "SELECT cost_client_cost.id
						FROM cost_client_cost
						LEFT JOIN cost_client_cost_cstm ON(cost_client_cost_cstm.id_c = cost_client_cost.id)
						LEFT JOIN cost_client_cost_cases_c ON(cost_client_cost_cases_c.deleted = 0 AND cost_client_cost_cases_c.cost_client_cost_casescost_client_cost_idb = cost_client_cost.id)
						WHERE cost_client_cost.deleted = 0 AND cost_client_cost_cases_c.cost_client_cost_casescases_ida = '{$_REQUEST['record']}' AND cost_client_cost.recovery_of_costs != 'waived_this_client_cost' AND cost_client_cost.recovery_of_costs != 'Recovered_and_paid_back_in_full'
						ORDER BY cost_client_cost.date_entered ASC";
				$result = $GLOBALS['db']->query($query, true);
				while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
					$COST_Client_Cost = BeanFactory::getBean('COST_Client_Cost', $row['id']);
					if($COST_Client_Cost->status == 'Due' || $COST_Client_Cost->status == 'Deferred_Until_End_of_Case'){
						$check_number = 'Due';
					}else{
						$check_number = $COST_Client_Cost->check_number;
					}
					$total += $COST_Client_Cost->total_amount;
					$html .='<tr>
						<td><span style="font-size: 15px;">'. $COST_Client_Cost->paid_date . '</span></td>
						<td><span style="font-size: 15px;">'. $COST_Client_Cost->parent_name . '</span></td>
						<td><span style="font-size: 15px;">'. $GLOBALS['app_list_strings']['cost_type_list'][$COST_Client_Cost->type] . '</span></td>
						<td><span style="font-size: 15px;">'. number_format($COST_Client_Cost->total_amount, 2) . '</span></td>
						<td><span style="font-size: 15px;">'. $check_number . '</span></td>

					</tr>';
				}
					$html .='<tr>
						<td colspan ></td>
						<td colspan ></td>
						<td colspan = "1"><span style="font-size: 15px;"><b> TOTAL COSTS : </b></span></td>
						<td colspan = "1"><span style="font-size: 15px;">'. number_format($total, 2) . '</span></td>
						<td></td>

						</tr>';
			}
		}
		$html .='</table>';

		$pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '10', '10', '15', '3', '3', '3','3');

		$pdf->SetHTMLHeader($header);
		$pdf->AddPage();
		$pdf->WriteHTML($html);
		$pdf->Output();
		ob_clean();
		$pdf->Output("Client Costs TO Be Paid.pdf", 'I');
	}
	public function action_client_costs_waived(){
		require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
		global $db, $timedate, $current_user, $app_list_strings;

		$date_time = $timedate->getInstance()->nowDb();
		$current_date = date('Y/m/d', strtotime($date_time));
		$current_time = date('H:i:s A', strtotime($date_time));

		$header = '<table style="table-layout: fixed;height: 60px; width: 800px;" border="0">

				<tr border="0" style="height: 51px; color: white;border:none;">
					<td  style="width: 232px; height: 51px;border:none;"><span style="color:black;font-size:15px;"><b>CLIENT COSTS WAIVED</b></span></td>
					<td></td><td></td><td></td>
					<td  style="width: 253px; height: 51px;border:none;"><span style="color:black;float:right;font-size:10px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:10px;">Time Printed:<b>'.$current_time.'</b></span></td>
				</tr>
		</table>';

		$html = '<table style="border-collapse:collapse; table-layout:fixed;width:100%;word-wrap:break-word;" border="1">
				<thead>
				<tr>
				<td  style="width:15%;font-size: 14px;font-weight: bold; "><strong>Date</strong></td>
				<td  style="width:20%;font-size: 14px;font-weight: bold; "><strong>Payee</strong></td>
				<td  style="width:15%;font-size: 14px;font-weight: bold; "><strong>Type </strong></td>
				<td  style="width:15%;font-size: 14px;font-weight: bold; "><strong>Amount</strong></td>


				</tr>
				</thead>
		';
		$total = 0;
		$case_bean = BeanFactory::getBean('Cases', $_REQUEST['record']);
		if($case_bean->load_relationship('cost_client_cost_cases')){
			if($case_bean->load_relationship('cost_client_cost_cases')){
				$query = "SELECT cost_client_cost.id
						FROM cost_client_cost
						LEFT JOIN cost_client_cost_cstm ON(cost_client_cost_cstm.id_c = cost_client_cost.id)
						LEFT JOIN cost_client_cost_cases_c ON(cost_client_cost_cases_c.deleted = 0 AND cost_client_cost_cases_c.cost_client_cost_casescost_client_cost_idb = cost_client_cost.id)
						WHERE cost_client_cost.deleted = 0 AND cost_client_cost_cases_c.cost_client_cost_casescases_ida = '{$_REQUEST['record']}' AND cost_client_cost.recovery_of_costs = 'waived_this_client_cost'
						ORDER BY cost_client_cost.date_entered ASC";
				$result = $GLOBALS['db']->query($query, true);
				while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
					$COST_Client_Cost = BeanFactory::getBean('COST_Client_Cost', $row['id']);
					$total += $COST_Client_Cost->total_amount;
					$html .='<tr>
						<td><span style="font-size: 15px;">'. $COST_Client_Cost->paid_date . '</span></td>
						<td><span style="font-size: 15px;">'. $COST_Client_Cost->parent_name . '</span></td>
						<td><span style="font-size: 15px;">'. $GLOBALS['app_list_strings']['cost_type_list'][$COST_Client_Cost->type] . '</span></td>
						<td><span style="font-size: 15px;">'. number_format($COST_Client_Cost->total_amount, 2) . '</span></td>

					</tr>';
				}
					$html .='<tr>
						<td colspan = "2"></td>
						<td colspan = "2"><span style="font-size: 15px;"><b> TOTAL COSTS WAIVED : </b>'. number_format($total, 2) . '</span></td>

					</tr>';
			}
		}
		$html .='</table>';

		$pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '10', '10', '15', '3', '3', '3','3');

		$pdf->SetHTMLHeader($header);
		$pdf->AddPage();
		$pdf->WriteHTML($html);
		$pdf->Output();
		ob_clean();
		$pdf->Output("Client Costs Waived.pdf", 'I');
	}
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
    public function action_statueoflimitation()
	{


		$this->view = 'statueoflimitation';
	}
    public function action_sol()
	{
		global $db;

		$states_dom = $_POST['states_dom'];
		//die($states_dom);
		if (empty(trim($states_dom))) {
			SugarApplication::redirect('index.php?module=Cases&action=statueoflimitation');
			die();
		}

		$sol_time = $_POST['sol_time'];

		$case_type = $_POST['case_type'];
		$sol_category = $_POST['sol_category'];
		// die(print_r($sol_time));
		$sql1 = "SELECT * FROM sol_time where state_id='$states_dom'";
		$result = $db->query($sql1);
		if ($result->num_rows > 0) {

			foreach ($case_type as $x => $val) {

				if (($case_type[$x] !== '')) {
					//$sql="INSERT INTO sol_time (case_type,sol,state_id) values('$val','$sol_time[$x]','$states_dom')";

					$sql = "UPDATE  sol_time SET sol='$sol_time[$x]', sol_category='$sol_category[$x]'  where case_type='$val' and state_id='$states_dom' ";

					if ($db->query($sql)) {
					} else {
						die('error');
					}
				}
			}
		} else {
			foreach ($case_type as $x => $val) {

				if (($case_type[$x] !== '')) {
					$sql = "INSERT INTO sol_time (case_type,sol,state_id,sol_category) values('$val','$sol_time[$x]','$states_dom','$sol_category[$x]')";



					if ($db->query($sql)) {
					} else {
						die('error');
					}
				}
			}
		}
		SugarApplication::redirect('index.php?module=Cases&action=statueoflimitation');
	}
	public function action_getsol()
	{
		global $db;
		$case_type = $_POST['case_type'];
		$state = $_POST['state'];
		// echo $state;
		// die();
		// $sql1= "SELECT case_type FROM sol_time WHERE state_id='$state' ";
		$sql = "SELECT * FROM sol_time WHERE state_id='{$state}' ";
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while ($product = $GLOBALS["db"]->fetchByAssoc($result)) {
				$products[] = $product;
			}

			echo json_encode($products);
			die();
		} else {
			echo "false";
			die();
		}
		// $row = $db->fetchByAssoc($result);


	}
	// public function action_insertsol(){
	// 	global $db;
	// 	$sql = "INSERT INTO sol_state (case_type) values('$val')";";
	// 	$result = $db->query($sql);
	// 	while ( $product = $GLOBALS["db"]->fetchByAssoc($result) ) {
	// 		$products[] = $product;
	//    }
	// 	// $row = $db->fetchByAssoc($result);
	// 	echo json_encode($products);
	// 	die();
	// }
	public function action_showsubpanels()
	{
		// echo "test";
		// die();
		$this->view = 'subpanels';
	}
	public function action_relatedDocuments(){
        $this->view = 'relatedDocuments';
    }
    public function action_searchByStatus(){
        global $db;
		$sql=$this->GenrateQueryDependingOnDropdowns($_POST);
       $result = $db->query($sql);
       $output=$this->generalizeCode($result);
       echo json_encode($output);
       die();
    }

    public function action_searchByType(){
        global $db;
		$sql=$this->GenrateQueryDependingOnDropdowns($_POST);
       $result = $db->query($sql);
       $output=$this->generalizeCode($result);
       echo json_encode($output);
       die();
    }
    public function action_searchByAssignedLawyer(){
        global $db;
		$sql=$this->GenrateQueryDependingOnDropdowns($_POST);
       $result = $db->query($sql);
       $output=$this->generalizeCode($result);
       echo json_encode($output);
       die();
    }
    public function action_searchByAssistentLawyer(){
        global $db;
		$sql=$this->GenrateQueryDependingOnDropdowns($_POST);
       $result = $db->query($sql);
       $output=$this->generalizeCode($result);
       echo json_encode($output);
       die();
    }

    public function action_SearchCases(){
        global $db;
        $searchText = $_REQUEST['searcheditem'];

         $sql = "SELECT cases.*,cases_cstm.* FROM cases INNER JOIN cases_cstm on cases.id=cases_cstm.id_c WHERE cases.name LIKE '%".$searchText."%' AND cases.deleted=0 AND cases.status!='Closed' LIMIT 200";
         $result = $db->query($sql);
         $output=$this->generalizeCode($result);
        echo json_encode($output);
        die();
    }
public function GenrateQueryDependingOnDropdowns($POSTArray){
        global $db;
        $query="";
		foreach($POSTArray as $keys => $values) {
            if($keys=="status"){
                if($_POST[$keys]=="NoFilterApply"){

                }else if($_POST[$keys]==""){
                         $query.=" (cases.status IS NULL OR cases.status='') AND";
                 }else{
                         $query.=" cases.status LIKE '%". $_POST[$keys]."%' AND";
                 }
             }else if($keys=="type"){
               if($_POST[$keys]=="NoFilterApply"){

               }else if($_POST[$keys]==""){
                        $query.=" (cases.type IS NULL OR cases.type='') AND";
                }else{
                        $query.=" cases.type LIKE '%". $_POST[$keys]."%' AND";
                }
            }else if($keys=="assignedLawyer"){
                if($_POST[$keys]=="NoFilterApply"){

                }else if($_POST[$keys]==""){
                         $query.=" (cases.assigned_user_id IS NULL OR cases.assigned_user_id='') AND";
                 }else{
                    $sql = "SELECT id FROM users WHERE users.last_name LIKE '%".$_POST[$keys]/*"Admin"*/."%'";
                    $result = $db->query($sql);
                    $record=$GLOBALS["db"]->fetchByAssoc($result);
                     if($record['id']){
                         $query.=" cases.assigned_user_id= '".$record['id']."' AND";
                     }else{
                        echo json_encode(array('data'=>''));
                        die();
                     }
                 }
             }else if($keys=="AssistantLaywer"){
                if($_POST[$keys]=="NoFilterApply"){

                }else if($_POST[$keys]==""){
                         $query.=" (cases.default_assistant_lawyer_id IS NULL OR cases.default_assistant_lawyer_id='') AND";
                 }else{
                    $sql = "SELECT id FROM users WHERE users.last_name LIKE '%".$_POST[$keys]/*"Admin"*/."%'";
                    $result = $db->query($sql);
                    $record=$GLOBALS["db"]->fetchByAssoc($result);
                     if($record['id']){
                         $query.=" cases.default_assistant_lawyer_id= '".$record['id']."' AND";
                     }else{
                        echo json_encode(array('data'=>''));
                        die();
                     }
                 }
             }

          }
          $sql="SELECT cases.*,cases_cstm.* FROM cases INNER JOIN cases_cstm on cases.id=cases_cstm.id_c WHERE ".$query."  cases.deleted=0 ORDER BY name ASC LIMIT 200";
          return $sql;
          die();
	}
    function generalizeCode($result){
        $fetched_record=array();
        global $app_list_strings;
        $appListLabel = $app_list_strings['case_status_dom'];
        $appTypeLabel = $app_list_strings['complaint_type_list'];
        $status_label = '';
        $type_label = '';

        if ($result->num_rows > 0) {

            while ($record = $GLOBALS["db"]->fetchByAssoc($result)) {
                if (!empty($record['status'])) {
                    foreach ($appListLabel as $key => $value) {
                        if ($key == $record['status']) {
                            $status_label = $value;
                        }
                    }
                }
                if (!empty($record['type'])) {
                    foreach ($appTypeLabel as $key => $value) {
                        if ($key == $record['type']) {
                            $type_label = $value;
                        }
                    }
                }
                $bean = BeanFactory::getBean('Users', $record['assigned_user_id']);
                $changeDate = date("m/d/Y", strtotime($record['date_of_incident_c']));
                $default_assistant_lawyer_id = BeanFactory::getBean('Users', $record['default_assistant_lawyer_id']);
                $fetched_record[] =["FirstCheckBox"=>'<input title="Select this row" onclick="sListView.check_item(this, document.MassUpdate)" type="checkbox" name="mass[]" value="'.$record['id'].'">','EditIconForEachRecord'=>'<a target="_blank" title="Edit" id="edit-'.$record['id'].'" href="index.php?module=Cases&amp;offset=1&amp;stamp=1653916918004779100&amp;return_module=Cases&amp;action=EditView&amp;record='.$record['id'].'">
                <img src="themes/Honey/images/edit_inline.gif?v=V6Jf_6LIk4nKTRgtYTnxCA" border="0" alt="Edit"><!-- </a> -->
</a>',"id" =>$record['id'],"name"=>'<b><a target="_blank" href="index.php?module=Cases&amp;offset=1&amp;stamp=1653913081018878600&amp;return_module=Cases&amp;action=DetailView&amp;record='.$record['id'].'">
                '.$record['name'].'
                </a></b>',"status" => $status_label,"type" => $type_label,"date_of_incident_c" => $changeDate ,"UserName" => $bean->last_name,'Info'=>'<span id="adspan_'.$record['id'].'" onclick="lvg_dtails(\''.$record['id'].'\')" style="position: relative;"><!--not_in_theme!--><img vertical-align="middle" class="info" border="0" alt="Additional Details" src="themes/Honey/images/info_inline.gif?v=V6Jf_6LIk4nKTRgtYTnxCA"></span>'
                ,
                "TotalCaseLength "=>$record['total_case_length_c'],
                "DaysCurrentStatus "=>$record['case_status_no_of_days'],

                "assistant_lawyer" => ($default_assistant_lawyer_id->last_name),
                "insurance_summary" => $record['case_insurance_summary_c'],
                "estimated_case_value" => $record['mdp_estimated_case_value_c'],
                "trial_conference_hearing" => $record['pre_trial_conference_hearing_c'],

            ];
            }

            $output = array(

                "data"       =>  $fetched_record
               );
               return $output;
        }else {
                return array('data'=>'');
        }
    }
    public function action_getRelatedContactRoles(){
    	$role_id = $_REQUEST['record'];
    	$case_id = $_REQUEST['case_id'];
    	global $db;
    	$sql = "SELECT
	c.id as contact_id, CONCAT(c.first_name,' ',c.last_name) AS contact_name
FROM
	contacts c
INNER JOIN contacts_cases cc ON (cc.deleted = 0 AND cc.contact_id = c.id)
WHERE
	c.deleted = 0 AND cc.case_id = '{$case_id}' AND cc.contact_role = '{$role_id}'";
$result = $db->query($sql, true);
$related_contacts = array('' => 'Select a Contact');
While($row = $db->fetchByAssoc($result)){
	$related_contacts[$row['contact_id']] = $row['contact_name'];
}
echo json_encode(array(
	'contact_list' => convertArrayToITL($related_contacts, false)
));die;
    }
    function action_GetAllUsers(){
        global $db;
        $sql="SELECT id,first_name,last_name FROM users where status='Active' AND deleted='0'";
        $result = $db->query($sql);
        $userdata=array();
        while($record = $GLOBALS["db"]->fetchByAssoc($result)){
            $userdata[]=['id' => $record['id'],'name'=>$record['first_name']." ".$record['last_name']];

        }
        echo json_encode($userdata);
        die();
    }
    function action_restrictUser(){
    	$module = $_REQUEST['modulelist'];
    	if($module == 'Case'){
    	$check_users = array();
    	$cases_list = $_REQUEST['caseslist'];
    	$users_list = $_REQUEST['userslist'];
    	// print_r($users_list);
    	$conversion = json_encode($cases_list);
		$replace1 = str_replace("[",'',$conversion);
		$replace2 = str_replace("]",'',$replace1);
    	$bean = BeanFactory::getBean("Cases");
    	$query = "cases.id IN ({$replace2})";
    	$cases = $bean->get_full_list('',$query);
    	// print_r($cases);
    	foreach($cases as $case){
    		if(!empty($case->restricted_user_c) || $case->restricted_user_c !=''){
    			$arr = explode(",", $case->restricted_user_c);
    			foreach($users_list as $key => $check_user){
    				if(in_array($check_user,$arr)){

    				}
    				else{
    					$check_users[] = $check_user;
    				}
    			}
    			$merge_arrays = array_merge($arr,$check_users);
    			$case->restricted_user_c = implode(",", $merge_arrays);
    			// print_r($case->restricted_user_c);
    		}
     //Mark each meeting as Not Held
    	// echo $case->id;
    	else{
    		 $case->restricted_user_c = implode(",",$users_list);
    	}

     //Save the meeting changes
     $case->save();
   }
    	}
   else if($module == 'Contact'){
   	$check_users = array();
    	$contacts_list = $_REQUEST['contactlist'];
    	$users_list = $_REQUEST['userslist'];
    	// print_r($users_list);
    	$conversion = json_encode($contacts_list);
		$replace1 = str_replace("[",'',$conversion);
		$replace2 = str_replace("]",'',$replace1);
    	$bean = BeanFactory::getBean("Contacts");
    	$query = "contacts.id IN ({$replace2})";
    	$contacts = $bean->get_full_list('',$query);
    	// print_r($cases);
    	foreach($contacts as $contact){
    		if(!empty($contact->restricted_user_c) || $contact->restricted_user_c !=''){
    			$arr = explode(",", $contact->restricted_user_c);
    			foreach($users_list as $key => $check_user){
    				if(in_array($check_user,$arr)){

    				}
    				else{
    					$check_users[] = $check_user;
    				}
    			}
    			$merge_arrays = array_merge($arr,$check_users);
    			$contact->restricted_user_c = implode(",", $merge_arrays);
    			// print_r($contact->restricted_user_c);
    		}
     //Mark each meeting as Not Held
    	// echo $contact->id;
    	else{
    		 $contact->restricted_user_c = implode(",",$users_list);
    	}

     //Save the meeting changes
     $contact->save();
   }
   }
    else if($module == 'Organization'){
   	$check_users = array();
    	$accounts_list = $_REQUEST['accountlist'];
    	$users_list = $_REQUEST['userslist'];
    	// print_r($users_list);
    	$conversion = json_encode($accounts_list);
		$replace1 = str_replace("[",'',$conversion);
		$replace2 = str_replace("]",'',$replace1);
    	$bean = BeanFactory::getBean("Accounts");
    	$query = "accounts.id IN ({$replace2})";
    	$accounts = $bean->get_full_list('',$query);
    	// print_r($cases);
    	foreach($accounts as $account){
    		if(!empty($account->restricted_user_c) || $account->restricted_user_c !=''){
    			$arr = explode(",", $account->restricted_user_c);
    			foreach($users_list as $key => $check_user){
    				if(in_array($check_user,$arr)){

    				}
    				else{
    					$check_users[] = $check_user;
    				}
    			}
    			$merge_arrays = array_merge($arr,$check_users);
    			$account->restricted_user_c = implode(",", $merge_arrays);
    			// print_r($account->restricted_user_c);
    		}
     //Mark each meeting as Not Held
    	// echo $account->id;
    	else{
    		 $account->restricted_user_c = implode(",",$users_list);
    	}

     //Save the meeting changes
     $account->save();
   }
   }
   header("Location:index.php?module=Administration&action=CaseRestriction");
    }
    function action_unrestrictUser(){
    	global $db;
    	$caseBean = BeanFactory::getBean("Cases", $_REQUEST['case_id']);
    	$arr = explode(",", $caseBean->restricted_user_c);
    	$user_list = array();
    	foreach($arr as $key => $userid){
    		if($userid == $_REQUEST['user_id']){
    			unset($arr[$key]);
    		}
    		else{
    			$user_list[] = $userid;
    		}
    	}
    		$caseBean->restricted_user_c = implode(",", $user_list);
    		$caseBean->save();
    	header("Location:index.php?module=Administration&action=CaseRestriction");
    }
    function action_StatusActiveAndInactive(){
        global $db;
		 $workflow_ids= $_REQUEST['checkboxArray'];
			foreach ($workflow_ids as $id) {
			   $workflow_related = BeanFactory::getBean('AOW_WorkFlow', $id);
			   $workflow_related->status='Active';
		   	   $workflow_related->save();
			      }
  	die;
    }
    public function action_getAllRelatedWorkflows(){
        global $db;

        $bean = BeanFactory::getBean('AOW_Conditions');
	   $type_name= $_REQUEST['event_type'];
	   $case_id= $_REQUEST['case_id'];
	   $query = "value = '$type_name' ";
	   $conditions_workflows = $bean->get_full_list('',$query);
    //    pre($conditions_workflows);
	   $workflows="";
	   if (!empty($conditions_workflows))
	   {
	   $workflows .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	   <div class="container-fluid" style="padding-top:30px;height:400px;overflow-y:scroll;">
	   <table class="table table-striped" id = "case_table" style="width:780px;"  >
	   <thead>
	   <tr>
            <th style = "text-align:left;">Workflows</th>
            <th style = "text-align:left;">Action Name</th>
            <th style = "text-align:left;">Description</th>
            <th style = "text-align:left;">Actions</th>
       </tr>
            </thead>
            <tbody>
		 ';


    foreach($conditions_workflows as $row)
    {
    $sql = "SELECT * FROM aow_processed where aow_processed.status='Complete' AND aow_processed.aow_workflow_id = '{$row->aow_workflow_id}' AND aow_processed.parent_id = '{$case_id}'";
 	$result = $db->query($sql);
 	$row2 = $db->fetchByAssoc($result);
     pre(!empty($row->aow_workflow_id) && empty($row2['id']));
  if (!empty($row->aow_workflow_id))
   {
      $get_id=$row->aow_workflow_id;
   $workflow_related = BeanFactory::getBean('AOW_WorkFlow', $get_id);

   $workflow_related->status='Inactive';
   $workflow_related->save();
   $action_bean = BeanFactory::getBean('AOW_Actions');
   $query = "aow_actions.aow_workflow_id='$workflow_related->id'";
   $all_actions_related_to_workflow = $action_bean->get_full_list('',$query);

            $workflows.='
            <tr>
		 <td style="">
		 <input type="checkbox" id="workflow_related" name="workflow_related" value="'.$workflow_related->id.'" style="padding-bottom:22px;">
			 <label for="workflow_related" style="font-size:14px; padding-left:5px;"> '.$workflow_related->name.'</label>
		 </td><td style="width:330px;"><ol>';
		 foreach($all_actions_related_to_workflow as $action){
		 $workflows .= '<li>'.$action->name.'</li>';
		 }
		 $workflows .= '</ol></td><td><a href="#" style="color:#edd03d;" onclick="ShowDescription(\''.$workflow_related->description.'\')"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
		 <td style="">

			 <a href="index.php?module=AOW_WorkFlow&action=DetailView&record='.$workflow_related->id.'" target="_blank"><i class="fa fa-eye" style="font-size:14px;color:#edd03d;" ></i></a>
			 				&nbsp; | &nbsp;
			 <a href="index.php?module=AOW_WorkFlow&action=EditView&record='.$workflow_related->id.'" target="_blank"><i  class="fa fa-edit" style="font-size:14px;color:#edd03d;" ></i></a>
			</td>
			</tr>';

    }

    }
    $workflows .='</tbody></table><input title="Activate" accesskey="a" class="button primary" onclick="CheckedAllWorkflows();" type="button" name="button" value="Activate" id="SAVE" style="float:right; border-radius:20px; "><input title="Cancel"  class="button primary" onclick="cancelWorkflow();" type="button" name="cancel_workflow" value="Cancel" id="Cancel" style="float:right; border-radius:20px; ""></div>';

}
    echo $workflows;
        die();
}
 public function action_get_case_assistant_options(){
        global $db;
        $sql = "SELECT users.id,
        CONCAT_WS(' ', NULLIF(users.first_name, ''), NULLIF(users.last_name, '')) as assistant_name
        FROM users
        WHERE users.status='Active' AND users.deleted='0'
         AND users.id IN (
          SELECT DISTINCT default_assistant_lawyer_id
          FROM cases WHERE
          cases.status NOT LIKE '%closed%')";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
        $rows = array();
        while($row = $result->fetch_assoc()) {
        $rows[] = $row;
        }
        $arr_for_options_p = json_encode($rows);
        }
        echo $arr_for_options_p;
        die();

    }
    public function action_get_attorney_options(){
        global $db;
        $sql = "SELECT users.id,
        CONCAT_WS(' ', NULLIF(users.first_name, ''), NULLIF(users.last_name, '')) as assistant_name
        FROM users
        WHERE users.status='Active' AND users.deleted='0'
         AND users.id IN (
          SELECT DISTINCT assigned_user_id
          FROM cases
          WHERE cases.status NOT LIKE '%closed%'
         )";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
        $rows = array();
        while($row = $result->fetch_assoc()) {
        $rows[] = $row;
        }
        $arr_for_options_p = json_encode($rows);
        }
        echo $arr_for_options_p;
        die();

    }
    public function action_UpdateAllEventsRelatedToCurrentCase(){
        global $db;
        $beans = "select cases_fp_events_1fp_events_idb from cases_fp_events_1_c where cases_fp_events_1cases_ida='".$_REQUEST['recordID']."'";
        $result=$db->query($beans);
        while ($record = $db->fetchByAssoc($result)) {
            $bean = BeanFactory::getBean("FP_events",$record['cases_fp_events_1fp_events_idb']);
                if($bean->deleted==='0'){
                    if(!empty($bean->multiple_assigned_users)){
                        $text = $bean->multiple_assigned_users;
                        $text = trim($text, "^");
                        $array = explode(",", $text);
                        $array = array_map('trim', $array, array_fill(0, count($array), "^"));
                        $key = array_search($_REQUEST['previousLawyerID'], $array);
                        if ($key !== false) {
                            $array[$key] = $_REQUEST['currentLawyerID'];
                            $array = array_map(function($element) {
                                return "^" . $element . "^";
                            }, $array);
                            $text = implode(",", $array);
                            $bean->multiple_assigned_users=$text;
                        }else{
                            $bean->multiple_assigned_users=$bean->multiple_assigned_users.',^'.$_REQUEST['currentLawyerID'].'^';
                        }

                    }else{
                        $bean->multiple_assigned_users='^'.$_REQUEST['currentLawyerID'].'^';
                    }

                    $bean->save();
                }

        }
        echo 'changedSuccfully';
        die();
    }

    public function action_testAction(){
        // require_once "modules/AOW_WorkFlow/AOW_WorkFlow.php";
        // // require_once "custom/modules/Cases/AOW_Workflow_advanced.php";
        // $aw = new AOW_WorkFlow();
        $bean = BeanFactory::getBean("AOW_WorkFlow");
    	$query = "aow_workflow.flow_module IN ('Cases')";
    	$aow_workflows = $bean->get_full_list('',$query);
        $field=array();
        foreach($aow_workflows as $workflow){
            $field[] = $this->getConditionLines($workflow->id);
        }

        pre($field);

    }
    private function getConditionLines($id){
        global $db;
        if(!$id){
            return array();
        }
        $sql = "SELECT id FROM aow_conditions WHERE aow_workflow_id = '".$id."' AND deleted = 0 ORDER BY condition_order ASC";
        $result = $db->query($sql);
		$conditions = array();
        if($result->num_rows>0){
            while ($row = $db->fetchByAssoc($result)) {
                $condition_name = new AOW_Condition();
                $condition_name->retrieve($row['id']);
                if(!$condition_name->parenthesis) {
                    $condition_name->module_path = implode(":", unserialize(base64_decode($condition_name->module_path)));
                }
                if($condition_name->value_type == 'Date'){
                    $condition_name->value = unserialize(base64_decode($condition_name->value));
                }
                $condition_item = $condition_name->toArray();

                if(!$condition_name->parenthesis) {
                    $display = $this->getDisplayForFields($condition_name->module_path, $condition_name->field, 'Cases');
                    $condition_item['module_path_display'] = $display['module'];
                    $condition_item['field_label'] = $display['field'];
                }
                
                if(isset($conditions[$condition_item['condition_order']])) {
                    $conditions[] = $condition_item;
                }
                else {
                    $conditions[$condition_item['condition_order']] = $condition_item;
                }
            }
        }
        return $conditions;
    }
    public function getDisplayForFields($modulePath, $field, $reportModule){
        $modulePathDisplay = array();
        $currentBean = BeanFactory::getBean($reportModule);
        $modulePathDisplay[] = $currentBean->module_name;
        if(is_array($modulePath)) {
            $split = $modulePath;
        }else{
            $split = explode(':', $modulePath);
        }
        if ($split && $split[0] == $currentBean->module_dir) {
            array_shift($split);
        }
        foreach($split as $relName){
            if(empty($relName)){
                continue;
            }
            if(!empty($currentBean->field_name_map[$relName]['vname'])){
                $moduleLabel = trim(translate($currentBean->field_name_map[$relName]['vname'],$currentBean->module_dir),':');
            }
            $thisModule = getRelatedModule($currentBean->module_dir, $relName);
            $currentBean = BeanFactory::getBean($thisModule);

            if(!empty($moduleLabel)){
                $modulePathDisplay[] = $moduleLabel;
            }else {
                $modulePathDisplay[] = $currentBean->module_name;
            }
        }
        $fieldDisplay = $currentBean->field_name_map[$field]['type'];
        return $fieldDisplay;
    }
}
