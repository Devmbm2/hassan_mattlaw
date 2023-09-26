<?php
	
	global $current_user, $sugar_version, $sugar_config, $beanFiles, $db, $app_list_strings;
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
	$case_status = $app_list_strings['case_status_dom'];
	unset($case_status['Closed']);
	$case_status = array_keys($case_status);
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
					'title' => 'KME OverDue Tasks',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('K. Mitch Espat'),
						'status_advanced' => array('overdue'),
						'case_status_advanced' => $case_status,
						'search_module' => 'Tasks',
						'advanced' => 1,
					),
					'module' => 'Tasks', 
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
					'title' => 'Anita DiGiacomo OverDue Tasks',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Anita DiGiacomo'),
						'status_advanced' => array('overdue'),
						'case_status_advanced' => $case_status,
						'search_module' => 'Tasks',
						'advanced' => 1,
					),
					'module' => 'Tasks', 
				),
			
			),
		),
		array(
			'users_list' => array(
				//Matthew D. Powell
				'e4cd5835-f692-69de-3b3a-591598674c54',
 				//Lisa
				'368bfe4c-ae71-349e-9346-5a0c51b7eafe',
 				//Brian
				'556183db-dd5d-578a-5e9e-5af4367f58b9',
 				//Robert
				'906a6a67-334e-4f2a-40b8-5d10c084af1a',
			),
			'dashlets' => array(
				array(
					'title' => 'Matt\'s OverDue Tasks with Case Status "Lit" or "Appeal"',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_advanced' => array('Lit_1', 'Lit_2', 'Lit_3', 'Lit_4', 'Lit_5', 'Lit_6', 'Lit_7', 'Lit_8', 'Appeal_Pending'),
						'status_advanced' => array('overdue'),
						'search_module' => 'Tasks',
						'advanced' => 1,
					),
					'module' => 'Tasks', 
				),
			),
		),
		array(
			'users_list' => array(
				//Chance
				'6576acd9-8045-162d-229f-59a95b0970a8',
 				//Meghan
				'67d4c695-9336-7e7d-2161-59a95d6a5ec5',
				//Jackson Sanger
				'e9879027-ef7a-884e-6a39-5cc7381ed67b',
 				//John
				'38f268b8-1ef7-9fab-045f-59a95dcb107b',
 				//Tiffany
				'16e755c2-368a-acdf-3128-59a95c79f4d9',
			),
			'dashlets' => array(
				array(
					'title' => 'Matt\'s OverDue Tasks with Case Status "Pre"',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Matthew D. Powell'),
						'case_status_advanced' => array('PreSuit_1', 'Med_Mal_PreSuit_1','Med_Mal_PreSuit_2', 'Med_Mal_PreSuit_3', 'PreSuit_2', 'PreSuit_3', 'PreSuit_4', 'PreSuit_5','PreSuit_5.1','PreSuit_5.2','PreSuit_5.3', 'PreSuit_5.4', 'PreSuit_5.5', 'PreSuit_6', 'PreSuit_6.1', 'PreSuit_6.2', 'PreSuit_6.3', 'PreSuit_6.4', 'PreSuit_6.5', 'PreSuit_6.6'),
						'status_advanced' => array('overdue'),
						'search_module' => 'Tasks',
						'advanced' => 1,
					),
					'module' => 'Tasks',
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
			// ),
		// ),
		array(
			'users_list' => array(
				//Brian Kozlowski
				'556183db-dd5d-578a-5e9e-5af4367f58b9',
			),
			'dashlets' => array(
				array(
					'title' => 'Brian OverDue Tasks',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Brian Kozlowski'),
						'status_advanced' => array('overdue'),
						'case_status_advanced' => $case_status,
						'search_module' => 'Tasks',
						'advanced' => 1,
					),
					'module' => 'Tasks',
				),
				
			),
		),
		array(
			'users_list' => array(
 				//Robert Johnson 
				'906a6a67-334e-4f2a-40b8-5d10c084af1a', 
			),
			'dashlets' => array(
				array(
					'title' => 'Robert OverDue Tasks',
					'listViewFilters' => array(
						'searchFormTab' => 'advanced_search',
						'query' => 'true',
						'assigned_lawyer_cases_advanced' => array('Robert Johnson'),
						'status_advanced' => array('overdue'),
						'case_status_advanced' => $case_status,
						'search_module' => 'Tasks',
						'advanced' => 1,
					),
					'module' => 'Tasks',
				),
			),
		),
	);
	foreach($dashlets_array AS $dashlets_data){
		$dashlets_add = array();
		foreach($dashlets_data['dashlets'] AS $dashlet_options){
			$ht_module_name = $dashlet_options['module'];
			$module_class = ($ht_module_name == 'Tasks') ? 'MyTasks' : $ht_module_name;
			require_once('custom/modules/'.$ht_module_name.'/metadata/dashletviewdefs.php');
			$displayColumns = array();
			foreach($dashletData[$ht_module_name.'Dashlet']['columns'] AS $field => $field_data){
				$displayColumns[] = strtolower($field);
			}
			unset($dashlet_options['module']);
			$dashlet_options['displayColumns'] = $displayColumns;
			$dashlet_options['myItemsOnly'] = false;
			$dashlet_options['displayRows'] = 50;
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
			$pageName = 'Tasks OverDue';

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
				//Add ListView Filters
				$this->listViewFilters = addslashes($this->listViewFilters);
				$query = "SELECT id FROM `saved_search` WHERE deleted = 0 AND assigned_user_id = '{$id}' AND search_module = '{$dashlet['module']}' AND name LIKE '%{$dashlet['options']['title']}%';";
				$result = $db->query($query);  
				$contents = base64_encode(serialize($dashlet['options']['listViewFilters']));
				if($result->num_rows > 0){
					$row = $db->fetchByAssoc($result);
					$db->query("UPDATE `saved_search` SET contents = '{$contents}' WHERE deleted = 0 AND id ='{$row['id']}';");
				}else{
					$db->query("INSERT INTO `saved_search` (id, date_entered, date_modified, name, deleted, contents, search_module, assigned_user_id) VALUES (UUID(), '2020-02-13 03:23:00', '2020-02-13 03:23:00', '{$dashlet['options']['title']}', '0', '{$contents}', '{$dashlet['module']}', '{$id}');");
				}
			}
			$dashboardPage['columns'] = $pagecolumns;
			$dashboardPage['pageTitle'] = $pageName;
			$dashboardPage['numColumns'] = $numberColumns;
			$notfound = true;
			// print"<pre>";print_r($existingPages);die;
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