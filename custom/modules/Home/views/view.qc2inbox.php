<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class HomeViewqc2inbox extends SugarView
{
    public function display()
    {
  
    echo "<script src='cache/include/javascript/sugar_grp_yui_widgets.js'></script>";
      global $db; 
  
     $smarty = new Sugar_Smarty();
     $module    = $_REQUEST['filter_module'];
     if ($module == "neg_negotiations") {
        $sql = "select * from quality_control_remarks where status='qc1_passed' And deleted=0 And module_name='Negotiations'  ";
    } else if ($module == "plea_pleadings") {
        $sql = "select * from quality_control_remarks where status='qc1_passed' And deleted=0 And module_name='Pleadings'  ";
    } else if ($module == "disc_discovery") {
        $sql = "select * from quality_control_remarks where status='qc1_passed' And deleted=0 And module_name='Discovery'  ";
    }
     $result=$db->query($sql);
     while($row = $db->fetchByAssoc($result)){
        $user_bean = BeanFactory::getBean('Users',$row['users_id']);
        $row["Created_By"] = $user_bean->user_name; 
         $data[] = $row;
     }	
     $smarty->assign('results', $data);   

        $qc2inbox = $smarty->fetch('custom/modules/Home/tpls/qc2inbox.tpl');
        echo $qc2inbox;
		// echo "casetypeview";
		// die();
    }
}