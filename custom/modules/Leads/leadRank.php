<?php
class leadRank
{
    function leadRankNotify($bean, $event, $arguments)
    {
        if ($bean->status == "Intake_Scheduled") {
            $alert_bean = BeanFactory::newBean('Alerts');
            $alert_bean->name = "Lead Rank";
            $alert_bean->description = "New Intake Lead is saved with name " .$bean->salutation." ". $bean->first_name. " ". $bean->last_name. " Please give it Rank." ;
            $alert_bean->target_module = 'Lead';
            $alert_bean->type = 'info';
            $alert_bean->url_redirect = 'index.php?module=Leads&action=DetailView&record='.$bean->id;
            $alert_bean->assigned_user_id = $bean->assigned_user_name;
            $alert_bean->is_read = "0";
            $alert_bean->save();
        }
    }
}
