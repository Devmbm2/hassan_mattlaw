<?php

require_once('include/MVC/View/views/view.list.php');

class TasksViewList extends ViewList
{
	 public function __construct(){
        parent::__construct();
		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
    }
    public function preDisplay()
    {
        parent::preDisplay();
        echo "<script type='text/javascript' src='custom/include/javascript/goto_massupdate.js'></script>";
    }

    public function listViewPrepare()
    {
        if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = strtoupper('date_due');
            $_REQUEST['sortOrder'] = 'ASC';
        }
        parent::listViewPrepare();
    }
/*    function listViewProcess() {
		global $current_user;
		$this->processSearchForm();
		$this->lv->searchColumns = $this->searchForm->searchColumns;
		if (!$this->headers)
			return;
		if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
			$this->lv->ss->assign("SEARCH", true);
			$this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
			$this->lv->setup($this->seed, 'custom/modules/Tasks/tpls/ListViewGeneric.tpl', $this->where, $this->params);
			$savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
           
			echo $this->lv->display();
		}
    } */
   public function listViewProcess()
    {
        $parent_table='cases';
        $child_table="tasks";
        $this->processSearchForm();
        $this->lv->searchColumns = $this->searchForm->searchColumns;

        if (!$this->headers)
            return;
        if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
            $this->lv->ss->assign("SEARCH", true);
            $this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
            if($_REQUEST['is_done']){
                $this->params['custom_where'] .= " AND tasks.status != 'Done'";
            }
            if($_REQUEST['is_archived']){
            $this->params['custom_from'] = " INNER JOIN ".$parent_table." on ".$parent_table.".id = ".$child_table.".parent_id";
            $this->params['custom_where'] = " AND cases.status = 'Closed' AND tasks.deleted = 0";
            }else{
                $this->params['custom_from'] = " LEFT JOIN ".$parent_table." on ".$parent_table.".id = ".$child_table.".parent_id";
            $this->params['custom_where'] = " AND (cases.status != 'Closed' || cases.status is null) AND tasks.deleted=0";
            }
            $this->lv->setup($this->seed, 'custom/modules/Tasks/tpls/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
		}
    }	
}


 
