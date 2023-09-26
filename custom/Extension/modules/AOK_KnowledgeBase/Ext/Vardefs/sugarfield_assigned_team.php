<?php
global $current_user;
if(is_admin($current_user) || ACLAction::getUserAccessLevel($current_user->id,"SecurityGroups", 'access') == ACL_ALLOW_ENABLED) {
        $db = DBManagerFactory::getInstance();
        $query = "SELECT * FROM securitygroups where deleted = 0";
        $result = $db->query($query, true, "Error retrieving security groups");
        $security_groups = array();
        while($row = $db->fetchByAssoc($result)) {
            $security_groups[] = $row;
        }
        $options = array(""=>"Select Audience");
        foreach($security_groups as $group) {
          if($group['name'] == 'Admins' || $group['name'] == 'Managers' || $group['name'] == 'Lower Level Users'){
             $options[$group['id']] = $group['name'];
          }
         
        }
}
$dictionary['AOK_KnowledgeBase']['fields']['assigned_team'] =
          array(
                'name' => 'assigned_team',
                'vname' => 'LBL_ASSIGNED_TEAM',
                'type' => 'enum',
                'dbType' => 'varchar',
                'len' => '255',
                'options' => $options,
                'reportable'=>true,


         );
?>
