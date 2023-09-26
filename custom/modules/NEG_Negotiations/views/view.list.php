<?php

require_once('include/MVC/View/views/view.list.php');

class NEG_NegotiationsViewList extends ViewList
{
		public function preDisplay()
    {
        parent::preDisplay();
	echo "<script type='text/javascript' src='custom/include/javascript/goto_massupdate.js'></script>";
        $this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItem();
    }
	  public function buildMyMenuItem()
    {
        global $app_strings;

return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="javascript:void(0)" onmouseover='hiliteItem(this,"yes");'
				onmouseout='unhiliteItem(this);'
				onclick="sugarListView.get_checks();
				document.MassUpdate.action.value='mark_done';
				document.MassUpdate.submit();">Mark Done</a>

EOHTML;
		}
    public function listViewPrepare()
    {
        if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = strtoupper('date_of_negotiation_c');
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

            if($_REQUEST['filter_module']=='recently_saved'){
                global $db;
                        $query = "select id from users where remote_user=1";
                        $result=$db->query($query);
                        $All_Records="(";
                        while ($record = $db->fetchByAssoc($result)) {
                            $All_Records.="'".$record['id']."',";
                            // pre($record);
                        }
                        $All_Records = rtrim($All_Records, ",");
                        $All_Records.=")";

                        // pre($All_Records);
                        $this->params['custom_where'] .= " AND neg_negotiations.created_by IN ".$All_Records;
                    }
            $this->lv->setup($this->seed, 'custom/modules/NEG_Negotiations/tpls/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
		}
    }
}



