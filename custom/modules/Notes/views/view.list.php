<?php

require_once('include/MVC/View/views/view.list.php');

class NotesViewList extends ViewList
{

    public function listViewPrepare(){
        if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = strtoupper('date_entered');
            $_REQUEST['sortOrder'] = 'DESC';
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
			$this->params['custom_where'] = " AND parent_type != 'Emails'";
			if($_REQUEST['custom_notes_filter']){
				$this->params['custom_where'] = " AND parent_type != 'Contacts' AND parent_type != 'Cases'";
			}
			//      ======Search by Note Type======
            if($_REQUEST['note_type_value']){
                $search = $_REQUEST['note_type_value'];
                if($search != 'no_filter'){
                    $this->params['custom_where'] = " AND ( notes_cstm.note_type_c LIKE '%{$search}%' )";
                }
            }
            //      ======Search by Note Name======
            if($_REQUEST['notes_by_name']){
                $search = $_REQUEST['notes_by_name'];
                $this->params['custom_where'] = " AND ( notes.name LIKE '%{$search}%' )";
            }
			$this->lv->setup($this->seed, 'custom/modules/Notes/tpls/ListViewGeneric.tpl', $this->where, $this->params);
			$savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
           
			echo $this->lv->display();
		}
    }
	
}


 
