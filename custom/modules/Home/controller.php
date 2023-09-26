<?php 
require_once("modules/Home/controller.php");

class CustomHomeController extends HomeController{
	public function action_generate_doc(){
		$this->view = "generate_doc";
	}
	public function action_intakeForm(){
	
        $this->view = 'intakeform';
    }
	public function action_getCaseType(){
        global $db;
		$caseType = $_REQUEST['case_type'];
		$module = $_REQUEST['search_module'];
		$sql = "SELECT ht_formbuilder.id,ht_formbuilder.description,ht_formbuilder.column_size,ht_formbuilder.condition_description FROM ht_formbuilder WHERE ht_formbuilder.case_type='{$caseType}' AND ht_formbuilder.related_module='{$module}' AND  ht_formbuilder.question_type = 'beginning'AND  ht_formbuilder.deleted = 0";
		$result = $db->query($sql);
		$row = $db->fetchByAssoc($result);
		echo json_encode($row);
		die();
    }
    public function action_getSpecificIntakeForm(){
        global $db;
		$caseType = $_REQUEST['case_type'];
		$module = $_REQUEST['search_module'];
			$sql = "SELECT ht_formbuilder.id,ht_formbuilder.description,ht_formbuilder.column_size, ht_formbuilder.condition_description FROM ht_formbuilder WHERE ht_formbuilder.case_sub_type='{$caseType}' AND ht_formbuilder.related_module='{$module}' AND  ht_formbuilder.question_type = 'specific'AND  ht_formbuilder.deleted = 0";
		$result = $db->query($sql);
		$row = $db->fetchByAssoc($result);
		echo json_encode($row);
		die();
    }
 //    public function action_qc1_inbox()
	// {

	// 	$this->view = 'qc1inbox';
	// }
	// public function action_qc1_failed()
	// {


	// 	$this->view = 'qc1failed';
	// }
	// public function action_qc1_repaired()
	// {


	// 	$this->view = 'qc1repaired';
	// }

	// public function action_qc2_inbox()
	// {


	// 	$this->view = 'qc2inbox';
	// }
	// public function action_qc2_failed()
	// {


	// 	$this->view = 'qc2failed';
	// }
	// public function action_fetchdata()
	// {
	// 	global $db;
	// 	$module    =$_REQUEST['filter_module'];
   
 //        $sql = "SELECT $module.id,$module.document_name,$module.created_by  FROM $module WHERE NOT EXISTS (SELECT *  FROM quality_control_remarks WHERE quality_control_remarks.record_id = $module.id) ORDER BY $module.document_name DESC LIMIT 1,1";
		

 //        $result_sql = $db->query($sql);
       
 //         if ($result_sql->num_rows > 0) {
 //        while ($record = $GLOBALS["db"]->fetchByAssoc($result_sql)) {
 //            $user_bean = BeanFactory::getBean('Users',$record['created_by']);
 //            // print_r($user_bean->user_name);
 //             if($module =="neg_negotiations")
 //            {
 //                $record["Module"] = "Negotiations"; 
 //                $record["Created_By"] = $user_bean->user_name; 
 //            }
 //            else if($module == "plea_pleadings")
 //            {
 //                $record["Module"] = "Pleadings"; 
 //                $record["Created_By"] = $user_bean->user_name; 

 //            }
           
 //           else if($module == "disc_discovery")
 //            {
 //                $record["Module"] = "Discovery"; 
 //                $record["Created_By"] = $user_bean->user_name; 

 //            }
 //            $record_array[] = $record;
 //        }
 //    }
 //    else
 //      {
          
      	
 //      }
	// 	echo json_encode($record_array);
	// 	die();
	// 	// $this->view = 'qc1inbox';
	// }
	// public function action_submit_qc1_remarks()
	// {
	// 	global $db, $current_user;
	// 	$record_id = $_POST['record_id'];
	// 	$users_id = $_POST['users_id'];
	// 	$module_name = $_POST['module_name'];
	// 	$document_name = $_POST['document_name'];
	// 	$deleted = $_POST['deleted'];
	// 	$remarks = $_POST['remarks'];


