<?php
require_once "modules/Documents/controller.php";
class CustomDocumentsController extends DocumentsController{
	function __construct(){
		parent::__construct();
	}
	function action_DocumentCheckConflictedEvents(){
		ob_clean();
		global $timedate, $current_user;

		$stream_html  = "<script type='text/javascript' src='https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js'></script>
			  <link href='https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'/>";
		$data = array();
		$tz = $timedate->userTimezone($current_user);
		date_default_timezone_set($tz);
		if(empty($_REQUEST['date_start']) || empty($_REQUEST['date_end'])){
			echo 'false';die;
		}
		$date_start = gmdate("Y-m-d H:i:s", strtotime($_REQUEST['date_start']));
		$date_end = gmdate("Y-m-d H:i:s", strtotime($_REQUEST['date_end']));
		/* $assigned_user_id = $_REQUEST['assigned_user_id']; */
		$record_id = $_REQUEST['record_id'];
		$where_case = '';
		/* print"<pre>";print_r($_REQUEST); */
		if(!empty($_REQUEST['case_id'])){
			$where_case = "AND cases_fp_events_1_c.cases_fp_events_1cases_ida = '{$_REQUEST['case_id']}'";
		}
		/* $selected_user_ids = '^'.str_replace(",", "^,^", $_REQUEST['multiple_assigned_users']).'^'; */
		$sql = "SELECT dr1.id, dr1.name, dr1.date_start, dr1.date_end,  dr1.assigned_user_id, dr1.multiple_assigned_users
				FROM fp_events dr1
				RIGHT JOIN cases_fp_events_1_c ON (cases_fp_events_1_c.cases_fp_events_1fp_events_idb = dr1.id)
				WHERE dr1.deleted = 0  {$where_case} AND ((dr1.date_start  BETWEEN '{$date_start}' AND '{$date_end}' || dr1.date_end  BETWEEN '{$date_start}' AND '{$date_end}') OR (dr1.date_start <= '{$date_start}' AND dr1.date_end >= '{$date_end}'))";
		/* echo $sql;die; */
		$result = $GLOBALS['db']->query($sql, true);
		if($result->num_rows <= 0){
			echo 'false';die;
		}else{
			$display =false;
			$stream_html  .= '<style>
							#data {
							  font-family: arial, sans-serif;
							  border-collapse: collapse;
							  width: 100%;
							}

							#data td, th {
							  border: 1px solid #dddddd;
							  text-align: left;
							  padding: 8px;
							}
							</style>';
			$event_view = 'Creating';
			if($record_id == ''){
				$event_view = 'Creating';
			}else{
				$event_view = 'Editing';
			}
			$stream_html  .= '<form name = \'conflict\'><span style="color:black;font-weight:bold">Here is the list of Users and the Events that conflicts with the new event you just '. $event_view .'  </span><br>';
			$stream_html  .="<br><table id= 'data'>
							<tr>
								<th>Users</th>
								<th>Event Name</th>
								<th>Start Date</th>
								<th>End Date</th>
							</tr>";
			$event_ids = array();
			while($row = $GLOBALS['db']->fetchByAssoc($result)){
				//$cehck = $this->getRelatedUsersEvents($selected_user_ids, $row['multiple_assigned_users']);
				//if($cehck['result']){
					$event_ids[] = $row['id'];
					$display =true;
					$all_users = get_user_array();
					/* print"<pre>";print_r($all_users); */
					$multiple_assigned_users = unencodeMultienum($row['multiple_assigned_users']);
					$names = array();
					foreach($multiple_assigned_users as $id){
						$names[] = $all_users[$id];
					}
					/* print"<pre>";print_r($names); */
					$stream_html  .=" <tr>
									  <td>". implode(',', $names) ."</td>
									  <td></b><a href='index.php?module=FP_events&action=DetailView&record=".$row['id']."' target='_blank'><b>".$row['name']."</td>
									  <td>".$timedate->to_display_date_time($row['date_start']) ."</td>
									  <td>".$timedate->to_display_date_time($row['date_end']) ."</td>
									  </tr>";
					/* $stream_html  .="User Name's <b>".$cehck['user_names']."</b> event named <a href='index.php?module=FP_events&action=DetailView&record=".$row['id']."' target='_blank'><b>".$row['name']."</b></a> conflicts with the new event you just created. <br>"; */
				//}
			}
			$stream_html .='</table><br><table><tr><td><b>Select Event To merge: </b></td><td>
				<input type="text" name="event_name" class="sqsEnabled sqsNoAutofill" tabindex="0" id="event_name" size="" value="" title="" autocomplete="off">
				<input type="hidden" name="event_id" id="event_id" value="">
				<span class="id-ff multiple">
				<button type="button" name="btn_account_name" id="btn_account_name" tabindex="0" title="Select Account" class="button firstChild" value="Select Account" 

