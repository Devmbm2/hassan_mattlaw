<?php

require_once('include/MVC/View/views/view.list.php');

class ht_smsViewList extends ViewList
{
	function listViewProcess() {
		$this->processSearchForm();
		$this->lv->searchColumns = $this->searchForm->searchColumns;
		if (!$this->headers)
			return;
		if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
			$this->lv->ss->assign("SEARCH", true);
			$this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
			if($_REQUEST['incoming_sms']){
				$this->params['custom_where'] = " AND ht_sms.sent_received = 'Incoming'";
			}else if($_REQUEST['outgoing_sms']){
				$this->params['custom_where'] = " AND ht_sms.sent_received = 'Outgoing'";
			}
			$this->lv->setup($this->seed, 'include/ListView/ListViewGeneric.tpl', $this->where, $this->params);
			$savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
           
			echo $this->lv->display();
		}
    }
}


 
