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
				//Lisa Radziewicz
				'368bfe4c-ae71-349e-9346-5a0c51b7eafe',
			),
			'dashlets' => array(
				array(
					'title' => "Brian's Soft Documents",
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Brian Kozlowski'),
						'hard_or_soft_doc_advanced' => array('Soft_Documents'),
						'search_module' => 'Documents',
						'advanced' => 1,
					),
					'module' => 'Documents', 
				),
				array(
					'title' => "Brian's Hard Documents",
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Brian Kozlowski'),
						'hard_or_soft_doc_advanced' => array('Hard_Documents'),
						'search_module' => 'Documents',
						'advanced' => 1,
					),
					'module' => 'Documents', 
				),
				array(
					'title' => "Brian's Negotiations",
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Brian Kozlowski'),
						'search_module' => 'NEG_Negotiations',
						'advanced' => 1,
					),
					'module' => 'NEG_Negotiations', 
				),	
				array(
					'title' => "Brian's Pleadings",
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Brian Kozlowski'),
						'search_module' => 'PLEA_Pleadings',
						'advanced' => 1,
					),
					'module' => 'PLEA_Pleadings', 
				),
				array(
					'title' => "Brian's Discovery",
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Brian Kozlowski'),
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
			$pageName = "Brian's Documents";

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