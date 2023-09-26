<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class HomeViewqc1inbox extends SugarView
{

    public function display()
    {
        global $db;
        $smarty = new Sugar_Smarty();


    $module    =$_REQUEST['filter_module'];
   $module_cstm = $module.'_cstm';
        // $sql = "SELECT $module.id,$module.document_name,$module.created_by  FROM $module WHERE NOT EXISTS (SELECT *  FROM quality_control_remarks WHERE quality_control_remarks.record_id = $module.id) AND $module.deleted = 0 ORDER BY $module.document_name DESC LIMIT 3000";
   $sql = "SELECT $module.id,$module.document_name,$module.created_by FROM $module INNER JOIN $module_cstm on $module.id = $module_cstm.id_c 
       WHERE $module.done = 0 
       AND $module_cstm.qc1_reviewed_c IS NULL 
       AND $module_cstm.assistant_reviewed_c IS NULL AND 
       $module.deleted = 0 
       ORDER BY $module.document_name DESC LIMIT 3000";
		

        $result_sql = $db->query($sql);
       
         if ($result_sql->num_rows > 0) {
        while ($record = $GLOBALS["db"]->fetchByAssoc($result_sql)) {
            $user_bean = BeanFactory::getBean('Users',$record['created_by']);
            // print_r($user_bean->user_name);
             if($module =="neg_negotiations")
            {
                $record["Module"] = "Negotiations"; 
                $record["Created_By"] = $user_bean->user_name; 
            }
            else if($module == "plea_pleadings")
            {
                $record["Module"] = "Pleadings"; 
                $record["Created_By"] = $user_bean->user_name; 

            }
           
           else if($module == "disc_discovery")
            {
                $record["Module"] = "Discovery"; 
                $record["Created_By"] = $user_bean->user_name; 

            }
            $record_array[] = $record;
        }
    }
    else
      {
          $record_array=[];
      }
           $smarty->assign('results', $record_array);

         $qc1inbox = $smarty->fetch('custom/modules/Home/tpls/qc1inbox.tpl');
        echo $qc1inbox;
        // echo "casetypeview";
        // die();
    }
}
