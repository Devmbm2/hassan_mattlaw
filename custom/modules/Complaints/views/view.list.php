<?php

require_once('include/MVC/View/views/view.list.php');

class ComplaintsViewList extends ViewList
{
    public function preDisplay(){
        parent::preDisplay();
		global $current_user;
	//Prevent delete record from normal user
		if(!$current_user->is_admin){
			 $this->lv = new ListViewSmarty();
			 $this->lv->delete = false;
			 $this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItem();
		}else{
			$this->lv = new ListViewSmarty();
			$this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItem();
		}
    }
	public function buildMyMenuItem()
    {
        global $app_strings;

return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");'
				onmouseout='unhiliteItem(this);'
				onclick="sugarListView.get_checks();
				document.MassUpdate.action.value='complaints_list_view_report';
				document.MassUpdate.submit();">Generate Report</a>
				
EOHTML;
		}

    public function listViewPrepare()
    {
        if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = strtoupper('name');
            $_REQUEST['sortOrder'] = 'ASC';
        }
        parent::listViewPrepare();
    }

    function listViewProcess() {
		global $current_user;
		$this->processSearchForm();
		$this->lv->searchColumns = $this->searchForm->searchColumns;
		if (!$this->headers)
			return;
		if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
			$this->lv->ss->assign("SEARCH", true);
			$this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
			// if($_SESSION['status'] != 'Closed'){
				// $this->params['custom_where'] = " AND complaints.status != 'Closed' AND complaints.status != 'Adiosed'";
			// }
			// if($_REQUEST['archive_complaints_basic']){
				// $this->params['custom_where'] = " AND complaints.status = 'Closed' OR complaints.status = 'Adiosed'";
			// }
			
			$this->lv->setup($this->seed, 'custom/modules/Complaints/tpls/ListViewGeneric.tpl', $this->where, $this->params);
			$savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
           
			echo $this->lv->display();
		}
    }
	
}


 