	// 	$sql1 = "SELECT * FROM quality_control_remarks where record_id='$record_id'";
	// 	$result1 = $db->query($sql1);
	// 	if ($result1->num_rows > 0) {
	// 		$sql = "UPDATE  quality_control_remarks SET remarks=CONCAT(remarks,'<br><b>QC1 Remarks:</b>$remarks'),status='qc1_failed' WHERE record_id= '$record_id' And deleted=0 ";
	// 		if ($db->query($sql)) {

	// 			$url = 'index.php?module=Home&action=qc1_failed&filter_module=';
	// 			$alert = BeanFactory::newBean('Alerts');
	// 			$alert->name = 'QC1 Failed ';
	// 			$alert->description = "Your adocument " . $document_name . " of module " . $module_name . "\n again need attention!!!";
	// 			$alert->assigned_user_id = $users_id;
	// 			$alert->is_read = 0;
	// 			$alert->target_module = 'Home';
	// 			$alert->type = 'info';		
	// 				if ($module_name == 'Pleadings') {
	// 					$module_name = 'plea_pleadings';
	// 				} else if ($module_name == 'Negotations') {
	// 					$module_name = ' neg_negotiations';
	// 				} else if ($module_name == 'Discovery') {
	// 					$module_name = 'disc_discovery';
	// 				}
	// 			$alert->url_redirect = $url.$module_name;
	// 			$alert->save();

	// 			if ($module_name == 'plea_pleadings') {
	// 				$module_name = 'PLEA_Pleadings';
	// 				SugarApplication::redirect('index.php?module=' . $module_name . '&action=DetailView&record=' . $record_id);
	// 			} else if ($module_name == 'neg_negotiations') {
	// 				$module_name = 'NEG_Negotiations';
	// 				SugarApplication::redirect('index.php?module=' . $module_name . '&action=DetailView&record=' . $record_id);
	// 			} else if ($module_name == 'disc_discovery') {
	// 				$module_name = 'DISC_Discovery';
	// 				SugarApplication::redirect('index.php?module=' . $module_name . '&action=DetailView&record=' . $record_id);
	// 			}
	// 		}
	// 	} else {
	// 		$sql = "INSERT INTO quality_control_remarks (record_id,users_id,module_name,document_name,remarks,date_time,deleted,status) values('$record_id','$users_id','$module_name','$document_name','<b>QC1 Remarks:</b>$remarks',NOW(),'$deleted','qc1_failed')";
	// 		if ($db->query($sql)) {
	
	// 			$url = 'index.php?module=Home&action=qc1_failed&filter_module=';
	// 			$alert = BeanFactory::newBean('Alerts');
	// 			$alert->name = 'QC1 Failed ';
	// 			$alert->description = "Your document " . $document_name . " of module " . $module_name . "\nneed attention!!!";
	// 			$alert->assigned_user_id = $users_id;
	// 			$alert->is_read = 0;
	// 			$alert->target_module = 'Home';
	// 			$alert->type = 'info';

	// 			if ($module_name == 'Pleadings') {
	// 				$module_name = 'plea_pleadings';
	// 			} else if ($module_name == 'Negotations') {
	// 				$module_name = ' neg_negotiations';
	// 			} else if ($module_name == 'Discovery') {
	// 				$module_name = 'disc_discovery';
	// 			}

	// 			$alert->url_redirect = $url.$module_name;
	// 			$alert->save();

