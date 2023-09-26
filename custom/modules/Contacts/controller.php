<?php
require_once "modules/Contacts/controller.php";
class CustomContactsController extends ContactsController
{
	
	public function action_livesearch()
	{
		global $db;
		$searchText = $_REQUEST['searcheditem'];

		// //die();
		$sql = "SELECT * FROM contacts  WHERE last_name LIKE  '%$searchText%' 
	 			OR first_name LIKE '%$searchText%' OR salutation LIKE  '%$searchText%' OR concat(first_name,' ',last_name) LIKE '%$searchText%' OR concat(last_name,' ',first_name) LIKE '%$searchText%' AND deleted =0
				order by last_name asc LIMIT 200";
		$result = $db->query($sql);
		$fetched_record=array();
		if ($result->num_rows > 0) {
			while ($record = $GLOBALS["db"]->fetchByAssoc($result)) {
				$bean = BeanFactory::getBean('Contacts',$record['id']);
				if($bean->id!=null)
				{
				$fetched_record[] = ["id" =>$bean->id,"first_name"=>$bean->first_name,"last_name" => $bean->last_name,"salutation" => $bean->salutation,"account_name"=> $bean->account_name,"account_id"=> $bean->account_id, "type_c"=> $bean->type_c, "phone_work"=> $bean->phone_work, "phone_mobile"=> $bean->phone_mobile, "country_code_phone"=> $bean->country_code_phone];
			}
				// $fetched_record['first_name'] = ;
				// $fetched_record[] = $record;
			}
			echo json_encode($fetched_record);
			die();
		} else {
			echo ('error');
			die();
		}
	}
	public function action_statueoflimitation()
	{


		$this->view = 'statueoflimitation';
	}
	public function action_getCaseType()
	{
		global $db;
		$caseType = $_REQUEST['case_type'];
		$module = $_REQUEST['module'];
		$sql = "SELECT ht_formbuilder.id,ht_formbuilder.description,ht_formbuilder.column_size FROM ht_formbuilder WHERE ht_formbuilder.case_type='{$caseType}' AND ht_formbuilder.related_module='{$module}' ";
		$result = $db->query($sql);
		$row = $db->fetchByAssoc($result);
		echo json_encode($row);
		die();
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
}
