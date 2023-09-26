<?php
require_once "modules/FP_events/controller.php";
class CustomFP_eventsController extends FP_eventsController
{
	public function action_zoom_config()
    {
		$this->view = 'zoom_config';
		$GLOBALS['view'] = 'zoom_config'; 
	}
	public function action_user_managment()
    {
		$this->view = 'user_managment';
		$GLOBALS['view'] = 'user_managment'; 
	}
	public function action_saveconfig(){
		  ob_clean();
		  require_once('include/utils.php');
		  global $app_strings, $current_user, $moduleList, $sugar_config;
		  
		  $this->view = '';
		  $GLOBALS['view'] = '';      

		  if (!is_admin($current_user)) 
			 sugar_die($app_strings['ERR_NOT_ADMIN']);

		  require_once('modules/Configurator/Configurator.php');
		  $configurator = new Configurator();
		  $configurator->loadConfig();  // no es necesario

		  $configurator->config['zoom']['application_key'] = $_REQUEST['application_key'];
		  $configurator->config['zoom']['application_secret'] = $_REQUEST['application_secret'];
		  
		  $configurator->saveConfig();
		  SugarApplication::appendErrorMessage("Your New Zoom Credentials are Saved...");
		  SugarApplication::redirect("index.php?module=Administration&action=index");		
	} 
	public function action_saveUser(){
		  ob_clean();
		  global $app_strings, $current_user, $moduleList, $sugar_config;
		  
		  $this->view = '';
		  $GLOBALS['view'] = '';      

		  if (!is_admin($current_user)) 
			 sugar_die($app_strings['ERR_NOT_ADMIN']);
			 
		  include_once 'custom/include/zoom/Zoom_Api.php';
		  if(!empty($_REQUEST['user_email'])){
			$user_email = $_REQUEST['user_email'];	
			$createUserArray['action']      = 'create';
			$createUserArray['user_info']   = array(
				'email'  => $user_email,
				'type'   => '1',
			);
			$zoom_meeting = new Zoom_Api($GLOBALS['sugar_config']['zoom']);
			$response = $zoom_meeting->createUser($createUserArray);
			if($response->id){
				SugarApplication::appendErrorMessage("Email has been sent to this Email Address For Approval to be added in the Mattlaw Zoom Account.");
				SugarApplication::redirect("index.php?module=FP_events&action=user_managment");
				
			}else{
				SugarApplication::appendErrorMessage("This Email Address has not been added due to this error: ".$response->message);
				SugarApplication::redirect("index.php?module=FP_events&action=user_managment");
			}
			  
		  }
		
		  		
	} 
    public function action_getSelectedDates()
    {
		ob_clean();
		$start_date = $_REQUEST['start_date'];
		$end_date = $_REQUEST['end_date'];
		$data = array();
		foreach($start_date as $no => $date){
			$start_d = $date[0].' '.$date[1].':'.$date[2];
			$end_d = $end_date[$no][0].' '.$end_date[$no][1].':'.$end_date[$no][2];
			$duration_hours = $this->getSelectedDatesHoursMinutes($start_d, $end_d, 'h');
			$duration_minutes = $this->getSelectedDatesHoursMinutes($start_d, $end_d, 'm');
			$data[] = array('date_start' => $date[0].' '.$date[1].':'.$date[2], 'date_end' => $end_date[$no][0].' '.$end_date[$no][1].':'.$end_date[$no][2], 'duration_hours' => $duration_hours, 'duration_minutes' => $duration_minutes);
		}
		echo json_encode($data);die;
		/* echo json_encode($data);die; */
	}
	