	// 			if ($module_name == 'plea_pleadings') {
	// 				$module_name = 'PLEA_Pleadings';
	// 				SugarApplication::redirect('index.php?module=' . $module_name . '&action=DetailView&record=' . $record_id);
	// 			} else if ($module_name == 'neg_negotiations') {
	// 				$module_name = 'NEG_Negotiations';
	// 				SugarApplication::redirect('index.php?module=' . $module_name . '&action=DetailView&record=' . $record_id);
	// 			} else if ($module_name == 'disc_discovery') {
	// 				$module_name = 'DISC_Discovery';
	// 				SugarApplication::redirect('index.php?module=' . $module_name . '&action=DetailView&record=' . $record_id);
	// 			}
	// 		}
	// 	}
	// }
	// public function action_submit_qc2_remarks()
	// {
	// 	global $db, $current_user;
	// 	$record_id = $_POST['record_id'];
	// 	$module_name = $_POST['module_name'];
	// 	$document_name = $_POST['document_name'];
	// 	$remarks = $_POST['remarks'];

	// 	$sql = "UPDATE quality_control_remarks SET remarks=CONCAT(remarks,'<br><b>QC2 Remarks:</b>$remarks'),status='qc2_failed' WHERE record_id= '$record_id' And deleted=0 ";
	// 	if ($db->query($sql)) {
	// 		if ($module_name == 'Pleadings') {
	// 			$module_name = 'PLEA_Pleadings';
	// 		} else if ($module_name == 'Negotations') {
	// 			$module_name = 'NEG_Negotiations';
	// 		} else if ($module_name == 'Discovery') {
	// 			$module_name = 'DISC_Discovery';
	// 		}

	// 		SugarApplication::redirect('index.php?module=' . $module_name . '&action=DetailView&record=' . $record_id);
	// 	}
	// }

	// public function action_update_user_repaired_status()
	// {

	// 	global $db, $current_user;
	// 	$record_id = $_POST['record_id'];
	// 	$users_id = $_POST['users_id'];
	// 	$module_name = $_POST['module_name'];
		
	// 	$sql = "UPDATE  quality_control_remarks SET status='user_repaired' WHERE record_id= '$record_id' and deleted=0 ";
		
	// 	$result = $db->query($sql);
	// 	if ($result) {
	// 		echo ('success');
	// 		die();
	// 	} else {
	// 		echo ('failed');
	// 		die();
	// 	}
	// }
	// public function action_pass_document_to_qc2()
	// {
	// 	global $db, $current_user;
	// 	$record_id = $_POST['record_id'];
	// 	$module_name = $_POST['module_name'];

	// 	$sql = "UPDATE  quality_control_remarks SET status='qc1_passed' WHERE record_id= '$record_id' and deleted=0";
	// 	//  $result = $db->prepare($sql);
	//   $result = $db->query($sql);
	// 	if ($result) {
	// 		echo ('success');
	// 		die();
	// 	} else {
	// 		echo ('failed');
	// 		die();
	// 	}
	// }
	// public function action_pass_document_to_qc2_from_qc1inbox()
	// {
	// 	global $db, $current_user;
	// 	$record_id = $_POST['record_id'];
	// 	$created_by = $_POST['created_by'];
	// 	$module_name = $_POST['module_name'];
	// 	$document_name = $_POST['document_name'];
	// 	$deleted = $_POST['deleted'];
	// 	// echo($record_id,$created_by,$module_name )
	// 	$sql = "INSERT INTO quality_control_remarks(record_id,users_id,module_name,document_name,remarks,date_time,deleted,status) values('$record_id','$created_by','$module_name','$document_name','$remarks',NOW(),'$deleted','qc1_passed')";
	// 	$result = $GLOBALS['db']->query($sql, true);


	// 	if ($result) {
	// 		echo ('success');
	// 		die();
	// 	} else {
	// 		echo ('failed');
	// 		die();
	// 	}
	// 	// $result = $db->query($sql, true);
	// 	// if ($result) {
	// 	// 	if ($module_name = 'Discovery')
	// 	// 		$sql1 = "UPDATE  disc_discovery SET qc_done=2 WHERE id= '$record_id' and deleted=0";
	// 	// 	$result1 = $db->query($sql1, true);
	// 	// 	if ($result1) {
	// 	// 		echo ('success');
	// 	// 		die();
	// 	// 	}
	// 	// } else {
	// 	// 	echo ('failed');
	// 	// 	die();
	// 	// }
	// }
}