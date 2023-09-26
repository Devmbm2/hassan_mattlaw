<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/Users/User.php");

class CustomUser extends User {

	public function __construct() {
        parent::__construct();
	}
		function create_new_list_query($order_by, $where, $filter = array(), $params = array(), $show_deleted = 0, $join_type = '', $return_array = false, $parentbean = null, $singleSelect = false, $ifListForExport = false)
	{
		/* $_REQUEST['parent_id'] = '4391e830-e6dd-46d1-3c9c-5a68ad3343a5'; */
		if (isset($_REQUEST['parent_id']) && empty($_REQUEST['parent_id'])) {
			return  false;
		}
		
		$Ids = $this->updateRelatedAssignedAttorney();
		
		if (empty($Ids) && isset($_REQUEST['parent_id'])) {
			return false;
		} else if (!empty($Ids) && isset($_REQUEST['parent_id'])) {
			$where .= " && users.id IN $Ids ";
		}
		/* echo $where;die; */
		return parent::create_new_list_query($order_by, $where, $filter, $params, $show_deleted, $join_type, $return_array, $parentbean, $singleSelect, $ifListForExport);
	}
	
	function updateRelatedAssignedAttorney($parent_id = '')
	{
		$id = '';
		if(empty($parent_id)){
			$id = $_REQUEST['parent_id'];
		}else{
			$id = $parent_id;
		}
		if (empty($id)) {
			return;
		}
		
		$userBean = BeanFactory::getBean('Users', $id);
		$RelatedIds = array();
		if ($userBean->load_relationship('direct_reports')) {
			$relatedBeans = $userBean->direct_reports->getBeans();
			foreach ($relatedBeans as $user) {
				$RelatedIds[] = $user->id;
			}
		}
		
		if (empty($RelatedIds)) {
			return '';
		}
		
		$IdsStr = implode("' , '", $RelatedIds);
		return "('" . $IdsStr . "')";
	}

}