	public function getSelectedDatesHoursMinutes($start_date, $end_date, $select)
    {
		$date1 = strtotime($start_date);  
		$date2 = strtotime($end_date);
		
		$diff = abs($date2 - $date1); 
		$years = floor($diff / (365*60*60*24));  

	    $months = floor(($diff - $years * 365*60*60*24) 
								   / (30*60*60*24));  
		$days = floor(($diff - $years * 365*60*60*24 -  
					 $months*30*60*60*24)/ (60*60*24)); 

		$hours = floor(($diff - $years * 365*60*60*24  
			   - $months*30*60*60*24 - $days*60*60*24) 
										   / (60*60)); 
		$minutes = floor(($diff - $years * 365*60*60*24  
         - $months*30*60*60*24 - $days*60*60*24  
                          - $hours*60*60)/ 60);  
		if($select == 'h'){
			return $hours;
		}else if($select == 'm'){
			return $minutes;
		}
		/* echo json_encode($data);die; */
	}
	public function action_Googlepreview()
    {
		$this->view = 'google_preview';
		//$GLOBALS['view'] = 'zoom_config'; 
		// echo "test";
		// die();
	}
	//==============Searching in List View of Events Module==============
    public function action_liveSearch()
    {
        global $db,$app_list_strings;
        $fetched_record=array();
        $searchText = $_REQUEST['searcheditem'];
        $appListLabel = $app_list_strings['event_type_list'];
        $sql0 = "SELECT fp_events.id AS fp_events_id,fp_events.name AS fp_events_name,fp_events.date_start AS fp_events_date_start,
                 fp_events.type_c AS fp_events_purpose,fp_events.multiple_assigned_users AS fp_events_assigned_user_id,
                 fp_events_cstm.location_address_city_c AS location_address_city, cases.name AS
                 cases_name,cases.id AS cases_id FROM fp_events LEFT JOIN fp_events_cstm ON fp_events.id = fp_events_cstm.id_c
                 LEFT JOIN cases_fp_events_1_c ON fp_events_cstm.id_c = cases_fp_events_1_c.cases_fp_events_1fp_events_idb
                 LEFT JOIN cases ON cases_fp_events_1_c.cases_fp_events_1cases_ida = cases.id WHERE (fp_events.name LIKE '%$searchText%')
                 AND fp_events.deleted = 0 order by fp_events.date_start desc LIMIT 200";
        $result0 = $db->query($sql0);
        while ($record0 = $GLOBALS["db"]->fetchByAssoc($result0)) {
            $assigned_user_id = $record0['fp_events_assigned_user_id'];
            if(!empty($assigned_user_id)){
                $assigned_user_id1 = str_replace("^","",$assigned_user_id);
                $assigned_user_id2 = explode(",",$assigned_user_id1);
                $fetched_users = array();
                foreach ($assigned_user_id2 as $key => $value){
                    $sql2 = "SELECT users.first_name,users.last_name,users.user_name FROM users WHERE users.id = '$value'";
                    $result2 = $db->query($sql2);
                    $record2 = $GLOBALS["db"]->fetchByAssoc($result2);
                    $first_name = $record2['first_name'];
                    $last_name = $record2['last_name'];
                    $user_name = $record2['user_name'];
                    // $user_name2 = $first_name.' '.$last_name;
                    $user_name2 = $user_name;
                    $fetched_users[] = $user_name2;
                }
                $fetched_users_string = implode(",",$fetched_users);
            }
            $date_start = $record0['fp_events_date_start'];
            $date = strtotime($date_start);
            $new_date_start = date('m/d/Y', $date);
            $purpose_meeting = '';
            if (!empty($record0['fp_events_purpose'])) {
                foreach ($appListLabel as $key => $value) {
                    if ($key == $record0['fp_events_purpose']) {
                        $purpose_meeting = $value;
                    }
                }
            }
            if(empty($record0['cases_name'])){
                $record0['cases_name'] = '';
            }
            $fetched_record[] = ["id" =>$record0['fp_events_id'],"date_entered" =>$new_date_start,"case_id" =>$record0['cases_id'],
                "case_name" =>$record0['cases_name'],"name"=>$record0['fp_events_name'],"meeting" => $purpose_meeting,
                "primary_address_city"=> $record0['location_address_city'],"assigned_to"=> $fetched_users_string,"open_calender"=> '',
                "start_travel"=> ''];
        }
            $output = array(
            "data"       =>  $fetched_record
            );
            echo json_encode($output);
            die();
    }
// ==============Events Purpose Live Search==============
    public function action_eventsPurposeSearch()
    {
        global $db,$app_list_strings;
        $fetched_record=array();
        $searchText = $_REQUEST['search_data'];
        $appListLabel = $app_list_strings['event_type_list'];
        if(!empty($searchText)){
            $sql0 = "SELECT fp_events.id AS fp_events_id,fp_events.name AS fp_events_name,fp_events.date_start AS fp_events_date_start,
                 fp_events.type_c AS fp_events_purpose,fp_events.multiple_assigned_users AS fp_events_assigned_user_id,
                 fp_events_cstm.location_address_city_c AS location_address_city, cases.name AS
                 cases_name,cases.id AS cases_id FROM fp_events LEFT JOIN fp_events_cstm ON fp_events.id = fp_events_cstm.id_c
                 LEFT JOIN cases_fp_events_1_c ON fp_events_cstm.id_c = cases_fp_events_1_c.cases_fp_events_1fp_events_idb
                 LEFT JOIN cases ON cases_fp_events_1_c.cases_fp_events_1cases_ida = cases.id WHERE ( fp_events.type_c = '$searchText' )
                 AND fp_events.deleted = 0 order by fp_events.date_start asc LIMIT 200";
        }else{
            $sql0 = "SELECT fp_events.id AS fp_events_id,fp_events.name AS fp_events_name,fp_events.date_start AS fp_events_date_start,
                 fp_events.type_c AS fp_events_purpose,fp_events.multiple_assigned_users AS fp_events_assigned_user_id,
                 fp_events_cstm.location_address_city_c AS location_address_city, cases.name AS
                 cases_name,cases.id AS cases_id FROM fp_events LEFT JOIN fp_events_cstm ON fp_events.id = fp_events_cstm.id_c
                 LEFT JOIN cases_fp_events_1_c ON fp_events_cstm.id_c = cases_fp_events_1_c.cases_fp_events_1fp_events_idb
                 LEFT JOIN cases ON cases_fp_events_1_c.cases_fp_events_1cases_ida = cases.id WHERE ( fp_events.type_c IS NULL
                 OR fp_events.type_c = '' ) AND fp_events.deleted = 0 order by fp_events.name desc LIMIT 200";
        }
            $result0 = $db->query($sql0);
            while ($record0 = $GLOBALS["db"]->fetchByAssoc($result0)) {
                $assigned_user_id = $record0['fp_events_assigned_user_id'];
                if(!empty($assigned_user_id)){
                    $assigned_user_id1 = str_replace("^","",$assigned_user_id);
                    $assigned_user_id2 = explode(",",$assigned_user_id1);
                    $fetched_users = array();
                    foreach ($assigned_user_id2 as $key => $value){
                        $sql2 = "SELECT users.first_name,users.last_name,users.user_name FROM users WHERE users.id = '$value'";
                        $result2 = $db->query($sql2);
                        $record2 = $GLOBALS["db"]->fetchByAssoc($result2);
                        $first_name = $record2['first_name'];
                        $last_name = $record2['last_name'];
                        $user_name = $record2['user_name'];
                        // $user_name2 = $first_name.' '.$last_name;
                        $user_name2 = $user_name;
                        $fetched_users[] = $user_name2;
                    }
                    $fetched_users_string = implode(",",$fetched_users);
                }
                $date_start = $record0['fp_events_date_start'];
                $date = strtotime($date_start);
                $new_date_start = date('m/d/Y', $date);
                $purpose_meeting = '';
                if (!empty($record0['fp_events_purpose'])) {
                    foreach ($appListLabel as $key => $value) {
                        if ($key == $record0['fp_events_purpose']) {
                            $purpose_meeting = $value;
                        }
                    }
                }
                if(empty($record0['cases_name'])){
                    $record0['cases_name'] = '';
                }
                $fetched_record[] = ["id" =>$record0['fp_events_id'],"date_entered" =>$new_date_start,"case_id" =>$record0['cases_id'],
                    "case_name" =>$record0['cases_name'],"name"=>$record0['fp_events_name'],"meeting" => $purpose_meeting,
                    "primary_address_city"=> $record0['location_address_city'],"assigned_to"=> $fetched_users_string,
                    "open_calender"=> '',"start_travel"=> ''];
            }
            $output = array(
                "data"       =>  $fetched_record
            );
            echo json_encode($output);
            die();
    }
// ==============Events Cases Live Search==============
    public function action_eventsLinkedCasesSearch()
    {
        global $db,$app_list_strings;
        $fetched_record=array();
        $searchText = $_REQUEST['search_data'];
        $appListLabel = $app_list_strings['event_type_list'];
        if(!empty($searchText)){
            $sql0 = "SELECT fp_events.id AS fp_events_id,fp_events.name AS fp_events_name,fp_events.date_start AS fp_events_date_start,
                     fp_events.type_c AS fp_events_purpose,fp_events.multiple_assigned_users AS fp_events_assigned_user_id,
                     fp_events_cstm.location_address_city_c AS location_address_city, cases.name AS cases_name,cases.id AS cases_id
                     FROM fp_events LEFT JOIN fp_events_cstm ON fp_events.id = fp_events_cstm.id_c LEFT JOIN cases_fp_events_1_c ON
                     fp_events_cstm.id_c = cases_fp_events_1_c.cases_fp_events_1fp_events_idb LEFT JOIN cases ON 
                     cases_fp_events_1_c.cases_fp_events_1cases_ida = cases.id WHERE (cases.name LIKE '%$searchText%')
                     AND fp_events.deleted = 0 order by fp_events.date_start desc LIMIT 200";
            $result0 = $db->query($sql0);
            while ($record0 = $GLOBALS["db"]->fetchByAssoc($result0)) {
                $assigned_user_id = $record0['fp_events_assigned_user_id'];
                if(!empty($assigned_user_id)){
                    $assigned_user_id1 = str_replace("^","",$assigned_user_id);
                    $assigned_user_id2 = explode(",",$assigned_user_id1);
                    $fetched_users = array();
                    foreach ($assigned_user_id2 as $key => $value){
                        $sql2 = "SELECT users.first_name,users.last_name,users.user_name FROM users WHERE users.id = '$value'";
                        $result2 = $db->query($sql2);
                        $record2 = $GLOBALS["db"]->fetchByAssoc($result2);
                        $first_name = $record2['first_name'];
                        $last_name = $record2['last_name'];
                        $user_name = $record2['user_name'];
                        // $user_name2 = $first_name.' '.$last_name;
                        $user_name2 = $user_name;
                        $fetched_users[] = $user_name2;
                    }
                    $fetched_users_string = implode(",",$fetched_users);
                }
                $date_start = $record0['fp_events_date_start'];
                $date = strtotime($date_start);
                $new_date_start = date('m/d/Y', $date);
                $purpose_meeting = '';
                if (!empty($record0['fp_events_purpose'])) {
                    foreach ($appListLabel as $key => $value) {
                        if ($key == $record0['fp_events_purpose']) {
                            $purpose_meeting = $value;
                        }
                    }
                }
                if(empty($record0['cases_name'])){
                    $record0['cases_name'] = '';
                }
                $fetched_record[] = ["id" =>$record0['fp_events_id'],"date_entered" =>$new_date_start,"case_id" =>$record0['cases_id'],
                    "case_name" =>$record0['cases_name'],"name"=>$record0['fp_events_name'],"meeting" => $purpose_meeting,
                    "primary_address_city"=> $record0['location_address_city'],"assigned_to"=> $fetched_users_string,
                    "open_calender"=> '',"start_travel"=> ''];
            }

            echo json_encode($fetched_record);
            die();
        }
    }

