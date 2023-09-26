<?php
class SavedBy{
    public function saved_by($bean, $event, $arguments){
        global $current_user;
        $bean->saved_by_name=$current_user->full_name;
        $bean->saved_by=$current_user->id;
    }
}

?>
