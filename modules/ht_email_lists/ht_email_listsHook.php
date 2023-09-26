<?php
class ht_email_listsHook {
    function getFromAddr(&$bean, $event, $arguments){
		global $db;
		$query = "SELECT from_addr,to_addrs FROM `emails_text` where deleted=0 and email_id= '{$bean->id}'";
		$email = BeanFactory::getBean("Emails", $bean->id);
		$users = BeanFactory::getBean("Users", $email->created_by);
		$bean->from_addr_name = $users->gmail_id;
		$bean->to_addr_name = $email->to_addrs;
	}
}