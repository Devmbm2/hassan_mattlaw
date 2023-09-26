<?php

require_once('include/MVC/View/views/view.list.php');

class DocumentsViewList extends ViewList {
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
				document.MassUpdate.submit();">Mark Done</a>
				
EOHTML;
		}
		
		protected function buildMyMenuItemExportMulti()
    {
        global $app_strings;
        return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");' 
				onmouseout='unhiliteItem(this);' 
				onclick="return sListView.send_form(true, 'Documents', 'index.php?entryPoint=download_attachment_multi','Please select at least 1 record to proceed.')">Export Attachments</a>
EOHTML;
    }
	protected function buildMyMenuItemPrintMulti()
    {
        global $app_strings;
        return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");' 
				onmouseout='unhiliteItem(this);' 
				onclick="return sListView.send_form(true, 'Documents', 'index.php?entryPoint=download_attachment_multi&merge=true','Please select at least 1 record to proceed.')">Print Attachments</a>
EOHTML;
    }
	   public function listViewPrepare()
    {
        if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = strtoupper('date_of_document_c');
            $_REQUEST['sortOrder'] = 'DESC';
        }
        parent::listViewPrepare();
    }
	
	  /*public function listViewPrepare()
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
		if($_REQUEST['ht_document_type'] == 'Soft_Documents'){
			//print"<pre>";print_r($displayColumns);
			unset($displayColumns['OUTGOING_DOCUMENT']);
		}
        $this->lv->displayColumns = $displayColumns;

        $this->module = $module;

        $this->prepareSearchForm();

        if (isset($this->options['show_title']) && $this->options['show_title']) {
            $moduleName = isset($this->seed->module_dir) ? $this->seed->module_dir : $GLOBALS['mod_strings']['LBL_MODULE_NAME'];
            echo $this->getModuleTitle(true);
        }
    }*/
	
    function listViewProcess() {
	$this->processSearchForm();
        $this->lv->searchColumns = $this->searchForm->searchColumns;
		/* print"<pre>";print_r($this->lv);die; */
	if (!$this->headers)
            return;
        if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
		$this->lv->ss->assign("SEARCH", true);
                $this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
		if($_REQUEST['ht_document_type']=='Hard_Documents'){
			$this->params['custom_where'] = " AND documents.hard_or_soft_doc = 'Hard_Documents' ";
		}
		if($_REQUEST['ht_document_type']=='Soft_Documents'){
			$this->params['custom_where'] = " AND documents.hard_or_soft_doc = 'Soft_Documents' ";
		}
         //     =======Cases name Search=======
            if($_REQUEST['search_data']){
                $search = $_REQUEST['search_data'];
                if($search != 'no_filter'){
                    $this->params['custom_from'] = " LEFT JOIN documents_cases ON documents.id = documents_cases.document_id LEFT JOIN cases ON documents_cases.case_id = cases.id";
                    $this->params['custom_where'] = " AND cases.id = '$search'";
                }
            }
        //      ======Search by Case Assigned To======
            if($_REQUEST['search_case_assigned_to']){
                $search = $_REQUEST['search_case_assigned_to'];
                if($search != 'no_filter'){
                    $this->params['custom_from'] = " LEFT JOIN documents_cases ON documents.id = documents_cases.document_id LEFT JOIN cases ON documents_cases.case_id = cases.id";
                    $this->params['custom_where'] = " AND cases.assigned_user_id = '{$search}'";
                }
            }
            //      ======Search by Case Assistant======
            if($_REQUEST['search_case_assistant']){
                $search = $_REQUEST['search_case_assistant'];
                if($search != 'no_filter'){
                    $this->params['custom_from'] = " LEFT JOIN documents_cases ON documents.id = documents_cases.document_id LEFT JOIN cases ON documents_cases.case_id = cases.id";
                    $this->params['custom_where'] = " AND  cases.default_assistant_lawyer_id = '{$search}'";
                }
            }    
			/* echo $this->where;die;
			print"<pre>";print_r($this->where);die; */
			$this->lv->setup($this->seed, 'custom/modules/Documents/tpls/ListViewGeneric.tpl', $this->where, $this->params);
			$savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
			echo $this->lv->display();
	}
		
    }
	
	public function getModuleTitle(
        $show_help = true
        )
    {
        global $sugar_version, $sugar_flavor, $server_unique_key, $current_language, $action;

        $theTitle = "<div class='moduleTitle'>\n";

        $module = preg_replace("/ /","",$this->module);

        $params = $this->_getModuleTitleParams();
        $index = 0;

		if(SugarThemeRegistry::current()->directionality == "rtl") {
			$params = array_reverse($params);
		}
		if(count($params) > 1) {
			array_shift($params);
		}
		$count = count($params);
        $paramString = '';
        foreach($params as $parm){
            $index++;
            $paramString .= $parm;
            if($index < $count){
                $paramString .= $this->getBreadCrumbSymbol();
            }
        }
		
		if($_REQUEST['ht_document_type'] == 'Hard_Documents') {
			$theTitle .= "<h2> Hard Documents </h2>\n";
		}else if ($_REQUEST['ht_document_type'] == 'Soft_Documents') {
			$theTitle .= "<h2> Soft Documents </h2>\n";
		}else {
			$theTitle .= "<h2> Documents </h2>\n";
		}
		
        if($this->type == 'list') {
            $theTitle .= "<span class='utils'>";
            $createImageURL = SugarThemeRegistry::current()->getImageURL('create-record.gif');
            if($this->type == 'list') $theTitle .= '<a href="#" class="btn btn-success showsearch"><span class=" glyphicon glyphicon-search" aria-hidden="true"></span></a>';$url = 
            $theTitle .= "</span>";
        }

        $theTitle .= "<div class='clear'></div></div>\n";
        return $theTitle;
    }
	
	
}
