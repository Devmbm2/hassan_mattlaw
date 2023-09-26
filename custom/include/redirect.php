<?php
	class redirect {

		function after_subpanel_save(&$bean, $event, $arguments)
		{
			$link_fields = array(
			    // Contacts
				'Accounts' => array('accounts_contacts' => 'contacts'),
				'Accounts' => array('documents_accounts' => 'documents'),
				'Accounts' => array('account_leads' => 'leads'),
				'Accounts' => array('member_accounts' => 'accounts'),
				
				'Cases' => array('account_cases' => 'accounts'),
				'Accounts' => array('account_cases' => 'cases'),
				//Cases
				'Contacts' => array('contacts_cases' => 'cases'),
				'Contacts' => array('contact_direct_reports' => 'contacts'),
				'Contacts' => array('documents_contacts' => 'documents'),
				'Contacts' => array('contact_leads' => 'leads'),
				//'documents_contacts' => 'soft_documents',
				// Leads
				'Leads' => array('leads_documents' => 'hard_documents'),
				'Leads' => array('leads_documents' => 'soft_documents'),
				
				// Discovery
				'DISC_Discovery' => array('disc_discovery_disc_discovery_1' => 'disc_discovery_disc_discovery_1disc_discovery_ida'),
				
				
				'DHA_PlantillasDocumentos' => array('dha_plantillasdocumentos_tasks_1' => 'dha_plantillasdocumentos_tasks_1'),
				
			);
			if(isset($_REQUEST['return_id']) && !empty($_REQUEST['return_id'])){
				if( $_REQUEST['parent_type'] == 'Cases' && $_REQUEST['module'] == 'Tasks'){
					$_REQUEST['relate_to'] = 'activities';
				}
				if($_REQUEST['parent_type'] == 'Cases' &&  ($_REQUEST['module'] == 'Notes' || $_REQUEST['module'] == 'Calls')){
					$_REQUEST['relate_to'] = 'history';
				}
				$_REQUEST['relate_to'] = isset($link_fields[$_REQUEST['return_module']][$_REQUEST['relate_to']]) && !empty($link_fields[$_REQUEST['return_module']][$_REQUEST['relate_to']]) ? $link_fields[$_REQUEST['return_module']][$_REQUEST['relate_to']] : $_REQUEST['relate_to']; 
				
				// SugarApplication::redirect('index.php?module='.$_REQUEST['return_module'].'&action='.$_REQUEST['return_action'].'&record='.$_REQUEST['return_id'].'&relate_to='.$_REQUEST['relate_to']. '&offset=1');
			}
			
		}

	}