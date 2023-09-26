<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

class DisplayUserNameLogicHook
{
    public function fetchUserName($bean, $event, $arguments)
    {
        // echo "Bean printing here";
        // print_r($bean->saved_by);
        // pre($event);
        // Check if the field 'saved_by' is set and not empty
        // if (!empty($bean->saved_by)) {
            // $user = BeanFactory::getBean('Users', $bean->saved_by);
                // Fetch the user's name and populate the field
                // echo "Hello World";
                // pre();
                $bean->date_entered = "Hello World";//$user->full_name;
                // $bean->processed_dates_times['saved_by'] = "Hello World";//$user->full_name;
                // pre('j');
                //
                // $bean->save();
        // }
    }
}
?>
