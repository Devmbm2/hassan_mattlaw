<?php
require_once "modules/Notes/controller.php";
class CustomNotesController extends NotesController{
    function __construct(){
        parent::__construct();
    }
    //==============Searching in List View of Notes Module==============
    public function action_liveSearch()
    {
        global $db,$app_list_strings;
        $fetched_record=array();
        $searchText = $_REQUEST['search_value'];
        $appListLabel = $app_list_strings['note_type_c_list'];
        $sql0 = "SELECT n.id AS note_id,n.date_entered AS date_of_note,n.parent_type AS note_parent_type,n.parent_id AS note_parent_id,n.filename
                 AS note_filename,n.assigned_user_id AS user_id,n.name AS note_name,nc.note_type_c AS note_type FROM notes AS n LEFT JOIN notes_cstm
                 AS nc ON n.id = nc.id_c WHERE ( n.name LIKE '%$searchText%' ) AND n.deleted = 0 order by n.name asc LIMIT 200";
        $result0 = $db->query($sql0);
        while ($record0 = $GLOBALS["db"]->fetchByAssoc($result0)) {
            $filename = $record0['note_filename'];
            $date_start = $record0['date_of_note'];
            $date = strtotime($date_start);
            $new_date_start = date('m/d/Y H:i', $date);
            //            =====Get Note Type Field=====
            $note_type = '';
            if (!empty($record0['note_type'])) {
                foreach ($appListLabel as $key => $value) {
                    if ($key == $record0['note_type']) {
                        $note_type = $value;
                    }
                }
            }
            //            =====Get Assigned User Field=====
            $user_id = $record0['user_id'];
            $created_by = '';
            if (!empty($user_id)) {
                $sql = "SELECT users.user_name FROM users WHERE id = '$user_id' AND users.deleted = 0";
                $result = $db->query($sql);
                $record2 = $GLOBALS["db"]->fetchByAssoc($result);
                $created_by = $record2['user_name'];
            }
            //            =====Get Related To Field=====
            $note_parent_id = $record0['note_parent_id'];
            $related_to = '';$module = '';
            if(!empty($record0['note_parent_type']) && $record0['note_parent_type'] == 'Accounts'){
                $sql1 = "SELECT accounts.name FROM accounts WHERE id = '$note_parent_id' AND
                         accounts.deleted = 0";
                $result1 = $db->query($sql1);
                $record1 = $GLOBALS["db"]->fetchByAssoc($result1);
                $related_to = $record1['name'];
                $module = 'Accounts';
            }elseif(!empty($record0['note_parent_type']) && $record0['note_parent_type'] == 'Leads'){
                $sql2 = "SELECT leads.first_name FROM leads WHERE id = '$note_parent_id' AND
                         leads.deleted = 0";
                $result2 = $db->query($sql2);
                $record2 = $GLOBALS["db"]->fetchByAssoc($result2);
                $related_to = $record2['first_name'];
                $module = 'Leads';
            }elseif(!empty($record0['note_parent_type']) && $record0['note_parent_type'] == 'Cases'){
                $sql3 = "SELECT cases.name FROM cases WHERE id = '$note_parent_id' AND
                         cases.deleted = 0";
                $result3 = $db->query($sql3);
                $record3 = $GLOBALS["db"]->fetchByAssoc($result3);
                $related_to = $record3['name'];
                $module = 'Cases';
            }elseif(!empty($record0['note_parent_type']) && $record0['note_parent_type'] == 'Contacts'){
                $sql4 = "SELECT contacts.first_name FROM contacts WHERE id = '$note_parent_id' AND
                         contacts.deleted = 0";
                $result4 = $db->query($sql4);
                $record4 = $GLOBALS["db"]->fetchByAssoc($result4);
                $related_to = $record4['first_name'];
                $module = 'Contacts';
            }
            if($related_to == null){
                $related_to = '';
            }
            $fetched_record[] = ["id" =>$record0['note_id'],"date_entered" =>$new_date_start,"related_to" =>$related_to,
                "module" => $module,"subject"=>$record0['note_name'],"parent_id" => $note_parent_id,
                "note_type" => $note_type,"view_file" => $filename,"created_by" => $created_by,"user_id" => $user_id,"last_row" => ""];
        }
            $output = array(
                "data" => $fetched_record
            );
            echo json_encode($output);
            die();
    }

