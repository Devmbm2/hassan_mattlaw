<?php
require_once('include/MVC/View/views/view.edit.php');
class FP_eventsViewList extends ViewList {
        function FP_eventsViewList(){
        parent::ViewList();
}
	 public function listViewPrepare()
    {
        if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = strtoupper('date_start');
            $_REQUEST['sortOrder'] = 'DESC';
        }
        parent::listViewPrepare();
    }
/* 	public function listViewPrepare()
    {
        $module = $GLOBALS['module'];

        $metadataFile = $this->getMetaDataFile();

        if (!file_exists($metadataFile)) {
            sugar_die(sprintf($GLOBALS['app_strings']['LBL_NO_ACTION'], $this->do_action));
        }

        require($metadataFile);

        $this->listViewDefs = $listViewDefs;
        if(isset($viewdefs[$this->module]['ListView']['templateMeta'])) {
            $this->lv->templateMeta = $viewdefs[$this->module]['ListView']['templateMeta'];
        }
		

        if (!empty($this->bean->object_name) && isset($_REQUEST[$module . '2_' . strtoupper($this->bean->object_name) . '_offset'])) {//if you click the pagination button, it will populate the search criteria here
            if (!empty($_REQUEST['current_query_by_page'])) {//The code support multi browser tabs pagination
                $blockVariables = array('mass', 'uid', 'massupdate', 'delete', 'merge', 'selectCount', 'request_data', 'current_query_by_page', $module . '2_' . strtoupper($this->bean->object_name) . '_ORDER_BY');
                if (isset($_REQUEST['lvso'])) {
                    $blockVariables[] = 'lvso';
                }
                $current_query_by_page = json_decode(html_entity_decode($_REQUEST['current_query_by_page']), true);
                foreach ($current_query_by_page as $search_key => $search_value) {
                    if ($search_key != $module . '2_' . strtoupper($this->bean->object_name) . '_offset' && !in_array($search_key, $blockVariables)) {
                        if (!is_array($search_value)) {
                            $_REQUEST[$search_key] = securexss($search_value);
                        } else {
                            foreach ($search_value as $key => &$val) {
                                $val = securexss($val);
                            }
                            $_REQUEST[$search_key] = $search_value;
                        }
                    }
                }
            }
        }
        if (!empty($_REQUEST['saved_search_select'])) {
            if ($_REQUEST['saved_search_select'] == '_none' || !empty($_REQUEST['button'])) {
                $_SESSION['LastSavedView'][$_REQUEST['module']] = '';
                unset($_REQUEST['saved_search_select']);
                unset($_REQUEST['saved_search_select_name']);

                //use the current search module, or the current module to clear out layout changes
                if (!empty($_REQUEST['search_module']) || !empty($_REQUEST['module'])) {
                    $mod = !empty($_REQUEST['search_module']) ? $_REQUEST['search_module'] : $_REQUEST['module'];
                    global $current_user;
                    //Reset the current display columns to default.
                    $current_user->setPreference('ListViewDisplayColumns', array(), 0, $mod);
                }
            } else if (empty($_REQUEST['button']) && (empty($_REQUEST['clear_query']) || $_REQUEST['clear_query'] != 'true')) {
                $this->saved_search = loadBean('SavedSearch');
                $this->saved_search->retrieveSavedSearch($_REQUEST['saved_search_select']);
                $this->saved_search->populateRequest();
            } elseif (!empty($_REQUEST['button'])) { // click the search button, after retrieving from saved_search
                $_SESSION['LastSavedView'][$_REQUEST['module']] = '';
                unset($_REQUEST['saved_search_select']);
                unset($_REQUEST['saved_search_select_name']);
            }
        }
        $this->storeQuery = new StoreQuery();
        if (!isset($_REQUEST['query'])) {
            $this->storeQuery->loadQuery($this->module);
            $this->storeQuery->populateRequest();
	} elseif (!empty($_REQUEST['update_stored_query'])) {
            $updateKey = $_REQUEST['update_stored_query_key'];
            $updateValue = $_REQUEST[$updateKey];
            $this->storeQuery->loadQuery($this->module);
            $this->storeQuery->populateRequest();
            $_REQUEST[$updateKey] = $updateValue;
            $this->storeQuery->saveFromRequest($this->module);
        } else {
            $this->storeQuery->saveFromRequest($this->module);
        }

        $this->seed = $this->bean;
        $displayColumns = array();
        //if (!empty($_REQUEST['displayColumns'])) {
            foreach (explode('|', $_REQUEST['displayColumns']) as $num => $col) {
                if (!empty($this->listViewDefs[$module][$col]))
                    $displayColumns[$col] = $this->listViewDefs[$module][$col];
            }
        //} else {
            foreach ($this->listViewDefs[$module] as $col => $this->params) {
                //if (!empty($this->params['default']) && $this->params['default'])
                    $displayColumns[$col] = $this->params;
            }
        //}
		
        $this->params = array('massupdate' => true);
        if (!empty($_REQUEST['orderBy'])) {
            $this->params['orderBy'] = $_REQUEST['orderBy'];
            $this->params['overrideOrder'] = true;
            if (!empty($_REQUEST['sortOrder'])) $this->params['sortOrder'] = $_REQUEST['sortOrder'];
        }
	
        $this->lv->displayColumns = $displayColumns;

        $this->module = $module;

        $this->prepareSearchForm();

        if (isset($this->options['show_title']) && $this->options['show_title']) {
            $moduleName = isset($this->seed->module_dir) ? $this->seed->module_dir : $GLOBALS['mod_strings']['LBL_MODULE_NAME'];
            echo $this->getModuleTitle(true);
        }
    } */

	
	 function listViewProcess() {
		global $current_user;
		$this->processSearchForm();
		$this->lv->searchColumns = $this->searchForm->searchColumns;
		if (!$this->headers)
			return;
		if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
			$this->lv->ss->assign("SEARCH", true);
			$this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
			/* $this->params['custom_where'] .= " AND fp_events.status != 'Done'"; */
			$this->lv->setup($this->seed, 'include/ListView/ListViewGeneric.tpl', $this->where, $this->params);
			$savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
           
			echo $this->lv->display();
		}
    }
	function display() {
		parent::display();
		echo "<link href='custom/include/select2/css/select2.min.css' rel='stylesheet' type='text/css'/>";
		echo "<script type='text/javascript' src='custom/include/select2/js/select2.min.js'></script> ";
		echo "
			<script type='text/javascript'>
				$(document).ready(function(){
					$('#multiple_assigned_users').select2();
				});
			</script> 
		";
	}
}
?>
