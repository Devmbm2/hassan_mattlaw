<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */

// Account is used to store customer information.
class AccountCaseRelationship extends SugarBean {
	// Stored fields
	var $id;
	var $account_id;
	var $account_role;
	var $case_account_role;
	var $case_id;

	// Related fields
	var $account_name;
	var $case_name;

	var $table_name = "accounts_cases";
	var $object_name = "AccountCaseRelationship";
	var $column_fields = Array("id"
		,"account_id"
		,"case_id"
		,"account_role"
		,'date_modified'
		);

	var $new_schema = true;
	
	var $additional_column_fields = Array();
		var $field_defs = array (
       'id'=>array('name' =>'id', 'type' =>'char', 'len'=>'36', 'default'=>'')
      , 'account_id'=>array('name' =>'account_id', 'type' =>'char', 'len'=>'36', )
      , 'case_id'=>array('name' =>'case_id', 'type' =>'char', 'len'=>'36',)
      , 'account_role'=>array('name' =>'account_role', 'type' =>'char', 'len'=>'50')
      , 'date_modified'=>array ('name' => 'date_modified','type' => 'datetime')
      , 'deleted'=>array('name' =>'deleted', 'type' =>'bool', 'len'=>'1', 'default'=>'0', 'required'=>true)
      );


	public function __construct() {
		$this->db = DBManagerFactory::getInstance();
        $this->dbManager = DBManagerFactory::getInstance();

		$this->disable_row_level_security =true;

		}

	function fill_in_additional_detail_fields()
	{
		global $locale;
		if(isset($this->account_id) && $this->account_id != "")
		{
			$query = "SELECT name from accounts where id='$this->account_id' AND deleted=0";
			$result =$this->db->query($query,true," Error filling in additional detail fields: ");
			// Get the id and the name.
			$row = $this->db->fetchByAssoc($result);

			if($row != null)
			{
                		$this->account_name = $row['name'];
			}
		}

		if(isset($this->case_id) && $this->case_id != "")
		{
			$query = "SELECT name from cases where id='$this->case_id' AND deleted=0";
			$result =$this->db->query($query,true," Error filling in additional detail fields: ");
			// Get the id and the name.
			$row = $this->db->fetchByAssoc($result);

			if($row != null)
			{
				$this->case_name = $row['name'];
			}
		}

	}
}



?>
