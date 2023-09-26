<?php 
function getlistvalues(){
    static $listvalues = null;
    if(!$listvalues){
        global $db;
        $query = "SELECT id,name  FROM securitygroups order by name asc ";
        $result = $db->query($query, false);
        $listvalues = array();
        $listvalues[''] = '';
        while (($row = $db->fetchByAssoc($result)) != null) {
            $listvalues[$row['id']] = $row['name'];
        }
    }
    return $listvalues;
} 
?>