    // ==============Events Assigned Users Live Search==============
    public function action_eventsLinkedUsersSearch()
    {
        global $db,$app_list_strings;
        $fetched_record=array();
        $searchText = $_REQUEST['search_data'];
        $appListLabel = $app_list_strings['event_type_list'];
        if(!empty($searchText)){
            $sql = "SELECT users.id,users.user_name FROM users WHERE users.id = '$searchText'";
            $result = $db->query($sql);
            $record = $GLOBALS["db"]->fetchByAssoc($result);
            $user_id = $record['id'];

            $sql0 = "SELECT fp_events.id AS fp_events_id,fp_events.name AS fp_events_name,fp_events.date_start AS fp_events_date_start,
                     fp_events.type_c AS fp_events_purpose,fp_events.multiple_assigned_users AS fp_events_assigned_user_id,
                     fp_events_cstm.location_address_city_c AS location_address_city, cases.name AS cases_name,cases.id AS cases_id
                     FROM fp_events LEFT JOIN fp_events_cstm ON fp_events.id = fp_events_cstm.id_c LEFT JOIN cases_fp_events_1_c ON
                     fp_events_cstm.id_c = cases_fp_events_1_c.cases_fp_events_1fp_events_idb LEFT JOIN cases ON
                     cases_fp_events_1_c.cases_fp_events_1cases_ida = cases.id WHERE fp_events.deleted = 0 order by fp_events.date_start desc LIMIT 200";
            $result0 = $db->query($sql0);
            while ($record0 = $GLOBALS["db"]->fetchByAssoc($result0)) {
                $assigned_user_id = $record0['fp_events_assigned_user_id'];
                $assigned_user_id1 = str_replace("^","",$assigned_user_id);
                $assigned_user_id2 = explode(",",$assigned_user_id1);
                foreach ($assigned_user_id2 as $key => $value){
                    if($user_id == $value){
                        $fetched_users = array();
                        foreach ($assigned_user_id2 as $key => $value){
                            $sql2 = "SELECT users.first_name,users.last_name,users.user_name FROM users WHERE users.id = '$value'";
                            $result2 = $db->query($sql2);
                            $record2 = $GLOBALS["db"]->fetchByAssoc($result2);
                            $first_name = $record2['first_name'];
                            $last_name = $record2['last_name'];
                            $user_name = $record2['user_name'];
                            // $user_name2 = $first_name.' '.$last_name;
                            $user_name2 = $user_name;
                            $fetched_users[] = $user_name2;
                        }
                        $fetched_users_string = implode(",",$fetched_users);
                        $date_start = $record0['fp_events_date_start'];
                        $date = strtotime($date_start);
                        $new_date_start = date('m/d/Y', $date);
                        $purpose_meeting = '';
                        if (!empty($record0['fp_events_purpose'])) {
                            foreach ($appListLabel as $key => $value) {
                                if ($key == $record0['fp_events_purpose']) {
                                    $purpose_meeting = $value;
                                }
                            }
                        }
                        if(empty($record0['cases_name'])){
                            $record0['cases_name'] = '';
                        }

                        $fetched_record[] = ["id" =>$record0['fp_events_id'],"date_entered" =>$new_date_start,"case_id" =>$record0['cases_id'],
                            "case_name" =>$record0['cases_name'],"name"=>$record0['fp_events_name'],"meeting" => $purpose_meeting,
                            "primary_address_city"=> $record0['location_address_city'],"assigned_to"=> $fetched_users_string,
                            "open_calender"=> '',"start_travel"=> ''];
                    }
                }
            }
            echo json_encode($fetched_record);
            die();
        }
    }
    public function action_deleteattachment22()
        {
             $bean = BeanFactory::getBean('FP_events', $_POST['id']);
                $removeFile = "upload://{$bean->id}";
            if (file_exists($removeFile)) {
                    $bean->filename = '';
                    $bean->save();
            }
            echo 'true';
            die();
        }

