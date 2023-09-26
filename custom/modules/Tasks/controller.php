<?php
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/
require_once('custom/include/slack/slackHelper.php');
class TasksController extends SugarController{
	function __construct(){
		parent::__construct();
	}

    /**
     * @deprecated deprecated since version 7.6, PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code, use __construct instead
     */
    function TasksController(){
        $deprecatedMessage = 'PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code';
        if(isset($GLOBALS['log'])) {
            $GLOBALS['log']->deprecated($deprecatedMessage);
        }
        else {
            trigger_error($deprecatedMessage, E_USER_DEPRECATED);
        }
        self::__construct();
    }


	protected function action_getsmshtml(){
		$this->view = 'message';
	}
	protected function action_setsmshtml(){
		if(!empty($_REQUEST['user_id'])&& !empty($_REQUEST['record_id'])){
			global $sugar_config,$current_user;
			//$Slack = new Slack('xoxp-173581060022-304504807861-311991756548-466c3d9d1066bef127cbb29c1b8fb283');
			$Slack = new Slack($current_user->slack_token);
			$message .= $_REQUEST['sms_text'];
			$message .= PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL ;
		    $message .= $sugar_config['site_url'].'/index.php?module=Tasks&action=DetailView&record='.$_REQUEST['record_id'];
			
			if($_REQUEST['user_channel']=='user'){
				$Slack->call('chat.postMessage', array(
				   'channel' => $_REQUEST['user_id'],
				    'text'=> $message,
					'as_user' => 'true',
				 ));
			}
			if($_REQUEST['user_channel']=='channel'){
				$Slack->call('chat.postMessage', array(
				   'channel' => $_REQUEST['user_id'],
				    'text'=> $message,
					'as_user' => 'true',
				 ));
			}
		}
	}
    // ===============Live Search Request for List View===============
    public function action_liveSearch()
    {
        global $db,$app_list_strings;
        $fetched_record0=array();
        $searchText = $_REQUEST['searcheditem'];
        $appListLabel = $app_list_strings['case_status_dom'];
        $sql0 = "SELECT tasks.id AS task_id,tasks.date_due AS task_dueDate,tasks.name AS task_name,
                 tasks.description AS task_description,tasks.status AS task_status,
                 tasks.parent_type AS task_parent_type,tasks.priority AS task_priority,tasks.no_of_days AS task_noOfDays,
                 cases.id AS case_id,cases.name AS case_name,cases.status AS case_status 
                 FROM tasks LEFT JOIN cases ON tasks.parent_id = cases.id WHERE (tasks.name LIKE '%$searchText%'
                 OR tasks.status LIKE '%$searchText%') AND tasks.deleted = 0 order by tasks.name asc LIMIT 200";
        $result0 = $db->query($sql0);
        while ($record0 = $GLOBALS["db"]->fetchByAssoc($result0)) {
            $date_due = $record0['task_dueDate'];
            $date = strtotime($date_due);
            $new_date_due = date('m/d/Y', $date);
//          =====Get Team Assigned=====
            $task_id = $record0['task_id'];
            $sql1 = "SELECT tasks_cstm.securitygroup_id_c FROM tasks_cstm WHERE id_c = '$task_id'";
            $result1 = $db->query($sql1);
            $row1 = $db->fetchByAssoc($result1);
            $security_group_id = $row1['securitygroup_id_c'];
            $sql2 = "SELECT securitygroups.id,securitygroups.name FROM securitygroups WHERE id = '$security_group_id'";
            $result2 = $db->query($sql2);
            $row2 = $db->fetchByAssoc($result2);
            $team_assigned_id = $row2['id'];
            $team_assigned_name = $row2['name'];
            $new_case_status = '';
            if(!empty($record0['case_status'])){
                foreach ($appListLabel as $key => $value){
                    if($key == $record0['case_status']){
                        $new_case_status = $value;
                    }
                }
            }
                $fetched_record0[] = ["id" =>$task_id,"name"=>$record0['task_name'],"description" => $record0['task_description'],
                "status" => $record0['task_status'],"parent_type"=> $record0['task_parent_type'],
                "parent_id"=> $record0['parent_id'], "contact_id"=> $record0['contact_id'],
                "priority"=> $record0['task_priority'], "no_of_days"=> $record0['task_noOfDays'],
                "date_due"=> $new_date_due,"case_id"=>$record0['case_id'],"case_name"=>$record0['case_name'],
                "case_status" => $new_case_status,"assistant"=>'',"team_id" => $team_assigned_id,
                "team_name" => $team_assigned_name];
            }

            echo json_encode($fetched_record0);
            die();
    }

