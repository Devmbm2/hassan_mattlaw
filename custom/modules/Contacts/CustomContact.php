<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/Contacts/Contact.php");

class CustomContact extends Contact{

	public function __construct() {
        parent::__construct();
	}
		function create_new_list_query($order_by, $where, $filter = array(), $params = array(), $show_deleted = 0, $join_type = '', $return_array = false, $parentbean = null, $singleSelect = false, $ifListForExport = false)
	{
		/* $_REQUEST['parent_id'] = '9d2e0b9e-9491-d905-36b9-5b31e8f6e7be'; */
		/* echo $where;die; */
		if (isset($_REQUEST['parent_id']) && empty($_REQUEST['parent_id'])) {
			return  false;
		}
		
		if(isset($_REQUEST['caller_type']) && empty($_REQUEST['caller_type'])){
			return false;
		}
		
		$CallerTypeIds = $this->getCallerCaseContacts();
		if (empty($CallerTypeIds) && isset($_REQUEST['caller_type'])) {
			return false;
		} else if (!empty($CallerTypeIds) && isset($_REQUEST['caller_type'])) {
			$where .= " contacts.id IN $CallerTypeIds ";
		}
		 
		$Ids = $this->updateRelatedCaseContacts();
		
		if (empty($Ids) && isset($_REQUEST['parent_id'])) {
			return false;
		} else if (!empty($Ids) && isset($_REQUEST['parent_id'])) {
			$where .= " contacts.id IN $Ids ";
		}
		/*  echo $where;die; */
		return parent::create_new_list_query($order_by, $where, $filter, $params, $show_deleted, $join_type, $return_array, $parentbean, $singleSelect, $ifListForExport);
	}
	
	function getCallerCaseContacts($parent_case_id = '', $caller_type = '')
	{
		$id = '';
		$type = '';
		if(empty($caller_type) && isset($_REQUEST['caller_type'])){
			$id = $_REQUEST['parent_case_id'];
			$type = $_REQUEST['caller_type'];
		}else{
			$id = $parent_case_id;
			$type = $caller_type;
		}
		if (empty($id) || empty($type)) {
			return;
		}
		$contact_role = !empty($GLOBALS['app_list_strings']['caller_type_contact_roles_mapping'][$type]) ? $GLOBALS['app_list_strings']['caller_type_contact_roles_mapping'][$type] : '';
		if (empty($contact_role)) {
			return ;
		}
		if(is_array($contact_role)){
			$contact_role = implode("','", $contact_role);
			$contact_role = "('" . $contact_role . "')";
		}
		$sql = "SELECT * FROM `contacts_cases` WHERE deleted = 0 AND case_id = '{$id}' AND contact_role IN $contact_role";
		/* echo $sql;die; */
		$result = $GLOBALS['db']->query($sql, true);
		/* print_r($result); */
		$RelatedIds = array();
		while($row = $GLOBALS['db']->fetchByAssoc($result)){
			/* echo 'asd:'. $row['contact_id']; */
			$RelatedIds[] = $row['contact_id'];
		}
		
		/* print_r($RelatedIds); */
		if (empty($RelatedIds)) {
			return '';
		}
		$IdsStr = implode("' , '", $RelatedIds);
		/* echo "('" . $IdsStr . "')";die; */
		return "('" . $IdsStr . "')";
	}
	function updateRelatedCaseContacts($parent_id = '')
	{
		$id = '';
		if(empty($parent_id) && isset($_REQUEST['parent_id'])){
			$id = $_REQUEST['parent_id'];
		}else{
			$id = $parent_id;
		}
		if (empty($id)) {
			return;
		}
		
		$caseBean = BeanFactory::getBean('Cases', $id);
		$RelatedIds = array();
		if ($caseBean->load_relationship('contacts')) {
			$relatedBeans = $caseBean->contacts->getBeans();
			foreach ($relatedBeans as $case) {
				$RelatedIds[] = $case->id;
			}
		}
		
		if (empty($RelatedIds)) {
			return '';
		}
		
		$IdsStr = implode("' , '", $RelatedIds);
		return "('" . $IdsStr . "')";
	}

}
