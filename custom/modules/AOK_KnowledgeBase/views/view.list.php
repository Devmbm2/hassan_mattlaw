<?php

require_once('include/MVC/View/views/view.list.php');

class AOK_KnowledgeBaseViewList extends ViewList
{
    public function listViewPrepare()
    {
        if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = strtoupper('date_modified');
            $_REQUEST['sortOrder'] = 'DESC';
        }
        parent::listViewPrepare();
    }
	public function listViewProcess()
    {
        $this->processSearchForm();
        $this->lv->searchColumns = $this->searchForm->searchColumns;

        if (!$this->headers)
            return;
        if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
            $this->lv->ss->assign("SEARCH", true);
            $this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
            global $current_user,$db;
            $sql = "Select aok_knowledgebase.id, aok_knowledgebase.multiple_assigned_users FROM aok_knowledgebase where aok_knowledgebase.multiple_assigned_users IS NOT NULL";
            $result = $db->query($sql);
            $case_arr = array();
            while($row = $db->fetchByAssoc($result)){
                $replace1 = str_replace("^","",$row['multiple_assigned_users']);
                $arr = explode(",",$replace1);
                
                if(!in_array($current_user->id, $arr) && !is_admin($current_user)){
                    $case_arr[] = $row['id'];
                }
            }
            $conversion = json_encode($case_arr);
            $replace2 = str_replace("[",'',$conversion);
            $replace3 = str_replace("]",'',$replace2);
            if(!empty($replace3)){
                $this->params['custom_where'] =" AND aok_knowledgebase.id NOT IN ({$replace3}) ";
            }
            $this->lv->setup($this->seed, 'custom/modules/AOK_KnowledgeBase/tpls/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
		}
    }
}

