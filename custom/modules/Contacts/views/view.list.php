<?php

require_once('include/MVC/View/views/view.list.php');

class ContactsViewList extends ViewList
{
	function __construct(){
		parent::__construct();
		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
	}
	public function preDisplay()
    {
        parent::preDisplay();
		$this->lv = new ListViewSmarty();
		$this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItemNewsletter();
		$this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItemArchivedStatus();
        echo "<script type='text/javascript' src='custom/include/javascript/goto_massupdate.js'></script>";
    }
	public function buildMyMenuItemNewsletter(){
        global $app_strings;

return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");'
				onmouseout='unhiliteItem(this);'
				onclick="sugarListView.get_checks();
				document.MassUpdate.action.value='print_newsletter';
				document.MassUpdate.submit();">Print Newsletter</a>
				
EOHTML;
		}
		public function buildMyMenuItemArchivedStatus(){
        global $app_strings;
        $status =  $_REQUEST['is_archived'];
        if($status== 1)
        {
return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");'
				onmouseout='unhiliteItem(this);'
				onclick="sugarListView.get_checks();
				document.MassUpdate.action.value='unarchived';
				document.MassUpdate.submit();">UnArchived</a>
				
EOHTML;
}
else
{
	return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");'
				onmouseout='unhiliteItem(this);'
				onclick="sugarListView.get_checks();
				document.MassUpdate.action.value='archived';
				document.MassUpdate.submit();">Archived</a>
				
EOHTML;
}
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

		$this->processSearchForm();
		$this->lv->searchColumns = $this->searchForm->searchColumns;
		if (!$this->headers)
			return;
		if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
			$this->lv->ss->assign("SEARCH", true);
			$this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
			if($_REQUEST['active_client']){
				$ids = $this->set_contact_archived();
				$this->params['custom_where'] .= " AND contacts.id IN $ids";
			}
			if($_REQUEST['is_archived']){
				$this->params['custom_where'] .= " AND contacts.is_archived = '1'";
			}else{
				$this->params['custom_where'] .= " AND contacts.is_archived = 0";
			}
			if ( isset($_REQUEST['rec']) AND $_REQUEST['rec'] == 'duplicates') {
                $this->params['custom_where'] = " AND contacts.id IN (select a.id from contacts a join ( select first_name, last_name,suffix, deleted from contacts group by first_name, last_name,suffix, deleted having count(*) > 1 ) b on a.first_name = b.first_name and a.last_name = b.last_name  and a.suffix = b.suffix WHERE a.deleted = 0 AND b.deleted = 0)";
                $this->params['custom_where'] .= " AND contacts.deleted = 0";
                $this->params['orderBy'] = " ORDER BY first_name";
			}
			//      ======Live Search in List View======
            if($_REQUEST['search_contact']){
                $search = $_REQUEST['search_contact'];
                $this->params['custom_where'] = " AND ( last_name LIKE '%$search%' OR first_name LIKE '%$search%' OR salutation LIKE '%$search%' OR concat(first_name,' ',last_name) LIKE '%$search%' OR concat(last_name,' ',first_name) LIKE '%$search%' )";
            }
			$this->lv->setup($this->seed, 'custom/modules/Contacts/tpls/ListViewGeneric.tpl', $this->where, $this->params);
			$savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
			echo $this->lv->display();
		}
    }
	function set_contact_archived(){
	  global $db;
		$related_contacts = array();
		$roles = array('Injured_Person', 'Client', 'Primary_Contact');
		$sql = "SELECT DISTINCT contacts_cases.id, contacts_cases.contact_id, contacts_cases.contact_role
			FROM `contacts_cases`
			WHERE contacts_cases.deleted = 0 AND contacts_cases.contact_id != ''";
		$result = $db->query($sql, true);
		while($row = $db->fetchByAssoc($result)){
			if(in_array($row['contact_role'],  $roles)){
				$related_contacts[] = $row['contact_id'];
			}
		}  
		$IdsStr = implode("' , '", $related_contacts);
		return "('" . $IdsStr . "')";
	}
	
	
	
}

