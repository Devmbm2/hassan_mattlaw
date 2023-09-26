<?php

require_once('include/MVC/View/views/view.list.php');

class COST_Client_CostViewList extends ViewList
{
	public function preDisplay()
    {
        parent::preDisplay();
        $this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItemExportMulti();
        $this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItemCostReport();
    }
    public function listViewPrepare()
    {
        if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = 'date_entered';
            $_REQUEST['sortOrder'] = 'DESC';
        }
        parent::listViewPrepare();
	echo "<script type='text/javascript' src='custom/include/javascript/goto_massupdate.js'></script>";
    }
    function listViewProcess() {

        $this->processSearchForm();
        $this->lv->searchColumns = $this->searchForm->searchColumns;
        if (!$this->headers)
            return;
        if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
            $this->lv->ss->assign("SEARCH", true);
            $this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
            global $db;
        if(!empty($_POST['search_data'])){
        $search_data = " AND cost_client_cost.document_name Like '%".$_POST['search_data']."%' ";
        }
        if(!empty($_POST['status_cost_v'])){
            $status_cost_v  =  " AND cost_client_cost.status Like '%".$_POST['status_cost_v']."%' ";
            }
        if(!empty($_POST['select_cases_v'])){
                 $sql="SELECT cost_client_cost_casescost_client_cost_idb  FROM  cost_client_cost_cases_c WHERE cost_client_cost_casescases_ida='".$_POST['select_cases_v']."' ";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    $rows = array();
                    while($row = $result->fetch_assoc()) {
                        $rows[] = $row;
                    }
                    $id_array = array_column($rows, 'cost_client_cost_casescost_client_cost_idb');
                    $id_string = "'" . implode("','", $id_array) . "'";  
              $select_cases_v = " AND cost_client_cost.id  IN (".$id_string.")";
                }
        }

        if(!empty($_POST['select_payee_v'])){
            $select_payee_v = " AND cost_client_cost.parent_id = '".$_POST['select_payee_v']."' ";
            }

        if(!empty($search_data) || !empty($status_cost_v) || !empty($select_cases_v) || !empty($select_payee_v)  ){
            $this->params['custom_where']= $search_data . $select_cases_v . $select_payee_v . $status_cost_v ; 
            }
            $this->lv->setup($this->seed, 'custom/modules/COST_Client_Cost/tpls/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
        }
    }
	protected function buildMyMenuItemExportMulti()
    {
        global $app_strings;
        return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");' 
				onmouseout='unhiliteItem(this);' 
				onclick="return sListView.send_form(true, 'COST_Client_Cost', 'index.php?entryPoint=download_attachment_multi','Please select at least 1 record to proceed.')">Export Attachments</a>
EOHTML;
    }
	protected function buildMyMenuItemCostReport()
    {
        global $app_strings;

return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");'
				onmouseout='unhiliteItem(this);'
				onclick="sugarListView.get_checks();
				document.MassUpdate.action.value='CostReport';
				document.MassUpdate.submit();">Generate Client Cost Report</a>
				
EOHTML;
		}
}
