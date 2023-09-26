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

		global $current_user,$db;
		$this->processSearchForm();
		$this->lv->searchColumns = $this->searchForm->searchColumns;

		if (!$this->headers)
			return;
		if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
			$this->lv->ss->assign("SEARCH", true);
			$this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
			if($_SESSION['status'] != 'Closed'){
				$this->params['custom_where'] = " AND cases.status != 'Closed' AND cases.status != 'Adiosed'";
				// $this->security_check();
				
			}
			if($_REQUEST['archive_cases_basic']){
				$this->params['custom_where'] = " AND cases.status = 'Closed' OR cases.status = 'Adiosed' OR cases.status = '' OR cases.status IS NULL";
			}
            if(isset($_POST['SearchData'])){
                $this->params['custom_where'] =" AND cases.name LIKE '%".$_POST['SearchData']."%'";
            }
            if(isset($_POST['status']) && $_POST['status']==""){
                $this->params['custom_where'] =" AND (cases.status IS NULL OR cases.status='')";
            }
            if(isset($_POST['type']) && $_POST['type']==""){
                $this->params['custom_where'] =" AND (cases.type IS NULL OR cases.status='') ";
            }
            if(isset($_POST['assistentLawyerID'])){
                $this->params['custom_where'] =" AND cases.default_assistant_lawyer_id='".$_POST['assistentLawyerID']."'";
            }
            global $current_user,$db;
			$sql = "Select cases_cstm.id_c, cases_cstm.restricted_user_c FROM cases_cstm where cases_cstm.restricted_user_c IS NOT NULL";
            $result = $db->query($sql);
            $case_arr = array();
            while($row = $db->fetchByAssoc($result)){
            	$arr = explode(",",$row['restricted_user_c']);
            	if(in_array($current_user->id, $arr)){
				    $case_arr[] = $row['id_c'];
				}

            }
            $conversion = json_encode($case_arr);
			$replace1 = str_replace("[",'',$conversion);
			$replace2 = str_replace("]",'',$replace1);
			if(!empty($replace2)){
				$this->params['custom_where'] =" AND cases_cstm.id_c NOT IN ({$replace2}) ". $this->params['custom_where'];
			}
			$this->params['custom_where']="";
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



