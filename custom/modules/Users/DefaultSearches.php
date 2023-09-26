<?php
// Manage pre-saved searches (SavedSearch and StoreQuery) for the current user

require_once('modules/SavedSearch/SavedSearch.php');
require_once('modules/MySettings/StoreQuery.php');

class DefaultSearches {

    /**
     * Creation of SavedSearch and StoreQuery for the current user
     * 
     * @param object $bean
     * @param object $event
     * @param array $arguments
     */
    function addSavedSearch(&$bean, $event, $arguments) {
        global $current_user;

	// Check if current user not updated yet
	$userBean = BeanFactory::getBean('Users',$bean->id);
	if($userBean->updated_filter == 0) {
	    $userBean->updated_filter = 1;
	    $userBean->save();

        // Create and save the query filter for the Medical Record
        $this->createSavedSearch('MEDR_Medical_Records', 'New - Not Requested Yet', array('searchFormTab' => 'advanced_search', 'query' => true, 'status_id_advanced' => 'New_Not_Requested', 'search_module' => 'MEDR_Medical_Records', 'saved_search_action' => 'save', 'advanced' => true, 'orderBy' => 'DATE_ENTERED', 'sortOrder' => 'DESC'));
        $this->createSavedSearch('MEDR_Medical_Records', 'Received - Medical Record Summary NOT Done', array('searchFormTab' => 'advanced_search', 'query' => true, 'status_id_advanced' => 'Received', 'med_summary_status_c_advanced' => array(0 => 'Not_Done', 1 => 'Started_not_done'), 'search_module' => 'MEDR_Medical_Records', 'saved_search_action' => 'save', 'advanced' => true, 'orderBy' => 'DATE_ENTERED', 'sortOrder' => 'DESC'));
        $this->createSavedSearch('MEDR_Medical_Records', 'Request - Not Received Yet', array('searchFormTab' => 'advanced_search', 'query' => true, 'status_id_advanced' => 'Requested', 'search_module' => 'MEDR_Medical_Records', 'saved_search_action' => 'save', 'advanced' => true, 'orderBy' => 'DATE_ENTERED', 'sortOrder' => 'DESC'));

	// Received Medical Bills Saved Search
        $this->createSavedSearch('MDOC_Incoming_Bills', 'Running Summary NOT Updated', array('searchFormTab' => 'advanced_search', 'query' => true, 'running_summary_updated_c_advanced' => 'No', 'search_module' => 'MDOC_Incoming_Bills', 'saved_search_action' => 'save', 'advanced' => true, 'orderBy' => 'DATE_ENTERED', 'sortOrder' => 'DESC'));
        // Medical Bill Requests Saved Search
        $this->createSavedSearch('MREQ_MEDB_Requests', 'Requested - NOT Received Yet', array('searchFormTab' => 'advanced_search', 'query' => true, 'status_id_advanced' => 'Requested', 'search_module' => 'MREQ_MEDB_Requests', 'saved_search_action' => 'save', 'advanced' => true, 'orderBy' => 'DATE_ENTERED', 'sortOrder' => 'DESC'));

	// Client Cost Saved Search
        $this->createSavedSearch('COST_Client_Cost', 'Deferred Costs Due for Closed Cases', array('searchFormTab' => 'advanced_search', 'query' => true, 'status_advanced' => 'Deferred_Until_End_of_Case','case_status_advanced' => 'Closed', 'search_module' => 'COST_Client_Cost', 'saved_search_action' => 'save', 'advanced' => true, 'orderBy' => 'DATE_ENTERED', 'sortOrder' => 'DESC'));
        $this->createSavedSearch('COST_Client_Cost', 'Pre-Pay to Get', array('searchFormTab' => 'advanced_search', 'query' => true, 'status_advanced' => 'PrePay_to_Get', 'search_module' => 'COST_Client_Cost', 'saved_search_action' => 'save', 'advanced' => true, 'orderBy' => 'DATE_ENTERED', 'sortOrder' => 'DESC'));
        $this->createSavedSearch('COST_Client_Cost', 'Vendor Asking for Payment', array('searchFormTab' => 'advanced_search', 'query' => true, 'status_id_advanced' => array(0 => 'Asking_for_Payment', 1 => 'Demanding_Payment'), 'case_status_advanced' => 'Closed', 'search_module' => 'COST_Client_Cost', 'saved_search_action' => 'save', 'advanced' => true, 'orderBy' => 'DATE_ENTERED', 'sortOrder' => 'DESC'));

	// Create and save the query filter for the Prospect customers (Accounts) assigned to the current user
	$arr_search = array(0 => array('plea_name' => 'Anita\'s Incoming Pleadings',
				       'neg_name' => 'Anita\'s Incoming Negotiations',
				       'disc_name' => 'Anita\'s Incoming Discovery',
                                       'lawyer' => 'Anita DiGiacomo'),
			    1 => array('plea_name' => 'Matt\'s Incoming Pleadings',
			    	       'neg_name' => 'Matt\'s Incoming Negotiations',
				       'disc_name' => 'Matt\'s Incoming Discovery',
				       'lawyer' => 'Matthew D. Powell'),
			    2 => array('plea_name' => 'Mitch\'s Incoming Pleadings',
			    	       'neg_name' => 'Mitch\'s Incoming Negotiations',
				       'disc_name' => 'Mitch\'s Incoming Discovery',
                                       'lawyer' => 'K. Mitch Espat'),
			    );
	foreach($arr_search as $search){
        $this->createSavedSearch('PLEA_Pleadings', $search['plea_name'], array('searchFormTab' => 'advanced_search', 'query' => true, 'incoming_or_outgoing_advanced' => 'Incoming', 'assigned_lawyer_cases_advanced' => $search['lawyer'], 'search_module' => 'PLEA_Pleadings', 'saved_search_action' => 'save', 'advanced' => true,
		'orderBy' => 'DATE_ENTERED', 'sortOrder' => 'DESC'));
	$this->createSavedSearch('NEG_Negotiations', $search['neg_name'], array('searchFormTab' => 'advanced_search', 'query' => true, 'sent_rec_advanced' => 'Received', 'assigned_lawyer_cases_advanced' => $search['lawyer'], 'search_module' => 'NEG_Negotiations', 'saved_search_action' => 'save', 'advanced' => true, 'orderBy' => 'DATE_ENTERED', 'sortOrder' => 'DESC'));
        $this->createSavedSearch('DISC_Discovery', $search['disc_name'], array('searchFormTab' => 'advanced_search', 'query' => true, 'done_advanced' => '0', 'sent_received_advanced' => 'Received', 'assigned_lawyer_cases_advanced' => $search['lawyer'], 'search_module' => 'DISC_Discovery', 'saved_search_action' => 'save', 'advanced' => true, 'orderBy' => 'DATE_ENTERED', 'sortOrder' => 'DESC'));
	}
	}
    }
    /**
     * Creation of SavedSearch for the current user
     * 
     * @param string $strModule The module on which to create the SavedSearch
     * @param string $strName The name of the SavedSearch
     * @param array $arySearchQuery The search to be saved
     */
    private function createSavedSearch($strModule, $strName, $arySearchQuery) {
        global $current_user, $db;

        $beanSavedSearch = new SavedSearch('');
        $beanSavedSearch->name = $strName;
        $beanSavedSearch->search_module = $strModule;
        $beanSavedSearch->contents = base64_encode(serialize($arySearchQuery));
        $beanSavedSearch->assigned_user_id = $current_user->id;
        $strQuery = 'SELECT id FROM saved_search WHERE deleted = "0" AND assigned_user_id = "' . $current_user->id . '"'
            . ' AND search_module =  "' . $strModule . '" AND name = "' . $strName . '"';
        $rst = $db->query($strQuery);
	if ($row = $db->fetchByAssoc($rst)) {
            $beanSavedSearch->id = $row['id'];
            $strId = $beanSavedSearch->save();
            $GLOBALS['log']->debug('SavedSearch ' . $strName . ' for module ' . $strModule . ' updated for user '
                . $current_user->name . ' [' . $current_user->id . ']: ' . $row['id']);
        }
        else {
            $beanSavedSearch->new_schema = true;
            $strId = $beanSavedSearch->save();
            $GLOBALS['log']->debug('SavedSearch ' . $strName . ' for module ' . $strModule . ' created for user '
                . $current_user->name . ' [' . $current_user->id . ']: ' . $strId);
        }
    }

    /**
     * Creation of StoreQueryfor the current user
     * 
     * @param string $strModule The module on which to create the StoreQuery
     * @param array $arySearchQuery The search to be saved
     */
    private function createStoreQuery($strModule, $arySearchQuery) {
        global $current_user, $db;

        $beanStoreQuery = new StoreQuery();
        $beanStoreQuery->query = $arySearchQuery;
        $beanStoreQuery->SaveQuery($strModule);
    }

}
?>
