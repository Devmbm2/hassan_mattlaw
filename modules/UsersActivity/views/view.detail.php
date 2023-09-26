<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/View/views/view.detail.php');

class UsersActivityViewDetail extends ViewDetail {

    function UsersActivityViewDetail()
    {
        parent::ViewDetail();
    }
    function display() 
    {
        $item = $this->bean->item_name;
        if ($this->bean->action_name != 'Delete' && $this->bean->action_name != 'Login' && $this->bean->action_name != 'Logout')
        {
            $item = "<a href='index.php?action=DetailView&module={$this->bean->module_name}&record={$this->bean->item_id}'>{$this->bean->item_name}</a>";
        }
        $this->ss->assign("ITEM", $item);
        
        
        $whoisDetails = '';
        $ip = $this->bean->ip_address;
        if ($ip != "" && $ip != "127.0.0.1" && $ip != "::1") 
        {
            require("modules/UsersActivity/Whois.php");
            $whois = new Whois;
            $whoisDetails =  "<pre>".$whois->whoislookup($ip)."</pre>";
        }                
        $this->ss->assign('WHOIS_DETAILS', $whoisDetails);
        
        parent::display();
    }
}