<?php

require_once('include/MVC/View/views/view.list.php');

class CasesViewList extends ViewList
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
				document.MassUpdate.action.value='cases_list_view_report';
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
			if($_SESSION['status'] != 'Closed'){
				$this->params['custom_where'] = " AND cases.status != 'Closed' AND cases.status != 'Adiosed'";
			}
			if($_REQUEST['archive_cases_basic']){
				$this->params['custom_where'] = " AND cases.status = 'Closed' OR cases.status = 'Adiosed' OR cases.status = '' OR cases.status IS NULL";
			}
			
			$this->lv->setup($this->seed, 'custom/modules/Cases/tpls/ListViewGeneric.tpl', $this->where, $this->params);
			$savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
           
			echo $this->lv->display();
		}
    }
	function display(){
		$this->lv->ss->assign('all_users', json_encode(get_user_array()));
		parent::display();
		/* print"<pre>";print_r(json_encode(get_user_array())); */
	}
	
}


 
