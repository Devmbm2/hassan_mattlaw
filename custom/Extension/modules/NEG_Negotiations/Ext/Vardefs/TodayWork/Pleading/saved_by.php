<?php
class SavedBy{
    public function saved_by($bean, $event, $arguments){
        global $current_user;
        // pre($current_user);
        // pre($bean);
        $bean->saved_by_name=$current_user->full_name;
        // // pre($bean);
    }
}

?>