				onclick=\'open_popup(
				"FP_events", 
				600, 
				400, 
				"", 
				true, 
				false, 
				{"call_back_function":"set_return","form_name":"conflict","field_to_name_array":{"id":"event_id","name":"event_name"}}, 
				"single", 
				true
				);\'><img src="themes/Honey/images/id-ff-select.png?v=cnr9oDFHQ1anbCjF26dF3A"></button><button type="button" name="btn_clr_event_name" id="btn_clr_event_name" tabindex="0" title="Clear Event" class="button lastChild" onclick="SUGAR.clearRelateField(this.form, \'event_name\', \'event_id\');" value="Clear Account"><img src="themes/Honey/images/id-ff-clear.png?v=cnr9oDFHQ1anbCjF26dF3A"></button>
				</span></td></tr></table>
				';

			$stream_html .='<input id="deleted_events" name="deleted_events[]" type="hidden" value="'. implode(',', $event_ids) .'"><br><b>Would you like to save and continue or edit the Event Dates?</b><br><br>';
			$onClick = 'onclick = "$(\'#'. $_REQUEST['formName'].' #event_event_id\').val($(\'#event_id\').val());$(\'#'. $_REQUEST['formName'].' #deleted_events\').val($(\'#deleted_events\').val());var _form = document.getElementById(\''.$_REQUEST['formName'].'\'); _form.action.value=\'Save\';if(custom_validation())if(check_form(\''.$_REQUEST['formName'].'\'))SUGAR.ajaxUI.submitForm(_form);return false;"';
			$stream_html .='<input class="button" type="button" id = "btn-continue" value="Save & Continue" '.$onClick.'  style="float:right;">';
			$stream_html .='<input type="button" id = "edit_new_event" value="Edit Current Event" onclick="$(\'.container-close\').click();" style="float:right;"></form>';
			$stream_html .= "<script>$(document).ready(function() {
								$('#data').DataTable();
							});</script>";
			if($display){
				echo $stream_html;die;		
			}else{
				echo 'false';die;
			}
		}
	}
	function getRelatedUsersEvents($selected_user_ids, $db_user_ids){
		$names = array();
		$db_user_ids = explode(',', $db_user_ids);
		$result = false;
		$all_users = get_user_array();
		/* print"<pre>";print_r($all_users); */
		foreach(explode(',', $selected_user_ids) as $id){
			/* echo '$id: '.$id;echo '<br>'; */
			if (in_array($id, $db_user_ids)){
				$result = true;
				/* echo 'users: '.$all_users[$id]; */
				$id = str_replace('^', '', $id);
				$names[] = $all_users[$id];
			}
		}
		return array('result' => $result, 'user_names' => implode(',', $names));
	}
	function action_getSoftDocs()
    {
        global $db;
        $document_type = $_REQUEST['module_name'];
        $cases_record_value = $_REQUEST['case_id'];
        if ($document_type == 'plea_pleadings') {
            $pleading_records = array();
            $sql = "SELECT plea_pleadings_casesplea_pleadings_idb FROM plea_pleadings_cases_c WHERE plea_pleadings_casescases_ida = '$cases_record_value'";
            $result = $db->query($sql, true);
            if ($result->num_rows > 0) {
                while ($row = $db->fetchByAssoc($result)) {
                    $plea_id = $row['plea_pleadings_casesplea_pleadings_idb'];
                    if (!empty($plea_id)) {
                        $sql1 = "SELECT id,document_name FROM {$document_type} WHERE deleted = 0 AND id = '$plea_id'";
                        $result1 = $db->query($sql1, true);
                        if ($result1->num_rows > 0) {
                            $pleading_records[] = $db->fetchByAssoc($result1);
                        }
                    }
                }
            }
            echo json_encode($pleading_records);
            die();
        }elseif ($document_type == 'neg_negotiations'){
            $negotiation_records  = array();
            $sql3 =  "SELECT neg_negotiations_casesneg_negotiations_idb FROM neg_negotiations_cases_c WHERE neg_negotiations_casescases_ida = '$cases_record_value'";
            $result3 = $db->query($sql3, true);
            if($result3->num_rows > 0) {
                while ($row3 = $db->fetchByAssoc($result3)) {
                    $neg_id = $row3['neg_negotiations_casesneg_negotiations_idb'];
                    if(!empty($neg_id)){
                        $sql4 =  "SELECT id,document_name FROM {$document_type} WHERE deleted = 0 AND id = '$neg_id'";
                        $result4 = $db->query($sql4, true);
                        if($result4->num_rows > 0) {
                            $negotiation_records[] = $db->fetchByAssoc($result4);
                        }
                    }
                }
            }
            echo json_encode($negotiation_records);
            die();
        }else if($document_type == 'disc_discovery'){
            $discovery_records  = array();
            $sql5 =  "SELECT disc_discovery_casesdisc_discovery_idb FROM disc_discovery_cases_c WHERE disc_discovery_casescases_ida = '$cases_record_value'";
            $result5 = $db->query($sql5, true);
            if($result5->num_rows > 0) {
                while ($row5 = $db->fetchByAssoc($result5)) {
                    $disc_id = $row5['disc_discovery_casesdisc_discovery_idb'];
                    if(!empty($disc_id)){
                        $sql6 =  "SELECT id,document_name FROM {$document_type} WHERE deleted = 0 AND id = '$disc_id'";
                        $result6 = $db->query($sql6, true);
                        if($result6->num_rows > 0) {
                            $discovery_records[] = $db->fetchByAssoc($result6);
                        }
                    }
                }
            }
            echo json_encode($discovery_records);
            die();
        }
    }
    //    === Get Cases which are linked with documents ===
    public function action_getCases()
    {
        global $db;
        $sql = "SELECT cases.id AS cases_id,cases.name AS cases_name FROM documents
                LEFT JOIN documents_cases ON documents.id = documents_cases.document_id
                LEFT JOIN cases ON documents_cases.case_id = cases.id WHERE cases.deleted = 0
                order by cases.name asc";
        $result = $db->query($sql);
        $all_case_names = array();
        while ($record = $GLOBALS["db"]->fetchByAssoc($result)) {
            $name = $record['cases_name'];
            $id = $record['cases_id'];
            $all_case_names[$id] = $name;
        }
        echo json_encode($all_case_names);
        die();
    }
    //    === Get Users which are linked with documents ===
    public function action_getUsers()
    {
        global $db;
        $sql2 = "SELECT users.id,users.first_name,users.last_name FROM users WHERE users.deleted = 0 AND users.status = 'Active' order by users.first_name asc ";
        $result2 = $db->query($sql2);
        $all_users_names = array();
        while ($record2 = $GLOBALS["db"]->fetchByAssoc($result2)) {
            $assigned_user_id = $record2['id'];
            $assigned_first_name = $record2['first_name'];
            $assigned_last_name = $record2['last_name'];
            $case_assigned_to = $assigned_first_name . ' ' . $assigned_last_name;
            $all_users_names[$assigned_user_id] = $case_assigned_to;
        }
        echo json_encode($all_users_names);
        die();
    }
    // function action_Claim_Number(){
    //     global $db;
    //     $insurance_id=$_REQUEST['InsurnaceID'];
    //     $insurance_type=$_REQUEST['InsuranceType'];
    //     $query="SELECT * FROM `ht_claim_number` where account_id='$insurance_id' AND insurance_type='$insurance_type'";
    //     $result = $db->query($query, true);
    //     $options = '';
    //     while ($row = $db->fetchByAssoc($result)) {
    //         $options .= '<option value="'. $row['adjuster'] . '" data-ClaimNumber="'.$row['claim_number'].'">' . $row['adjuster'] . '</option>';

    //     }
    //     echo $options;
    // }
    function action_Claim_Number(){
        global $db;
        $insurance_id=$_REQUEST['InsurnaceID'];
        $insurance_type=$_REQUEST['InsuranceType'];
        $query="SELECT * FROM `ht_claim_number` where account_id='$insurance_id' AND insurance_type='$insurance_type'";
        $result = $db->query($query, true);
        $options = '';
        $check_adjuster=false;
        $rows = array();
        while ($row = $db->fetchByAssoc($result)) {
            $rows[] = $row;
            if($row['adjuster']!=""){
                $check_adjuster=true;
            }
        }
        if($check_adjuster){
            foreach ($rows as $row2){
                $options .= '<option value="'. $row2['adjuster'] . '" data-ClaimNumber="'.$row2['claim_number'].'">' . $row2['adjuster'] . '</option>';
            }
        }else{
            foreach ($rows as $row2){
                $options .= '<option value="'. $row2['claim_number'] . '">' . $row2['claim_number'] . '</option>';
            }
        }
        echo $options;
    }
}