    // ===============Live Search Request for List View Case Status===============
    public function action_caseStatusSearch()
    {
        global $db, $app_list_strings;
        $fetched_record = array();
        $searchText = $_REQUEST['search_data'];
        $appListLabel = $app_list_strings['case_status_dom'];
        if(!empty($searchText)){
                $sql = "SELECT tasks.id AS task_id,tasks.date_due AS task_dueDate,tasks.name AS task_name,
                        tasks.description AS task_description,tasks.status AS task_status,
                        tasks.parent_type AS task_parent_type,tasks.priority AS task_priority,tasks.no_of_days AS task_noOfDays,
                        cases.id AS case_id,cases.name AS case_name,cases.status AS case_status 
                        FROM tasks JOIN cases ON tasks.parent_id = cases.id WHERE ( cases.status LIKE '%$searchText%' )
                        AND tasks.deleted = 0 order by tasks.name asc LIMIT 200";
                $result = $db->query($sql);
                while ($record0 = $GLOBALS["db"]->fetchByAssoc($result)) {
                    $date_due = $record0['task_dueDate'];
                    $date = strtotime($date_due);
                    $new_date_due = date('m/d/Y', $date);
                    //          =====Get Team Assigned=====
                    $task_id = $record0['task_id'];
                    $sql1 = "SELECT tasks_cstm.securitygroup_id_c FROM tasks_cstm WHERE id_c = '$task_id'";
                    $result1 = $db->query($sql1);
                    $row1 = $db->fetchByAssoc($result1);
                    $security_group_id = $row1['securitygroup_id_c'];
                    $sql2 = "SELECT securitygroups.id,securitygroups.name FROM securitygroups WHERE id = '$security_group_id'";
                    $result2 = $db->query($sql2);
                    $row2 = $db->fetchByAssoc($result2);
                    $team_assigned_id = $row2['id'];
                    $team_assigned_name = $row2['name'];
                    $new_case_status = '';
                    if(!empty($record0['case_status'])){
                        foreach ($appListLabel as $key => $value){
                            if($key == $record0['case_status']){
                                $new_case_status = $value;
                            }
                        }
                    }
                    $fetched_record[] = ["id" =>$task_id,"name"=>$record0['task_name'],"description" => $record0['task_description'],
                        "status" => $record0['task_status'],"parent_type"=> $record0['task_parent_type'],
                        "parent_id"=> $record0['parent_id'], "contact_id"=> $record0['contact_id'],
                        "priority"=> $record0['task_priority'], "no_of_days"=> $record0['task_noOfDays'],
                        "date_due"=> $new_date_due,"case_id"=>$record0['case_id'],"case_name"=>$record0['case_name'],
                        "case_status" => $new_case_status,"assistant"=>'',"team_id" => $team_assigned_id,
                        "team_name" => $team_assigned_name];
                }
                            echo json_encode($fetched_record);
                            die();
        }
    }
    // ======Live Search Request for List View Case Other=======
    // public function action_caseOtherSearch()
    // {
    //     global $db, $app_list_strings;
    //     $fetched_record = array();
    //     $searchText = $_REQUEST['search_data'];
    //     $appListLabel = $app_list_strings['case_status_dom'];
    //     if(!empty($searchText)){
    //         $sql = "SELECT tasks.id AS task_id,tasks.date_due AS task_dueDate,tasks.name AS task_name,
    //                     tasks.description AS task_description,tasks.status AS task_status,
    //                     tasks.parent_type AS task_parent_type,tasks.priority AS task_priority,tasks.no_of_days AS task_noOfDays,
    //                     cases.id AS case_id,cases.name AS case_name,cases.status AS case_status 
    //                     FROM tasks JOIN cases ON tasks.parent_id = cases.id WHERE ( cases.name LIKE '%$searchText%' )
    //                     AND tasks.deleted = 0 order by tasks.name asc LIMIT 200";
    //         $result = $db->query($sql);
    //         while ($record0 = $GLOBALS["db"]->fetchByAssoc($result)) {
    //             $date_due = $record0['task_dueDate'];
    //             $date = strtotime($date_due);
    //             $new_date_due = date('m/d/Y', $date);
    //             //          =====Get Team Assigned=====
    //             $task_id = $record0['task_id'];
    //             $sql1 = "SELECT tasks_cstm.securitygroup_id_c FROM tasks_cstm WHERE id_c = '$task_id'";
    //             $result1 = $db->query($sql1);
    //             $row1 = $db->fetchByAssoc($result1);
    //             $security_group_id = $row1['securitygroup_id_c'];
    //             $sql2 = "SELECT securitygroups.id,securitygroups.name FROM securitygroups WHERE id = '$security_group_id'";
    //             $result2 = $db->query($sql2);
    //             $row2 = $db->fetchByAssoc($result2);
    //             $team_assigned_id = $row2['id'];
    //             $team_assigned_name = $row2['name'];
    //             $new_case_status = '';
    //             if(!empty($record0['case_status'])){
    //                 foreach ($appListLabel as $key => $value){
    //                     if($key == $record0['case_status']){
    //                         $new_case_status = $value;
    //                     }
    //                 }
    //             }
    //             $fetched_record[] = ["id" =>$task_id,"name"=>$record0['task_name'],"description" => $record0['task_description'],
    //                 "status" => $record0['task_status'],"parent_type"=> $record0['task_parent_type'],
    //                 "parent_id"=> $record0['parent_id'], "contact_id"=> $record0['contact_id'],
    //                 "priority"=> $record0['task_priority'], "no_of_days"=> $record0['task_noOfDays'],
    //                 "date_due"=> $new_date_due,"case_id"=>$record0['case_id'],"case_name"=>$record0['case_name'],
    //                 "case_status" => $new_case_status,"assistant"=>'',"team_id" => $team_assigned_id,
    //                 "team_name" => $team_assigned_name];
    //         }
    //         echo json_encode($fetched_record);
    //         die();
    //     }
    // }
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
       $query = "value = '$type_name' ";
       $conditions_workflows = $bean->get_full_list('',$query);
       $workflows="";
       if (!empty($conditions_workflows))
       {
       $workflows .='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <div class="container-fluid" style="padding-top:30px;">
       <table class="table table-striped" style="width:700px;"  >
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
          if (!empty($row->aow_workflow_id)) 
   {    
      $get_id=$row->aow_workflow_id;
   $workflow_related = BeanFactory::getBean('AOW_WorkFlow', $get_id);
   $workflow_related->status='Inactive';
   $workflow_related->save();
   $action_bean = BeanFactory::getBean('AOW_Actions');
   $query = "aow_actions.aow_workflow_id='$workflow_related->id'";
   $all_actions_related_to_workflow = $action_bean->get_full_list('',$query);
   foreach($all_actions_related_to_workflow as $action){   
            $workflows.='
            <tr>
         <td>
         <input type="checkbox" id="workflow_related" name="workflow_related" value="'.$workflow_related->id.'" style="padding-bottom:22px;">
             <label for="workflow_related" style="font-size:14px; padding-left:5px; " title = '.$workflow_related->description.'> '.$workflow_related->name.'</label>
         </td>
         <td>'.$action->action.'</td>
         <td><a href="#" style="color:#edd03d;" onclick="ShowDescription(\''.$workflow_related->description.'\')"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
         <td>
             
             <a href="index.php?module=AOW_WorkFlow&action=DetailView&record='.$workflow_related->id.'" target="_blank"><i  class="fa fa-eye" style="font-size:14px;color:#edd03d;" ></i></a>
                            &nbsp; | &nbsp;
             <a href="index.php?module=AOW_WorkFlow&action=EditView&record='.$workflow_related->id.'" target="_blank"><i  class="fa fa-edit" style="font-size:14px;color:#edd03d;" ></i></a>
            </td>
            </tr>';
        }
    }
        
    }
    $workflows .='</tbody></table><input title="Activate" accesskey="a" class="button primary" onclick="CheckedAllWorkflows();" type="button" name="button" value="Activate" id="SAVE" style="float:right; border-radius:20px; "></div>';
   
}
    echo $workflows;
        die(); 
}
	
}
?>