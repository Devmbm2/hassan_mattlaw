<?php
class SavedBy{
    public function saved_by($bean, $event, $arguments){
        global $current_user;
        // pre($current_user);
        $bean->saved_by=$current_user->full_name;
        // // pre($bean);
    }
}

?>
