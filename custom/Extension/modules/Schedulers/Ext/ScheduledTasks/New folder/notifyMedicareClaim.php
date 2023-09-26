<?php
 $job_strings[] = 'notifyMedicareClaim';
 function notifyMedicareClaim(){
    $bean = BeanFactory::getBean('Contacts');
    $Result = $bean->get_full_list("");
        foreach($Result as $value){
        $dob=$value->birthdate;
        $dob_format=new DateTime($dob);
        $now=new DateTime();
        $difference=$now->diff($dob_format);
        $age=$difference;
        $age->format('%y');
            $age->format('%m');
                if($age->format('%y')==63 && $age->format('%m')==6){
                $bean1 = BeanFactory::newBean('Alerts');
                $bean1->description=$value->salutation." ". $value->first_name." ". $value->last_name. " contact has reached the age near 65 year. Please open medicare claim for him.";
                $bean1->name = 'Notify Medicare Claim';
                $bean1->target_module = 'Contact';
                $bean1->type = 'info';
                $bean1->assigned_user_id=$value->assigned_user_name;
                $bean1->is_read="0";
                $bean1->url_redirect = 'index.php?module=Contacts&action=DetailView&record='.$value->id;
                $bean1->save();
        }
    }

return true;
}
?>

