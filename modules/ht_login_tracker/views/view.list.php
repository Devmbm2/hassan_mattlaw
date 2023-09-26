<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
require_once('include/MVC/View/views/view.list.php');
class ht_login_trackerViewList extends ViewList{
	function preDisplay(){
		$_REQUEST['sort_order'] = ' login_timestamp DESC ';
		parent::preDisplay();
		$this->lv->quickViewLinks = false;
    }
    function display(){
        global $app_list_strings, $mod_strings,$current_user;
        require_once('modules/htLoginTrackerLicenseAddon/license/htLoginTrackerOutfittersLicense.php');
		$validate_license = htLoginTrackerOutfittersLicense::isValid('htLoginTrackerLicenseAddon');
		if($validate_license !== true){
            SugarApplication::redirect("index.php?module=htLoginTrackerLicenseAddon&action=license");
        }
        if($this->HasLoginTrackerRole($current_user->id) && !$current_user->is_admin){
            $this->lv->delete = false;
        }
        parent::display();
    }
	function listViewProcess() {
        global $current_user;
        $this->processSearchForm();
        if(!$current_user->is_admin) 
            $this->params['custom_where'] = " AND ht_login_tracker.assigned_user_id = '{$current_user->id}' ";
      
        if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
            $this->lv->setup($this->seed, 'include/ListView/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
        }
    }

    public function HasLoginTrackerRole($id){
        global $db;
        $sql = "SELECT
                    * 
                FROM
                    acl_roles
                    INNER JOIN acl_roles_users ON acl_roles_users.user_id = '{$id}' 
                    AND acl_roles_users.role_id = acl_roles.id 
                    AND acl_roles_users.deleted = 0 
                WHERE
                    acl_roles.deleted = 0 
                    AND acl_roles.id = 'ht_login_tracker_id' 
                    AND acl_roles.deleted = 0";
        $result = $db->query($sql);
        if($result->num_rows == 0){
            return false;
        }
        return true;
    }
    
}