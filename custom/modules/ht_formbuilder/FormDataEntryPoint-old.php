<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
	global $log;
	$form_id = $_REQUEST["id"];
	$userUpdate = BeanFactory::getBean("ht_formbuilder", $form_id);
	$fbdesc = $userUpdate->description;
	$fbmodule = $userUpdate->related_module;
	$json = str_replace('&quot;', '"', $fbdesc);
	$fbdesc_decode = json_decode($json);
	$bean = BeanFactory::newBean($fbmodule);
		foreach($fbdesc_decode as $record){
		$bean->{$record->shape} = $_REQUEST[$record->name];
		}
			if(isset($_REQUEST['casetype']))
			{
				$bean->type = $_REQUEST['casetype'];
				}
				$bean->save();
	// print"<pre>";print_r($bean); 
	header("Location:index.php?module={$fbmodule}&action=DetailView&record={$bean->id}");