        public function action_get_users(){
            global $db;
            $data = array();
            $sql = "select users.id,users.user_name from users where users.deleted=0 AND users.status='Active'";
            $result = $db->query($sql);
            while($row = $db->fetchByAssoc($result)){
                $data[$row['id']] = $row['user_name'];
            }
            echo json_encode($data);
            die();
        }
        public function action_getCases(){
            global $db;
            $sql1 = "SELECT cases.id AS cases_id,cases.name AS cases_name FROM fp_events LEFT JOIN cases_fp_events_1_c
                     ON fp_events.id = cases_fp_events_1_c.cases_fp_events_1fp_events_idb LEFT JOIN cases ON
                     cases_fp_events_1_c.cases_fp_events_1cases_ida = cases.id WHERE cases.deleted = 0
                     order by cases.name asc";
            $result1 = $db->query($sql1);
            $all_case_names = array();
            while ($record1 = $GLOBALS["db"]->fetchByAssoc($result1)) {
                $name = $record1['cases_name'];
                $id = $record1['cases_id'];
                $all_case_names[$id] = $name;
            }
            echo json_encode($all_case_names);
            die();
        }
        function action_removeAttachment() {
            global $db;
            $note_id = $_REQUEST['note_id'];
            if(isset($note_id)){
                        $sql = "UPDATE notes
                                SET deleted=1, date_modified = NOW()
                                WHERE notes.id='{$note_id}'";
                        $db->query($sql, true);
                }
            }
}
