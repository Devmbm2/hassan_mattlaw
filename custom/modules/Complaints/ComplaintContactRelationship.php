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

// Contact is used to store customer information.
class ComplaintContactRelationship extends SugarBean {
	// Stored fields
	var $id;
	var $contact_id;
	//var $complaint_role;
	var $contact_role;
	var $contact_complaint_role;
	var $complaint_id;

	// Related fields
	var $contact_name;
	var $complaint_name;

	var $table_name = "contacts_complaints";
	var $object_name = "ComplaintContactRelationship";
	var $column_fields = Array("id"
		,"contact_id"
		,"complaint_id"
		//,"complaint_role"
		,"contact_role"
		,'date_modified'
		);

	var $new_schema = true;
	
	var $additional_column_fields = Array();
		var $field_defs = array (
       'id'=>array('name' =>'id', 'type' =>'char', 'len'=>'36', 'default'=>'')
      , 'contact_id'=>array('name' =>'contact_id', 'type' =>'char', 'len'=>'36', )
      , 'complaint_id'=>array('name' =>'complaint_id', 'type' =>'char', 'len'=>'36',)
      //, 'complaint_role'=>array('name' =>'complaint_role', 'type' =>'char', 'len'=>'50')
      , 'contact_role'=>array('name' =>'contact_role', 'type' =>'char', 'len'=>'50')
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
		if(isset($this->contact_id) && $this->contact_id != "")
		{
			$query = "SELECT first_name, last_name from contacts where id='$this->contact_id' AND deleted=0";
			$result =$this->db->query($query,true," Error filling in additional detail fields: ");
			// Get the id and the name.
			$row = $this->db->fetchByAssoc($result);

			if($row != null)
			{
                		$this->contact_name = $locale->getLocaleFormattedName($row['first_name'], $row['last_name']);
			}
		}

		if(isset($this->complaint_id) && $this->complaint_id != "")
		{
			$query = "SELECT name from complaints where id='$this->complaint_id' AND deleted=0";
			$result =$this->db->query($query,true," Error filling in additional detail fields: ");
			// Get the id and the name.
			$row = $this->db->fetchByAssoc($result);

			if($row != null)
			{
				$this->complaint_name = $row['name'];
			}
		}

	}
}



?>
