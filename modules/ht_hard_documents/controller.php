<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class ht_hard_DocumentsController extends SugarController {
	
	public function setup($module = ''){

		global $current_user,$db;

		$_REQUEST['module']="Documents";
		$_REQUEST['target_module']='Documents';
		$_REQUEST['target_action']='index';
		$_REQUEST['ht_document_type']='Hard_Documents';
		$_SESSION['ht_document_type']='Hard_Documents';
		parent::setup();
		
	}
	
	public function action_massupdate(){
		$_REQUEST['return_module']='ht_hard_documents';
		$_REQUEST['return_action']='index';
		parent::action_massupdate();
	}
}