    //==============Searching for Note Type Dropdown Field in List View==============
    public function action_notesPurposeSearch(){
        global $db,$app_list_strings;
        $fetched_record=array();
        $searchText = $_REQUEST['search_data'];
        $appListLabel = $app_list_strings['note_type_c_list'];
        if(!empty($searchText)){
            $sql0 = "SELECT n.id AS note_id,n.date_entered AS date_of_note,n.parent_type AS note_parent_type,n.parent_id AS note_parent_id,n.filename
                     AS note_filename,n.assigned_user_id AS user_id, n.name AS note_name,nc.note_type_c AS note_type FROM notes AS n LEFT JOIN notes_cstm
                     AS nc ON n.id = nc.id_c WHERE ( nc.note_type_c LIKE '%$searchText%' ) AND n.deleted = 0 order by n.name asc LIMIT 200";
        }else{
            $sql0 = "SELECT n.id AS note_id,n.date_entered AS date_of_note,n.parent_type AS note_parent_type,n.parent_id AS note_parent_id,n.filename
                     AS note_filename,n.assigned_user_id AS user_id, n.name AS note_name,nc.note_type_c AS note_type FROM notes AS n LEFT JOIN notes_cstm
                     AS nc ON n.id = nc.id_c WHERE ( nc.note_type_c IS NULL OR nc.note_type_c = '' ) AND n.deleted = 0 order by n.name asc LIMIT 200";
        }
        $result0 = $db->query($sql0);
        while ($record0 = $GLOBALS["db"]->fetchByAssoc($result0)) {
            $filename = $record0['note_filename'];
            $date_start = $record0['date_of_note'];
            $date = strtotime($date_start);
            $new_date_start = date('m/d/Y H:i', $date);
            //            =====Get Note Type Field=====
            $note_type = '';
            if (!empty($record0['note_type'])) {
                foreach ($appListLabel as $key => $value) {
                    if ($key == $record0['note_type']) {
                        $note_type = $value;
                    }
                }
            }
            //            =====Get Assigned User Field=====
            $user_id = $record0['user_id'];
            $created_by = '';
            if (!empty($user_id)) {
                $sql = "SELECT users.user_name FROM users WHERE id = '$user_id' AND users.deleted = 0";
                $result = $db->query($sql);
                $record2 = $GLOBALS["db"]->fetchByAssoc($result);
                $created_by = $record2['user_name'];
            }
            //            =====Get Related To Field=====
            $note_parent_id = $record0['note_parent_id'];
            $related_to = '';$module = '';
            if(!empty($record0['note_parent_type']) && $record0['note_parent_type'] == 'Accounts'){
                $sql1 = "SELECT accounts.name FROM accounts WHERE id = '$note_parent_id' AND
                         accounts.deleted = 0";
                $result1 = $db->query($sql1);
                $record1 = $GLOBALS["db"]->fetchByAssoc($result1);
                $related_to = $record1['name'];
                $module = 'Accounts';
            }elseif(!empty($record0['note_parent_type']) && $record0['note_parent_type'] == 'Leads'){
                $sql2 = "SELECT leads.first_name FROM leads WHERE id = '$note_parent_id' AND
                         leads.deleted = 0";
                $result2 = $db->query($sql2);
                $record2 = $GLOBALS["db"]->fetchByAssoc($result2);
                $related_to = $record2['first_name'];
                $module = 'Leads';
            }elseif(!empty($record0['note_parent_type']) && $record0['note_parent_type'] == 'Cases'){
                $sql3 = "SELECT cases.name FROM cases WHERE id = '$note_parent_id' AND
                         cases.deleted = 0";
                $result3 = $db->query($sql3);
                $record3 = $GLOBALS["db"]->fetchByAssoc($result3);
                $related_to = $record3['name'];
                $module = 'Cases';
            }elseif(!empty($record0['note_parent_type']) && $record0['note_parent_type'] == 'Contacts'){
                $sql4 = "SELECT contacts.first_name FROM contacts WHERE id = '$note_parent_id' AND
                         contacts.deleted = 0";
                $result4 = $db->query($sql4);
                $record4 = $GLOBALS["db"]->fetchByAssoc($result4);
                $related_to = $record4['first_name'];
                $module = 'Contacts';
            }
            if($related_to == null){
                $related_to = '';
            }
            $fetched_record[] = ["id" =>$record0['note_id'],"date_entered" =>$new_date_start,"related_to" =>$related_to,
                "module" => $module,"subject"=>$record0['note_name'],"parent_id" => $note_parent_id,
                "note_type" => $note_type,"view_file" => $filename,"created_by" => $created_by,"user_id" => $user_id,"last_row" => ""];
        }
        $output = array(
            "data" => $fetched_record
        );
        echo json_encode($output);
        die();
    }
}