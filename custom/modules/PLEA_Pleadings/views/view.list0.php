<?php

require_once('include/MVC/View/views/view.list.php');

class PLEA_PleadingsViewList extends ViewList
{
	public function preDisplay()
    {
        parent::preDisplay();
	echo "<script type='text/javascript' src='custom/include/javascript/goto_massupdate.js'></script>";
        $this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItem();
        $this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItemExportMulti();
        $this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItemPrintMulti();
    }
	  public function buildMyMenuItem()
    {
        global $app_strings;

return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="javascript:void(0)" onmouseover='hiliteItem(this,"yes");'
				onmouseout='unhiliteItem(this);'
				onclick="sugarListView.get_checks();
				document.MassUpdate.action.value='mark_done';
				document.MassUpdate.return_module.value = 'PLEA_Pleadings';
				document.MassUpdate.return_action.value = 'index';
				document.MassUpdate.submit();">Mark Done</a>

EOHTML;
		}
	protected function buildMyMenuItemExportMulti()
    {
        global $app_strings;
        return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");'
				onmouseout='unhiliteItem(this);'
				onclick="return sListView.send_form(true, 'PLEA_Pleadings', 'index.php?entryPoint=download_attachment_multi','Please select at least 1 record to proceed.')">Export Attachments</a>
EOHTML;
    }
	protected function buildMyMenuItemPrintMulti()
    {
        global $app_strings;
        return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");'
				onmouseout='unhiliteItem(this);'
				onclick="return sListView.send_form(true, 'PLEA_Pleadings', 'index.php?entryPoint=download_attachment_multi&merge=true','Please select at least 1 record to proceed.')">Print Attachments</a>
EOHTML;
    }
    public function listViewPrepare()
    {
        if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = strtoupper('date_filed_c');
            $_REQUEST['sortOrder'] = 'DESC';
        }
        parent::listViewPrepare();
    }
	public function listViewProcess()
    {
        global $db;
        $this->processSearchForm();
        $this->lv->searchColumns = $this->searchForm->searchColumns;

// pre($this->lv);
        if (!$this->headers)
            return;
        if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
            $this->lv->ss->assign("SEARCH", true);
            $this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
            // if($_REQUEST['filter_module']){
            //     $menu_qc = $_REQUEST['filter_module'];
            //     if($menu_qc == 'qc1_inbox'){
            //         $this->params['custom_where'] .= " AND plea_pleadings_cstm.done_c = 0
            //        AND (plea_pleadings_cstm.qc1_reviewed_c IS NULL OR plea_pleadings_cstm.qc1_reviewed_c = '')
            //        AND (plea_pleadings_cstm.assistant_reviewed_c IS NULL OR plea_pleadings_cstm.assistant_reviewed_c = '') AND
            //        plea_pleadings.deleted = 0";
            //     }
            //     else if($menu_qc == 'qc1_failed'){
            //         $this->params['custom_where'] .= " AND plea_pleadings_cstm.done_c = 0
            //        AND plea_pleadings_cstm.qc1_reviewed_c = 'qc1_fail'
            //        AND  plea_pleadings.deleted = 0";
            //     }
            //     else if($menu_qc == 'qc1_fixed'){
            //         $this->params['custom_where'] .= " AND plea_pleadings_cstm.done_c = 0
            //        AND plea_pleadings_cstm.qc1_reviewed_c = 'qc1_fixed'
            //        AND plea_pleadings.deleted = 0";
            //     }
            //     else if($menu_qc == 'qc2_inbox'){
            //         $this->params['custom_where'] .= " AND plea_pleadings_cstm.done_c = 0
            //        AND plea_pleadings_cstm.qc1_reviewed_c = 'qc1_pass'
            //        AND plea_pleadings.deleted = 0";
            //     }
            //     else if($menu_qc == 'qc2_failed'){
            //         $this->params['custom_where'] .= " AND plea_pleadings_cstm.done_c = 0
            //         AND plea_pleadings_cstm.assistant_reviewed_c = 'assistant_fail'
            //         AND plea_pleadings_cstm.qc1_reviewed_c != 'qc1_fail'
            //         AND plea_pleadings.deleted = 0";
            //     }
            //     else if($menu_qc == 'assistant_pass'){
            //         $this->params['custom_where'] .= " AND plea_pleadings_cstm.done_c = 0
            //        AND plea_pleadings_cstm.assistant_reviewed_c = 'assistant_pass'
            //        AND plea_pleadings.deleted = 0";
            //     }
            //     else if($menu_qc == 'discovery_matrix'){
            //         $this->params['custom_where'] .= " AND plea_pleadings_cstm.done_c = 0
            //        AND plea_pleadings_cstm.discovery_matrix_c = 0
            //        AND plea_pleadings.deleted = 0";
            //     }

            // }
            // else{
            //     $this->params['custom_where'] .= " AND plea_pleadings_cstm.done_c = 0
            //        AND plea_pleadings.deleted = 0";
            // }
            // pre($_REQUEST);
            // pre($this->seed);
            $this->params['orderBy'] = 'date_entered';
            $this->params['sortOrder'] = 'DESC';
            // pre($this->seed->table_name);
            // $records = $this->seed->get_list(
            //     // $this->seed->table_name,
            //     $this->params['orderBy'],
            //     $this->where,
            // );

            // foreach ($records['list'] as $key => $record) {
            //     if (!empty($record->saved_by)) {

            //         $userBean = BeanFactory::getBean('Users', $record->saved_by);
            //         if ($userBean) {
            //             $records['list'][$key]->saved_by = 'Modified Value Here';  // Modify this as needed
            //             $records['list'][$key]->processed_dates_times['saved_by'] = 'Modified Value Here';  // Modify this as needed
            //         }
            //         // pre($records['list'][$key]);
            //     }
            // }
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
                $this->params['custom_where'] .= " AND plea_pleadings.created_by IN ".$All_Records;
            }

            $this->lv->setup($this->seed, 'custom/modules/PLEA_Pleadings/tpls/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
		}
    }
}
