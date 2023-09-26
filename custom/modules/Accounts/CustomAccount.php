<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once("modules/Accounts/Account.php");

class CustomAccount extends Account{

	public function __construct() {
        parent::__construct();
	}
		function create_new_list_query($order_by, $where, $filter = array(), $params = array(), $show_deleted = 0, $join_type = '', $return_array = false, $parentbean = null, $singleSelect = false, $ifListForExport = false)
	{
		/* $_REQUEST['parent_id'] = '9d2e0b9e-9491-d905-36b9-5b31e8f6e7be'; */
		if (isset($_REQUEST['parent_id']) && empty($_REQUEST['parent_id'])) {
			return  false;
		}
		
		$Ids = $this->updateRelatedCaseAccounts();
		
		if (empty($Ids) && isset($_REQUEST['parent_id'])) {
			return false;
		} else if (!empty($Ids) && isset($_REQUEST['parent_id'])) {
			$where .= " accounts.id IN $Ids ";
		}
		/* echo $where;die; */
		return parent::create_new_list_query($order_by, $where, $filter, $params, $show_deleted, $join_type, $return_array, $parentbean, $singleSelect, $ifListForExport);
	}
	
	function updateRelatedCaseAccounts($parent_id = '')
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
		
		$accountsBean = BeanFactory::getBean('Cases', $id);
		$RelatedIds = array();
		if ($accountsBean->load_relationship('accounts')) {
			$relatedBeans = $accountsBean->accounts->getBeans();
			foreach ($relatedBeans as $account) {
				$RelatedIds[] = $account->id;
			}
		}
		
		if (empty($RelatedIds)) {
			return '';
		}
		
		$IdsStr = implode("' , '", $RelatedIds);
		return "('" . $IdsStr . "')";
	}

}
