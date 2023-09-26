<?php

class concatination_class {
    function concatination_method($bean, $event, $arguments)
    {
        $insurance_type = $bean->insurance_type;
        $claim_number = $bean->claim_number;
        $adjuster = $bean->adjuster;
        $insurance_company_name = $bean->account_name;
        $concatenated = $insurance_type . " " . $claim_number . " " . $adjuster . " " . $insurance_company_name;
        $bean->name=str_replace("_"," ",$concatenated);
    }
}
