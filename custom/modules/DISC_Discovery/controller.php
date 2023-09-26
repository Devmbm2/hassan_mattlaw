<?php
class DISC_DiscoveryController extends SugarController
{
	function action_get_related_case_fields() {
		ob_clean();
		$case_id = $_REQUEST['case_id'];
		if(!empty($case_id)){
			$case = BeanFactory::getBean('Cases', $case_id);
			if(!empty($case->contact_id_c)){
				$contact = BeanFactory::getBean('Contacts', $case->contact_id_c);	
				echo $contact->first_name . ' '.$contact->last_name ;die;
			}else{
				echo '';die;
			}
		}else{
			echo 'Case ID is Empty....';die;
		}
	
	}
	function action_get_nickname() {
		ob_clean();
		$depo_parent_id = $_REQUEST['depo_parent_id'];
		$depo_parent_type = $_REQUEST['depo_parent_type'];
		if(!empty($depo_parent_id)){
		$module = BeanFactory::getBean($depo_parent_type,$depo_parent_id);
			if(!empty($module->nickname_c)){
				echo $module->nickname_c;die();
			}else{
				echo '';die();
			}
		}else{
			echo '';die;
		}
	
	}
	function action_get_witness_nickname() {
		ob_clean();
		$witness_parent_id = $_REQUEST['witness_parent_id'];
		$witness_parent_type = $_REQUEST['witness_parent_type'];
		if(!empty($witness_parent_id)){
		$module = BeanFactory::getBean($witness_parent_type,$witness_parent_id);
			if(!empty($module->nickname_c)){
				echo $module->nickname_c;die();
			}else{
				echo '';die();
			}
		}else{
			echo '';die;
		}
	
	}
	function action_get_related_case_lawyer() {
		ob_clean();
		$fetched_record = array();
		$case_id = $_REQUEST['case_id'];
		if(!empty($case_id)){
			$case = BeanFactory::getBean('Cases', $case_id);
			if(!empty($case->default_assistant_lawyer_name || $case->default_assistant_lawyer_id || $case->assigned_user_name || $case->assigned_user_id)){
				$fetched_record[] = ["default_assistant_lawyer_name" =>$case->default_assistant_lawyer_name,"default_assistant_lawyer_id" =>$case->default_assistant_lawyer_id,"assigned_user_name" =>$case->assigned_user_name,
                            "assigned_user_id" =>$case->assigned_user_id];
				echo json_encode($fetched_record);die();
			}else{
				echo '';die;
			}
		}else{
			echo '';die;
		}
	
	}
	// public function action_show_memo_box_for_qc1()
	// {
	// 	global $db;
	// 	$document_id = $_POST['document_id'];

	// 	$disc_sql = "SELECT id,document_name,created_by FROM disc_discovery WHERE id='{$document_id}'  ";
	// 	$record_discovery = $db->query($disc_sql);

	// 	if ($record_discovery->num_rows > 0) {
	// 		while ($record = $GLOBALS["db"]->fetchByAssoc($record_discovery)) {
	// 			$record["Module"] = "Discovery";
	// 			$array_discovery[] = $record;
	// 		}
	// 	} else {
	// 		echo ('error');
	// 		die();
	// 	}
	// 	echo json_encode($array_discovery);
	// 	die();
	// }
	// public function action_show_memo_box_for_qc2()
	// {
	// 	global $db;
	// 	$document_id = $_POST['document_id'];

	// 	$disc_sql = "SELECT id,document_name,created_by FROM disc_discovery WHERE id='{$document_id}'  ";
	// 	$record_discovery = $db->query($disc_sql);

	// 	if ($record_discovery->num_rows > 0) {
	// 		while ($record = $GLOBALS["db"]->fetchByAssoc($record_discovery)) {
	// 			$record["Module"] = "Discovery";
	// 			$array_discovery[] = $record;
	// 		}
	// 	} else {
	// 		echo ('error');
	// 		die();
	// 	}
	// 	echo json_encode($array_discovery);
	// 	die();
	// }
	function action_removeAttachment() {
		global $db;
		$note_id = $_REQUEST['note_id'];
		// echo $note_id;die();
		if(isset($note_id)){
				$sql = "UPDATE notes
						SET deleted=1, date_modified = NOW()
						WHERE notes.id='{$note_id}'";
				$db->query($sql, true);
				
			}

	}
	//    === Get Cases which are linked with documents ===
    public function action_getCases()
    {
        global $db;
        $sql = "SELECT cases.id AS cases_id,cases.name AS cases_name FROM disc_discovery LEFT JOIN disc_discovery_cases_c ON
                disc_discovery.id = disc_discovery_cases_c.disc_discovery_casesdisc_discovery_idb LEFT JOIN cases ON
                disc_discovery_cases_c.disc_discovery_casescases_ida = cases.id WHERE cases.deleted = 0 order by cases.name asc";
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
        $sql2 = "SELECT users.id,users.first_name,users.last_name FROM users WHERE users.deleted = 0 order by users.first_name asc";
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
}
