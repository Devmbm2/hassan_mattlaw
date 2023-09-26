<?php
	
	global $current_user, $sugar_version, $sugar_config, $beanFiles, $db;
	require_once('include/MySugar/MySugar.php');

	// build dashlet cache file if not found
	if(!is_file($cachefile = sugar_cached('dashlets/dashlets.php'))) {
		require_once('include/Dashlets/DashletCacheBuilder.php');

		$dc = new DashletCacheBuilder();
		$dc->buildCache();
	}
	require_once $cachefile;
	require('modules/Home/dashlets.php');
	$type = 'Home';
	$dashlets_array = array(
		array(
			'users_list' => array(
				// Luisa
				'4ac2a45a-a52c-52d7-9d0f-5b48994e335c', 
				//K. Mitch Espat
				'8202dffa-afd8-2b0e-93ef-59a95bf00a77',
				//Saeed
				'54f0da65-ef55-f73f-88f7-595f9370744a',
			),
			'dashlets' => array(
				array(
					'title' => 'KME Documents',
					'listViewFilters' => 'KME',
					'module' => 'Documents', 
				),
				array(
					'title' => 'KME Pleadings',
					'listViewFilters' => 'KME',
					'module' => 'PLEA_Pleadings', 
				),
				array(
					'title' => 'KME Discovery',
					'listViewFilters' => 'KME',
					'module' => 'DISC_Discovery', 
				),
				array(
					'title' => 'KME Negotiations',
					'listViewFilters' => 'KME',
					'module' => 'NEG_Negotiations', 
				),
			),
		),
		array(
			'users_list' => array(
				//Ann Cox
				'344e151b-f9f3-ece9-4678-59a95cb117ee', 
				//Anita DiGiacomo
				'2f706d89-ee14-839e-318d-59a95cf87304',
				
			),
			'dashlets' => array(
				array(
					'title' => 'AAD Documents',
					'listViewFilters' => 'AAD',
					'module' => 'Documents', 
				),
				array(
					'title' => 'AAD Pleadings',
					'listViewFilters' => 'AAD',
					'module' => 'PLEA_Pleadings', 
				),
				array(
					'title' => 'AAD Discovery',
					'listViewFilters' => 'AAD',
					'module' => 'DISC_Discovery', 
				),
				array(
					'title' => 'AAD Negotiations',
					'listViewFilters' => 'AAD',
					'module' => 'NEG_Negotiations', 
				),
			),
		),
		array(
			'users_list' => array(
				//Matthew D. Powell
				'e4cd5835-f692-69de-3b3a-591598674c54',
 				//Lisa Radziewicz
				'368bfe4c-ae71-349e-9346-5a0c51b7eafe',
				//Cindy Khawaja
				'bed3def3-dbd0-afc8-db90-5ec3d1ed4f2e'
			),
			'dashlets' => array(
				array(
					'title' => 'Matt Incoming Documents not done Case Assigned to Matthew Powell',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_c_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'outgoing_document_advanced' => array('0'),
						'category_id_advanced' => array('Incoming'),
						'search_module' => 'Documents',
						'advanced' => 1,
					),
					'module' => 'Documents', 
				),
				array(
					'title' => 'Matt Incoming Pleadings not done Case Assigned to Matthew Powell',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'outgoing_document_advanced' => array('0'),
						'incoming_or_outgoing_advanced' => array('Incoming'),
						'search_module' => 'PLEA_Pleadings',
						'advanced' => 1,
					),
					'module' => 'PLEA_Pleadings', 
				),
				array(
					'title' => 'Matt Incoming Negotiations not done Case Assigned to Matthew Powell',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'done_advanced' => array('0'),
						'sent_rec_advanced' => array('Received'),
						'search_module' => 'NEG_Negotiations',
						'advanced' => 1,
					),
					'module' => 'NEG_Negotiations', 
				),
				array(
					'title' => 'Matt Incoming Discovery not done Case Assigned to Matthew Powell',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'outgoing_document_advanced' => array('0'),
						'sent_received_advanced' => array('Received'),
						'search_module' => 'DISC_Discovery',
						'advanced' => 1,
					),
					'module' => 'DISC_Discovery', 
				),
				
			),
		),
		// array(
			// 'users_list' => array(
				// //Lisa Radziewicz
				// '368bfe4c-ae71-349e-9346-5a0c51b7eafe',
			// ),
			// 'dashlets' => array(
				// array(
					// 'title' => 'Matt\'s Incoming Not Done Hard Docs',
					// 'listViewFilters' => 'Matt\'s Incoming Not Done Hard Docs',
					// 'module' => 'Documents', 
				// ),
				// array(
					// 'title' => 'Matt\'s Incoming Not Done Pleadings',
					// 'listViewFilters' => 'Matt\'s Incoming Not Done Pleadings',
					// 'module' => 'PLEA_Pleadings', 
				// ),
				// array(
					// 'title' => 'Matt\'s Incoming Not Done Discovery',
					// 'listViewFilters' => 'Matt\'s Incoming Not Done Discoveryl',
					// 'module' => 'DISC_Discovery', 
				// ),
				// array(
					// 'title' => 'Matt\'s Incoming Not Done Negotiations',
					// 'listViewFilters' => 'Matt\'s Incoming Not Done Negotiations',
					// 'module' => 'NEG_Negotiations', 
				// ),
			// ),
		// ),
		array(
			'users_list' => array(
				//Brian Kozlowski
				'556183db-dd5d-578a-5e9e-5af4367f58b9',
			),
			'dashlets' => array(
				array(
					'title' => 'Brian Incoming Pleadings Case Assigned to Brian Kozlowski',
					'listViewFilters' => 'Brian Incoming Pleadings Case Assigned to Brian Kozlowski',
					'module' => 'PLEA_Pleadings', 
				),
				array(
					'title' => 'Brian Incoming Negotations not done Case Assigned to Brian Kozlowski',
					'listViewFilters' => 'Brian Incoming Negotations not done Case Assigned to Brian Kozlowski',
					'module' => 'NEG_Negotiations', 
				),
				array(
					'title' => 'Brian Incoming Discovery not done Case Assigned to Brian Kozlowski',
					'listViewFilters' => 'Brian Incoming Discovery not done Case Assigned to Brian Kozlowski',
					'module' => 'DISC_Discovery', 
				),
				array(
					'title' => 'Brian Incoming Documents not done Case Assigned to Brian Kozlowski',
					'listViewFilters' => 'Brian Incoming Documents not done Case Assigned to Brian Kozlowski',
					'module' => 'Documents', 
				),
				array(
					'title' => 'Matt Incoming Documents not done Case Assigned to Matthew Powell',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_c_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'outgoing_document_advanced' => array('0'),
						'category_id_advanced' => array('Incoming'),
						'search_module' => 'Documents',
						'advanced' => 1,
					),
					'module' => 'Documents', 
				),
				array(
					'title' => 'Matt Incoming Pleadings not done Case Assigned to Matthew Powell',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'outgoing_document_advanced' => array('0'),
						'incoming_or_outgoing_advanced' => array('Incoming'),
						'search_module' => 'PLEA_Pleadings',
						'advanced' => 1,
					),
					'module' => 'PLEA_Pleadings', 
				),
				array(
					'title' => 'Matt Incoming Negotiations not done Case Assigned to Matthew Powell',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'done_advanced' => array('0'),
						'sent_rec_advanced' => array('Received'),
						'search_module' => 'NEG_Negotiations',
						'advanced' => 1,
					),
					'module' => 'NEG_Negotiations', 
				),
				array(
					'title' => 'Matt Incoming Discovery not done Case Assigned to Matthew Powell',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'outgoing_document_advanced' => array('0'),
						'sent_received_advanced' => array('Received'),
						'search_module' => 'DISC_Discovery',
						'advanced' => 1,
					),
					'module' => 'DISC_Discovery', 
				),
			),
		),array(
			'users_list' => array(
 				//Robert Johnson 
				'906a6a67-334e-4f2a-40b8-5d10c084af1a', 
			),
			'dashlets' => array(
				array(
					'title' => 'Robert\'s Incoming Pleadings not done Case Assigned to Robert Johnson',
					'listViewFilters' => 'Robert\'s Incoming Pleadings not done Case Assigned to Robert Johnson',
					'module' => 'PLEA_Pleadings', 
				),
				array(
					'title' => 'Robert\'s Incoming Negotiations not done Case Assigned to Robert Johnson',
					'listViewFilters' => 'Robert\'s Incoming Negotiations not done Case Assigned to Robert Johnson',
					'module' => 'NEG_Negotiations', 
				),
				array(
					'title' => 'Robert\'s Incoming Discovery not done Case Assigned to Robert Johnson',
					'listViewFilters' => 'Robert\'s Incoming Discovery not done Case Assigned to Robert Johnson',
					'module' => 'DISC_Discovery', 
				),
				array(
					'title' => 'Robert\'s Incoming Documents not done Case Assigned to Robert Johnson',
					'listViewFilters' => 'Robert\'s Incoming Documents not done Case Assigned to Robert Johnson',
					'module' => 'Documents', 
				),
				array(
					'title' => 'Matt Incoming Documents not done Case Assigned to Matthew Powell',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_c_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'outgoing_document_advanced' => array('0'),
						'category_id_advanced' => array('Incoming'),
						'search_module' => 'Documents',
						'advanced' => 1,
					),
					'module' => 'Documents', 
				),
				array(
					'title' => 'Matt Incoming Pleadings not done Case Assigned to Matthew Powell',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'outgoing_document_advanced' => array('0'),
						'incoming_or_outgoing_advanced' => array('Incoming'),
						'search_module' => 'PLEA_Pleadings',
						'advanced' => 1,
					),
					'module' => 'PLEA_Pleadings', 
				),
				array(
					'title' => 'Matt Incoming Negotiations not done Case Assigned to Matthew Powell',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'done_advanced' => array('0'),
						'sent_rec_advanced' => array('Received'),
						'search_module' => 'NEG_Negotiations',
						'advanced' => 1,
					),
					'module' => 'NEG_Negotiations', 
				),
				array(
					'title' => 'Matt Incoming Discovery not done Case Assigned to Matthew Powell',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'outgoing_document_advanced' => array('0'),
						'sent_received_advanced' => array('Received'),
						'search_module' => 'DISC_Discovery',
						'advanced' => 1,
					),
					'module' => 'DISC_Discovery', 
				),
			),
		),array(
			'users_list' => array(
 				//Robert Johnson 
				'906a6a67-334e-4f2a-40b8-5d10c084af1a', 
			),
			'dashlets' => array(
				array(
					'title' => 'Robert\'s Incoming Pleadings not done Case Assigned to Robert Johnson',
					'listViewFilters' => 'Robert\'s Incoming Pleadings not done Case Assigned to Robert Johnson',
					'module' => 'PLEA_Pleadings', 
				),
				array(
					'title' => 'Robert\'s Incoming Negotiations not done Case Assigned to Robert Johnson',
					'listViewFilters' => 'Robert\'s Incoming Negotiations not done Case Assigned to Robert Johnson',
					'module' => 'NEG_Negotiations', 
				),
				array(
					'title' => 'Robert\'s Incoming Discovery not done Case Assigned to Robert Johnson',
					'listViewFilters' => 'Robert\'s Incoming Discovery not done Case Assigned to Robert Johnson',
					'module' => 'DISC_Discovery', 
				),
				array(
					'title' => 'Robert\'s Incoming Documents not done Case Assigned to Robert Johnson',
					'listViewFilters' => 'Robert\'s Incoming Documents not done Case Assigned to Robert Johnson',
					'module' => 'Documents', 
				),
				array(
					'title' => 'Matt Incoming Documents not done Case Assigned to Matthew Powell',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_c_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'outgoing_document_advanced' => array('0'),
						'category_id_advanced' => array('Incoming'),
						'search_module' => 'Documents',
						'advanced' => 1,
					),
					'module' => 'Documents', 
				),
				array(
					'title' => 'Matt Incoming Pleadings not done Case Assigned to Matthew Powell',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'outgoing_document_advanced' => array('0'),
						'incoming_or_outgoing_advanced' => array('Incoming'),
						'search_module' => 'PLEA_Pleadings',
						'advanced' => 1,
					),
					'module' => 'PLEA_Pleadings', 
				),
				array(
					'title' => 'Matt Incoming Negotiations not done Case Assigned to Matthew Powell',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'done_advanced' => array('0'),
						'sent_rec_advanced' => array('Received'),
						'search_module' => 'NEG_Negotiations',
						'advanced' => 1,
					),
					'module' => 'NEG_Negotiations', 
				),
				array(
					'title' => 'Matt Incoming Discovery not done Case Assigned to Matthew Powell',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'outgoing_document_advanced' => array('0'),
						'sent_received_advanced' => array('Received'),
						'search_module' => 'DISC_Discovery',
						'advanced' => 1,
					),
					'module' => 'DISC_Discovery', 
				),
			),
		),
	);
	foreach($dashlets_array AS $dashlets_data){
		$dashlets_add = array();
		foreach($dashlets_data['dashlets'] AS $dashlet_options){
			$ht_module_name = $dashlet_options['module'];
			$module_class = ($ht_module_name == 'Documents') ? 'MyDocuments' : $ht_module_name;
			require_once('custom/modules/'.$ht_module_name.'/metadata/listviewdefs.php');
			$displayColumns = array();
			foreach($listViewDefs[$ht_module_name] AS $field => $field_data){
				$displayColumns[] = strtolower($field);
			}
			unset($dashlet_options['module']);
			$dashlet_options['displayColumns'] = $displayColumns;
			$dashlet_options['myItemsOnly'] = false;
			$dashlet_options['displayRows'] = 0;
			$dashlet_options['autoRefresh'] = -1;
			$dashlets_add[create_guid()] = array(
				'className' => $dashletsFiles[$module_class.'Dashlet']['class'],
				'module' => $ht_module_name,
				'fileLocation' => $dashletsFiles[$module_class.'Dashlet']['file'],
				'options' => $dashlet_options,
			);
		}
		
		foreach($dashlets_data['users_list'] AS $id){
			
			$user = array();
			$user = BeanFactory::getBean('Users',$id);
			$existingPages = $user->getPreference('pages',$type);
			$existingDashlets = $user->getPreference('dashlets', $type);
			$dashboardPage = array();
			$numberColumns = 1;
			$pageName = 'Incoming Documents';

			$pagecolumns[0] = array();
			$pagecolumns[0]['dashlets'] = array();
			$pagecolumns[0]['width'] = '100%';
			foreach($existingPages as $pid=>$page) {
				if($page['pageTitle'] == $pageName){
					foreach($page['columns'][0]['dashlets'] as $rm_dashlet) {
						unset($existingDashlets[$rm_dashlet]);
					}
				}
			}
			foreach($dashlets_add as $guid=>$dashlet) {
				array_push($pagecolumns[0]['dashlets'], $guid);
			}
			$dashboardPage['columns'] = $pagecolumns;
			$dashboardPage['pageTitle'] = $pageName;
			$dashboardPage['numColumns'] = $numberColumns;
			$notfound = true;
			foreach($existingPages as $pid=>$page) {
				if($page['pageTitle'] == $pageName){
					$existingPages[$pid] = $dashboardPage;
					$notfound = false;
				}
			}
			if($notfound) {
				array_push($existingPages,$dashboardPage);
			}
			$all_dashlets = array_merge($existingDashlets,$dashlets_add);
			$user->setPreference('pages', $existingPages, 0, $type);
			$user->setPreference('dashlets', $all_dashlets, 0, $type);
			$user->save();
		}
	}
	die('DONE');
?>